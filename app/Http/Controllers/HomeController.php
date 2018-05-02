<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $data  = $request->validate([
            'filename'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        dd($data);

//        if ($request->hasFile('filename')){
//
//            dd($file);
//        }
    }
}
