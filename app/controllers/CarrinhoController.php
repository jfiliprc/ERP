<?php

namespace App\Controllers;

use App\Helpers\Validator;
use App\Models\CarrinhoModel;
use App\Helpers\View;
use App\Models\ProdutoModel;
use App\Models\VariacaoModel;

class CarrinhoController
{
    public function index(?string $message = null, ?array $errors = null)
    {
        $itens = CarrinhoModel::getCarrinho();
        $totalCarrinho = CarrinhoModel::getTotal();

        foreach ($itens as &$item) {
            $variacao = VariacaoModel::findById($item['variacao_id']);

            if ($variacao && isset($variacao['estoque'])) {
                $item['estoque_atual'] = $variacao['estoque'];
            } else {
                $item['estoque_atual'] = 0;
            }
        }
        unset($item);

        View::render('carrinho/index', [
            'itens' => $itens,
            'errors' => $errors ?? null,
            'message' => $message ?? null,
            'totalCarrinho' => $totalCarrinho
        ]);
    }


    public function store()
    {
        $data = filter_input_array(INPUT_POST, [
            'produto_id' => FILTER_VALIDATE_INT,
            'variacao_id' => FILTER_VALIDATE_INT,
            'quantidade' => FILTER_VALIDATE_INT,
        ]);

        $rules = [
            'produto_id' => ['required', 'numeric', 'positive'],
            'variacao_id' => ['required', 'numeric', 'positive'],
            'quantidade' => ['required', 'numeric', 'min' => 1],
        ];

        $errors = Validator::validate($data, $rules);
        $produtos = ProdutoModel::getProductsWithVariations();


        $produto = ProdutoModel::findById($data['produto_id']);
        if (!$produto) {
            $errors['produto_id'] = 'Produto não encontrado.';
        }


        $variacao = VariacaoModel::findById($data['variacao_id']);
        if (!$variacao) {
            $errors['variacao_id'] = 'Variação não encontrada.';
        }

        $estoqueDisponivel = $variacao['estoque'] ?? 0;
        if ($data['quantidade'] > $estoqueDisponivel) {
            $errors['quantidade'] = 'Quantidade solicitada excede o estoque disponível.';
        }


        if ($errors) {
            return View::render('loja/index', [
                'errors' => $errors,
                'message' => null,
                'produtos' => $produtos,
            ]);
        }

        $data += [
            'produto_nome' => $produto['nome'],
            'valor' => $produto['valor'],
            'estoque' => $estoqueDisponivel,
            'variacao_descricao' => $variacao['descricao'],
        ];

        CarrinhoModel::add($data);

        return View::render('loja/index', [
            'message' => 'Item adicionado ao carrinho com sucesso!',
            'errors' => null,
            'produtos' => $produtos,
        ]);
    }



    public function update($index)
    {
        $data = [
            'quantidade' => filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT),
        ];

        $rules = [
            'quantidade' => ['required', 'numeric', 'min' => 1],
        ];

        $errors = Validator::validate($data, $rules);

        $carrinho = CarrinhoModel::getCarrinho();
        $item = $carrinho[$index] ?? null;

        if (!$item) {
            $errors['item'] = 'Item do carrinho não encontrado.';
        } else {
            $variacao = VariacaoModel::findById($item['variacao_id']);
            if (!$variacao) {
                $errors['variacao'] = 'Variação não encontrada.';
            } else {
                $estoqueDisponivel = $variacao['estoque'] ?? 0;
                if ($data['quantidade'] > $estoqueDisponivel) {
                    $errors['quantidade'] = 'Quantidade solicitada excede o estoque disponível.';
                }
            }
        }

        if ($errors) {
            $this->index(errors: $errors);
            return;
        }

        CarrinhoModel::update($index, $data);

        $this->index(message: 'Item atualizado com sucesso!');
    }



    public function destroy($index)
    {
        CarrinhoModel::delete($index);

        $this->index(message: 'Item removido do carrinho!');
    }
}
