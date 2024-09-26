<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdatedStore extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Asegúrate de que la autorización sea correcta según tu aplicación
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'curp' => 'required|string|min:18|max:18',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'birthdate' => 'required',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255'
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'La validación falló.',
            'errors' => $validator->errors(),
        ], 422));
    }

}
