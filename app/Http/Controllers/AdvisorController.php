<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Academic;
use App\Models\Qualification;
use Illuminate\Http\Request;

class AdvisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advisors = Advisor::all();
        return view('advisors.index', compact('advisors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academics = Academic::pluck('academic', 'id');
        $qualifications = Qualification::pluck('qualification', 'id');
        return view('advisors.create', compact('academics', 'qualifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'adv_id' => 'required|unique:advisors',
            'adv_fname' => 'required',
            'adv_lname' => 'required',
            // 'aca_id' => 'required',
            'qua_id' => 'required',
        ]);

        Advisor::create($request->all());

        session()->flash('success', 'Advisor created successfully.');

        return redirect()->route('advisors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advisor $advisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advisor $advisor)
    {
        $academics = Academic::pluck('academic', 'id');
        $qualifications = Qualification::pluck('qualification', 'id');
        return view('advisors.edit', compact('advisor', 'academics', 'qualifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advisor $advisor)
    {
        $advisor->update($request->all());

        session()->flash('success', 'Advisor updated successfully.');

        return redirect()->route('advisors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advisor $advisor)
    {
        $advisor->delete();

        session()->flash('success', 'Advisor deleted successfully.');

        return redirect()->route('advisors.index');
    }
}
