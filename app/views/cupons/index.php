<html lang="pt-BR">

<?php $title = 'Cupons - ERP'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

<body class="bg-light">

    <div class="container py-5">

        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Gestão de Cupons</h1>
            <p class="text-muted">Cadastre, edite e exclua seus cupons de forma prática e rápida.</p>
        </div>

        <?php require __DIR__ . '/../partials/alerts.php'; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm mb-5">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Novo Cupom</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/cupons">
                            <div class="mb-3">
                                <label class="form-label">Código</label>
                                <input type="text" name="codigo" placeholder="Código do Cupom" required
                                    class="form-control" value="<?= htmlspecialchars($data['codigo'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Desconto (%)</label>
                                <input type="number" step="0.01" min="0" name="desconto" placeholder="Desconto" required
                                    class="form-control" id="desconto"
                                    value="<?= htmlspecialchars($data['desconto'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Valor Mínimo (R$)</label>
                                <input type="number" step="0.01" min="0" name="valor_minimo" placeholder="Valor mínimo"
                                    required class="form-control" id="valor_minimo"
                                    value="<?= htmlspecialchars($data['valor_minimo'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Validade</label>
                                <input type="date" name="validade" required class="form-control"
                                    value="<?= htmlspecialchars($data['validade'] ?? '') ?>">
                            </div>
                            <button class="btn btn-success w-100">
                                <i class="bi bi-save"></i> Salvar Cupom
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-ticket-perforated me-2"></i> Cupons Cadastrados</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Desconto (%)</th>
                            <th>Valor Mínimo (R$)</th>
                            <th>Validade</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cupons as $c): ?>
                            <tr>
                                <td><?= htmlspecialchars($c['codigo']) ?></td>
                                <td><?= number_format($c['desconto'], 2, ',', '.') ?>%</td>
                                <td><?= number_format($c['valor_minimo'], 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($c['validade']) ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="/cupons/<?= $c['id'] ?>" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form method="POST" action="/cupons/<?= $c['id'] ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm" title="Excluir">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>
    <script src="https://unpkg.com/imask"></script>

    <script>
        const desconto = document.getElementById('desconto');
        const valorMinimo = document.getElementById('valor_minimo');

        const maskOptions = {
            mask: Number,
            thousandsSeparator: '.',
            radix: ',',
            mapToRadix: ['.']
        };

        IMask(desconto, maskOptions);
        IMask(valorMinimo, maskOptions);
    </script>
</body>

</html>