<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Advisor;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $advisors = Advisor::selectRaw("CONCAT (adv_fname, ' ', adv_lname) as fullname, adv_id")->pluck('fullname', 'adv_id');
        $advisors = DB::table("advisors")
        ->leftJoin('academics', 'academics.id' , '=', 'advisors.aca_id')
        ->join('qualifications', 'qualifications.id', '=', 'advisors.qua_id')
        ->selectRaw("CONCAT (CASE WHEN academics.academic IS NULL THEN '' ELSE academics.academic END, ' ', qualifications.abbreviation, ' ', adv_fname, ' ', adv_lname) as fullname, advisors.adv_id")
        ->pluck('fullname', 'advisors.adv_id');
        return view('students.create', compact('advisors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students',
            'std_fname' => 'required',
            'std_lname' => 'required',
            'facultyname' => 'required',
            'programname' => 'required',
            'academic_year' => 'required',
            'semester' => 'required',
            'adv_id' => 'required',
            'project' => 'required',
            'title_research' => 'required',
        ]);



        $data1 = [
            'student_id' => $request->student_id,
            'std_title' => $request->std_title,
            'std_fname' => $request->std_fname,
            'std_lname' => $request->std_lname,
            'facultyname' => $request->facultyname,
            'programname' => $request->programname,
            'academic_year' => $request->academic_year,
            'semester' => $request->semester,
            'status' => $request->status,
        ];

        $data2 = [
            'student_id' => $request->student_id,
            'adv_id' => $request->adv_id,
            'project' => $request->project,
            'title_research' => $request->title_research,
        ];

        Student::create($data1);
        Project::create($data2);

        session()->flash('success', 'Student created successfully.');

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
