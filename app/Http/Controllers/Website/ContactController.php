<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
   * Enviar formulário de contato para a equipe.
   *
   * @param object Request
   *
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $data = ['name' => $request->name, 'email' => $request->email, 'mensagem' => $request->mensagem, 'form_name' => $request->form_name, 'form_time' => $request->form_time];
      $validator = Validator::make($data, [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255',
          'mensagem' => 'required|min:6',
          'form_name' => 'honeypot',
          'form_time' => 'required|honeytime:10',
      ]);

      if ($validator->fails()) {
          return redirect('contato')->withErrors($validator)->withInput();
      }

      if (Mail::send('emails.contact', $data, function ($message) use ($data) {
          $message->from($data['email'], $data['name']);
          $message->subject('Contato de '.$data['name']);
          $message->to('contato@astrogame.me');
      })) {
          return redirect('contato')->with(['status' => true]);
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
