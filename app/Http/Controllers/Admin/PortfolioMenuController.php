<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PortfolioMenu;

class PortfolioMenuController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$menus = PortfolioMenu::all();
    	return view('dashboard.portfolioMenus.index', compact('menus'));
    }

    public function create()
    {
    	return view('dashboard.portfolioMenus.create');
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
        ) );

        $menu = new PortfolioMenu;
        $menu->title = $request->title;
        $menu->unique_id = preg_replace("/\s+/", "", strtolower($request->title));
        $menu->save();
        return back()->with( 'message', 'Menu added successfully' );
    }

    public function edit($id)
    {
    	$menu = PortfolioMenu::find($id);
    	return view('dashboard.portfolioMenus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
        ) );

        $menu = PortfolioMenu::find($id);
        $menu->title = $request->title;
        $menu->unique_id = preg_replace("/\s+/", "", strtolower($request->title));
        $menu->update();
        return redirect()->route('portfolioMenus.index')->with( 'message', 'Menu Updated Successfully' );
    }

    public function destroy($id)
    {
        PortfolioMenu::find($id)->delete();
        return redirect()->back()->with( 'success', 'Menu deleted successfully' );
    }
}
