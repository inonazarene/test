<?php

namespace App\Http\Controllers;

use App\PhotoTag;
use Image;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth')->except('show');
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

            $name = str_replace('', '_', $user->name);

            $image = $name.'_'.uniqid().'.'.$image_extension;

            // $image_location ='public/photos';
            $file = Image::make($file)->resize(768, 1024);


            $request->file->move(public_path('photos'), $image);

            Photo::create([
                'filename'=>'/photos/'.$image,
                'filesize'=>formatSizeUnits($file->filesize()),
                'user_id'=>$user->user_id,
                'width'=>$file->width(),
                'height'=>$file->height()
            ]);

        }

        return ['success'=>'Photo has been uploaded.'];

    }
    public function storeTags(Request $request)
    {
        $request->validate([
            'tag'=>'required|alpha|max:255|min:3'
        ]);

        $tag = PhotoTag::create($request->all());

        return back();
    }

    public function show(Request $request)
    {
        $skip = $request->skip;
        $photos = Photo::with('tags')->skip($skip)->take(10)->get();

        return $photos->toArray();
    }
}
