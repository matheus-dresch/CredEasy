<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupFormRequest extends FormRequest
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
            'cpf' =>       ['required', 'size:14'],
            'nome' =>      ['required', 'min:3', 'max:255'],
            'renda' =>     ['required'],
            'email' =>     ['required', 'email'],
            'telefone' =>  ['required', 'min:14', 'max:24'],
            'profissao' => ['required', 'min:3', 'max:255'],

            'cep' =>     ['required'],
            'rua' =>     ['required', 'max:255' ],
            'estado' =>  ['required', 'size:2'],
            'cidade' =>  ['required', 'max:255' ],
            'bairro' =>  ['required', 'max:255' ],
            'numcasa' => ['required', 'max:255' ],

            'senha' => ['required', 'min:8', 'max:128']
        ];
    }
}
