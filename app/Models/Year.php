<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Std;

class Year extends Model
{
    //use HasFactory;
    protected $fillable = ['year'];

    public function years()
    {
        return $this->hasMany(Year::class);
    }
    public function stds()
    {
        return $this->hasMany(Std::class);
    }
}
