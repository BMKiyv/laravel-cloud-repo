<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class YearsController extends Controller
{
    public function years () {
        $years = DB::select('select * from years');
        return view('years.index', ['years'=>$years]);
    }
   
}
