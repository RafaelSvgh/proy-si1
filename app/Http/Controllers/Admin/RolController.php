<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.rol.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('admin.rol.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rol = Role::create([
            'name'=>$request->nombre
        ]);
        $permisos = Permission::all();

        for ($i=0; $i < count($permisos) ; $i++) {
            $permiso = $permisos[$i];
            for ($j=0; $j< count($request->permisos); $j++) { 
                if($permiso->id==intval($request->permisos[$j])){
                    $rol->givePermissionTo($permiso);
                }
            } 
        }
        return redirect(route('admin.rol.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rol = Role::find($id);
        return view('admin.rol.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rol = Role::find($id);
        $rol->update([
            'name'=>$request->nombre
        ]);
        return redirect(route('admin.rol.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol = Role::find($id);
         $rol->delete();
         return redirect(route('admin.rol.index'));
    }
}
