<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advisor;
use App\Models\Project;
use App\Models\Qualification;
use App\Models\Academic;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $advisors = Advisor::all();

        if (!is_null($request->input('status'))) $advisors = Advisor::where('status', $request->input('status'))->get();

        return view('reports.index', compact('advisors'));
        // return view('advisors.index', ['advisors' => $advisors->toQuery()->paginate(10)]);
    }

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

        return view('reports.show', compact('advisor', 'quota_is', 'quota_thesis'));
    }

    public function edit(Advisor $advisor)
    {
        $academics = Academic::pluck('academic', 'id');
        $qualifications = Qualification::pluck('qualification', 'id');
        return view('reports.edit', compact('advisor', 'academics', 'qualifications'));
    }

    public function update(Request $request, Advisor $advisor)
    {
        $advisor->update($request->all());

        session()->flash('success', 'Advisor updated successfully.');

        \Log::info("Advisor " . $request->adv_fname . " " . $request->adv_lname . " Update finished by " . Auth::user()->name);

        return redirect()->route('reports.index');
    }
}
