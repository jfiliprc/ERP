<?php $title = 'Editar Estoque - ERP'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Editar Estoque</h5>
                </div>
                <div class="card-body">

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/estoque/<?= htmlspecialchars($estoque['id']) ?>">
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="variacao_id"
                            value="<?= htmlspecialchars($estoque['variacao_id']) ?>" />

                        <div class="mb-3">
                            <label class="form-label">Variação (Produto - Descrição)</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars(
                                (($variacao['produto_nome'] ?? '') . ' - ' . ($variacao['descricao'] ?? ''))
                            ) ?>" disabled />
                        </div>

                        <div class="mb-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input type="number" id="quantidade" name="quantidade" min="0" class="form-control" required
                                value="<?= htmlspecialchars($estoque['quantidade']) ?>" />
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-save"></i> Salvar Alterações
                            </button>
                            <a href="/estoque" class="btn btn-secondary w-100">
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