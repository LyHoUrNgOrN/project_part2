<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Skill::with('user')->get();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'skill_name' => "required",
            'skill_detail' => "required",
            
        ]);
        $Skill = new Skill();
        $Skill->skill_name = $request->skill_name;
        $Skill->skill_detail = $request->skill_detail;
        $Skill->save();
        return response()->json(['message' => 'create','data'=>$Skill], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return Skill::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'skill_name' => "required",
            'skill_detail' => "required",
            
        ]);
        $Skill = Skill::findOrFail($id);
        $Skill->skill_name = $request->skill_name;
        $Skill->skill_detail = $request->skill_detail;
        $Skill->save();
        return response()->json(['message' => 'update','data'=>$Skill], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Skill::destroy($id);
    }
}
