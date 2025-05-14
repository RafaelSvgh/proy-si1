<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\FuncionesGlobales;
use Illuminate\Http\Request;
use App\Models\Permiso;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    use FuncionesGlobales;
    public function index(){
        $permisos = Permission::all(); //trae todos registros de la tabla conocimiento y los almacena
        return view('admin.permiso.index', compact('permisos')); // se retorna una vista con la variable 
    }

    public function edit($id){
        $permiso = Permission::find($id);
        return view('admin.permiso.edit', compact('permiso'));
    }

    public function create(){
        return view('admin.permiso.create');
    }

    public function store(Request $request){ // añade un nuevo registro en la tabla de conocimiento
        $permiso = Permission::create([
            'name'=> $request->nombre
        ]);
        $this->cargarABitacora($request, 'Creacion de un nuevo Permiso', 'permiso', $permiso->id);
        return redirect(route('admin.permiso.index'));
    }

    public function update(Request $request, $id){
        $permiso = Permission::find($id);
        $permiso->update([
            'name'=> $request->nombre
        ]);
        $this->cargarABitacora($request, 'Actualizacion de un Permiso', 'permiso', $permiso->id);
        return redirect(route('admin.permiso.index'));
    }

    public function destroy(Request $request, $id){
        $permiso = Permission::find($id);
        $permiso->delete();
        $this->cargarABitacora($request, 'Eliminacion de un Permiso', 'permiso', $permiso->id);
        return redirect(route('admin.permiso.index'));
    }
}
