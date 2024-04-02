<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CnpjValido implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $value);
        if (strlen($cnpj) !== 14) {
            $fail($this->message());
        }

        // Verificar dígitos verificadores
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j === 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;

        if ((int) $cnpj[12] !== ($resto < 2 ? 0 : 11 - $resto)) {
            $fail($this->message());
        }

        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j === 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        (int) $cnpj[13] === ($resto < 2 ? $fail($this->message()) : 11 - $resto);
    }

    public function message(): string
    {
        return "O :attribute é inválidoooooooo";
    }
}
