<?php

namespace App\Models;

class CarrinhoModel
{
    public static function getCarrinho(): array
    {
        return $_SESSION['carrinho'] ?? [];
    }

    public static function add(array $item): void
    {
        $_SESSION['carrinho'][] = $item;
    }

    public static function update(int $index, array $item): void
    {
        if (isset($_SESSION['carrinho'][$index])) {
            $_SESSION['carrinho'][$index] = array_merge($_SESSION['carrinho'][$index], $item);
        }
    }

    public static function delete(int $index): void
    {
        if (isset($_SESSION['carrinho'][$index])) {
            unset($_SESSION['carrinho'][$index]);
            $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // reindexa
        }
    }

    public static function getTotal(): float
    {
        $total = 0;

        if (!empty($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $item) {
                $valor = $item['valor'] ?? 0;
                $quantidade = $item['quantidade'] ?? 1;
                $total += $valor * $quantidade;
            }
        }

        return $total;
    }
}
