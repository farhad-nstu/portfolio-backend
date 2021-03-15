<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Education;

class EducationController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$educations = Education::all();
    	return view('dashboard.educations.index', compact('educations'));
    }

    public function create()
    {
    	return view('dashboard.educations.create');
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'institute' => 'required',
            'concentration' => 'required',
            'pass_year' => 'required',
        ) );

        $education = new Education;
        $education->title = $request->title;
        $education->institute = $request->institute;
        $education->concentration = $request->concentration;
        $education->pass_year = $request->pass_year;
        $education->result = $request->result;
        $education->save();
        return back()->with( 'message', 'Education added successfully' );
    }

    public function edit($id)
    {
    	$education = Education::find($id);
    	return view('dashboard.educations.edit', compact('education'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
            'institute' => 'required',
            'concentration' => 'required',
            'pass_year' => 'required',
        ) );

        $education = Education::find($id);
        $education->title = $request->title;
        $education->institute = $request->institute;
        $education->concentration = $request->concentration;
        $education->pass_year = $request->pass_year;
        $education->result = $request->result;
        $education->update();
        return redirect()->route('education.index')->with( 'message', 'Education Updated Successfully' );
    }

    public function show($id)
    {
    	$education = Education::find($id);
    	return view('dashboard.educations.show', compact('education'));
    }

    public function destroy($id)
    {
        $education = Education::find($id)->delete();
        return redirect()->back()->with( 'success', 'Education deleted successfully' );
    }
}
