<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'filename',
        'std_id',
    ];


    public function std_id () {
        return $this->belongsTo(Std::class);
    }
    public function filename () {
        return $this->belongsTo(Std::class);
    }
}
