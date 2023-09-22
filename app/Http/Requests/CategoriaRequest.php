<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
            'nombre' => 'required|string|max:20|unique:categorias,nombre',
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['nombre'] = 'required|string|max:20|unique:categorias,nombre,' . $this->route('categoria');
        }

        return $rules;
    }
}
