<?php

namespace App\Livewire\Admin\User;

use App\Models\Candidato;
use App\Models\Reclutador;
use App\Models\User;
use App\Traits\FuncionesGlobales;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;
use Livewire\Component;

class UserCreate extends Component
{
    use FuncionesGlobales;

    public $nombre = '';
    public $telefono = '';
    public $correo = '';
    public $password = '';
    public $password_confirmation = '';
    public $rol = 'candidato';
    public $departamento = '';
    public $direccion = '';
    public $toggleEstado = true;
    
    protected $rules = [
        'nombre' => 'required|string|max:255',
        'telefono' => 'required|string|min:8|max:15',
        'correo' => 'required|email|unique:users,email',
        'password' => [
            'required',
            'min:8',
            // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        ],
        'password_confirmation' => 'required|same:password',
        'rol' => 'required|in:admin,reclutador,candidato',

        'cargo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo', // ajusta si usas otros estados
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'modalidad' => 'required|in:presencial,remoto,hibrido', // ajusta según tus modalidades
            'salario_minimo' => 'required|numeric|min:0',
            'salario_maximo' => 'required|numeric|gte:salario_minimo',
            'area_id' => 'required|exists:areas,id', // asume que existe una tabla areas
    ];

    protected $messages = [
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria.',
        'password_confirmation.same' => 'Las contraseñas no coinciden.',
        'password.regex' => 'La contraseña debe contener al menos una mayúscula, minúscula, número y símbolo.',
        'correo.unique' => 'El correo ya está en uso.',
        
        'cargo.required' => 'El cargo es obligatorio.',
        
        'estado.in' => 'El estado debe ser activo o inactivo.',
        
        'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser posterior o igual a la fecha de inicio.',
        
        'salario_maximo.gte' => 'El salario máximo debe ser mayor o igual al salario mínimo.',
        
        'area_id.exists' => 'El área seleccionada no es válida.',
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
            'estado' => $this->toggleEstado ? 'A' : 'I',
        ]);

        if ($this->rol == 'candidato') {
            Candidato::create([
                'direccion' => $this->direccion,
                'user_id' => $user->id,
            ]);
        }
        if ($this->rol == 'reclutador') {
            Reclutador::create([
                'departamento' => $this->departamento,
                'user_id' => $user->id,
            ]);
        }

        $user->assignRole($this->rol);

        $this->cargarABitacora($request, 'Creación de un nuevo usuario con rol ' . $this->rol, 'users', $user->id);

        session()->flash('message', 'Usuario creado correctamente.');
        $this->reset();
        return redirect()->route('admin.users.index');
    }
    public function render()
    {

        return view('livewire.admin.user.user-create');
    }
}
