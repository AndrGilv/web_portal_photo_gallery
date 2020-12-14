<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Debugbar;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
//        $photos = Photo::all();
        $photos = Photo::orderByDesc('date')->paginate(15);
        /*Debugbar::info($object);
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');*/
        return view('home', ['photos'=> $photos]);
    }
}
