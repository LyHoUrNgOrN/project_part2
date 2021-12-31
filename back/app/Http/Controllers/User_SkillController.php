<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User_Skill;

class User_SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User_Skill::with(['user', 'skill'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_skill = new User_Skill();
        $user_skill->user_id = $request->user_id;
        $user_skill->skill_id = $request->skill_id;

        $user_skill->save();
        return response()->json(['message' => 'Successed', 'data' => $user_skill], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User_Skill::with(['user', 'skill'])->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDelete = User_Skill::destroy($id);
    }
}
