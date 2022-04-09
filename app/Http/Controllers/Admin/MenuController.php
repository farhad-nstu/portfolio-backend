<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$menus = Menu::all();
    	return view('dashboard.menus.index', compact('menus'));
    }

    public function create()
    {
    	return view('dashboard.menus.create');
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'name' => 'string|required',
        ) );

        $menu = new Menu;
        $menu->name = $request->name;
        $menu->save();
        return back()->with( 'message', 'Menu added successfully' );
    }

    public function edit($id)
    {
    	$menu = Menu::find($id);
    	return view('dashboard.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'name' => 'string|required',
        ) );

        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->update();
        return redirect()->route('menus.index')->with( 'message', 'Menu Updated Successfully' );
    }

    public function destroy($id)
    {
        Menu::find($id)->delete();
        return redirect()->back()->with( 'success', 'Menu deleted successfully' );
    }
}
