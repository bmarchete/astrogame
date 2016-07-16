<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReportRequest;
use App\Bug;

class ReportController extends Controller
{
    public function send(StoreReportRequest $request)
    {
        $user_id = auth()->user()->id;

        if (Bug::where('text', $request->text)->where('user_id', $user_id)->limit(1)->first()) {
            return response()->json(['status' => false, 'text' => trans('game.bug-repeat')]);
        }

        if (Bug::insert(['user_id' => $user_id, 'text' => $request->text])) {
            return response()->json(['status' => true, 'text' => trans('game.bug-success')]);
        } else {
            return response()->json(['status' => false, 'text' => trans('game.bug-fail')]);
        }
    }
}
