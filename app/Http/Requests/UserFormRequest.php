<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'username'=>'required',
            'persona'=>'required',
            'email'=>'required',
            'password'=>'required',
            'rol'=>'required',
            'area'=>'required',
            'cargo'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Debe escribir un username',
            'persona.required' => 'Debe agregar una persona',
            'email.required' => 'Debe escribir correo valido',
            'password.required' => 'Debe escribir una contraseña',
            'rol.required' => 'Debe seleccionar de que categoria es esta entrada',
            'area.required' => 'Debe seleccionar una imagen para esta entrada',
            'cargo.required' => 'El archivo seleccionado no es una imagen'
        ];
    }
}
