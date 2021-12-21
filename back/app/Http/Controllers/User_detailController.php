<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_detail;
class User_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User_detail::with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'phone' => "required",
            'date_of_birth' => "required",
            'province' => "required",
            'batch' => "required",
            'role' => "nullable",
            'picture' => "nullable",
            'major' => "required",
            'current_position' => "required",
            'gender' => "required"
            
              
        ]);

                //move image to storage
        $request->file('profile')->store('public/profiles');
        $User_detail = new User_detail();
        $User_detail->user_id = $request->user_id;
        $User_detail->phone = $request->phone;
        $User_detail->date_of_birth = $request->date_of_birth;
        $User_detail->province = $request->province;
        $User_detail->picture = $request->file('picture')->hashName();
        $User_detail->batch = $request->batch;
        $User_detail->major = $request->major;
        $User_detail->current_position = $request->current_position;
        $User_detail->gender = $request->gender;
      
        
        $User_detail->save();
        return response()->json(['message' => 'create','data'=>$User_detail, 'user_detalis'=>$this->index()], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return User_detail::findOrFail($id);
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
        //
        $request->validate([
            'phone' => "required",
            'date_of_birth' => "required",
            'province' => "required",
            'batch' => "required",
            'role' => "nullable",
            'picture' => "nullable",
            'major' => "required",
            'current_position' => "required",
            'gender' => "required"
            
              
        ]);
                        //move image to storage
        $request->file('profile')->store('public/profiles');
        $User_detail = User_detail::findOrFail($id);
        $User_detail->user_id = $request->user_id;
        $User_detail->phone = $request->phone;
        $User_detail->date_of_birth = $request->date_of_birth;
        $User_detail->province = $request->province;
        $User_detail->picture = $request->file('picture')->hashName();
        $User_detail->batch = $request->batch;
        $User_detail->major = $request->major;
        $User_detail->current_position = $request->current_position;
        $User_detail->gender = $request->gender;
       
        
        $User_detail->save();
        return response()->json(['message' => 'update'], 200);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
