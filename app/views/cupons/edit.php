<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Editar Cupom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">ERP</a>
            <div>
                <a class="btn btn-outline-light me-2" href="/"><i class="bi bi-house-door"></i></a>
                <a class="btn btn-outline-light me-2" href="/carrinho"><i class="bi bi-cart4"></i></a>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Editar Cupom</h5>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="/cupons/<?= $cupom['id'] ?>">
                            <input type="hidden" name="_method" value="PUT" />

                            <div class="mb-3">
                                <label for="codigo" class="form-label">Código do Cupom</label>
                                <input type="text" id="codigo" name="codigo" class="form-control" required
                                    value="<?= htmlspecialchars($cupom['codigo']) ?>" />
                            </div>

                            <div class="mb-3">
                                <label for="desconto" class="form-label">Desconto (%)</label>
                                <input type="number" step="0.01" min="0" max="100" id="desconto" name="desconto"
                                    class="form-control" required value="<?= htmlspecialchars($cupom['desconto']) ?>" />
                            </div>

                            <div class="mb-3">
                                <label for="valor_minimo" class="form-label">Valor Mínimo (R$)</label>
                                <input type="number" step="0.01" min="0" id="valor_minimo" name="valor_minimo"
                                    class="form-control" required
                                    value="<?= htmlspecialchars($cupom['valor_minimo']) ?>" />
                            </div>

                            <div class="mb-3">
                                <label for="validade" class="form-label">Validade</label>
                                <input type="date" id="validade" name="validade" class="form-control" required
                                    value="<?= htmlspecialchars($cupom['validade']) ?>" />
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="bi bi-save"></i> Salvar Alterações
                                </button>
                                <a href="/cupons" class="btn btn-secondary w-100">
                                    <i class="bi bi-x-circle"></i> Cancelar
                                </a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="bg-primary text-white text-center py-3">
        ERP - Sistema de Gestão &copy; <?= date('Y') ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>