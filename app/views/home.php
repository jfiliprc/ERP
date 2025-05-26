<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Home - ERP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body style="background-color: #cfe9f1;">

    <!-- HERO -->
    <section class="py-5 text-center">
        <div class="container">
            <h1 class="display-4 fw-bold text-primary">Mini ERP</h1>
            <p class="lead text-secondary">Gerencie produtos, pedidos e muito mais com facilidade.</p>
        </div>
    </section>

    <!-- CARDS -->
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

            <!-- Produtos -->
            <div class="col">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body text-center d-flex flex-column">
                        <i class="bi bi-box-seam display-4 text-primary mb-3"></i>
                        <h5 class="card-title">Produtos</h5>
                        <p class="card-text">Cadastre e gerencie seus produtos e variações.</p>
                        <a href="/produtos" class="btn btn-primary w-100 mb-2 mt-auto">Produtos</a>
                        <a href="/variacoes" class="btn btn-outline-primary w-100">Variações</a>
                    </div>
                </div>
            </div>

            <!-- Estoque -->
            <div class="col">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body text-center d-flex flex-column">
                        <i class="bi bi-clipboard-data display-4 text-success mb-3"></i>
                        <h5 class="card-title">Estoque</h5>
                        <p class="card-text">Monitore e atualize o estoque de seus produtos.</p>
                        <a href="/estoque" class="btn btn-success w-100 mt-auto">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Pedidos -->
            <div class="col">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body text-center d-flex flex-column">
                        <i class="bi bi-cart4 display-4 text-warning mb-3"></i>
                        <h5 class="card-title">Pedidos</h5>
                        <p class="card-text">Acompanhe os pedidos realizados pelos clientes.</p>
                        <a href="/pedidos" class="btn btn-warning w-100 mt-auto">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Cupons -->
            <div class="col">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body text-center d-flex flex-column">
                        <i class="bi bi-ticket-perforated display-4 text-danger mb-3"></i>
                        <h5 class="card-title">Cupons</h5>
                        <p class="card-text">Crie e gerencie cupons de desconto.</p>
                        <a href="/cupons" class="btn btn-danger w-100 mt-auto">Acessar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- LOJA - Card Full Width -->
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border rounded-4" style="background-color: #ffffff; border-color: #a8d0ff;">
                    <div
                        class="card-body text-center text-primary d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-shop-window display-4"></i>
                            <div>
                                <h4 class="mb-1 fw-bold">Loja</h4>
                                <p class="mb-0" style="max-width: 600px;">Faça compras aqui e gerencie seu carrinho
                                    facilmente.</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="/loja" class="btn btn-primary btn-lg fw-semibold">
                                <i class="bi bi-bag-fill me-2"></i> Acessar Loja
                            </a>
                            <a href="/carrinho" class="btn btn-outline-primary btn-lg fw-semibold">
                                <i class="bi bi-cart3 me-2"></i> Ver Carrinho
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- FOOTER -->
    <footer class="text-center py-4 text-muted">
        ERP © 2025
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <style>
        .custom-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</body>




</html>