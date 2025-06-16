<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CandidatoOferta;
use App\Models\Oferta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatoController extends Controller
{
    public function welcome()
    {
        $ofertas = Oferta::all();
        return view('welcome', compact('ofertas'));
    }

    public function postular(Request $request, $ofertaId)
    {
        $oferta = Oferta::find($ofertaId);
        $candidato = Auth::user()->candidato;

        $yaPostulado = CandidatoOferta::where('candidato_id', $candidato->id)
            ->where('oferta_id', $ofertaId)
            ->exists();

        if ($yaPostulado) {
            return redirect()->route('candidato.welcome')->with('error', 'Ya has postulado a esta oferta');
        }
        CandidatoOferta::create([
            'estado' => 'A',
            'fecha_postulacion' => Carbon::now(),
            'oferta_id' => $oferta->id,
            'candidato_id' => Auth::user()->candidato->id
        ]);

        return redirect()->route('candidato.welcome')->with('success', 'Postulación exitosa');
    }
}
