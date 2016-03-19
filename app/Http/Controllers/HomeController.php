<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Mail;
use Auth;
use Session;

class HomeController extends Controller
{
    public $lang_avaliable = ['pt-br', 'en'];

    /**
     * Página inicial do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(Auth::check()){
            return redirect('/game');
        }

        return view('project.home');
    }

    /**
     * Página sobre do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function sobre() {
        return view('project.about');
    }

    /**
     * Página sobre do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function equipe() {
        $team = [
                
                (object) [
                 'name' => 'Eduardo Ramos',
                 'img' => 'img/team/edu.jpg',
                 'description' => 'Programador, roterista, front-end, designer e mochileiro',
                 'facebook' => 'https://www.facebook.com/eduardoaugustoramos',
                 'twitter' => 'https://twitter.com/EduardoRamos__',
                 'github' => 'http://github.com/Ablon'],

                (object) [
                 'name' => 'Adriano Faboci',
                 'img' => 'img/team/adriano.jpg',
                 'description' => 'Faz tudo e mochileiro',
                 'facebook' => '',
                 'twitter' => '',
                 'github' => ''],

                 (object) [
                 'name' => 'Brenda Conttessotto',
                 'img' => 'img/team/bre.jpg',
                 'description' => 'Faz tudo e mochileira',
                 'facebook' => '',
                 'twitter' => '',
                 'github' => ''],

                 (object) [
                 'name' => 'Laís Vitória',
                 'img' => 'img/team/lais.jpg',
                 'description' => 'Artista, roterista, escritora, designer e mochileira',
                 'facebook' => '',
                 'twitter' => '',
                 'github' => ''],

                 (object) [
                 'name' => 'Gabriel Ferreira',
                 'img' => 'img/team/gabriel.jpg',
                 'description' => 'Faz tudo e mochileiro',
                 'facebook' => '',
                 'twitter' => '',
                 'github' => ''],

                ];
        return view('project.team', ['team' => $team]);
    }

    /**
     * Página sobre do contato
     *
     * @return \Illuminate\Http\Response
     */
    public function contato() {
        return view('project.contact');
    }

    /**
     * Página de termos de uso
     *
     * @return \Illuminate\Http\Response
     */
    public function termos() {
        return view('project.termos');
    }

    /**
     * Página de política de privacidade
     *
     * @return \Illuminate\Http\Response
     */
    public function politica() {
        return view('project.politica');
    }

    /**
     * Muda para inglês o aplicativo
     *
     * @param string lang
     * @return \Illuminate\Http\Response
     */
    public function change_language(Request $request, $lang = 'en') {
        if(in_array($lang, $this->lang_avaliable)){
            Session::put('language', $lang);
            
            if(Auth::check()){
                // mudar user_settings
            }

        } else {
            exit('Essa linguagem não é suportada.');
        }
        $referer = $request->header('referer'); // redireciona para a página anterior
        return (!empty($referer)) ? redirect($referer) : redirect('/');
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
