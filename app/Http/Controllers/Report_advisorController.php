<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advisor;
use App\Models\Student;
use App\Models\Project;
use App\Models\Faculty;
use App\Models\Qualification;
use App\Models\Academic;
use Illuminate\Support\Facades\Auth;

class Report_advisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $advisors = Advisor::all();

        if (!is_null($request->input('status'))) $advisors = Advisor::where('status', $request->input('status'))->get();

        if (!is_null($request->input('project_status'))) $advisors = Advisor::join('projects', 'advisors.adv_id', '=', 'projects.adv_id')->where('projects.project_status', $request->input('project_status'))->select('advisors.*', 'projects.adv_id')->distinct()->get();

        if (!is_null($request->input('project'))) $advisors = Advisor::join('projects', 'advisors.adv_id', '=', 'projects.adv_id')->where('projects.project', $request->input('project'))->select('advisors.*', 'projects.adv_id')->distinct()->get();

        return view('reports.advisors.index', compact('advisors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Advisor $report_advisor)
    {
        return view('reports.advisors.show', compact('report_advisor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advisor $report_advisor)
    {
        $academics = Academic::pluck('academic', 'id');
        $qualifications = Qualification::pluck('qualification', 'id');
        return view('reports.advisors.edit', compact('report_advisor', 'academics', 'qualifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advisor $report_advisor)
    {
        $report_advisor->update($request->all());

        session()->flash('success', 'Advisor updated successfully.');

        \Log::info("Advisor " . $request->adv_fname . " " . $request->adv_lname . " Update finished by " . Auth::user()->name);

        return redirect()->route('report-advisors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advisor $report_advisor)
    {
        $report_advisor->delete();

        \Log::info("Advisor " . $report_advisor->adv_id  . " Delete finished by " . Auth::user()->name);

        session()->flash('success', 'Advisor deleted successfully.');

        return redirect()->route('report-advisors.index');
    }
}
