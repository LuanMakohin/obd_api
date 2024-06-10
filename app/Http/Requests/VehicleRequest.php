<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VehicleRequest extends FormRequest
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
            'manufacturer_id' => 'required|integer|min:1',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'year' => 'required|integer|min:1700',
            'mileage' => 'required|integer|min:0',
            'user_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'manufacturer_id.required' => 'O campo ID do fabricante é obrigatório.',
            'manufacturer_id.integer' => 'O ID do fabricante deve ser um número inteiro.',
            'manufacturer_id.min' => 'O ID do fabricante deve ser um número inteiro não negativo.',
            'model.required' => 'O campo do modelo é obrigatório.',
            'model.string' => 'O modelo deve ser uma string.',
            'model.max' => 'O modelo não pode ter mais de 255 caracteres.',
            'type.required' => 'O campo do tipo é obrigatório.',
            'type.string' => 'O tipo deve ser uma string.',
            'type.max' => 'O tipo não pode ter mais de 255 caracteres.',
            'year.required' => 'O campo do ano é obrigatório.',
            'year.integer' => 'O ano deve ser um número inteiro.',
            'year.min' => 'O ano deve ser um número inteiro não negativo.',
            'mileage.required' => 'O campo da quilometragem é obrigatório.',
            'mileage.integer' => 'A quilometragem deve ser um número inteiro.',
            'mileage.min' => 'A quilometragem deve ser um número inteiro não negativo.',
            'user_id.required' => 'O carro precisa de um usuário para ser associado.',
            'user_id.integer' => 'O ID precisa ser um número inteiro não negativo.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors], 422));
    }
}
