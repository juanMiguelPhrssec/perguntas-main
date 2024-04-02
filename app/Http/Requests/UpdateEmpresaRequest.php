<?php

namespace App\Http\Requests;

use App\Rules\CnpjValido;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
{
    
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
            'nome_da_empresa' => 'required',
            'cnpj' => ['required', 'string', 'min:14', 'max:18', new CnpjValido],
            
         
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Inclua o ID do usuário atualmente autenticado nos dados da solicitação
        $this->merge([
       
            'cnpj' => preg_replace('/[^0-9]/', '', $this->cnpj),
        ]);
    }
}
