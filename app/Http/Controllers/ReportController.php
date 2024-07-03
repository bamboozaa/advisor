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
// use Illuminate\Support\Facades\DB;
use DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $advisors = Advisor::all();

        if (!is_null($request->input('status'))) $advisors = Advisor::where('status', $request->input('status'))->get();

        if (!is_null($request->input('project_status'))) $advisors = Advisor::join('projects', 'advisors.adv_id', '=', 'projects.adv_id')->where('projects.project_status', $request->input('project_status'))->select('advisors.*', 'projects.adv_id')->distinct()->get();

        if (!is_null($request->input('project'))) $advisors = Advisor::join('projects', 'advisors.adv_id', '=', 'projects.adv_id')->where('projects.project', $request->input('project'))->select('advisors.*', 'projects.adv_id')->distinct()->get();

        return view('reports.advisors.index', compact('advisors'));
    }

    public function index_students(Request $request)
    {
        // return $request->input('fac_id');
        $students = Student::all()->sortByDesc('created_at')->sortByDesc('updated_at');

        $minYear = Student::select('academic_year')->orderBy('academic_year', 'ASC') ->first();
        $maxYear = Student::select('academic_year')->orderBy('academic_year', 'DESC') ->first();

        $faculties = Faculty::pluck('fac_name', 'id');
        $advisors = DB::table("advisors")
        ->leftJoin('academics', 'academics.id' , '=', 'advisors.aca_id')
        ->join('qualifications', 'qualifications.id', '=', 'advisors.qua_id')
        ->selectRaw("CONCAT (CASE WHEN academics.academic IS NULL THEN '' ELSE academics.academic END, ' ', CASE WHEN qualifications.abbreviation IS NULL THEN '' ELSE qualifications.abbreviation END, ' ', adv_fname, ' ', adv_lname) as fullname, advisors.adv_id")
        ->where('advisors.status', 1)
        ->pluck('fullname', 'advisors.adv_id');
        if (!is_null($request->input('fac_id'))) {
            $students = Student::where('fac_id', $request->input('fac_id'))->get();
        }

        if (!is_null($request->input('academic_year'))) {
            $students = Student::where('academic_year', $request->input('academic_year'))->get();
        }

        if (!is_null($request->input('adv_id'))) {
            $adv_id = $request->input('adv_id');
            $students = Student::join('projects', 'students.student_id', '=', 'projects.student_id')->where('projects.adv_id', $adv_id)->get();
        }

        if (!is_null($request->input('fac_id')) && !is_null($request->input('academic_year'))) {
            $students = Student::where('fac_id', $request->input('fac_id'))->where('academic_year', $request->input('academic_year'))->get();
        }

        return view('reports.students.index', compact('students', 'faculties', 'minYear', 'maxYear', 'advisors'));
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

        return view('reports.advisors.show', compact('advisor', 'quota_is', 'quota_thesis'));
    }

    public function edit(Advisor $advisor)
    {
        $academics = Academic::pluck('academic', 'id');
        $qualifications = Qualification::pluck('qualification', 'id');
        return view('reports.advisors.edit', compact('advisor', 'academics', 'qualifications'));
    }

    public function update(Request $request, Advisor $advisor)
    {
        $advisor->update($request->all());

        session()->flash('success', 'Advisor updated successfully.');

        \Log::info("Advisor " . $request->adv_fname . " " . $request->adv_lname . " Update finished by " . Auth::user()->name);

        return redirect()->route('reports.advisors.index');
    }
}
