<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\UserObservatory;

class ObservatoryController extends GameController
{
    public function index() {
        $observatory = new UserObservatory();
        $observatory->get_users_planetarium();
        $this->view_vars[] = ['planetarium' => $observatory->planetarium];

        return view('game.general.observatory', $this->view_vars());
    }
}
