<?php

namespace AstroGame\Http\Controllers;

use Illuminate\Http\Request;

use AstroGame\Http\Requests;

class ExplorationController extends GameController
{
    public function index() {
        return view('game.general.exploration', $this->view_vars());
    }
}
