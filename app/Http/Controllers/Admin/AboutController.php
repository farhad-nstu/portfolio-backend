<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\About;
use Intervention\Image\ImageManagerStatic as Image;
use DB;

class AboutController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$abouts = About::all();
    	return view('dashboard.abouts.index', compact('abouts'));
    }

    public function create()
    {
    	return view('dashboard.abouts.create');
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'name' => 'string|required',
            'email' => 'required',
            'phone' => 'required',
        ) );

        $about = new About;
        $about->name = $request->name;
        $about->email = $request->email;
        $about->phone = $request->phone;
        $about->designation = $request->designation;
        $about->short_name_desc = $request->short_name_desc;
        $about->description = $request->description;
        $about->current_focus = $request->current_focus;
        $about->professional_experience = $request->professional_experience;
        $about->course = $request->course;

        $image = $request->file( 'image' );
        $filename    = $image->getClientOriginalName();
        $image_resize = Image::make( $image->getRealPath() );
        $image_resize->resize( 800, 800 );
        $image_resize->save( public_path( 'images/' .$filename ) );
        $about->image = 'images/'.$filename;

        $about->save();
        return back()->with( 'message', 'About added successfully' );
    }

    public function edit($id)
    {
    	$about = About::find($id);
    	return view('dashboard.abouts.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'name' => 'string|required',
            'email' => 'required',
            'phone' => 'required',
        ) );

        $about = About::find($id);
        $about->name = $request->name;
        $about->email = $request->email;
        $about->phone = $request->phone;
        $about->designation = $request->designation;
        $about->short_name_desc = $request->short_name_desc;
        $about->description = $request->description;
        $about->current_focus = $request->current_focus;
        $about->professional_experience = $request->professional_experience;
        $about->course = $request->course;

        if(!empty($request->image)){
	        $image = $request->file( 'image' );
            $filename    = $image->getaboutOriginalName();
            $image_resize = Image::make( $image->getRealPath() );
            $image_resize->resize( 800, 800 );
            $image_resize->save( public_path( 'images/' .$filename ) );
	        unlink($about->image);
	        $about->image = 'images/'.$filename;
        }

        $about->update();
        return redirect()->route('about.index')->with( 'message', 'Updated Successfully' );
    }

    public function show($id)
    {
    	$about = About::find($id);
    	return view('dashboard.abouts.show', compact('about'));
    }

    public function destroy($id)
    {
        $about = About::find($id);
        unlink($about->image);
        $about->delete();
        return redirect()->back()->with( 'success', 'Deleted successfully' );
    }
}
