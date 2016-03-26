<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bug;
use Validator;
use Response;

class BugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $text = $request->input('text');
        $validator = Validator::make(['text' => $text], [
            'text' => 'required|min:10'
        ]);

        if($validator->fails()){
        	$messages = $validator->errors();
            return Response::json(['status' => false, 'text' => $messages->first('text')]);
        }

        $user_id = auth()->user()->id;

        if(Bug::where('text', $text)->where('user_id', $user_id)->limit(1)->get()->first()){
        	return Response::json(['status' => false, 'text' => trans('game.bug-repeat')]);
        }

        $bug_report = Bug::insert(['user_id' => $user_id, 'text' => $text]);
        
        return Response::json(['status' => $bug_report,  'text' => 'Deu bom :)']);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
