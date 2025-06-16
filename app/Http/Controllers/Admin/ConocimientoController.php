<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\FuncionesGlobales;
use Illuminate\Http\Request;
use App\Models\Conocimiento;

class ConocimientoController extends Controller
{
    use FuncionesGlobales;
    public function index()
    {
        $conocimientos = Conocimiento::all(); //trae todos registros de la tabla conocimiento y los almacena
        return view('admin.conocimiento.index', compact('conocimientos')); // se retorna una vista con la variable
    }

    public function create()
    {
        return view('admin.conocimiento.create');
    }

    public function store(Request $request)
    { // añade un nuevo registro en la tabla de conocimiento
        $conocimiento = Conocimiento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        $this->cargarABitacora($request, 'Creacion de una nueva Area de Conocimiento', 'conocimiento', $conocimiento->id);
        return redirect(route('admin.conocimiento.index'));
    }

    public function edit($id)
    {
        $conocimiento = Conocimiento::find($id);
        return view('admin.conocimiento.edit', compact('conocimiento'));
    }

    public function update(Request $request, $id)
    {
        $conocimiento = Conocimiento::find($id);
        $conocimiento->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        $this->cargarABitacora($request, 'Actualizacion de una Area de Conocimiento', 'conocimiento', $conocimiento->id);
        return redirect(route('admin.conocimiento.index'));
    }

    public function destroy(Request $request, $id)
    {
        $conocimiento = Conocimiento::find($id);
        $conocimiento->delete();
        $this->cargarABitacora($request, 'Eliminacion de una Area de Conocimiento', 'conocimiento', $conocimiento->id);
        return redirect(route('admin.conocimiento.index'));
    }
}
