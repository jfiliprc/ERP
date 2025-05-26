<?php

namespace App\Controllers;

use App\Helpers\Validator;
use App\Models\ProdutoModel;
use App\Helpers\View;

class ProdutoController
{
    public function index(?string $message = null, ?array $errors = null)
    {
        $produtos = ProdutoModel::all();

        View::render('produtos/index', [
            'produtos' => $produtos,
            'errors' => $errors ?? null,
            'message' => $message ?? null,
        ]);

        return;
    }

    public function store()
    {
        $data = [
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'valor' => filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
        ];

        $rules = [
            'nome' => ['required', 'min' => 3],
            'valor' => ['required', 'numeric', 'positive'],
        ];

        $errors = Validator::validate($data, $rules);

        // Verificar se já existe produto com esse nome
        if (!$errors && ProdutoModel::existsByName($data['nome'])) {
            $errors['nome'] = 'Já existe um produto cadastrado com este nome.';
        }

        if ($errors) {
            $this->index(errors: $errors);
            return;
        }

        ProdutoModel::create($data);

        $this->index(message: 'Produto adicionado com sucesso!');
    }

    public function show($id)
    {
        $produto = ProdutoModel::find($id);

        if (!$produto) {
            http_response_code(404);
            echo "Produto não encontrado.";
            return;
        }

        View::render('produtos/edit', [
            'produto' => $produto
        ]);

        return;
    }

    public function update($id)
    {
        $data = [
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'valor' => filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
        ];

        $rules = [
            'nome' => ['required', 'min' => 3],
            'valor' => ['required', 'numeric', 'positive'],
        ];

        $errors = Validator::validate($data, $rules);

        // Verificar duplicidade excluindo o próprio registro atual
        if (!$errors && ProdutoModel::existsByName($data['nome'], $id)) {
            $errors['nome'] = 'Já existe outro produto cadastrado com este nome.';
        }

        if ($errors) {
            $produto = ProdutoModel::find($id);
            View::render('produtos/edit', [
                'errors' => $errors,
                'produto' => array_merge($produto ?? [], $data),
            ]);
            return;
        }

        ProdutoModel::update($id, $data);

        $this->index(message: 'Produto atualizado com sucesso!');
    }


    public function destroy($id)
    {
        ProdutoModel::delete($id);

        $this->index(message: 'Produto excluído com sucesso!');
        return;
    }
}
