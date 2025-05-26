<?php

namespace App\Controllers;

use App\Models\ProdutoModel;
use App\Helpers\View;

class LojaController
{
    public function index()
    {
        $produtos = ProdutoModel::getProductsWithVariations();

        View::render('loja/index', [
            'produtos' => $produtos
        ]);
    }

}
