<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //

    protected $fillable = ['question_set_id', 'question', 'a', 'b', 'c', 'd', 'answer', 'hint'];

    public function questionSet()
    {
        return $this->belongsTo(QuestionSet::class);
    }
}
