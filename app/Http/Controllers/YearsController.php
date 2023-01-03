<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateYearsRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Year;
use App\Models\Std;

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
       $show_std = DB::select("select * from stds where stds.years_id=$id_year");
       // $show_std = Year::where('years_id', $id_year)->get();
        //return view('years.year', compact('show_std'));
        return view('years.year', ['std'=>$show_std, 'year'=>$show_year]);
    }
    public function update (UpdateYearsRequest $request, $year) {
        $std = new Std();
        $id_year = Year::where('year', $year)->get('id')[0]->id;
        $new_path = $year . "/" . $request->input('name');

        $std->name = $request->input('name');
        $std->path = $new_path;
        $std->years_id = $id_year;

        
        $allDirectories = Storage::allDirectories('public');
        for($i=0; $i<count($allDirectories); $i++){
            if($allDirectories[$i]==='public/'. $year . '/' . $request->input('name')){
                break;
            }
            else {
                Storage::makeDirectory('public/'. $year . '/' . $request->input('name'));
            }
        }
        $std->save();
        return redirect()->route('years.year',$year)->with('success', 'Підприємство було успішно створено');
    }

}
