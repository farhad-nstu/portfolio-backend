<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Resume;

class ResumeController extends Controller
{
	public function index()
	{
		$resume = Resume::first();
		return view('dashboard.cv.index', compact('resume'));
	}
    public function insert_resume()
    {
    	return view('dashboard.cv.insert');
    }

    public function resume_store(Request $request)
    {
    	// dd($request->file('resume'));
    	$data = new Resume;
    	$resume = $request->file('resume');
        $filename    = $resume->getClientOriginalName();
        // $image_resize->save( public_path( 'images/' .$filename ) );
        // $ext=strtolower($image->getClientOriginalExtension());
            // $image_full_name=$image.'.'.$ext;
            $upload_path='images';
            // $image_url=$upload_path.$image_full_name;
            $success = $resume->move($upload_path,$filename);
        $data->resume = $success;
        // $product->save();
        $data->save();
        return back();
    }

    public function file_download($id)
    {
    	// $resume = Resume::where('id', $id)->pluck('resume')->first();
        $resume = Resume::where('id', 1)->pluck('resume')->first();
    	$headers = [
              'Content-Type' => 'application/pdf',
           ];
		return response()->download($resume, 'filename.pdf', $headers);
    }
}
