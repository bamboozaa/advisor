<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academic;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $academics = Academic::all();
        return view('home', compact('academics'));
    }
}
