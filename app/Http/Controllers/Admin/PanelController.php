<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index(){
      return view('Admin.panel');
    }

//csrf extend &&& post method
    public function ckeditorUploadimage(){

    $this->validate(request() , [
           'upload' => 'required|mimes:jpeg,png,bmp',
       ]);

       $file = request()->file('upload');
       $year = Carbon::now()->year;
       $imagePath = "/upload/images/{$year}/";
       $filename = $file->getClientOriginalName();

       if(file_exists(public_path($imagePath) . $filename)) {
           $filename = Carbon::now()->timestamp . $filename;
       }
       $file->move(public_path($imagePath) , $filename);
       $url = $imagePath . $filename;

       return "<script>window.parent.CKEDITOR.tools.callFunction(1 , '{$url}' , '')</script>";
   }

}
