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
        return view('game.chapters.welcome', $this->view_vars());
    }

    public function tutorial()
    {
        $chapter      = new UserProgres;
        $chapter->key = 'welcome';
        $complete     = $chapter->complete()['completed'];
        if ($complete) {
            session()->put('notify',

                [

                    ['text'  => '<i class="uk-icon-exclamation"> </i> Você ganhou 100 xp!',
                        'status' => 'success'],
                    ['text'  => '<i class="uk-icon-exclamation"> </i> Parabéns, você acabou de completar as boas vindas!',
                        'status' => 'success'],

                ]);
        } else {
            session()->forget('notify');
        }
        return view('game.chapters.tutorial', $this->view_vars());
    }

    public function chapter1()
    {
        $chapter      = new UserProgres;
        $chapter->key = 'tutorial';
        $complete     = $chapter->complete()['completed'];

        if ($complete) {
            session()->put('notify',

                [

                    ['text'  => '<i class="uk-icon-exclamation"> </i> Você ganhou 200 xp!',
                        'status' => 'success'],
                    ['text'  => '<i class="uk-icon-exclamation"> </i> Parabéns, você acabou de completar o tutorial básico!',
                        'status' => 'success'],

                ]);
        } else {
            session()->forget('notify');
        }

        return view('game.chapters.chapter1', $this->view_vars());
    }
}
