<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $data  = $request->validate([
            'file'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('file')){

            $user = Auth::user();

            $file = $request->file('file');

            $image_extension = $file->clientExtension();

            $image = $user->name.'_'.uniqid().'.'.$image_extension;

            $image_location ='public/photo';

            $request->file->storeAs($image_location, $image);

            list($width, $height) = getimagesize($file);


            Photo::create([
                'filename'=>'/photo/'.$image,
                'filesize'=>formatSizeUnits($file->getClientSize()),
                'user_id'=>$user->user_id,
                'width'=>$width,
                'height'=>$height
            ]);

        }

        return back()->with('success','Photo has been uploaded.');

    }

    public function show(Request $request)
    {
        $skip = $request->skip;
        $photos = Photo::skip($skip)->take(2)->get();

        return response()->json($photos);
    }
}
