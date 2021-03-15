<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use Intervention\Image\ImageManagerStatic as Image;

class ProjectController extends Controller
{
	public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$projects = Project::all();
    	return view('dashboard.projects.index', compact('projects'));
    }

    public function create()
    {
    	return view('dashboard.projects.create');
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'link' => 'required',
        ) );

        $description = strip_tags($request->description);
        // $description = str_replace("&nbsp;", "", $content);

        $project = new Project;
        $project->title = $request->title;
        $project->description = $request->description;
        $project->pure_desc = $description;
        $project->link = $request->link;

        $image = $request->file( 'image' );
        $filename    = $image->getClientOriginalName();
        $image_resize = Image::make( $image->getRealPath() );
        $image_resize->resize( 800, 800 );
        $image_resize->save( public_path( 'images/' .$filename ) );
        $project->image = 'images/'.$filename;

        $project->save();
        return back()->with( 'message', 'Project added successfully' );
    }

    public function edit($id)
    {
    	$project = Project::find($id);
    	return view('dashboard.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'link' => 'required',
        ) );

        $description = strip_tags($request->description);
        // $description = str_replace("&nbsp;", "", $content);

        $project = Project::find($id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->pure_desc = $description;
        $project->link = $request->link;

        if(!empty($request->image)){
	        $image = $request->file( 'image' );
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make( $image->getRealPath() );
            $image_resize->resize( 800, 800 );
            $image_resize->save( public_path( 'images/' .$filename ) );
	        unlink($project->image);
	        $project->image = 'images/'.$filename;
        }

        $project->update();
        return redirect()->route('project.index')->with( 'message', 'Project Updated Successfully' );
    }

    public function show($id)
    {
    	$project = Project::find($id);
    	return view('dashboard.projects.show', compact('project'));
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        $images = json_decode($project->image);
        foreach ($images as $image) {
        	unlink($image);
        }
        $project->delete();
        return redirect()->back()->with( 'success', 'Project deleted successfully' );
    }
}
