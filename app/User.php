<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function questions(){

        return $this->hasMany(Question::class);

    }

    public function getUrlAttribute(){
     //   return route('questions.show', $this->id);
     return '#';
    }

    public function answers(){

        return $this->hasMany(Answer::class);
    }

     public function getAvatarAttribute()
    {
        # code...

        $email = $this->email;;
        $size = 32;

        return $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?&s=" . $size;
    }

    public function favourites()
    {
        # code...
        return $this->belongsToMany(Question::class, 'favourites')->withTimestamps();// 'user_id', 'question_id');
    }


public function voteQuestions()
{
    # code...
    return $this->morphedBymany(Question::class, 'votable');
}

public function voteAnswers()
{
    # code...
    return $this->morphedBymany(Answer::class, 'votable');
}

public function voteQuestion(Question $question, $vote)
{
    # code...
     $voteQuestions = $this->voteQuestions();
     $this->_vote($voteQuestions, $question, $vote);

}

    public function voteAnswer(Answer $answer, $vote)
    {

        $voteAnswers = $this->voteAnswers();
        $this->_vote($voteAnswers, $answer, $vote);

    }

    private function _vote($relationship, $model, $vote)
    {
        # code...
        if($relationship->where('votable_id', $model->id)->exists()){
            $relationship->updateExistingPivot($model- ['vote' => $vote]);
         }else{
             $relationship->attach($model- ['vote' => $vote]);
         }
         $model->load('votes');
        $downVotes = (int) $model->downVotes()->sum('vote');

        $upVotes = (int) $model->upVotes()->sum('vote');
         $model->votes_crelationshipount = $upVotes + $downVotes;
         $model->save();
    }


}

