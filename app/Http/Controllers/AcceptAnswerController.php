<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    //
    public function __invoke(Answer $answer)
    {
        # code...
        $this->authorize('accept', $answer);
        $answer->question->acceptBestAnswer($answer);
        return back();
    }
}
