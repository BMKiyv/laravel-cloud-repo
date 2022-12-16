<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Name;

class NameController extends Controller
{
    public function index() {
        $langs = Name::find(1)->languages;
        return dd($langs);
    }
}
