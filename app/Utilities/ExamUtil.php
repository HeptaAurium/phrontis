<?php

namespace App\Utilities;

use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Term;
use Illuminate\Support\Facades\DB;

class ExamUtil
{
    static function get_current_term()
    {
        $date = (int)Date('m');
        $year = (int)Date('Y');

        $term = Term::where('begins', '<=', $date)->where('ends', '>=', $date)->where('year', $year)->first();
        if (!empty($term)) {
            return [
                'success' => 1,
                'name' => $term->name . "/" . $term->year,
                'id' => $term->id
            ];
        } else {
            return [
                'success' => 0,
                "message" => "Current Session not defined",
            ];
        }
    }

    static function check_if_filled($subject, $class, $exam_type, $branch)
    {

        $term = Self::get_current_term();
        $filled = Exam::where('session', $term['id'])
            ->where('subject', $subject)
            ->where('class', $class)
            ->where('exam_type', $exam_type)
            ->where('branch_id', $branch)
            ->first();
        // dd($branch);

        return !empty($filled) ? true : false;
    }

    static function get_marks_by_type($student, $class, $subject, $type)
    {

        return Exam::where('students_id', $student)
            ->where('exam_type', $type)
            ->where('subject', $subject)->where('class', $class)
            ->pluck("marks")
            ->first();
    }

    static function get_exam_mean($score)
    {
        $count = count($score);
        $sum = 0;
        foreach ($score as  $val) {
            $sum += $val;
        }

        return $sum / $count;
    }

    static function get_marks_by_class($class, $session, $subject)
    {
        $results = Exam::where('session', $session)
            ->where('class', $class)
            ->where('subject', $subject)
            ->leftJoin('students as st', 'examinations.students_id', 'st.id')
            ->select(
                'st.fname as fname',
                'st.lname as lname',
            )
            ->get();

        return $results;
    }

    static function get_student_mark_list($student, $session, $subject)
    {
        $results = Exam::where('session', $session)
            ->where('students_id', $student)
            ->where('subject', $subject)
            // ->pluck('marks')
            ->get();

        $res = 0;
        $processed_subjects = [];

        foreach ($results as $key) {
            // check if subect is already processed
            if (in_array($key->subject, $processed_subjects)) {
                continue;
            }

            $final = Self::compute_full_papers($key);
            $res += $final;
            array_push($processed_subjects, $key->subject);
        }

        return $res;
    }

    public static function compute_exam_totals($results)
    {
        $mark = $results->marks;
        $type = ExamType::find($results->exam_type);
        $kind = $type->kind;
        $final = 0;
        // dd($type->out_of);
        if ($kind == 'cat') {
            $final = ($mark / $results->out_of) * $type->out_of;
        } elseif ($kind == 'full') {
            $final = ($mark / $results->out_of) * 100;
        } else {
            $final = $mark;
        }
        // dd($final);
        return $final;
    }

    static function compute_cats($results, $total)
    {
        //   Hard coded for now, to be made dynamic later
        return ($results->marks / $results->out_of) * $total;
    }
    static function compute_full_papers($results)
    {
        // Get all papers for the said subject

        $subject = $results->subject;
        $student = $results->students_id;
        $session = $results->session;
        $marks_total = 0;
        $cats_total = 0;

        $cats =  Exam::where('students_id', $student)
            ->where('subject', $subject)
            ->where('session', $session)
            ->where(function ($query) {
                $query->where('exam_type', '=', 1)
                    ->orWhere('exam_type', '=', 2);
            })
            ->sum('marks');
        $cats_out_of = Exam::where('students_id', $student)
            ->where('subject', $subject)
            ->where('session', $session)
            ->where(function ($query) {
                $query->where('exam_type', '=', 1)
                    ->orWhere('exam_type', '=', 2);
            })
            ->sum('out_of');


        $cats_total += $cats / $cats_out_of * 30;


        // full paper
        if ($results->class < 3) {
            $finals = Exam::where('students_id', $student)
                ->where('subject', $subject)
                ->where('session', $session)
                ->where('exam_type', 6)
                ->first();

            $marks_total = ($finals->marks / $finals->out_of) * 70;
        } else {

            $final = Exam::where('students_id', $student)
                ->where('subject', $subject)
                ->where('session', $session)
                ->where(function ($query) {
                    $query->where('exam_type', '=', 3)
                        ->orWhere('exam_type', '=', 4)
                        ->orWhere('exam_type', '=', 5);
                })
                ->sum('marks');

            $tot = Exam::where('students_id', $student)
                ->where('subject', $subject)
                ->where('session', $session)
                ->where(function ($query) {
                    $query->where('exam_type', '=', 3)
                        ->orWhere('exam_type', '=', 4)
                        ->orWhere('exam_type', '=', 5);
                })
                ->sum('out_of');

            // $final = $marks;
            // $tot = $marks->sum('');
            // dd($tot === 0);

            $tot = $tot + 1;
            $marks_total = $final /  $tot * 70;
        }

        return $cats_total + $marks_total;
    }

    static function compute_students_mean_score($student)
    {

        $subjects = Subject::get();
        $session = Self::get_current_term();
        $stud = Student::find($student);
        $mean = 0;
        // dd($session);
        foreach ($subjects as $subject) {
            $mean += Self::get_student_mark_list($student, $session['id'], $subject->id);
        }
        // dd($mean);

        return $mean;
    }

    static function grading_system($mark)
    {
        $mark = floatval(round($mark));
        $grade = Grade::where('from', '<=', $mark)->where('to', '>=', $mark)->pluck('grade')->first();
        return $grade;
    }

    static function convert_to_points($mark, $student)
    {
        $student = Student::find($student);
        return ($mark / ($student->subjects_taking * 100)) * ($student->subjects_taking * 12);
    }

    static function grading_system_points($points, $student)
    {
        $student = Student::find($student);
        $points = ($points  / ($student->subjects_taking * 12)) * 12;
        $points = round($points);
        // return $points;
        if ($points == 12) {
            return "A";
        } elseif ($points >= 11) {
            return 'A-';
        } elseif ($points >= 10) {
            return 'B+';
        } elseif ($points >= 9) {
            return 'B';
        } elseif ($points >= 8) {
            return 'B-';
        } elseif ($points >= 7) {
            return 'C+';
        } elseif ($points >= 6) {
            return 'C';
        } elseif ($points >= 5) {
            return 'C-';
        } elseif ($points >= 4) {
            return 'D+';
        } elseif ($points >= 3) {
            return 'D';
        } elseif ($points >= 2) {
            return 'D-';
        } elseif ($points <= 1) {
            return 'E';
        }
    }

    static function get_student_position($mn, $class)
    {
        // class mean
        $students = Student::where('class', $class)->get();
        $subjects = Subject::get();
        $session = Self::get_current_term();
        $class_mean = [];
        foreach ($students as $student) {
            $mean = 0;
            foreach ($subjects as $subject) {
                $mean += Self::get_student_mark_list($student->id, $session['id'], $subject->id);
            }
            array_push($class_mean, $mean);
        }

        // sort array in descending order
        rsort($class_mean);

        return array_search($mn, $class_mean) + 1;
        // return $mean;
    }

    // indivudual student
    static function get_individual_marklist($student, $subject, $session, $exam_type)
    {

        $marks = Exam::where('students_id', $student)
            ->where('subject', $subject)
            ->where('session', $session)
            ->where('exam_type', $exam_type)
            ->first();

        return !empty($marks) ? $marks->marks : "---";
    }
}
