<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Skill;

class SkillController extends Controller
{
  	public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index()
    {
    	$skills = Skill::all();
    	return view('dashboard.skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
        ) );

        $skill = new skill;
        $skill->title = $request->title;
        $skill->save();
        return back()->with( 'message', 'Added successfully' );
    }

    public function update(Request $request, $id)
    {
    	$this->validate( $request, array(
            'title' => 'string|required',
        ) );

        $skill = Skill::find($id);
        $skill->title = $request->title;
        $skill->update();
        return redirect()->route('skill.index')->with( 'message', 'Updated Successfully' );
    }

    public function skill_delete($id)
    {
        $skill = Skill::with('attributes')->where('id', $id)->delete();
        return redirect()->back()->with( 'success', 'Deleted successfully' );
    }
}
