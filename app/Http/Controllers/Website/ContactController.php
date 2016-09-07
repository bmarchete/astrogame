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
      $data = ['name' => $request->name, 'email' => $request->email, 'mensagem' => $request->mensagem];
      $mail = Mail::send('emails.contact', $data, function ($message) use ($data) {
          $message->from($data['email'], $data['name']);
          $message->subject('Contato do Astrogame ' . $data['name']);
          $message->to('eduardo.auramos@gmail.com');
      });

      if ($mail) {
          return redirect('contato')->with(['status' => true]);
      } else {
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
      return view('website.contact', ['page' => 'contato']);
  }
}
