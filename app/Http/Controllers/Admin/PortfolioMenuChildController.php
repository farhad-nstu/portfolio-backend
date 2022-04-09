<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PortfolioMenuChild;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\PortfolioMenu;

class PortfolioMenuChildController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$childs = PortfolioMenuChild::with('menu')->get();
    	return view('dashboard.portfolioMenuChilds.index', compact('childs'));
    }

    public function create()
    {
    	$menus = PortfolioMenu::all();
    	return view('dashboard.portfolioMenuChilds.create', compact('menus'));
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'menu_id' => 'required',
        ) );

        $child = new PortfolioMenuChild;
        $child->title = $request->title;
        $child->menu_id = $request->menu_id;

        $image = $request->file( 'image' );
        $filename    = $image->getClientOriginalName();
        $image_resize = Image::make( $image->getRealPath() );
        $image_resize->resize( 800, 800 );
        $image_resize->save( public_path( 'images/portfolio/childs/' .$filename ) );
        $child->image = 'images/portfolio/childs/'.$filename;

        $child->save();
        return back()->with( 'message', 'Data added successfully' );
    }

    public function edit($id)
    {
    	$child = PortfolioMenuChild::find($id);
    	$menus = PortfolioMenu::all();
    	return view('dashboard.portfolioMenuChilds.edit', compact('child', 'menus'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'menu_id' => 'required',
        ) );

        $child = PortfolioMenuChild::find($id);
        $child->title = $request->title;
        $child->menu_id = $request->menu_id;

        if(!empty($request->image)){
	        $image = $request->file( 'image' );
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make( $image->getRealPath() );
            $image_resize->resize( 800, 800 );
            $image_resize->save( public_path( 'images/portfolio/childs/' .$filename ) );
	        if(isset($child->image)) {
	        	unlink($child->image);
	        }
	        $child->image = 'images/portfolio/childs/'.$filename;
        }

        $child->update();
        return redirect()->route('portfolioMenuChilds.index')->with( 'message', 'Data Updated Successfully' );
    }

    public function destroy($id)
    {
        $child = PortfolioMenuChild::find($id);
        if(isset($child->image)) {
        	unlink($child->image);
        }
        $child->delete();
        return redirect()->back()->with( 'success', 'Data deleted successfully' );
    }
}
