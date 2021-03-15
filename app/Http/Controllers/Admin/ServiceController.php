<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use Intervention\Image\ImageManagerStatic as Image;

class ServiceController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$services = Service::all();
    	return view('dashboard.services.index', compact('services'));
    }

    public function create()
    {
    	return view('dashboard.services.create');
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
        ) );

        $description = strip_tags($request->description);
        // dd($content);
        // $description = str_replace("&nbsp;", "", $content);

        $service = new Service;
        $service->title = $request->title;
        $service->description = $request->description;
        $service->pure_desc = $description;

        $image = $request->file( 'image' );
        $filename    = $image->getClientOriginalName();
        $image_resize = Image::make( $image->getRealPath() );
        $image_resize->resize( 800, 800 );
        $image_resize->save( public_path( 'images/' .$filename ) );
        $service->image = 'images/'.$filename;

        $service->save();
        return back()->with( 'message', 'Service added successfully' );
    }

    public function edit($id)
    {
    	$service = Service::find($id);
    	return view('dashboard.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
        ) );

        $description = strip_tags($request->description);
        // $description = str_replace("&nbsp;", "", $content);

        $service = Service::find($id);
        $service->title = $request->title;
        $service->description = $request->description;
        $service->pure_desc = $description;

        if(!empty($request->image)){
	        $image = $request->file( 'image' );
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make( $image->getRealPath() );
            $image_resize->resize( 800, 800 );
            $image_resize->save( public_path( 'images/' .$filename ) );
	        unlink($service->image);
	        $service->image = 'images/'.$filename;
        }

        $service->update();
        return redirect()->route('service.index')->with( 'message', 'Service Updated Successfully' );
    }

    public function show($id)
    {
    	$service = Service::find($id);
    	return view('dashboard.services.show', compact('service'));
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $images = json_decode($service->image);
        foreach ($images as $image) {
        	unlink($image);
        }
        $service->delete();
        return redirect()->back()->with( 'success', 'Service deleted successfully' );
    }
}
