<?php

namespace App\Controllers;

use App\Helpers\Validator;
use App\Models\CupomModel;
use App\Helpers\View;

class CupomController
{
    public function index(?string $message = null, ?array $errors = null)
    {
        $cupons = CupomModel::all();

        View::render('cupons/index', [
            'cupons' => $cupons,
            'errors' => $errors ?? null,
            'message' => $message ?? null,
        ]);

        return;
    }

    public function store()
    {
        $data = [
            'codigo' => filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS),
            'desconto' => filter_input(INPUT_POST, 'desconto', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'validade' => filter_input(INPUT_POST, 'validade', FILTER_SANITIZE_SPECIAL_CHARS),
            'valor_minimo' => filter_input(INPUT_POST, 'valor_minimo', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) ?: 0.00,
        ];

        $rules = [
            'codigo' => ['required', 'min' => 3],
            'desconto' => ['required', 'numeric', 'positive'],
            'validade' => ['required'],
            'valor_minimo' => ['required', 'numeric', 'min' => 0],
        ];

        $errors = Validator::validate($data, $rules);

        if (!$errors && CupomModel::existsByCode($data['codigo'])) {
            $errors['codigo'] = 'Já existe um cupom cadastrado com este código.';
        }

        if ($errors) {
            $this->index(errors: $errors);
            return;
        }

        CupomModel::create($data);

        $this->index(message: 'Cupom adicionado com sucesso!');
    }

    public function show($id)
    {
        $cupom = CupomModel::find($id);

        if (!$cupom) {
            http_response_code(404);
            echo "Cupom não encontrado.";
            return;
        }

        View::render('cupons/edit', [
            'cupom' => $cupom
        ]);

        return;
    }

    public function update($id)
    {
        $data = [
            'codigo' => filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS),
            'desconto' => filter_input(INPUT_POST, 'desconto', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'valor_minimo' => filter_input(INPUT_POST, 'valor_minimo', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'validade' => filter_input(INPUT_POST, 'validade', FILTER_SANITIZE_SPECIAL_CHARS),
        ];

        $rules = [
            'codigo' => ['required', 'min' => 3],
            'desconto' => ['required', 'numeric', 'positive'],
            'valor_minimo' => ['required', 'numeric', 'positive'],
            'validade' => ['required'],
        ];

        $errors = Validator::validate($data, $rules);

        if (!$errors && CupomModel::existsByCode($data['codigo'], $id)) {
            $errors['codigo'] = 'Já existe outro cupom cadastrado com este código.';
        }

        if ($errors) {
            $cupom = CupomModel::find($id);
            View::render('cupons/edit', [
                'errors' => $errors,
                'cupom' => array_merge($cupom ?? [], $data),
            ]);
            return;
        }

        CupomModel::update($id, $data);

        $this->index(message: 'Cupom atualizado com sucesso!');
    }


    public function destroy($id)
    {
        CupomModel::delete($id);

        $this->index(message: 'Cupom excluído com sucesso!');
        return;
    }
}
