<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);
    
        $fileName = time().'.'.$request->file->extension();  
     
        $request->file->move(public_path('storage'), $fileName);
   
        /*  
            Write Code Here for
            Store $fileName name in DATABASE from HERE 
        */
     
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file', $fileName);
   
    }
}
