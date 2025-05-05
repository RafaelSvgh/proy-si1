<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Traits\FuncionesGlobales;
use Illuminate\Http\Request;
use Livewire\Component;

class UserUpdate extends Component
{
    use FuncionesGlobales;

    public $nombre, $telefono, $correo, $password, $password_confirmation, $rol, $departamento, $direccion;
    public $userId;
    public $toggleEstado = true;
    public function mount($user, $candidato, $reclutador)
    {
        $this->nombre = $user->name;
        $this->telefono = $user->telefono;
        $this->correo = $user->email;
        $this->rol = $user->getRoleNames()->first();
        $this->userId = $user->id;
        $this->departamento = $reclutador ? $reclutador->departamento : '';
        $this->direccion = $candidato ? $candidato->direccion : '';
        $this->toggleEstado = $user->estado == 'A' ? true : false;
    }

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'telefono' => 'required|string|min:8|max:15',
        'correo' => 'required|email',
        'password' => [
            'required',
            'min:8',
            // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        ],
        'password_confirmation' => 'required|same:password',
        'rol' => 'required|in:admin,reclutador,candidato',
    ];

    protected $messages = [
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria.',
        'password_confirmation.same' => 'Las contraseñas no coinciden.',
        'password.regex' => 'La contraseña debe contener al menos una mayúscula, minúscula, número y símbolo.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update(Request $request)
    {
        $this->validate();
        $user = User::find($this->userId);
        $user->update([
            'name' => $this->nombre,
            'telefono' => $this->telefono,
            'email' => $this->correo,
            'password' => bcrypt($this->password),
            'estado' => $this->toggleEstado ? 'A' : 'I',
        ]);
        
        if($this->rol != $user->getRoleNames()->first()){
            $user->deleteReclutador();
            $user->deleteCandidato();
        }
        if ($this->rol == 'candidato') {
            $user->candidato()->updateOrCreate(
                ['user_id' => $user->id],
                ['direccion' => $this->direccion]
            );
        } else if ($this->rol == 'reclutador') {
            $user->reclutador()->updateOrCreate(
                ['user_id' => $user->id],
                ['departamento' => $this->departamento]
            );
        }
        $user->syncRoles([]);
        $user->assignRole($this->rol);
        $this->cargarABitacora($request, 'Actualización de un usuario con rol ' . $this->rol, 'users', $user->id);

        session()->flash('message', 'Usuario actualizado correctamente.');
        $this->reset();
        return redirect()->route('admin.users.index');
    }
    public function render()
    {
        return view('livewire.admin.user.user-update');
    }
}
