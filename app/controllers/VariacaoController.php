<?php

namespace App\Controllers;

use App\Helpers\Validator;
use App\Models\VariacaoModel;
use App\Models\ProdutoModel;
use App\Helpers\View;

class VariacaoController
{

    public function index(?string $message = null, ?array $errors = null)
    {
        $variacoes = VariacaoModel::getVariationsWithProducts();
        $produtos = ProdutoModel::all();

        View::render('variacoes/index', [
            'variacoes' => $variacoes,
            'produtos' => $produtos,
            'errors' => $errors ?? null,
            'message' => $message ?? null,
        ]);
        return;
    }

    public function store()
    {
        $data = [
            'produto_id' => filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT),
            'descricao' => trim(filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS)),
        ];

        $rules = [
            'produto_id' => ['required', 'numeric', 'positive'],
            'descricao' => ['required', 'min' => 3],
        ];

        $errors = Validator::validate($data, $rules);

        // Validação duplicidade
        if (!$errors && VariacaoModel::existsByProdutoAndDescricao($data['produto_id'], $data['descricao'])) {
            $errors['descricao'] = 'Já existe uma variação com essa descrição para este produto.';
        }

        if ($errors) {
            $this->index(errors: $errors);
            return;
        }

        VariacaoModel::create($data);

        $this->index(message: 'Variação adicionada com sucesso!');
        return;
    }

    public function show($id)
    {
        $variacao = VariacaoModel::find($id);
        if (!$variacao) {
            http_response_code(404);
            echo "Variação não encontrada.";
            return;
        }

        $produtos = ProdutoModel::all();

        View::render('variacoes/edit', [
            'variacao' => $variacao,
            'produtos' => $produtos,
        ]);
    }

    public function update($id)
    {
        $data = [
            'produto_id' => filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT),
            'descricao' => trim(filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS)),
        ];

        $rules = [
            'produto_id' => ['required', 'numeric', 'positive'],
            'descricao' => ['required', 'min' => 3],
        ];

        $errors = Validator::validate($data, $rules);

        // Validação duplicidade no update (ignorando o próprio registro)
        if (!$errors && VariacaoModel::existsByProdutoAndDescricao($data['produto_id'], $data['descricao'], $id)) {
            $errors['descricao'] = 'Já existe uma variação com essa descrição para este produto.';
        }

        if ($errors) {
            $variacao = VariacaoModel::find($id);
            $produto = ProdutoModel::find($variacao['produto_id']);
            $variacao['nome'] = $produto['nome'] ?? 'Produto não encontrado';
            $produtos = ProdutoModel::all();

            View::render('variacoes/edit', [
                'errors' => $errors,
                'variacao' => array_merge($variacao, $data),
                'produtos' => $produtos,
            ]);
            return;
        }

        VariacaoModel::update($id, $data);

        $this->index(message: 'Variação atualizada com sucesso!');
        return;
    }

    public function destroy($id)
    {
        VariacaoModel::delete($id);

        $this->index(message: 'Variação excluída com sucesso!');
        return;
    }
}
