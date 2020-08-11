<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    //
    public function __construct()
    {
        # code...
        $this->middleware('auth');
    }
    public function store(Question $question)
    {
        # code...
        $question->favourites()->attach(auth()->id());
        return back();
    }

    public function destroy(Question $question)
    {
        # code...
        $question->favourites()->detach(auth()->id());
        return back();
    }
}
