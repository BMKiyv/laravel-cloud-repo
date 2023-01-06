<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateYearsRequest;
use App\Models\Year;
use App\Models\Std;

class YearsController extends Controller
{
    public function years () {
        $years = Year::all();
        return view('years.index', ['years'=>$years]);
    }
    public function year ($year) {
       $_year = Year::where('year','=', $year)->get()[0];
       $show_year = $_year->year;
       $id_year = $_year->id;
       $show_std = Std::where('years_id','=', $id_year)->get();
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
