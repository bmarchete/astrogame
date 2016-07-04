<?php

namespace App\Http\Controllers;

use App\UserConfig;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $lang_avaliable = ['pt-br', 'en'];

    /**
     * Página inicial do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            return redirect('/game');
        }

        return $this->home();
    }

    public function home()
    {
        return view('project.home', ['page' => 'index']);
    }

    /**
     * Página sobre do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function sobre()
    {
        return view('project.about', ['page' => 'sobre']);
    }

    /**
     * Página sobre do projeto
     *
     * @return \Illuminate\Http\Response
     */
    public function equipe()
    {
        $team = [(object) [
            'name'        => 'Eduardo Ramos',
            'img'         => 'img/team/edu.jpg',
            'description' => 'Programador, roterista, front-end, designer e mochileiro',
            'facebook'    => 'https://www.facebook.com/eduardoaugustoramos',
            'twitter'     => 'https://twitter.com/EduardoRamos__',
            'github'      => 'http://github.com/eduduardo',
            'author_blog' => 'edu'],

            (object) [
                'name'        => 'Adriano Faboci',
                'img'         => 'img/team/adriano.jpg',
                'description' => 'Um jovem amante da música, além de um viciado em series e jogos eletrônicos!',
                'facebook'    => 'https://www.facebook.com/adriano.faboci',
                'instagram'   => 'https://www.instagram.com/adriano_faboci/',
                'author_blog' => 'adriano'],

            (object) [
                'name'        => 'Brenda Conttessotto',
                'img'         => 'img/team/bre.jpg',
                'description' => 'Faz tudo',
                'facebook'    => 'https://www.facebook.com/brendacaroline.conttessotto',
                'author_blog' => 'brenda'],

            (object) [
                'name'        => 'Laís Vitória',
                'img'         => 'img/team/lais.jpg',
                'description' => 'Artista, roterista, escritora, designer e mochileira',
                'facebook'    => 'https://www.facebook.com/laisvitoria.granziera',
                'instagram'   => 'https://www.instagram.com/lais_granziera/',
                'devianart'   => 'http://artbygranziera.deviantart.com/',
                'author_blog' => 'lais'],

            (object) [
                'name'        => 'Gabriel Ferreira',
                'img'         => 'img/team/gabriel.jpg',
                'description' => 'Faz tudo e mochileiro',
                'facebook'    => 'https://www.facebook.com/profile.php?id=100004880953329',
                'author_blog' => 'gab'],
        ];
        return view('project.team', ['team' => $team, 'page' => 'equipe']);
    }



    /**
     * Página de termos de uso
     *
     * @return \Illuminate\Http\Response
     */
    public function termos()
    {
        return view('project.termos', ['page' => 'termos']);
    }

    /**
     * Página de política de privacidade
     *
     * @return \Illuminate\Http\Response
     */
    public function politica()
    {
        return view('project.politica', ['page' => 'politica']);
    }

    /**
     * Página de créditos e referencias
     *
     * @return \Illuminate\Http\Response
     */
    public function credits()
    {
        return view('project.credits', ['page' => 'credits']);
    }


    /**
     * Muda para inglês o aplicativo
     *
     * @param string lang
     * @return \Illuminate\Http\Response
     */
    public function change_language(Request $request, $lang = 'en')
    {
        if (in_array($lang, $this->lang_avaliable)) {
            session()->put('language', $lang);

            if (auth()->check()) {
                UserConfig::setConfig('lang', $lang);
            }

        } else {
            exit('Essa linguagem não é suportada.');
        }
        return redirect()->back();
    }
}
