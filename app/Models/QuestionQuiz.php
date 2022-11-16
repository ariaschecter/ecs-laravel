<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionQuiz extends Model
{
    use HasFactory;

    protected $guarded = ['question_id'];

    public function sub_mapel() {
        return $this->belongsTo(SubMapel::class, 'sub_mapel_id', 'sub_mapel_id');
    }

    public function choice() {
        return $this->hasMany(ChoiceQuiz::class, 'question_id', 'question_id');
    }
}
