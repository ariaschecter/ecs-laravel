<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $guarded = ['mapel_id'];

    public function sub_mapel() {
        return $this->hasMany(SubMapel::class, 'mapel_id', 'mapel_id');
    }
}
