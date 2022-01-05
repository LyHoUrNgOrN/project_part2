<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with(['user_details','company', 'skill'])->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'], 
            'last_name' => ['required', 'string', 'max:255'], 
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        
        
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();
        
        
        return response()->json([
            'user' => $user,
        ]); 
    }
    public function signin(Request $request)
    {
        // singin function
        $email_err = "";
        $password_err = "";
        $status = 200;
        $user = User::where('email', $request->email)->first();
        if (!$user){
            $email_err = "Wrong your email";
            $status = 401;
        }
        else if(!Hash::check($request->password, $user->password)){
            $password_err = "Wrong your password!";
            $status = 401;

        }
       
        
        // if (!$user && !Hash::check($request->password, $user->password)){
        //     $password_err = "Wrong your password!";
        //     $email_err = "Wrong your email!";
            
        // }

        return response()->json([
            'user' => $this->index(),
            'email_err'=>$email_err,
            'password_err'=>$password_err
        ],$status);
        //signout function
    }
    public function signout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'signout']);
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
        return User::with(['user_details','company'])->findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDelete = User::destroy($id);
        if($isDelete){
            return response()->json(["message"=>"quited"],201);
        }
        return response()->json(["message"=>"quit_error"],404);
    }


    public function update(Request $request, $id)
    {
        
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();
        return response()->json(
            $user, 
        ); 
    }



    public function updatePassword(Request $request, $id)
    {
        
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(
            $user, 
        ); 
    }
}