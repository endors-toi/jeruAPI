<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|max:20',
            'apellido' => 'required|max:20',
            'nombre_usuario' => 'required|min:3|max:20|unique:usuarios',
            'contrasena' => 'required|max:255',
            'id_rol' => 'required|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre no puede tener más de 20 caracteres',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.max' => 'El apellido no puede tener más de 20 caracteres',
            'nombre_usuario.required' => 'El nombre de usuario es obligatorio',
            'nombre_usuario.min' => 'El nombre de usuario debe tener al menos 3 caracteres',
            'nombre_usuario.max' => 'El nombre de usuario no puede tener más de 20 caracteres',
            'nombre_usuario.unique' => 'El nombre de usuario ya existe',
            'contrasena.required' => 'La contraseña es requerida',
            'contrasena.max' => 'Error en la contraseña',
            'id_rol.required' => 'El rol es obligatorio',
            'id_rol.exists' => 'El rol no existe',
        ];
    }
}
