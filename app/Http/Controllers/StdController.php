<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Std;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Vish4395\LaravelFileViewer\LaravelFileViewer;

class StdController extends Controller
{
    public function index ($year, $std) {
        $show_std = Std::where('name',$std)->get()[0]->id;
        $show_files = File::where('std_id',$show_std)->orderBy('filename')->paginate(2);
        if (isset($_GET['name'])){
            
            $show_files = File::where('std_id', $show_std)->where('filename', 'LIKE', "%{$_GET['name']}%")->paginate(2);
            return view('stds.index', ['year'=>$year, 'std' => $std,'show_files'=> $show_files]);
           }
           else {
            //dd($show_std,$show_files);
            return view('stds.index', ['year'=>$year, 'std' => $std,'show_files'=> $show_files]);
           }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $year, $std) {
        $fileName = $request->file?$request->file->getClientOriginalName():'';
       $show_std = Std::where('name',$std)->get()[0];
        $path = $show_std->path;//1
        $id_std = $show_std->id;
         $names = $show_std->filename->pluck('filename');
         $truth = true;
         if (count($names)>0){
            foreach($names as $elem){
               $elem===$fileName? $truth = false: $truth = true;
            }             
        }
        if($fileName === ''){
            return back()
            ->withErrors(['name'=>'Файл не вибрано'])
            ->with('file', $fileName);
        }

           elseif($truth){
            $new_file = new File();
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

        else{
            return back()
            ->withErrors(['file'=>'Файл з такою назвою тут вже існує'])
            ->with('file', $fileName);
        }
        

    }
    public function delete (Request $request, $year, $std) {
        $filename = $request->query()['name'];
        $show_std = Std::where('name',$std)->get()[0];
        $path = $show_std->path;//2
      $file_id = File::where('filename',$filename)->get()[0]->id;
      File::find($file_id)->delete();
        Storage::disk('public')->delete($path . '/' . $filename);
        return back()
        ->with('success','Файл було успішно deleted')
        ->with('file', $filename);
    }
    public function download (Request $request,$year,$std) {
        $filename = $request->query()['name'];
        $filename = $filename;
        $show_std = Std::where('name',$std)->get()[0];
        $path = $show_std->path;//3
        
        return Storage::download($path . '/' . $filename);
    }
    public function view(Request $request)
    {
        $name = $request->query()['name'];
        $std = $request->query()['std'];
        $year = $request->query()['year'];
        $filepath =  $year . '/' . $std . '/' . $name;
        $file_url = asset('storage/' . $filepath);
        $file_data = [
            [
                'label' => __('Label'),
                'value' => "Value"
            ]
        ];
        $file_viewer = new LaravelFileViewer();
        return $file_viewer->show($name, $filepath, $file_url, $file_data);
    }
   
};
