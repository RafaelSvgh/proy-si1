<?php

namespace App\Http\Controllers\Reclutador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReclutadorController extends Controller
{
    public function index(){
        return view('reclutador.dashboard');
    }
}
