<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use Intervention\Image\ImageManagerStatic as Image;

class MemberController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$members = Member::all();
    	return view('dashboard.members.index', compact('members'));
    }

    public function create()
    {
    	return view('dashboard.members.create');
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'email' => 'required',
            'phone' => 'required',
        ) );

        $member = new Member;
        $member->title = $request->title;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->designation = $request->designation;
        $member->company_name = $request->company_name;
        $member->description = $request->description;

        $image = $request->file( 'image' );
        $filename    = $image->getClientOriginalName();
        $image_resize = Image::make( $image->getRealPath() );
        $image_resize->resize( 800, 800 );
        $image_resize->save( public_path( 'images/' .$filename ) );
        $member->image = 'images/'.$filename;

        $member->save();
        return back()->with( 'message', 'Member added successfully' );
    }

    public function edit($id)
    {
    	$member = Member::find($id);
    	return view('dashboard.members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'email' => 'required',
            'phone' => 'required',
        ) );

        $member = Member::find($id);
        $member->title = $request->title;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->designation = $request->designation;
        $member->company_name = $request->company_name;
        $member->description = $request->description;

        if(!empty($request->image)){
	        $image = $request->file( 'image' );
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make( $image->getRealPath() );
            $image_resize->resize( 800, 800 );
            $image_resize->save( public_path( 'images/' .$filename ) );
	        unlink($member->image);
	        $member->image = 'images/'.$filename;
        }

        $member->update();
        return redirect()->route('member.index')->with( 'message', 'Member Updated Successfully' );
    }

    public function show($id)
    {
    	$member = Member::find($id);
    	return view('dashboard.members.show', compact('member'));
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        unlink($member->image);
        $member->delete();
        return redirect()->back()->with( 'success', 'Member deleted successfully' );
    }
}
