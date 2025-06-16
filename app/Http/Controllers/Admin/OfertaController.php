<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Oferta;
use App\Models\Area;
use App\Models\Reclutador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ofertas = Oferta::all(); // Retrieve all records from the 'ofertas' table
        $user = Auth::user(); // Get the currently authenticated user
        return view('admin.oferta.index', compact('ofertas', 'user')); // Return the view with the 'ofertas' variable
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();
        $reclutadores = Reclutador::all();
        return view('admin.oferta.create', compact('areas', 'reclutadores')); // Return the view for creating a new offer
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Oferta::create([
            'cargo' => $request->cargo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'modalidad' => $request->modalidad,
            'salario_minimo' => $request->salario_minimo,
            'salario_maximo' => $request->salario_maximo,
            'area_id' => $request->area_id,
            'reclutador_id' => Auth::user()->reclutador->id ?? null
        ]);
        return redirect(route('admin.oferta.index')); // Redirect to the index page after storing the offer
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
        $oferta = Oferta::find($id); // Find the offer by ID
        $areas = Area::all();
        return view('admin.oferta.edit', compact('oferta', 'areas')); // Return the edit view with the offer data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $oferta = Oferta::find($id);
        $oferta->update([
            'cargo' => $request->cargo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'modalidad' => $request->modalidad,
            'salario_minimo' => $request->salario_minimo,
            'salario_maximo' => $request->salario_maximo,
            'area_id' => $request->area_id,
            'reclutador_id' => Auth::user()->reclutador->id ?? null
        ]);
        return redirect(route('admin.oferta.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $oferta = Oferta::find($id); // Find the offer by ID
        $oferta->delete(); // Delete the offer
        return redirect(route('admin.oferta.index')); // Redirect to the index page
    }

    public function candidatos(string $id)
    {
        $oferta = Oferta::find($id);
        $candidatos = $oferta->candidatoOferta;
        return view('admin.oferta.candidatos', compact('oferta', 'candidatos'));
    }

}
