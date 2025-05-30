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
        'telefono' => 'required|numeric|digits_between:8,15',
        'correo' => 'required|email|unique:users,email',
        'password' => [
            'required',
            'min:8',
            //'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        ],
        'password_confirmation' => 'required|same:password',
        'rol' => 'required|in:admin,reclutador,candidato',
    ];

    protected $messages = [
        'nombre.required' => 'El campo nombre es obligatorio.',
        'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
        'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
        
        'telefono.required' => 'El campo teléfono es obligatorio.',
        'telefono.numeric' => 'El campo teléfono debe contener solo números.',
        'telefono.digits_between' => 'El campo teléfono debe tener entre 8 y 15 dígitos.',

        'correo.required' => 'El campo correo es obligatorio.',
        'correo.email' => 'El correo electrónico debe tener un formato válido.',
        'correo.unique' => 'Este correo ya está registrado.',

        'password.required' => 'El campo contraseña es obligatorio.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y un carácter especial.',

        'password_confirmation.required' => 'Debe confirmar la contraseña.',
        'password_confirmation.same' => 'Las contraseñas no coinciden.',

        'rol.required' => 'El campo rol es obligatorio.',
        'rol.in' => 'El rol seleccionado no es válido. Debe ser admin, reclutador o candidato.',
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
