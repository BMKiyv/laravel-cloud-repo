<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'years_id', 'path'];

    public function files() {
        return $this->hasMany(File::class);
}

public static function uploadImage(Request $request, $image = null)
{
    if ($request->hasFile('thumbnail')) {
        if ($image) {
            Storage::delete($image);
        }
        $folder = date('Y');
        return $request->file('thumbnail')->store("images/{$folder}");
    }
    return null;
}

public function getImage()
{
    if (!$this->thumbnail) {
        return asset("no-image.png");
    }
    return asset("uploads/{$this->thumbnail}");
}

}
