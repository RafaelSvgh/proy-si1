<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'nombre' => 'required|string|max:255',
        'telefono' => 'required|numeric|digits_between:8,15',
        'correo' => 'required|email|unique:users,email',
        'password' => [
            'required',
            'min:8',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        ],
        'confirm_password' => 'required|same:password',
        'rol' => 'required|in:admin,reclutador,candidato',
    ];
}

public function messages(): array
{
    return [
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

        'confirm_password.required' => 'Debe confirmar la contraseña.',
        'confirm_password.same' => 'Las contraseñas no coinciden.',

        'rol.required' => 'El campo rol es obligatorio.',
        'rol.in' => 'El rol seleccionado no es válido. Debe ser admin, reclutador o candidato.',
    ];
}

}
