<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Travels;
use App\Feedback;
class DataController extends Controller
{
  function show_travels (){
    return view('layouts.add_travel');
  }

  function show_cars (){
    return view('layouts.add_cars');
  }
  function show_feed (){
    return view('layouts.add_feedback');
  }

  function insert_travel (Request $request){
    $Travels= new Travels;
    $Travels->driver_id=Auth::id();
    $Travels->starting_point=$request->title;
    $Travels->destination=$request->editor1;
	  $Travels->price=$request->price;
	  $rules = ['price' => 'min:0|max:20'];
	  $this->validate($request, $rules);
	  $Travels->seatsAvailable=$request->seats;
    $Travels->session_start=$request->date;
    $Travels->save();
  }

  function show_session (){
    $Travels = DB::table('travels')->get();
    return view('layouts.sessions', compact('Travels'));
  }

  function insert_feedback (Request $request){
    $Feedback= new Feedback;
    $Feedback->passenger_id=Auth::id();
    $Feedback->comment=$request->comment;
    $Feedback->rating=$request->rating;
    $Feedback->save();
  }
  function show_feedback (){
    $Feedback = DB::table('feedback')->get();
    return view('layouts.feedbacks', compact('Feedback'));
  }
}
