<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Mail;

class HomeController extends Controller
{

    /**
     * Página inicial do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('project.home');
    }

    /**
     * Página sobre do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function sobre() {
        return view('project.sobre');
    }

    /**
     * Página sobre do contato
     *
     * @return \Illuminate\Http\Response
     */
    public function contato() {
        return view('project.contato');
    }

    /**
     * Enviar formulário de contato para a equipe
     *
     * @param object Request
     * @return \Illuminate\Http\Response
     */
    public function enviar_contato(Request $request){
        $data = ['nome' => $request->nome, 'email' => $request->email, 'contato' => $request->contato];
        $validator = Validator::make($data, [
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'contato' => 'required|min:6',
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        // se passar
        // queue para enviar email
        Mail::queue('emails.welcome', $data, function ($message) {
            //
        });
    }
}
