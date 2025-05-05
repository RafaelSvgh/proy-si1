<?php

namespace App\Traits;

use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait FuncionesGlobales
{
    public function cargarABitacora(
        Request $request,
        $descripcion,
        $tabla,
        $registro_id        
    ) {
        $bitacora = new Bitacora();
        $bitacora->usuario = Auth::user()->name;
        $bitacora->descripcion = $descripcion;
        $bitacora->metodo = $request->method();
        $bitacora->ruta = $request->fullUrl();
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = $tabla;
        $bitacora->registro_id = $registro_id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();
    }
}
