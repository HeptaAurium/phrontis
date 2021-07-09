<?php

namespace App\Http\Controllers;

use App\Models\FormClass;
use App\Models\Stream;
use App\Models\Student;
use App\Utilities\SettingsUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\StudentsImport;
use Excel;

class StudentsController extends Controller
{
    public function __construct()
    {
        $global  = [];
        $settings = SettingsUtility::get_all_settings();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(Request $request)
    {
        //
        $data = [];
        $data['darasas'] = FormClass::get();
        $data['streams'] = Stream::get();
        if ($request->ajax()) {

            $students = Student::orderBy('id', 'DESC');

            if ($request->class != "all") {
                $students->where('class', $request->class);
            }

            if ($request->stream != "all") {
                $students->where('stream', $request->stream);
            }

            if (SettingsUtility::allow_both_gender()) {
                if ($request->gender != "both") {
                    $students->where('gender', $request->gender);
                }
            }


            $students = $students->get();

            return DataTables::of($students)
                ->addColumn('full_name', function ($row) {
                    return $row->fname . " " . $row->mname . " " . $row->lname;
                })
                ->addColumn('contact', function ($row) {
                    return $row->parent_phone;
                })
                ->editColumn('class', function ($row) {
                    return FormClass::where('id', $row->class)->pluck('name')->first();
                })
                ->editColumn('stream', function ($row) {
                    return Stream::where('id', $row->stream)->pluck('name')->first();
                })
                ->addColumn('action', function ($row) {
                    $data  = [];
                    $data['row'] = $row;
                    return view('students.partials.index_action', $data)->render();
                })
                ->rawColumns(['full_name', 'contact', 'class', 'stream', 'action'])
                ->make(true);
        }

        return view('students.index', $data);
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
        $data['counties'] = DB::table('counties')->get();
        $data['classes'] = FormClass::get();
        $data['streams'] = Stream::get();

        return view('students.create', $data);
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
        try {

            if ($request->hasFile('file')) {
                // dd($request->file);
                $data = Excel::toCollection(new StudentsImport, request()->file('file'));
                foreach ($data as $dt) {
                    foreach ($dt as $val) {
                        $insertData  = [
                            'adm_no' => $val[0],
                            'doa' => $val[1],
                            'class' => (int)$val[2],
                            'dob' => $val[3],
                            'gender' => $val[4] == "M" ? "male" : "female",
                            'fname' => $val[5],
                            'lname' => $val[6],
                            'parent_fname' => $val[7],
                            'parent_lname' => $val[8],
                            'parent_phone' => "+254" . $val[9],
                            'branch' => 2
                        ];

                        Student::insert($insertData);
                    }
                }
            } else {

                $inputs = $request->except(['_token', 'adm_no']);
                // dd($inputs);

                $student = new Student;

                foreach ($inputs as $key => $value) {
                    $student->$key = $value;
                }

                if ($request->adm_no != "automatic") {
                    $student->adm_no = $request->adm_no;
                }
                $student->save();

                $new = Student::find($student->id);

                if (empty($new->adm_no)) {
                    $len = strlen($new->id);
                    $adm = $new->adm_no;
                    $pow = 4 - $len;
                    $zeros = "";
                    for ($i = 0; $i < $pow; $i++) {
                        $zeros .= '0';
                    }
                    $new->adm_no = $zeros . $new->id;
                    $new->save();
                }
            }
            flash(trans('reports.insert_success'))->success();
        } catch (\Throwable $th) {
            \Log::error($th);
            flash(trans('reports.error'))->error();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
