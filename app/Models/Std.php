<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Std extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'years_id', 'path'];

    public function files() {
        return $this->hasMany(File::class);
    }  
    public function filename () {
        return $this->hasMany(File::class);
    }
    public function tags (){
        return $this->belongsToMany(Tag::class, 'std_tags','stds_id','tags_id');
    }

}
