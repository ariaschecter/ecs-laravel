<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListMapel extends Model
{
    use HasFactory;

    protected $guarded = ['list_mapel_id'];

    public function sub_mapel() {
        return $this->belongsTo(SubMapel::class, 'sub_mapel_id', 'sub_mapel_id');
    }
}
