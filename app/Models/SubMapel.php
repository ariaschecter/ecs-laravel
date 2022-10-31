<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMapel extends Model
{
    use HasFactory;

    protected $guarded = ['sub_mapel_id'];

    public function mapel() {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'mapel_id');
    }
}
