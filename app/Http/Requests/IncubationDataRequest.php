<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncubationDataRequest extends FormRequest
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
            'fecha_recepcion' => 'required',
            'cliente_id' => 'required',
            'producto' => 'required',
            'cantidad' => 'required|numeric',
            'tipo_huevo' => 'required',
            'numero_bandeja' => 'required',
            'etapa' => 'nullable',
            'estado' => 'nullable',
            'descripcion' => 'nullable',
            // Añade más reglas de validación según necesites
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
            'fecha_recepcion.required' => 'La fecha de recepción es requerida.',
            'cliente_id.required' => 'El campo cliente es requerido.',
            'producto.required' => 'El campo producto es requerido.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.numeric' => 'La cantidad debe ser un valor numérico.',
            'tipo_huevo.required' => 'El tipo de huevo es obligatorio.',
            'numero_bandeja.required' => 'El número de bandeja es obligatorio.',
            // Añade más mensajes de error personalizados según necesites
        ];
    }
}