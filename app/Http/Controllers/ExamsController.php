<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\FormClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Term;
use App\Utilities\ExamUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //results
        $data = [];
        $data['classes'] =  FormClass::get();
        $data['subjects'] =  Subject::get();
        $data['exam_types'] =  ExamType::get();
        $data['branches'] =  Branch::get();
        $data['terms'] =  Term::get();
        $data['students'] =  Student::orderBY('adm_no');
        $term = ExamUtil::get_current_term();
        $data['current_term'] = $term;
        $results = Exam::where('session', $term);

        return view('exams.results', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [];
        $data['classes'] =  FormClass::get();
        $data['subjects'] =  Subject::get();
        $data['exam_types'] =  ExamType::get();
        $data['branches'] =  Branch::get();

        return view('exams.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->results);
        try {

            // out_of
            $term = ExamUtil::get_current_term();
            $types = json_decode($request->exam_types);
            foreach ($types as $value) {
                $req = "type" . $value;
                DB::table('exam_out_of')->insert(
                    ['exam_type' =>  $value, "out_of" => $request->$req, 'term' => $term['id'], 'created_at' => now(), 'updated_at' => now()]
                );
            }

            // Post results
            $subject = $request->subject;
            $results = $request->results;

            foreach ($results as $value) {
                $exam = json_decode($value);
                $req = "type" . $exam->exam_type;
                $res = new Exam;
                $res->students_id = $exam->student;
                $res->marks = $exam->marks;
                $res->subject = $subject;
                $res->class = $exam->class;
                $res->out_of = $request->$req;
                $res->exam_type = $exam->exam_type;
                $res->session = $term['id'];
                $res->branch_id = $request->branch;
                $res->save();
            }


            flash(trans('reports.insert_success'))->success();
            return redirect()->action([ExamsController::class, 'index']);
        } catch (\Throwable $th) {
            \Log::error($th);
            flash(trans('reports.error'))->error();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $data = [];
        $data['student'] = Student::find($request->student);
        $data['exam_types'] = ExamType::get();
        $data['subjects'] = Subject::get();
        return view('students.results', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }

    public function get_exam_list(Request $request)
    {
        $exam_data = [];

        $exam_data['exam_types'] = json_decode($request->exam_types);
        $exam_data['class'] = FormClass::find($request->clss);
        $subject = $request->subject;
        $exam_data['subject'] = Subject::find($subject);
        $branch = $request->branch;
        $exam_data['branch'] = Branch::find($branch);
        $exam_data['students'] = Student::where('branch', $branch)->where('class', $request->clss)->get();

        // $filled = ExamUtil::check_if_filled($subject, $request->cass, $exam_type, $branch);
        return view('exams.partials.exam-list', $exam_data)->render();
    }
}
