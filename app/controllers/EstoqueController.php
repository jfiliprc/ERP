<?php

namespace App\Controllers;

use App\Helpers\Validator;
use App\Models\EstoqueModel;
use App\Models\VariacaoModel;
use App\Helpers\View;

class EstoqueController
{
    public function index(?string $message = null, ?array $errors = null)
    {
        $estoques = EstoqueModel::getEstoqueWithVariacao();
        $variacoes = VariacaoModel::getVariationsWithProducts();

        View::render('estoque/index', [
            'estoques' => $estoques,
            'variacoes' => $variacoes,
            'errors' => $errors ?? null,
            'message' => $message ?? null,
        ]);
        return;
    }

    public function store()
    {
        $data = [
            'variacao_id' => filter_input(INPUT_POST, 'variacao_id', FILTER_VALIDATE_INT),
            'quantidade' => filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT),
        ];

        $rules = [
            'variacao_id' => ['required', 'numeric', 'positive'],
            'quantidade' => ['required', 'numeric', 'min' => 0],
        ];

        $errors = Validator::validate($data, $rules);

        // Verifica duplicidade
        if (!$errors && EstoqueModel::existsByVariacao($data['variacao_id'])) {
            $errors['variacao_id'] = 'Já existe estoque cadastrado para esta variação.';
        }

        if ($errors) {
            $this->index(errors: $errors);
            return;
        }

        EstoqueModel::create($data);

        $this->index(message: 'Estoque adicionado com sucesso!');
    }


    public function show($id)
    {
        $estoque = EstoqueModel::find($id);
        if (!$estoque) {
            http_response_code(404);
            echo "Estoque não encontrado.";
            return;
        }

        $variacao = VariacaoModel::findWithProductById($estoque['variacao_id']);

        View::render('estoque/edit', [
            'estoque' => $estoque,
            'variacao' => $variacao,
        ]);
    }



    public function update($id)
    {
        $data = [
            'variacao_id' => filter_input(INPUT_POST, 'variacao_id', FILTER_VALIDATE_INT),
            'quantidade' => filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT),
        ];

        $rules = [
            'variacao_id' => ['required', 'numeric', 'positive'],
            'quantidade' => ['required', 'numeric', 'min' => 0],
        ];

        $errors = Validator::validate($data, $rules);

        if (!$errors && EstoqueModel::existsByVariacao($data['variacao_id'], $id)) {
            $errors['variacao_id'] = 'Já existe estoque cadastrado para esta variação.';
        }

        if ($errors) {
            $estoque = EstoqueModel::find($id);

            $variacao = VariacaoModel::findById($estoque['variacao_id']);

            View::render('estoque/edit', [
                'errors' => $errors,
                'estoque' => array_merge($estoque, $data),
                'variacao' => $variacao,
            ]);
            return;
        }

        EstoqueModel::update($id, $data);

        $this->index(message: 'Estoque atualizado com sucesso!');
    }



    public function destroy($id)
    {
        EstoqueModel::delete($id);

        $this->index(message: 'Estoque excluído com sucesso!');
        return;
    }
}
