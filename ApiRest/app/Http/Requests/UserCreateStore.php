<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserCreateStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

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
            'curp' => 'required|string|min:18|max:18|unique:user_management,curp',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'birthdate' => 'required',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255'
        ];
    }
    //TODO al mandar la section se tiene que comprobar que exista en el sistema


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'La validación falló.',
            'errors' => $validator->errors(),
        ], 422));
    }



}
