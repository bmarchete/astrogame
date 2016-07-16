<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Mail;

class ContactController extends Controller
{
    /**
   * Enviar formulário de contato para a equipe.
   *
   * @param object Request
   *
   * @return \Illuminate\Http\Response
   */
  public function store(ContactRequest $request)
  {
      try {
        Mail::send('emails.contact', $request, function ($message) use ($request) {
            $message->from($request->email, $request->name);
            $message->subject('Contato de '. $request->name);
            $message->to('eduardo@astrogame.me');
        });

        return redirect('contato')->with(['status' => true]);
      } catch (\Exception $e) {
        return redirect('contato')->withErrors(['Não foi possível enviar o contato, tente mais tarde'])->withInput();
      }
  }

  /**
   * Página sobre do contato.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('project.contact', ['page' => 'contato']);
  }
}
