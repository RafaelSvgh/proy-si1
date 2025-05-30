<?php

namespace App\Livewire\Admin\Candidato;

use Livewire\Component;
use App\Traits\FuncionesGlobales;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Candidato;

class CandidatoCreate extends Component
{
    use FuncionesGlobales;

    public $nombre = '';
    public $telefono = '';
    public $correo = '';
    public $password = '';
    public $password_confirmation = '';
    public $rol = 'candidato';
    public $direccion = '';
    
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
        'direccion' => 'required|string|max:255',
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

        'direccion.required' => 'El campo dirección es obligatorio.',
        'direccion.string' => 'El campo dirección debe ser una cadena de texto.',
        'direccion.max' => 'La dirección no debe exceder los 255 caracteres.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save(Request $request)
    {
        $this->validate();

        // Aquí puedes guardar el usuario en la base de datos
        $user = User::create([
            'name' => $this->nombre,
            'telefono' => $this->telefono,
            'email' => $this->correo,
            'password' => bcrypt($this->password),
            'estado' => 'A',
        ]);

        
        $candidato = Candidato::create([
            'direccion' => $this->direccion,
            'user_id' => $user->id,
        ]);

        $user->assignRole($this->rol);

        $this->cargarABitacora($request, 'Creación de un nuevo candidato ', 'candidatos', $candidato->id);

        session()->flash('message', 'Candidato creado correctamente.');
        $this->reset();
        return redirect()->route('admin.candidato.index');
    }
    public function render()
    {
        return view('livewire.admin.candidato.candidato-create');
    }
}
