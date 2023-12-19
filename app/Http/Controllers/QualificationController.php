<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qualifications = Qualification::all();
        return view('qualifications.index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('qualifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'qualification' => 'required|unique:qualifications',
        ]);

        Qualification::create($request->all());

        session()->flash('success', 'Qualification created successfully.');

        return redirect()->route('qualifications.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Qualification $qualification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qualification $qualification)
    {
        return view('qualifications.edit', compact('qualification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qualification $qualification)
    {
        $qualification->update($request->all());

        session()->flash('success', 'Qualification updated successfully.');

        return redirect()->route('qualifications.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qualification $qualification)
    {
        $qualification->delete();

        session()->flash('success', 'Qualification deleted successfully.');

        return redirect()->route('qualifications.index');
    }
}
