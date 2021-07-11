<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\FormClass;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;

class PdfController extends Controller
{
    //

    public function student_report(Request $request)
    {
        $data = [];
        $student = Student::find($request->student);
        $data['student'] = $student;
        $data['exam_types'] = ExamType::get();
        $data['subjects'] = Subject::get();
        $data['class'] = FormClass::find($student->class);
        $branch = Branch::find($student->branch);
        $data['branch'] = $branch;
        $data['logo'] = File::get(public_path('img/branches/' . $branch->logo_path . '.txt'));

        $pdf = PDF::loadView('forms.student',  $data);
        return $pdf->download($student->fname." ".$student->lname .".pdf");
    }
}
