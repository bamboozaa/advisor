<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academic;
use App\Models\Advisor;
use App\Models\Student;

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
        $academics = Academic::all();
        $advisors = Advisor::all();
        $students = Student::all();
        $gs = Student::where('dep_id', 1)->get();
        $ism = Student::where('dep_id', 2)->get();
        $exs = Student::where('dep_id', 3)->get();
        $tcism = Student::where('dep_id', 4)->get();
        $harbour = Student::where('dep_id', 5)->get();
        return view('home', compact('academics', 'advisors', 'students', 'gs', 'ism', 'exs', 'tcism', 'harbour'));
    }
}
