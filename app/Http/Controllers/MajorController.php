<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use App\Models\Major;
use App\Models\Faculty;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::all();
        return view('majors.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::pluck('fac_name', 'id');
        return view('majors.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMajorRequest $request)
    {
        Major::create($request->all());

        session()->flash('success', 'Major created successfully.');

        return redirect()->route('majors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        $faculties = Faculty::pluck('fac_name', 'id');
        return view('majors.edit', compact('major', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMajorRequest $request, Major $major)
    {
        $major->update($request->all());

        session()->flash('success', 'Major updated successfully.');

        return redirect()->route('majors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        $major->delete();

        session()->flash('success', 'Major deleted successfully.');

        return redirect()->route('majors.index');
    }
}
