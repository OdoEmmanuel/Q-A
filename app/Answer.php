<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Gate;
class Answer extends Model
{
    //

    use  VotableTrait;

    protected $fillable = ['body', 'user_id', 'question_id'];

    public function question(){

        return $this->belongsTo(Question::class);
    }


    public function user(){

        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute(){

        return \Parsedown::instance()->text($this->body);
     }

     public static function boot(){
         parent::boot();

         static::created(function($answer){
             $answer->question->increment('answers_count');
             });

         static::deleted(function($answer){
             $question = $answer->question;
             $question->decrement('answers_count');
             if($question->best_answer_id == $answer->id){
                 $question->best_answer_id = NULL;
                 $question->save();
             }
         });
     }


    public function getCreatedDateAttribute(){

        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        # code...
        return $this->isBest ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute()
    {
        # code...
        return $this->isBest();
    }
    public function isBest()
    {
        # code...
        return $this->id == $this->question->best_answer_id;
    }



}
