<?php

namespace AstroGame\Http\Controllers;

use AstroGame\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Mail;
use AstroGame\UserConfig;

class HomeController extends Controller
{
    public $lang_avaliable = ['pt-br', 'en', 'es', 'fr'];

    /**
     * Página inicial do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(auth()->check()){
            return redirect('/game');
        }

        return view('project.home', ['page' => 'index']);
    }

    /**
     * Página sobre do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function sobre() {
        return view('project.about', ['page' => 'sobre']);
    }

    /**
     * Página sobre do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function equipe() {
        $team = [(object) [
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
                 'github' => '']
                 ];
        return view('project.team', ['team' => $team, 'page' => 'equipe']);
    }

    /**
     * Página sobre do contato
     *
     * @return \Illuminate\Http\Response
     */
    public function contato() {
        return view('project.contact', ['page' => 'contato']);
    }

    /**
     * Página de termos de uso
     *
     * @return \Illuminate\Http\Response
     */
    public function termos() {
        return view('project.termos', ['page' => 'termos']);
    }

    /**
     * Página de política de privacidade
     *
     * @return \Illuminate\Http\Response
     */
    public function politica() {
        return view('project.politica', ['page' => 'politica']);
    }

    /**
     * Muda para inglês o aplicativo
     *
     * @param string lang
     * @return \Illuminate\Http\Response
     */
    public function change_language(Request $request, $lang = 'en') {
        if(in_array($lang, $this->lang_avaliable)){
            session()->put('language', $lang);
            
            if(auth()->check()){
                UserConfig::setConfig('lang', $lang);
            }

        } else {
            exit('Essa linguagem não é suportada.');
        }
        return redirect()->back();
    }

    /**
     * Enviar formulário de contato para a equipe
     *
     * @param object Request
     * @return \Illuminate\Http\Response
     */
    public function enviar_contato(Request $request){
        $data = ['name' => $request->name, 'email' => $request->email, 'message' => $request->message];
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'message' => 'required|min:6',
        ]);

        if($validator->fails()){
            return redirect('contato')->withErrors($validator)->withInput();
        }

        // se passar
        // queue para enviar email
        Mail::queue('emails.welcome', $data, function ($message) {
            //
        });
    }
}
