<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function index(){
        $bitacoras = Bitacora::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.bitacora.index', compact('bitacoras'));
    }
}
