<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use Mail;

class ReportController extends Controller
{
    public function send(StoreReportRequest $request)
    {
        $data = ['name' => auth()->user()->name, 'email' => auth()->user()->email, 'text' => $request->text];
        $mail = Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->from('eduardo@astrogame.me', 'Astrogame');
            $message->subject('Bug Report do Astrogame ' . $data['name']);
            $message->to('eduardo.auramos@gmail.com');
        });

        if ($mail) {
            return response()->json(['status' => true, 'text' => trans('game.bug-success')]);
        } else {
            return response()->json(['status' => false, 'text' => trans('game.bug-fail')]);
        }
    }
}
