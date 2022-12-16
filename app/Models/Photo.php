<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Year;

class Photo extends Model
{
    protected $fillable = ['src', 'years_id'];

    public function years()
    {
        return $this->hasMany(Photo::class);
    }

    public function years_id()
    {
        return $this->belongsTo(Year::class);
    }
}
