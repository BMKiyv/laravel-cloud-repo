<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Year;

class YearsController extends Controller
{
    public function years () {
        //$years = DB::select('select * from years');
        $years = Year::all();
        return view('years.index', ['years'=>$years]);
    }
    public function year ($year) {
        $show_year = DB::select("select * from years where years.year=$year");
        $id_year = get_object_vars($show_year[0])['id'];
        $show_photo = DB::select("select * from photos where photos.years_id=$id_year");
        return view('years.year', ['photo'=>$show_photo, 'year'=>$show_year]);
    }
   
}
