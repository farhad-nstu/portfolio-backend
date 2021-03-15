<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Award;

class AwardController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$awards = Award::all();
    	return view('dashboard.awards.index', compact('awards'));
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'date' => 'required',
        ) );

        $award = new Award;
        $award->title = $request->title;
        $award->date = $request->date;
        $award->ground = $request->ground;
        $award->save();
        return back()->with( 'message', 'Added successfully' );
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'date' => 'required',
        ) );

        $award = Award::find($id);
        $award->title = $request->title;
        $award->date = $request->date;
        $award->ground = $request->ground;
        $award->update();
        return redirect()->route('award.index')->with( 'message', 'Updated Successfully' );
    }

    public function destroy($id)
    {
        $award = Award::find($id)->delete();
        return redirect()->back()->with( 'success', 'Deleted successfully' );
    }
}
