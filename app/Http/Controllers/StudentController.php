<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Advisor;
use App\Models\Project;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        // $students = Student::where('dep_id', $id)->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::pluck('dep_name', 'id');
        $faculties = Faculty::pluck('fac_name', 'id');
        $majors = Major::pluck('major_name', 'id');
        // $advisors = Advisor::selectRaw("CONCAT (adv_fname, ' ', adv_lname) as fullname, adv_id")->pluck('fullname', 'adv_id');
        $advisors = DB::table("advisors")
        ->leftJoin('academics', 'academics.id' , '=', 'advisors.aca_id')
        ->join('qualifications', 'qualifications.id', '=', 'advisors.qua_id')
        ->selectRaw("CONCAT (CASE WHEN academics.academic IS NULL THEN '' ELSE academics.academic END, ' ', qualifications.abbreviation, ' ', adv_fname, ' ', adv_lname) as fullname, advisors.adv_id")
        ->pluck('fullname', 'advisors.adv_id');
        return view('students.create', compact('advisors', 'departments', 'faculties', 'majors'));
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
            // 'facultyname' => 'required',
            'dep_id' => 'required',
            'fac_id' => 'required',
            // 'programname' => 'required',
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
            // 'facultyname' => $request->facultyname,
            'dep_id' => $request->dep_id,
            'fac_id' => $request->fac_id,
            // 'programname' => $request->programname,
            'major' => $request->major,
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

        \Log::info("student id : " . $request->student_id . " Create finished by " . Auth::user()->name);

        // return redirect()->route('students.index');
        return redirect()->route('advisors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $departments = Department::pluck('dep_name', 'id');
        $faculties = Faculty::pluck('fac_name', 'id');
        $majors = Major::pluck('major_name', 'id');
        $advisors = DB::table("advisors")
        ->leftJoin('academics', 'academics.id' , '=', 'advisors.aca_id')
        ->join('qualifications', 'qualifications.id', '=', 'advisors.qua_id')
        ->selectRaw("CONCAT (CASE WHEN academics.academic IS NULL THEN '' ELSE academics.academic END, ' ', CASE WHEN qualifications.abbreviation IS NULL THEN '' ELSE qualifications.abbreviation END, ' ', adv_fname, ' ', adv_lname) as fullname, advisors.adv_id")
        ->pluck('fullname', 'advisors.adv_id');
        return view('students.show', compact('student', 'advisors', 'departments', 'faculties', 'majors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $departments = Department::pluck('dep_name', 'id');
        $faculties = Faculty::pluck('fac_name', 'id');
        $advisors = DB::table("advisors")
        ->leftJoin('academics', 'academics.id' , '=', 'advisors.aca_id')
        ->join('qualifications', 'qualifications.id', '=', 'advisors.qua_id')
        ->selectRaw("CONCAT (CASE WHEN academics.academic IS NULL THEN '' ELSE academics.academic END, ' ', CASE WHEN qualifications.abbreviation IS NULL THEN '' ELSE qualifications.abbreviation END, ' ', adv_fname, ' ', adv_lname) as fullname, advisors.adv_id")
        ->pluck('fullname', 'advisors.adv_id');
        return view('students.edit', compact('student', 'advisors', 'departments', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $student_id = $request->student_id;
        $project = Project::where('student_id', $student_id);
        $data1 = [
            'student_id' => $request->student_id,
            'std_title' => $request->std_title,
            'std_fname' => $request->std_fname,
            'std_lname' => $request->std_lname,
            // 'facultyname' => $request->facultyname,
            'dep_id' => $request->dep_id,
            'fac_id' => $request->fac_id,
            // 'programname' => $request->programname,
            'major' => $request->major,
            'academic_year' => $request->academic_year,
            'semester' => $request->semester,
            'status' => $request->status,
        ];

        $data2 = [
            'student_id' => $request->student_id,
            // 'adv_id' => $request->adv_id,
            // 'project' => $request->project,
            'title_research' => $request->title_research,
            'title_research_en' => $request->title_research_en,
            'publisher' => $request->publisher,
            'publishing_year' => $request->publishing_year,
            'project_status' => $request->project_status,
        ];

        $student->update($data1);
        // $student->project->update($data1);
        $project->update($data2);

        session()->flash('success', 'Student updated successfully.');

        \Log::info("Student ID : " . $request->student_id . " Update finished by " . Auth::user()->name);

        return redirect()->route('students.show', $student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        Project::where("student_id", $student->student_id)->delete();

        session()->flash('success', 'Student deleted successfully.');

        \Log::warning("Student ID : " . $student->student_id . " Delete finished by " . Auth::user()->name);

        return redirect()->route('advisors.index');
    }
}
