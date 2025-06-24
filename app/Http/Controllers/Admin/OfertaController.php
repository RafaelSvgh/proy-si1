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
    $request->validate([
        'cargo' => 'required|string|max:255',
        'descripcion' => 'required|string|min:10',
        'estado' => 'required|in:A,I', // A = Activo, I = Inactivo (ajusta si usas otro)
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'modalidad' => 'required|in:P,R,H', // P = Presencial, R = Remoto, H = Híbrido (ajústalo a tus letras)
        'salario_minimo' => 'required|numeric|min:0',
        'salario_maximo' => 'required|numeric|gte:salario_minimo',
        'area_id' => 'required|exists:areas,id',
    ], [
        'cargo.required' => 'El cargo es obligatorio.',
        'descripcion.required' => 'La descripción es obligatoria.',
        'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
        'estado.required' => 'El estado es obligatorio.',
        'estado.in' => 'El estado debe ser A (activo) o I (inactivo).',
        'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
        'fecha_fin.required' => 'La fecha de fin es obligatoria.',
        'fecha_fin.after_or_equal' => 'La fecha de fin debe ser posterior o igual a la de inicio.',
        'modalidad.required' => 'La modalidad es obligatoria.',
        'modalidad.in' => 'La modalidad debe ser P (presencial), R (remoto) o H (híbrido).',
        'salario_minimo.required' => 'El salario mínimo es obligatorio.',
        'salario_minimo.min' => 'El salario mínimo no puede ser negativo.',
        'salario_maximo.required' => 'El salario máximo es obligatorio.',
        'salario_maximo.gte' => 'El salario máximo debe ser mayor o igual al salario mínimo.',
        'area_id.required' => 'Debe seleccionar un área.',
        'area_id.exists' => 'El área seleccionada no es válida.',
    ]);

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

        $request->validate([
        'cargo' => 'required|string|max:255',
        'descripcion' => 'required|string|min:10',
        'estado' => 'required|in:A,I', // A = Activo, I = Inactivo (ajusta si usas otro)
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'modalidad' => 'required|in:P,R,H', // P = Presencial, R = Remoto, H = Híbrido (ajústalo a tus letras)
        'salario_minimo' => 'required|numeric|min:0',
        'salario_maximo' => 'required|numeric|gte:salario_minimo',
        'area_id' => 'required|exists:areas,id',
    ], [
        'cargo.required' => 'El cargo es obligatorio.',
        'descripcion.required' => 'La descripción es obligatoria.',
        'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
        'estado.required' => 'El estado es obligatorio.',
        'estado.in' => 'El estado debe ser A (activo) o I (inactivo).',
        'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
        'fecha_fin.required' => 'La fecha de fin es obligatoria.',
        'fecha_fin.after_or_equal' => 'La fecha de fin debe ser posterior o igual a la de inicio.',
        'modalidad.required' => 'La modalidad es obligatoria.',
        'modalidad.in' => 'La modalidad debe ser P (presencial), R (remoto) o H (híbrido).',
        'salario_minimo.required' => 'El salario mínimo es obligatorio.',
        'salario_minimo.min' => 'El salario mínimo no puede ser negativo.',
        'salario_maximo.required' => 'El salario máximo es obligatorio.',
        'salario_maximo.gte' => 'El salario máximo debe ser mayor o igual al salario mínimo.',
        'area_id.required' => 'Debe seleccionar un área.',
        'area_id.exists' => 'El área seleccionada no es válida.',
    ]);

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
