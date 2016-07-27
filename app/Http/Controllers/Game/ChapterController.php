<?php

namespace App\Http\Controllers;

use App\UserProgres;
use Illuminate\Http\Request;

class ChapterController extends GameController
{

    /**
     * Página inicial do jogo
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_chapter = new UserProgres();
        $chapter_name    = $current_chapter->current()->name;

        return $this->$chapter_name();
    }

    // =================================================
    //
    public function chapter_complete(Request $request)
    {
        // alguma checagem aqui para não ter espertinhos
        $key = $request->key;

        $chapter      = new UserProgres;
        $chapter->key = $key;
        $complete     = $chapter->complete();
        // =================================================

        return response()->json($complete);
    }

    // ========================================
    // chapters
    // order:
    // 1 - welcome (pre-tutorial)
    // 2 - tutorial
    // 3 - capítulo 1
    public function welcome()
    {
        return view('game.chapters.welcome');
    }

    public function tutorial()
    {
        return $this->general_chapter('tutorial');
    }

    public function chapter1()
    {
        return $this->general_chapter('chapter2');
    }

    public function chapter2()
    {
        return $this->general_chapter('chapter2');

    }

    public function general_chapter($chapter_key)
    {
        $chapter      = new UserProgres;
        $chapter->key = $chapter_key;
        $complete     = $chapter->complete()->completed;

        if($complete){
            session()->put('notify',
                [
                    ['text' => '<i class="uk-icon-exclamation"></i> Você ganhou CORRIGIR AQUI xp', 'status' => 'success'],

                ]);
        } else {
            //session()->put('notify');
        }
        if(view()->exists('game.chapters.' . $chapter_key)){
          return view('game.chapters.' . $chapter_key);
        } else {
          return view('game.chapters.welcome');
        }
    }
}
