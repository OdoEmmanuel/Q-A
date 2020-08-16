<?php
namespace App;


trait VotableTrait{


    public function votes()
    {
        # code...
        return $this->morphTomany(User::class, 'votable');
    }


    public function upVotes()
    {
        # code...
        return $this->votes()->wherePivot('vote', 1);
    }

    public function downVotes()
    {
        # code...
        return $this->votes()->wherePivot('vote', -1);
    }

}
