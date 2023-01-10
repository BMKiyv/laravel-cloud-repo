<?php

namespace App\Http\Controllers;
use App\Models\Std;
use App\Models\Year;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index () {
        $std = Std::paginate(2);
        $show_year = Year::pluck('year', 'id');
        if (isset($_GET['name'])){
            
            $show_std = Std::where('name', 'LIKE', "%{$_GET['name']}%")->get();
            $show_search = [];
            foreach($show_std as $elem) {
                $this_year=0;  
                foreach($show_year as $id=>$year){
                    if($elem->years_id===$id){
                      $this_year = $year;
                    }
                }
                array_push($show_search,[$elem->name,$this_year]);
            }
            return view('companies.index', [ 'std' => $show_search]);
           }
           else {
            // $show_std = [];
            // dd($std,$show_year[1], $std[0]->path);
            // foreach($std as $elem) {
            //     $this_year=0;  
            //     foreach($show_year as $id=>$year){
            //         if($elem->years_id===$id){
            //           $this_year = $year;
            //         }
            //     }
            //     array_push($show_std,[$elem->name,$this_year]);
            // }

            return view('companies.index', [ 'std' => $std]);
           }
    }
}
