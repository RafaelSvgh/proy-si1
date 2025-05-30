<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\User;
use App\Traits\FuncionesGlobales;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     use FuncionesGlobales;

    public function index()
    {
        $candidatos = Candidato::orderBy('updated_at', 'desc')->paginate(10);
        return view('candidato.index', compact('candidatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidato.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $candidato= Candidato::find($id);
        $user = $candidato->user;
        if ($candidato) {
            return view('candidato.edit', compact('user', 'candidato'));
        } else {
            return redirect()->route('candidato.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $candidato = Candidato::find($id);    
        if ($candidato) {
            $user = User::find($candidato->user_id);
            $candidato->delete();
            $user->delete();
            $this->cargarABitacora($request, 'Eliminación de un usuario', 'users', $user->id);
            return redirect()->route('admin.candidato.index');
        } else {
            return redirect()->route('admin.candidato.index');
        }
    }
}
