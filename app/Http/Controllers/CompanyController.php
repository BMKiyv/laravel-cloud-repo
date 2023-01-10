<?php

namespace App\Http\Controllers;
use App\Models\Std;
//use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index () {
        $std = Std::paginate(2);
        if (isset($_GET['name'])){            
            $show_std = Std::where('name', 'LIKE', "%{$_GET['name']}%")->paginate(2);
            return view('companies.index', [ 'std' => $show_std]);
           }
           else {
            return view('companies.index', [ 'std' => $std]);
           }
    }
}
