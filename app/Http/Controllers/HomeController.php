<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academic;
use App\Models\Advisor;
use App\Models\Student;
use App\Models\Project;

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
        $advisors_project = Project::select('adv_id')->distinct()->get();
        $academics = Academic::all();
        $advisors = Advisor::where('status', 1)->get();
        $students = Student::all();
        $students_pass = Project::select('student_id')->where('project_status', 1)->get();
        $gs = Student::where('dep_id', 1)->get();
        $gs_pass = Student::join('projects', 'students.student_id', '=', 'projects.student_id')->where('dep_id', 1)->where('projects.project_status', 1)->get();
        $ism = Student::where('dep_id', 2)->get();
        $ism_pass = Student::join('projects', 'students.student_id', '=', 'projects.student_id')->where('dep_id', 2)->where('projects.project_status', 1)->get();
        $exs = Student::where('dep_id', 3)->get();
        $exs_pass = Student::join('projects', 'students.student_id', '=', 'projects.student_id')->where('dep_id', 3)->where('projects.project_status', 1)->get();
        $tcism = Student::where('dep_id', 4)->get();
        $tcism_pass = Student::join('projects', 'students.student_id', '=', 'projects.student_id')->where('dep_id', 4)->where('projects.project_status', 1)->get();
        $harbour = Student::where('dep_id', 5)->get();
        return view('home', compact('academics', 'advisors', 'students', 'gs', 'ism', 'exs', 'tcism', 'harbour', 'advisors_project', 'students_pass', 'gs_pass', 'ism_pass', 'exs_pass', 'tcism_pass'));
    }
}
