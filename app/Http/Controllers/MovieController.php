<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Seat;
use App\Models\Ticket;
use App\Repositories\MovieRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    private $ticket;
    private $seat;

    public function __construct()
    {
        $this->ticket = new MovieRepository(new Ticket);
        $this->seat = new MovieRepository(new Seat);
    }

    public function create(Request $request)
    {
        $statement = Ticket::whereRaw("movie_id = $request->movie_id AND seat_id = $request->seat_id")->first();
        if ($statement) {
            return response(['message' => 'this seat is been!'], 400);
        } else {
            return $this->ticket->create($request);
        }
    }

    public function report()
    {
        return $this->seat->report();
    }
}
