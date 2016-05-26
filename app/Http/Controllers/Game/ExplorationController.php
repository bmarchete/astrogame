<?php

namespace App\Http\Controllers;

class ExplorationController extends GameController
{
    public function index()
    {
        return view('game.general.exploration', $this->view_vars());
    }
}
