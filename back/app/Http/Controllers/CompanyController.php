<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return Company::with('user')->get();
        return Company::all();
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
        'current_position' => "required",
        'hr_name' => "required",
        'company_name' => "required",
        'hr_email' => "required",
        'company_phone' => "required",
        'hr_phone' => "required",
        'company_email' => "required",
        'company_address' => "required",
        'company_website' => "required"  
    ]);

    $Companies = new Company();
    $Companies->current_position = $request->current_position;
    $Companies->hr_name = $request->hr_name;
    $Companies->company_name = $request->company_name;
    $Companies->hr_email = $request->hr_email;
    $Companies->company_phone = $request->company_phone;
    $Companies->hr_phone = $request->hr_phone;
    $Companies->company_email = $request->company_email;
    $Companies->company_address = $request->company_address;
    $Companies->company_website = $request->company_website;
    $Companies->save();

    return response()->json(['message' => 'create','data'=>$Companies], 201);
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
        return Company::where('user_id','like','%'.$id.'%')->get();
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
            'current_position' => "required",
            'hr_name' => "required",
            'company_name' => "required",
            'hr_email' => "required",
            'company_phone' => "required",
            'hr_phone' => "required",
            'company_email' => "required",
            'company_address' => "required",
            'company_website' => "required" 
        ]);
        //move image to storage
        // $request->file('profile')->store('public/profiles');
        $Companies = Company::findOrFail($id);
        
            $Companies->current_position = $request->current_position;
            $Companies->hr_name = $request->hr_name;
            $Companies->company_name = $request->company_name;
            $Companies->hr_email = $request->hr_email;
            $Companies->company_phone = $request->company_phone;
            $Companies->hr_phone = $request->hr_phone;
            $Companies->company_email = $request->company_email;
            $Companies->company_address = $request->company_address;
            $Companies->company_website = $request->company_website;
            $Companies->save();
       
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
        return Company::destroy($id);
    }
}
