<?php

namespace App\Helpers;

use App\Models\Exam;
use App\Models\Student;
use App\Models\Subject;
use App\Utilities\ExamUtil;
use Illuminate\Support\Facades\DB;

class ExamHelper
{
    private $mean;
    private $subject_total;

    public function __construct()
    {
        
    }

    public function update_marklist()
    {
        $students = Student::get();
        $subjects = Subject::get();
        $session = ExamUtil::get_current_term();
        $results = [];


        foreach ($subjects as $subject) {
            foreach ($students as $student) {
                $marks_total = 0;
                $cats_total = 0;

                $cats =  Exam::where('students_id', $student->id)
                    ->where('subject', $subject->id)
                    ->where('session', $session)
                    ->where(function ($query) {
                        $query->where('exam_type', '=', 1)
                            ->orWhere('exam_type', '=', 2);
                    })
                    ->sum('marks');
                $cats_out_of = Exam::where('students_id', $student->id)
                    ->where('subject', $subject->id)
                    ->where('session', $session)
                    ->where(function ($query) {
                        $query->where('exam_type', '=', 1)
                            ->orWhere('exam_type', '=', 2);
                    })
                    ->sum('out_of');
                $cats_total = $cats / $cats_out_of * 30;

                // full paper
                if ($student->class < 3) {
                    $finals = Exam::where('students_id', $student->id)
                        ->where('subject', $subject->id)
                        ->where('session', $session)
                        ->where('exam_type', 6)
                        ->first();

                    $marks_total = ($finals->marks / $finals->out_of) * 70;
                } else {
                    $final = Exam::where('students_id', $student->id)
                        ->where('subject', $subject->id)
                        ->where('session', $session)
                        ->where(function ($query) {
                            $query->where('exam_type', '=', 3)
                                ->orWhere('exam_type', '=', 4)
                                ->orWhere('exam_type', '=', 5);
                        })
                        ->sum('marks');

                    $tot = Exam::where('students_id', $student->id)
                        ->where('subject', $subject->id)
                        ->where('session', $session)
                        ->where(function ($query) {
                            $query->where('exam_type', '=', 3)
                                ->orWhere('exam_type', '=', 4)
                                ->orWhere('exam_type', '=', 5);
                        })
                        ->sum('out_of');

                    $tot = $tot + 1;
                    $marks_total = $final /  $tot * 70;
                }
            }

           
        }
    }
}
