<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    //

    use VotableTrait;
    
    protected $fillable = ['title', 'body'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value){

        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $value;


    }

    public function getUrlAttribute(){
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute(){

        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){

        if($this->answers_count > 0){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute(){

       return \Parsedown::instance()->text($this->body);
    }

    public function answers(){

        return $this->hasMany(Answer::class);
    }
    public function acceptBestAnswer(Answer $answer)
    {
        # code...
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favourites()
    {
        # code...
        return $this->belongsToMany(User::class, 'favourites')->withTimestamps();
    }

    public function isFavourited()
    {
        # code...
        return $this->favourites->where('user_id', auth()->id())->count() > 0;
    }
    public function getIsFovouritedAttribute()
    {
        # code...
        return $this->isFavourited();
    }
    public function getFovouritesCountAttribute()
    {
        # code...
         return $this->favourites->count();
    }



}
