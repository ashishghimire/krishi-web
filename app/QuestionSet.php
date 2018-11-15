<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionSet extends Model
{
    //
    protected $fillable = ['token'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function questionsPaginated()
    {
        return $this->hasMany(Question::class)->paginate(5);
    }
}
