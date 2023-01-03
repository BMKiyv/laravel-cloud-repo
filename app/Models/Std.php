<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Std extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'years_id', 'path'];

    public function photos() {
        return $this->hasMany(Photo::class);
    }  
    public function filename () {
        return $this->hasMany(Photo::class);
    }

}
