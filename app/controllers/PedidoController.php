<?php

namespace App\Controllers;

use App\Helpers\Validator;
use App\Helpers\View;
use App\Models\CarrinhoModel;
use App\Models\CupomModel;
use App\Models\EstoqueModel;
use App\Models\PedidoModel;
use App\Models\ProdutoModel;




class PedidoController
{
    public function index($errors = null, $message = null)
    {
        $pedidos = PedidoModel::getAllWithDetails();

        View::render('pedidos/index', [
            'pedidos' => $pedidos,
            'errors' => $errors,
            'message' => $message,
        ]);
    }


    public function create(?array $extras = null)
    {
        $totalCarrinho = CarrinhoModel::getTotal();

        $frete = 0.00;

        if ($totalCarrinho >= 52.00 && $totalCarrinho <= 166.59) {
            $frete = 15.00;
        } elseif ($totalCarrinho > 200.00) {
            $frete = 0.00;
        } else {
            $frete = 20.00;
        }

        $totalFinal = $totalCarrinho + $frete;


        $data = [
            'totalCarrinho' => $totalCarrinho,
            'frete' => $frete,
            'totalFinal' => $totalFinal,
            'errors' => null,
            'message' => null,
        ];

        $data = array_merge($data, $extras);

        View::render('pedido/index', $data);
    }


    public function aplicar()
    {
        $codigo = trim(filter_input(INPUT_POST, 'cupom', FILTER_SANITIZE_SPECIAL_CHARS));

        $carrinho = CarrinhoModel::getCarrinho();

        if (empty($carrinho)) {
            $this->create(['errors' => ['carrinho' => 'Carrinho vazio']]);
            return;
        }

        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += ($item['valor'] ?? 0) * ($item['quantidade'] ?? 1);
        }

        $cupom = CupomModel::getCupomValido($codigo, $subtotal);

        if (!$cupom) {
            $this->create(['errors' => ['cupom' => 'Cupom inválido ou expirado.']]);
            return;
        }

        $desconto = ($subtotal * ($cupom['desconto'] / 100));
        $total = $subtotal - $desconto;

        $this->create([
            'message' => 'Cupom aplicado com sucesso!',
            'subtotal' => $subtotal,
            'desconto' => $desconto,
            'totalFinal' => $total,
            'cupom' => $cupom,
            'codigo' => $codigo,
        ]);
    }

    public function alterarStatus()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $novoStatus = trim(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS));

        $statusValidos = ['pendente', 'pago', 'enviado', 'cancelado'];

        if (!$id || !$novoStatus || !in_array($novoStatus, $statusValidos)) {
            $this->index(['status' => 'Dados inválidos para alteração de status']);
            return;
        }

        // Atualiza o status no banco
        $atualizado = PedidoModel::updateStatus($id, $novoStatus);

        if ($atualizado) {
            $this->index(null, "Status do pedido #$id atualizado para '$novoStatus'.");
        } else {
            $this->index(['status' => 'Erro ao atualizar status do pedido.']);
        }
    }




    public function store()
    {
        $data = [
            'cep' => trim(filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS)),
            'logradouro' => trim(filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_SPECIAL_CHARS)),
            'numero' => trim(filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS)),
            'bairro' => trim(filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS)),
            'cidade' => trim(filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS)),
            'estado' => trim(filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS)),
        ];


        $rules = [
            'cep' => ['required', 'min' => 8, 'max' => 9],
            'logradouro' => ['required', 'min' => 3],
            'numero' => ['required'],
            'bairro' => ['required', 'min' => 3],
            'cidade' => ['required', 'min' => 3],
            'estado' => ['required', 'min' => 2, 'max' => 2],
        ];

        $errors = Validator::validate($data, $rules);

        if ($errors) {
            $this->index(errors: $errors);
            return;
        }


        $enderecoCompleto = "{$data['logradouro']}, {$data['numero']} - {$data['bairro']}, {$data['cidade']}-{$data['estado']}, CEP: {$data['cep']}";

        // Pega o carrinho da sessão
        $carrinho = CarrinhoModel::getCarrinho();

        if (empty($carrinho)) {
            $this->index(errors: ['carrinho' => 'O carrinho está vazio.']);
            return;
        }


        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += ($item['valor'] ?? 0) * ($item['quantidade'] ?? 1);
        }


        if ($subtotal >= 52.00 && $subtotal <= 166.59) {
            $frete = 15.00;
        } elseif ($subtotal > 200.00) {
            $frete = 0.00;
        } else {
            $frete = 20.00;
        }

        $total = $subtotal + $frete;

        $pedidoData = [
            'total' => $total,
            'frete' => $frete,
            'status' => 'pendente',
            'endereco' => $enderecoCompleto,
            'cep' => $data['cep'],
        ];

        $pedidoId = PedidoModel::createPedido($pedidoData);
        PedidoModel::createItensPedido($pedidoId, $carrinho);
        foreach ($carrinho as $item) {
            EstoqueModel::subtrairEstoque($item['variacao_id'], $item['quantidade']);
        }


        unset($_SESSION['carrinho']);

        $this->index(message: 'Pedido criado com sucesso!');
    }


}