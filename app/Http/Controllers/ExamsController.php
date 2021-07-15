<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 3000);

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
use Illuminate\Filesystem\Filesystem;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $exam_data['students'] = Student::where('branch', $branch)->where('class', $request->clss)->orderBy('adm_no', 'ASC')->get();

        // $filled = ExamUtil::check_if_filled($subject, $request->cass, $exam_type, $branch);
        return view('exams.partials.exam-list', $exam_data)->render();
    }

    public function reports()
    {
        $data = [];
        $data['classes'] = FormClass::get();
        $data['session'] = ExamUtil::get_current_term();

        return view('forms.create', $data);
    }

    public function generate_batch(Request $request)
    {
        $pdfMerger = PDFMerger::init();
        $i = 0;

        $data['exam_types'] = ExamType::get();
        $data['subjects'] = Subject::get();
        // $examinations = Exam::where('class', $request->class)->where('session', $request->session)->get();
        $students = Student::where('class', $request->class)->get();

        foreach ($students as $student) {
            $data['student'] = $student;
            $data['exam_types'] = ExamType::get();
            $data['subjects'] = Subject::get();
            $data['class'] = FormClass::find($student->class);
            $branch = Branch::find($student->branch);
            $data['branch'] = $branch;
            $data['logo'] = File::get(public_path('img/branches/' . $branch->logo_path . '.txt'));

            $pdf = PDF::loadView('forms.student',  $data);
            // $pdf->download(public_path($student->fname . " " . $student->lname . ".pdf"));
            $fd = public_path('forms/' . trim($data['class']->name));

            if (!File::exists($fd)) {
                File::makeDirectory($fd, 0777, true, true);
            }


            $pdf->save($fd . '/' .  trim($student->fname) . " " . trim($student->lname) .  '.pdf');
            $pdfMerger->addPDF($fd . '/' .  trim($student->fname) . " " . trim($student->lname) .  '.pdf');
            $i++;
        }

        $pdfMerger->merge();
        $clss = FormClass::find($request->class);
        $pdfMerger->save($clss->name . ".pdf", "browser");

        $file = new Filesystem;
        $file->cleanDirectory(public_path('forms'));
    }
}
