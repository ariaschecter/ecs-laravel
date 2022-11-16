<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChoiceQuiz extends Model
{
    use HasFactory;

    protected $guarded = ['choice_id'];

    public function question() {
        return $this->belongsTo(QuestionQuiz::class, 'question_id', 'question_id');
    }
}
