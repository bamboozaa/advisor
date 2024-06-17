<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Academic;
use App\Models\Project;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;

class AdvisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advisors = Advisor::all();
        return view('advisors.index', compact('advisors'));
        // return view('advisors.index', ['advisors' => $advisors->toQuery()->paginate(10)]);
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
        // return $advisor->adv_id;
        $thesis = Project::where([
            ['adv_id', $advisor->adv_id],
            ['project', 1],
            ['project_status', 0],
        ])->get();
        $is = Project::where([
            ['adv_id', $advisor->adv_id],
            ['project', 2],
            ['project_status', 0],
        ])->get();

        // return count($is);

        $academic1 = Advisor::select('adv_id')->where('adv_id', $advisor->adv_id)->where(function ($query) {
            $query->where('aca_id', 1)->orWhere('aca_id', 2);
        })->exists();

        $academic2 = Advisor::select('adv_id')->where('adv_id', $advisor->adv_id)->where([
            ['aca_id', 3],
            ['qua_id', 1],
        ])->exists();

        $academic3 = Advisor::select('adv_id')->where('adv_id', $advisor->adv_id)->whereNot(function ($query) {
            $query->where('aca_id', 1)->orWhere('aca_id', 2)->orWhere('aca_id', 3);
        })->where('qua_id', 1)->exists();

        if ($academic1 == 1 || $academic2 == 1) {
            // return $academic1 or $academic2;
            // thisis
            $quota_thesis = (10  - ceil((count($is))/3))- count($thesis);
            // return $quota_thesis2;

            // is
            if (count($thesis) === 0) {
                $quota_is = 15 - count($is);
            }

            if (count($thesis) > 0) {
                $p = (10 - count($thesis)) * 3;
                $q = count($thesis) + $p;
                if ($q <= 15) {
                    if (($p - count($is)) <= 0) {
                        $quota_is = 0;
                    } else {
                        $quota_is = $p - count($is);
                    }
                } else {
                    $quota_is = ($q + count($thesis)) - 15 - count($is);
                }
            }
        }

        if ($academic3 == 1) { //การค้นคว้าอิสระ อาจารย์ ดร.
            //thisis
            $quota_thesis = (5 - ceil(count($is)/3)) - count($thesis);
            // return $quota_thesis;

            // is
            if (count($thesis) === 0) {
                $quota_is = 15 - count($is);
            }

            if (count($thesis) > 0) {
                $quota_is = (15 - count($is)) - (count($thesis) * 3);
            }
        }

        return view('advisors.show', compact('advisor', 'quota_is', 'quota_thesis'));
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

        \Log::info("Advisor " . $request->adv_fname . " " . $request->adv_lname . " Update finished by " . Auth::user()->name);

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
