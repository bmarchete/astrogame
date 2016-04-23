<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bug;
use Validator;
use Response;

class BugController extends Controller
{
    public function send(Request $request)
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
        if($bug_report){
            return Response::json(['status' => true,  'text' => trans('game.bug-success')]);
        } else {
            return Response::json(['status' => true,  'text' => trans('game.bug-fail')]);
        }
    }
}
