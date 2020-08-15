<?php

namespace App\Http\Controllers;
use App\Question;
use App\User;

use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    //
    public function __construct()
    {
        # code...
        $this->middleware('auth');
    }

    public function __invoke(Question $question)
    {
        # code...
        $vote = (int) request()->vote;

        auth()->user()->voteQuestion($question, $vote);
        return back();
    }
}
