<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreQuiz extends Model
{
    use HasFactory;

    protected $guarded = ['score_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function sub_mapel()
    {
        return $this->belongsTo(SubMapel::class, 'sub_mapel_id', 'sub_mapel_id');
    }
}
