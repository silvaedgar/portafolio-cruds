<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function prepareForValidation()
    {
        $this->merge([
            'name' => filter_var($this->input('name'), FILTER_SANITIZE_STRING),
            'email' => filter_var($this->input('email'), FILTER_SANITIZE_EMAIL),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', $this->id == 0 ? 'unique:users,email' : "unique:users,email,$this->id"],
            'password' => 'required',
            'image' => $this->hasFile('image') ? 'image | max:2048 | mimes:jpeg,png,jpg,tiff,gif,bmp' : '',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese el Nombre ',
            'email.required' => 'Ingrese el email',
            'email.unique' => 'email ya registrado',
            'password.required' => 'Ingrese el Password',
            'image.max' => 'Tamano de Imagen no Permitido < 2MB',
            'image.image' => 'Formato de Imagen no valido',
            'image.mimes' => 'Formato de Imagen no valido',
        ];
    }
}
