<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Seat;
use App\Repositories\MovieRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $movie = Movie::select('id', 'title', 'release_year', 'play_time')->with('ticket')->get();
        $seat = Seat::select('id', 'number')->with('ticket')->get();
        if (Auth::check()){
            $user = Auth::user()->id;
        }else $user = 0;

        return view('home', compact('movie', 'seat', 'user'));

    }


}
