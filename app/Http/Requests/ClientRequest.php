<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigo' => [
                'required',
                'max:20',
                Rule::unique('clientes', 'codigo')->ignore($this->client), // Asumiendo que 'cliente' es el nombre del parámetro de la ruta
            ],
            'nombre' => [
                'required',
                'string',
                'max:255'
            ],
            'direccion' => 'required|max:255',
            'telefono' => 'required|numeric',
            'correo' => [
                'required',
                'email',
                'max:255',
                Rule::unique('clientes', 'correo')->ignore($this->client),
            ],
        ];
    }
    

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'codigo.required' => 'El código es obligatorio.',
            'codigo.unique' => 'El código ya está en uso.',
            'codigo.max' => 'El código no debe exceder los 20 caracteres.',
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.max' => 'La dirección no debe exceder los 255 caracteres.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser un número.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe ser una dirección válida.',
            'correo.max' => 'El correo electrónico no debe exceder los 255 caracteres.',
            'correo.unique' => 'El correo electrónico ya está en uso.',
        ];
    }
}
