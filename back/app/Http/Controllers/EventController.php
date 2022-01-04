<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Event::with('user')->get();

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
        $event= new Event();
        $event->user_id=$request->user_id;
        $event->title=$request->title;
        $event->dateStart=$request->dateStart;
        $event->dateEnd=$request->dateEnd;
        $event->city=$request->city;
        $event->description=$request->description;
        $event->picture=$request->picture;

        $event->save();

        return response()->json('Event create');
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
        return Event::with('event')->findOrFail($id);
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
        $event = Event::findOrFail($id);
        $event->user_id=$request->user_id;
        $event->title=$request->title;
        $event->dateStart=$request->dateStart;
        $event->dateEnd=$request->dateEnd;
        $event->city=$request->city;
        $event->description=$request->description;
        $event->picture=$request->picture;

        $event->save();

        return response()->json("Event Update");
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
        return Event::destroy($id);
    }
}
