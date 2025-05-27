<html lang="pt-BR">
<?php $title = 'Editar Produtos - ERP'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

<body class="bg-light">
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Editar Produto</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/produtos/<?= $produto['id'] ?>">
                            <input type="hidden" name="_method" value="PUT" />

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do Produto</label>
                                <input type="text" id="nome" name="nome" class="form-control" required
                                    value="<?= htmlspecialchars($produto['nome']) ?>" />
                            </div>

                            <div class="mb-3">
                                <label for="valor" class="form-label">Valor (R$)</label>
                                <input type="number" step="0.01" min="0" id="valor" name="valor" class="form-control"
                                    required value="<?= htmlspecialchars($produto['valor']) ?>" />
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="bi bi-save"></i> Salvar Alterações
                                </button>
                                <a href="/produtos" class="btn btn-secondary w-100">
                                    <i class="bi bi-x-circle"></i> Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>