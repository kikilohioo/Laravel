<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'names' => ['required', 'max:255'],
            'lasnames' => ['required', 'max:255'],
            'email' => ['required'],
            'password' => ['required'],
            'DNI' => ['required'],
            'DNI_type' => ['required'],
            'phone' => ['required'],
            'gender' => ['required'],
            'position' => ['required'],
            'number' => ['required']
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function () {
            //logica que no es esfecificamente de las reglas, pero se requiere validar
        });
    }
}
