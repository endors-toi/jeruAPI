<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredienteRequest extends FormRequest
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
            'nombre' => 'required|max:20|unique:ingredientes',
            'cantidad_disponible' => 'required|integer|min:0',
            'cantidad_critica' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del ingrediente es requerido',
            'nombre.max' => 'El nombre del ingrediente no puede tener más de 20 caracteres',
            'nombre.unique' => 'El nombre del ingrediente ya existe',
            'cantidad_disponible.required' => 'La cantidad disponible del ingrediente es requerida',
            'cantidad_disponible.integer' => 'La cantidad disponible del ingrediente debe ser un número entero',
            'cantidad_disponible.min' => 'La cantidad disponible del ingrediente debe ser mayor o igual a 0',
            'cantidad_critica.required' => 'La cantidad crítica del ingrediente es requerida',
            'cantidad_critica.integer' => 'La cantidad crítica del ingrediente debe ser un número entero',
            'cantidad_critica.min' => 'La cantidad crítica del ingrediente debe ser mayor o igual a 0',
        ];
    }
}
