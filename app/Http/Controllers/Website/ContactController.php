<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Contact;

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
      $contact = new Contact();
      $contact->name = $request->name;
      $contact->email = $request->email;
      $contact->mensagem = $request->mensagem;

      if ($contact->save()) {
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
      return view('project.contact', ['page' => 'contato']);
  }
}
