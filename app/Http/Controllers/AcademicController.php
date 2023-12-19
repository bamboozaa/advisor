<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academics = Academic::all();
        return view('academics.index', compact('academics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'academic' => 'required|unique:academics',
            'abbreviation' => 'required',
        ]);

        Academic::create($request->all());

        session()->flash('success', 'Academic created successfully.');

        return redirect()->route('academics.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Academic $academic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academic $academic)
    {
        return view('academics.edit', compact('academic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academic $academic)
    {
        $academic->update($request->all());

        session()->flash('success', 'Academic updated successfully.');

        return redirect()->route('academics.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academic $academic)
    {
        $academic->delete();

        session()->flash('success', 'Academic deleted successfully.');

        return redirect()->route('academics.index');
    }
}
