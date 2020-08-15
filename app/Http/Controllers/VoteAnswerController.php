<?php

namespace App\Http\Controllers;
use App\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{
    //
    public function __construct()
    {
        # code...
        $this->middleware('auth');
    }

    public function __invoke(Answer $answer)
    {
        # code...
        $vote = (int) request()->vote;

        auth()->user()->voteAnswer($answer, $vote);
        return back();
    }
}
