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
        return User::with('user_detail')->latest()->get();
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
            'password' => ['required', 'string', 'min:6'],
            
        ]);
        // $request->file('profile')->store('public/UserProfile');
        
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        // $user->profile = $request->file('profile')->hashName();
        $user->save();
        
        
        // $token = $user->createToken('mytoken')->plainTextToken;
        return response()->json([
            'user' => $this->index(),
            // 'token'=> $token
        ]); 
    }
    public function signin(Request $request)
    {
        // singin function
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message' => "Email or password in valid. Please contact to Admin!!"], 401);
        }

        // $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            // 'token' => $token
        ]);
        //signout function
    }
    public function signout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'signout']);
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
        $user = User::destroy($id);
        if($user ===1){
            return response(['message'=>'deleted','user'=>$this->index()]);
        }

    }
    public function searchName($name)
    {
        return User::where('first_name','LIKE','%'. $name .'%')
                        ->orWhere('last_name', 'LIKE', '%'. $name . '%')
                        ->orWhere('role', 'LIKE', '%'. $name . '%')
                        ->get();
    }

        /**
     * search the specified resource from storage.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    
}