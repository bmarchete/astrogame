<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use User;

// toda a magia vai acontecer aqui :)
class GameController extends Controller
{
    public function index() {
    	return view('game.chapters.tutorial');
    }	

    public function tutorial() {

    }
}
