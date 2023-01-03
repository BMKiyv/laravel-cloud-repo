<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadFileRequest;
use App\Rules\isValidExistsRule;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('fileUpload.index');
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $std = $request->query()['std'];
        $fileName= $request->file?$request->file->getClientOriginalName():'';
        $show_std = DB::select("select * from stds where stds.id=$std");
        $path = get_object_vars($show_std[0])['path'];
        //$verified = Storage::disk('public')->exists($path . '/' . $fileName)? 'nope':'ok';
        $id_std = get_object_vars($show_std[0])['id'];

        //$filename = $request->file->getClientOriginalName();
       // $is_exists = Storage::disk('public')->exists( $fileName );
        // $names = Photo::pluck('filename');
        // static $answer = false;
        //  foreach($names as $name){
        //     global $answer;
        //    $name==$fileName?$answer = true: $answer = false;

        //  }
        
     

        // $request->validate([
        //     'file' => 'required|mimes:pdf,xlx,doc,docx,xls|max:20000',
        //     'isexists' => ['required', new isValidExistsRule]

        // ]);


        //dd($request);

        // if($answer===true) {
        //     return back()
        //     ->withErrors('isexists.required');
        // }
        // else {
            $new_file = new Photo();
            $new_file->path = $path;
            $new_file->filename = $fileName;
            $new_file->std_id = $id_std;
            $request->file->storeAs( $path, $fileName, 'public');
            Storage::setVisibility($fileName, 'public');
            $new_file -> save();
    
            return back()
                ->with('success','Файл "' . $fileName . '" було успішно завантажено')
                ->with('file', $fileName);

        }
    
   
    
}
