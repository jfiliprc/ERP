<!DOCTYPE html>
<html lang="pt-br">

<?php $title = 'Editar Variações - ERP'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>


<body class="bg-light">

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Editar Variação</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/variacoes/<?= $variacao['id'] ?>">
                            <input type="hidden" name="_method" value="PUT" />

                            <div class="mb-3">
                                <label for="produto_id" class="form-label">Produto</label>
                                <select id="produto_id" name="produto_id" class="form-select" required>
                                    <?php foreach ($produtos as $produto): ?>
                                        <option value="<?= $produto['id'] ?>" <?= $produto['id'] == $variacao['produto_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($produto['nome']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição da Variação</label>
                                <input type="text" id="descricao" name="descricao" class="form-control" required
                                    value="<?= htmlspecialchars($variacao['descricao']) ?>" />
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="bi bi-save"></i> Salvar Alterações
                                </button>
                                <a href="/variacoes" class="btn btn-secondary w-100">
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