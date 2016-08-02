<?php

namespace App\Http\Controllers;

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

        $bug_report = new Bug();
        $bug_report->user_id = $user_id;
        $bug_report->text = $request->text;
        if ($bug_report->save()) {
            return response()->json(['status' => true, 'text' => trans('game.bug-success')]);
        } else {
            return response()->json(['status' => false, 'text' => trans('game.bug-fail')]);
        }
    }
}
