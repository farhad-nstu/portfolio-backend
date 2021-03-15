<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attribute;
use Intervention\Image\ImageManagerStatic as Image;
use App\Skill;

class AttributeController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$attributes = Attribute::all();
    	$skills = Skill::all();
    	return view('dashboard.attributes.index', compact('attributes', 'skills'));
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
    		'skill_id' => 'required',
            'title' => 'string|required',
        ) );

        $attribute = new Attribute;
        $attribute->title = $request->title;
        $attribute->skill_id = $request->skill_id;

        $image = $request->file( 'image' );
        $filename    = $image->getClientOriginalName();
        $image_resize = Image::make( $image->getRealPath() );
        $image_resize->resize( 800, 800 );
        $image_resize->save( public_path( 'images/' .$filename ) );
        $attribute->image = 'images/'.$filename;

        $attribute->save();
        return back()->with( 'message', 'Added successfully' );
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
        ) );

        $attribute = Attribute::find($id);
        $attribute->title = $request->title;
        $attribute->skill_id = $request->skill_id;

        if(!empty($request->image)){
	        $image = $request->file( 'image' );
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make( $image->getRealPath() );
            $image_resize->resize( 300, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
	        unlink($attribute->image);
	        $attribute->image = 'images/'.$filename;
        }

        $attribute->update();
        return redirect()->route('attribute.index')->with( 'message', 'Updated Successfully' );
    }

    public function destroy($id)
    {
        $attribute = Attribute::find($id)->delete();
        return redirect()->back()->with( 'success', 'Deleted successfully' );
    }
}
