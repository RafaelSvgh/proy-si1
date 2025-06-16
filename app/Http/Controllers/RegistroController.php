<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'estado' => 'A',
        ]);

        $user->assignRole('candidato');

        return redirect()->route('/');
    }

    // public function login(Request $request){
    //     dd($request->all());
    //     $user = User::where('email', $request->email)->first();
    //     if($user){
    //         $user->HasRole('candidato') ? redirect()->route('/') : redirect()->route('/admin');
    //     }
    //     return redirect()->route('/');
    // }

    // public function login(Request $request)
    // {
    //     // Validación
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate(); // Previene ataques de sesión

    //         $user = Auth::user();

    //         if ($user->hasRole('candidato')) {
    //             return redirect()->route('home');
    //         } else {
    //             return redirect()->route('admin.dashboard');
    //         }
    //     }

    //     return back()->withErrors([
    //         'email' => 'Credenciales incorrectas.',
    //     ]);
    // }
}
