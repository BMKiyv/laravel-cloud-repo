<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Std;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class StdController extends Controller
{
    public function std ($year, $std) {
        $show_std_id = Std::where('name',$std)->get()[0]->id;
        $show_files = Std::find($show_std_id)->filename;
        return view('years.std', ['year'=>$year, 'std' => $std,'show_files'=> $show_files]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $year, $std) {

        $fileName= $request->file?$request->file->getClientOriginalName():'';
       $show_std = Std::where('name',$std)->get()[0];
        $path = $show_std->path;
        $id_std = $show_std->id;


        $new_file = new Photo();
        $new_file->path = $path;
        $new_file->filename = $fileName;
        $new_file->std_id = $id_std;
        $request->file->storeAs( $path, $fileName, 'public');
        Storage::setVisibility($fileName, 'public');
        $new_file -> save();
        return back()
        ->with('success','Файл було успішно завантажено')
        ->with('file', $fileName);
    }
    public function delete (Request $request, $year, $std) {
        $filename = $request->query()['name'];
        $show_std = Std::where('name',$std)->get()[0];
        $path = $show_std->path;
      $file_id = Photo::where('filename',$filename)->get()[0]->id;
      Photo::find($file_id)->delete();
        Storage::disk('public')->delete($path . '/' . $filename);
        return back()
        ->with('success','Файл було успішно deleted')
        ->with('file', $filename);
    }
    public function download (Request $request,$year,$std) {
        $filename = $request->query()['name'];
        $filename = $filename;
        $show_std = Std::where('name',$std)->get()[0];
        $path = $show_std->path;
        
        return Storage::download($path . '/' . $filename);
    }
   
};
