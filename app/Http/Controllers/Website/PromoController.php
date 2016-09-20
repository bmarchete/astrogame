<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PromoController extends Controller
{
    public function expoete(){
        return view('promos.expoete');
    }
}
