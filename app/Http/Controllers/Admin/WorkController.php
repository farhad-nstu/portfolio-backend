<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;
use Intervention\Image\ImageManagerStatic as Image;

class WorkController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$works = Work::all();
    	return view('dashboard.works.index', compact('works'));
    }

    public function create()
    {
    	return view('dashboard.works.create');
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'description' => 'string|required'
        ) );

    	$work = new Work;
        $work->title = $request->title;
        $work->description = $request->description;

        $image = $request->file( 'image' );
        $filename    = $image->getClientOriginalName();
        $image_resize = Image::make( $image->getRealPath() );
        $image_resize->resize( 800, 800 );
        $image_resize->save( public_path( 'images/works/' .$filename ) );
        $work->image = 'images/works/'.$filename;

        $image = $request->file( 'icon' );
        $filename    = $image->getClientOriginalName();
        $image_resize = Image::make( $image->getRealPath() );
        $image_resize->resize( 800, 800 );
        $image_resize->save( public_path( 'images/works/icons/' .$filename ) );
        $work->icon = 'images/works/icons/'.$filename;

        $work->save();
        return back()->with( 'message', 'Data added successfully' );
    }

    public function edit($id)
    {
    	$work = Work::find($id);
    	return view('dashboard.works.edit', compact('work'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'description' => 'string|required'
        ) );

        $work = Work::find($id);
        $work->title = $request->title;
        $work->description = $request->description;

        if(!empty($request->image)){
	        $image = $request->file( 'image' );
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make( $image->getRealPath() );
            $image_resize->resize( 800, 800 );
            $image_resize->save( public_path( 'images/works/' .$filename ) );
	        if(isset($work->image)) {
	        	unlink($work->image);
	        }
	        $work->image = 'images/works/'.$filename;
        }

        if(!empty($request->icon)){
	        $image = $request->file( 'icon' );
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make( $image->getRealPath() );
            $image_resize->resize( 800, 800 );
            $image_resize->save( public_path( 'images/works/icons/' .$filename ) );
	        if(isset($work->icon)) {
	        	unlink($work->icon);
	        }
	        $work->icon = 'images/works/icons/'.$filename;
        }

        $work->update();
        return redirect()->route('works.index')->with( 'message', 'Data Updated Successfully' );
    }

    public function destroy($id)
    {
        Work::find($id)->delete();
        return redirect()->back()->with( 'success', 'Data deleted successfully' );
    }
}
