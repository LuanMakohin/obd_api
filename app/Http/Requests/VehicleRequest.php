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
            'manufacturer_id.required' => 'The manufacturer ID field is required.',
            'manufacturer_id.integer' => 'The manufacturer ID must be an integer.',
            'manufacturer_id.min' => 'The manufacturer ID must be a non-negative integer.',
            'model.required' => 'The model field is required.',
            'model.string' => 'The model must be a string.',
            'model.max' => 'The model may not be greater than 255 characters.',
            'type.required' => 'The type field is required.',
            'type.string' => 'The type must be a string.',
            'type.max' => 'The type may not be greater than 255 characters.',
            'year.required' => 'The year field is required.',
            'year.integer' => 'The year must be an integer.',
            'year.min' => 'The year must be a non-negative integer.',
            'mileage.required' => 'The mileage field is required.',
            'mileage.integer' => 'The mileage must be an integer.',
            'mileage.min' => 'The mileage must be a non-negative integer.',
            'user_id.required' => 'The car needs a user to be attached to',
            'user_id.integer' => 'The id needs to be a non-negative integer'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors], 422));
    }
}
