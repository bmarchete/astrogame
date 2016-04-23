<?php

namespace AstroGame\Http\Controllers;

use Illuminate\Http\Request;

use AstroGame\Http\Requests;

class ObservatoryController extends GameController
{
    public function observatory() {
        $observatory = new UserObservatory();
        $observatory->get_users_planetarium();
        $this->view_vars[] = ['planetarium' => $observatory->planetarium];

        return view('game.general.observatory', $this->view_vars());
    }
}
