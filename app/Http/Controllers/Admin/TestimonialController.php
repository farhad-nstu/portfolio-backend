<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$testimonials = Testimonial::all();
    	return view('dashboard.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
    	return view('dashboard.testimonials.create');
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'designation' => 'string|required',
            'description' => 'string|required',
            'status' => 'required',
        ) );

        $testimonial = new Testimonial;
        $testimonial->title = $request->title;
        $testimonial->designation = $request->designation;
        $testimonial->description = $request->description;
        $testimonial->status = $request->status;
        if($request->is_featured) {      	
        	$testimonial->is_featured = $request->is_featured;
        }

        $image = $request->file( 'image' );
        $filename    = $image->getClientOriginalName();
        $image_resize = Image::make( $image->getRealPath() );
        $image_resize->resize( 800, 800 );
        $image_resize->save( public_path( 'images/testimonials/' .$filename ) );
        $testimonial->image = 'images/testimonials/'.$filename;

        $icon = $request->file( 'icon' );
        $iconFile = $icon->getClientOriginalName();
        $icon_resize = Image::make( $icon->getRealPath() );
        $icon_resize->resize( 800, 800 );
        $icon_resize->save( public_path( 'images/testimonials/icons/' .$iconFile ) );
        $testimonial->icon = 'images/testimonials/icons/'.$iconFile;

        $testimonial->save();
        return back()->with( 'message', 'Data added successfully' );
    }

    public function edit($id)
    {
    	$testimonial = Testimonial::find($id);
    	return view('dashboard.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
    	// dd($request->all());
    	$this->validate( $request, array(
            'title' => 'string|required',
            'designation' => 'string|required',
            'description' => 'string|required',
            'status' => 'required',
        ) );

        $testimonial = Testimonial::find($id);
        $testimonial->title = $request->title;
        $testimonial->designation = $request->designation;
        $testimonial->description = $request->description;
        $testimonial->status = $request->status;
        if($request->is_featured) {      	
        	$testimonial->is_featured = $request->is_featured;
        }

        if(!empty($request->image)){
	        $image = $request->file( 'image' );
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make( $image->getRealPath() );
            $image_resize->resize( 800, 800 );
            $image_resize->save( public_path( 'images/testimonials/' .$filename ) );
	        if(isset($testimonial->image)) {     	
	        	if(file_exists($testimonial->image)) {
	        		unlink($testimonial->image);
	        	}
	        }
	        $testimonial->image = 'images/testimonials/'.$filename;
        }

        if(!empty($request->icon)){
	        $icon = $request->file( 'icon' );
            $iconFile    = $icon->getClientOriginalName();
            $image_resize = Image::make( $icon->getRealPath() );
            $image_resize->resize( 800, 800 );
            $image_resize->save( public_path( 'images/testimonials/icons/' .$iconFile ) );
	        if(isset($testimonial->icon)) {
	        	if(file_exists($testimonial->icon)) {
	        		unlink($testimonial->icon);
	        	}
	        }
	        $testimonial->icon = 'images/testimonials/icons/'.$iconFile;
        }

        $testimonial->update();
        return redirect()->route('testimonials.index')->with( 'message', 'Data Updated Successfully' );
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        if(isset($testimonial->image)) {
        	unlink($testimonial->image);
        }
        if(isset($testimonial->icon)) {
        	unlink($testimonial->icon);
        }
        $testimonial->delete();
        return redirect()->back()->with( 'success', 'Data deleted successfully' );
    }
}
