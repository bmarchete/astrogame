<?php

namespace AstroGame\Http\Controllers;

use Illuminate\Http\Request;

use AstroGame\Http\Requests;
use AstroGame\Bug;
use Validator;
use Response;

class BugController extends Controller
{
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
}
