<html lang="pt-br">

<?php $title = 'Editar Cupons - ERP'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

<body class="bg-light">

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

    <?php require __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>