<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use Intervention\Image\ImageManagerStatic as Image;
use DB;

class ClientController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$clients = Client::all();
    	$countries = DB::table('tbl_countries')->select('CountryID', 'CountryName')->get();
    	return view('dashboard.clients.index', compact('clients', 'countries'));
    }

    public function create()
    {
    	$countries = DB::table('tbl_countries')->select('CountryID', 'CountryName')->get();
    	return view('dashboard.clients.create', compact('countries'));
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'name' => 'string|required',
            'email' => 'required',
            'country_id' => 'required',
        ) );

        $client = new Client;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->country_id = $request->country_id;

        $image = $request->file( 'image' );
        $filename    = $image->getClientOriginalName();
        $image_resize = Image::make( $image->getRealPath() );
        $image_resize->resize( 800, 800 );
        $image_resize->save( public_path( 'images/' .$filename ) );
        $client->image = 'images/'.$filename;

        $client->save();
        return back()->with( 'message', 'Client added successfully' );
    }

    public function edit($id)
    {
    	$client = Client::find($id);
    	$countries = DB::table('tbl_countries')->select('CountryID', 'CountryName')->get();
    	return view('dashboard.clients.edit', compact('client', 'countries'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'name' => 'string|required',
            'email' => 'required',
            'country_id' => 'required',
        ) );

        $client = Client::find($id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->country_id = $request->country_id;

        if(!empty($request->image)){
	        $image = $request->file( 'image' );
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make( $image->getRealPath() );
            $image_resize->resize( 800, 800 );
            $image_resize->save( public_path( 'images/' .$filename ) );
	        unlink($client->image);
	        $client->image = 'images/'.$filename;
        }

        $client->update();
        return redirect()->route('client.index')->with( 'message', 'Client Updated Successfully' );
    }

    public function show($id)
    {
    	$client = Client::find($id);
    	$countries = DB::table('tbl_countries')->select('CountryID', 'CountryName')->get();
    	return view('dashboard.clients.show', compact('client', 'countries'));
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        unlink($client->image);
        $client->delete();
        return redirect()->back()->with( 'success', 'Client deleted successfully' );
    }
}
