<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($scheme)
    {
        $scheme = Scheme::where('slug', $scheme)->first();
        $slug = "none";
        if($scheme)
        {
            $slug = $scheme->slug;
        }

        return view('home', compact('slug'));
    }
}
