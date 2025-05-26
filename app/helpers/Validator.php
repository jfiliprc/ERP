<?php

namespace App\Helpers;

class Validator
{
    /**
     * Valida dados genéricos com base em regras.
     *
     * Regras possíveis (exemplo):
     * - required: campo obrigatório
     * - min: tamanho mínimo (para string)
     * - numeric: campo deve ser numérico
     * - positive: número deve ser > 0
     *
     * @param array $data Dados a validar ['campo' => valor]
     * @param array $rules Regras ['campo' => ['required', 'min' => 3, 'numeric', 'positive']]
     * @return array Lista de erros encontrados
     */
    public static function validate(array $data, array $rules): array
    {
        $errors = [];

        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;

            foreach ($fieldRules as $rule => $ruleValue) {
                if (is_int($rule)) {
                    // Caso regra seja só string, ex: 'required'
                    $rule = $ruleValue;
                    $ruleValue = true;
                }

                switch ($rule) {
                    case 'required':
                        if ($ruleValue && empty($value) && $value !== '0') {
                            $errors[] = "O campo {$field} é obrigatório.";
                        }
                        break;

                    case 'min':
                        if (is_string($value) && strlen($value) < $ruleValue) {
                            $errors[] = "O campo {$field} deve ter pelo menos {$ruleValue} caracteres.";
                        }
                        break;

                    case 'numeric':
                        if ($ruleValue && !is_numeric($value)) {
                            $errors[] = "O campo {$field} deve ser numérico.";
                        }
                        break;

                    case 'positive':
                        if ($ruleValue && is_numeric($value) && $value <= 0) {
                            $errors[] = "O campo {$field} deve ser maior que zero.";
                        }
                        break;

                    // aqui você pode adicionar mais regras, tipo 'max', 'email', 'regex' etc.
                }
            }
        }

        return $errors;
    }
}
