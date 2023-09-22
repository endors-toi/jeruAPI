<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdenRequest extends FormRequest
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
        $rules = [
            'id_usuario' => 'required|exists:usuarios,id',
            'estado' => 'required|integer|min:0|max:255', // Assuming 0-255 range for tinyInteger
            'nombre_cliente' => 'nullable|string|max:255',
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            unset($rules['id_usuario']); // Assuming you don't want to change the user ID on update
        }

        return $rules;
    }
}
