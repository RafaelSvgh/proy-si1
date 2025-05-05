<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\FuncionesGlobales;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use FuncionesGlobales;

    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
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
        $user = User::find($id);
        $reclutador = $user->reclutador;
        $candidato = $user->candidato;
        if ($user) {
            return view('admin.users.edit', compact('user', 'reclutador', 'candidato'));
        } else {
            return redirect()->route('admin.users.index');
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
        $user = User::find($id);    
        if ($user) {
            $user->delete();
            $this->cargarABitacora($request, 'Eliminación de un usuario', 'users', $user->id);
            return redirect()->route('admin.users.index');
        } else {
            return redirect()->route('admin.users.index');
        }
    }
}
