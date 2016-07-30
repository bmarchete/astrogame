<?php

namespace App\Http\Controllers;

use App\UserConfig;
use Illuminate\Http\Request;
use DB;
use App\User;
use Cache;

class HomeController extends Controller
{
    public $lang_avaliable = ['pt-br', 'en'];

    /**
     * Página inicial do projeto.
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
        return view('project.home');
    }

    /**
     * Página sobre do projeto.
     *
     * @return \Illuminate\Http\Response
     */
    public function sobre()
    {
        return view('project.about');
    }

    // middleware game
    public function ranking()
    {
        $players = Cache::remember('ranking', 5, function(){
            DB::statement(DB::raw('set @row:=0'));
            return User::select(DB::raw('@row:=@row+1 as row'), 'id', 'name', 'level', 'xp')
                      ->whereHas('config', function ($q) {
                          $q->where('key', 'private')->where('content', false);
                      })->limit(100)->orderBy('xp', 'DESC')->get();
        });

        return view('project.ranking', ['players' => $players]);
    }

    /**
     * Página sobre do projeto.
     *
     * @return \Illuminate\Http\Response
     */
    public function equipe()
    {
        $team = [(object) [
            'name' => 'Eduardo Ramos',
            'img' => 'img/team/edu.jpg',
            'description' => 'Programador, roteirista, front-end, designer, sysadmin e mochileiro',
            'facebook' => 'https://www.facebook.com/eduardoaugustoramos',
            'twitter' => 'https://twitter.com/EduardoRamos__',
            'github' => 'http://eduduardo.github.io',
            'instagram' => 'https://www.instagram.com/eduramos__/',
            ],

            (object) [
                'name' => 'Adriano Faboci',
                'img' => 'img/team/adriano.jpg',
                'description' => 'Game designer, roteirista e mochileiro',
                'facebook' => 'https://www.facebook.com/adriano.faboci',
                'instagram' => 'https://www.instagram.com/adriano_faboci/',
              ],

            (object) [
                'name' => 'Brenda Conttessotto',
                'img' => 'img/team/bre.jpg',
                'description' => 'Escritora e mochileira',
                'facebook' => 'https://www.facebook.com/brendacaroline.conttessotto',
                'instagram' => 'https://www.instagram.com/breconttessotto/',
                'twitter' => 'https://twitter.com/breconttessotto',
                ],

            (object) [
                'name' => 'Laís Vitória',
                'img' => 'img/team/lais.jpg',
                'description' => 'Artista, roteirista, escritora, designer e mochileira',
                'facebook' => 'https://www.facebook.com/laisvitoria.granziera',
                'instagram' => 'https://www.instagram.com/lais_granziera/',
                'devianart' => 'http://artbygranziera.deviantart.com/',
              ],

            (object) [
                'name' => 'Gabriel Ferreira',
                'img' => 'img/team/gabriel.jpg',
                'description' => 'Escritor, roteirista e mochileiro',
                'facebook' => 'https://www.facebook.com/profile.php?id=100004880953329',
                'twitter' => 'https://twitter.com/GabrielfilipeF',
                ],
        ];

        return view('project.team', ['team' => $team]);
    }

    /**
     * Página de termos de uso.
     *
     * @return \Illuminate\Http\Response
     */
    public function termos()
    {
        return view('project.termos');
    }

    /**
     * Página de política de privacidade.
     *
     * @return \Illuminate\Http\Response
     */
    public function politica()
    {
        return view('project.politica');
    }

    /**
     * Página de créditos e referencias.
     *
     * @return \Illuminate\Http\Response
     */
    public function credits()
    {
        return view('project.credits');
    }

    /**
     * Muda para inglês o aplicativo.
     *
     * @param string lang
     *
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
