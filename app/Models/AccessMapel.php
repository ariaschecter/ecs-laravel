<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessMapel extends Model
{
    use HasFactory;

    protected $guarded = ['access_mapel_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'mapel_id');
    }
}
