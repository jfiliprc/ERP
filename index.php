<?php
require __DIR__ . "/vendor/autoload.php";
session_start();
use Routes\Router;

$router = new Router();

$router->namespace("App\Controllers");

// Produtos
$router->delete("/produtos/{id}", "ProdutoController:destroy");
$router->put("/produtos/{id}", "ProdutoController:update");
$router->get("/produtos/{id}", "ProdutoController:show");
$router->post("/produtos", "ProdutoController:store");
$router->get("/produtos", "ProdutoController:index");

// Variações
$router->delete("/variacoes/{id}", "VariacaoController:destroy");
$router->put("/variacoes/{id}", "VariacaoController:update");
$router->get("/variacoes/{id}", "VariacaoController:show");
$router->post("/variacoes", "VariacaoController:store");
$router->get("/variacoes", "VariacaoController:index");

// Estoque
$router->delete("/estoque/{id}", "EstoqueController:destroy");  // opcional
$router->put("/estoque/{id}", "EstoqueController:update");
$router->get("/estoque/{id}", "EstoqueController:show");
$router->post("/estoque", "EstoqueController:store");
$router->get("/estoque", "EstoqueController:index");

// Cupons
$router->delete("/cupons/{id}", "CupomController:destroy");
$router->put("/cupons/{id}", "CupomController:update");
$router->get("/cupons/{id}", "CupomController:show");
$router->post("/cupons", "CupomController:store");
$router->get("/cupons", "CupomController:index");

// Loja
$router->get("/loja", "LojaController:index");

// Carrinho
$router->get("/carrinho", "CarrinhoController:index");
$router->post("/carrinho", "CarrinhoController:store");
$router->put("/carrinho/{id}", "CarrinhoController:update");
$router->delete("/carrinho/{id}", "CarrinhoController:destroy");

// Pedidos
$router->get("/pedidos", "PedidoController:index");
$router->post("/pedido/{id}/alterar-status", "PedidoController:alterarStatus");
$router->put("/pedido/{id}", "PedidoController:update");
$router->get("/pedido", "PedidoController:create");
$router->post("/pedido", "PedidoController:store");
$router->post('/pedido/aplicar-cupom', 'PedidoController:aplicar');


$router->get('/cupons', 'CupomController:index');
$router->post('/cupons', 'CupomController:store');
$router->get('/cupons/{id}', 'CupomController:show');
$router->post('/cupons/{id}', 'CupomController:update');
$router->delete('/cupons/{id}', 'CupomController:destroy');


// Home
$router->get("/", "HomeController:index");
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
