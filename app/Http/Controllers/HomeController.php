<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Student;
use App\Models\Subject;
use App\Utilities\ExamUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data  = [];
        $data['branches'] = Branch::get();
        $data['subjects'] = Subject::count();
        $data['session'] = ExamUtil::get_current_term();
        $data['students'] = Student::orderBy('adm_no', 'DESC');
        return view('home', $data);
    }
}
