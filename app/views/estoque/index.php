<html lang="pt-BR">
<?php $title = 'Estoque - ERP'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

<body class="bg-light d-flex flex-column min-vh-100">
    <main class="container py-5 flex-grow-1">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Gestão de Estoque</h1>
            <p class="text-muted">Adicione, edite e exclua registros de estoque por variação.</p>
        </div>

        <?php require __DIR__ . '/../partials/alerts.php'; ?>

        <!-- Formulário -->
        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Novo Estoque</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/estoque">
                            <div class="mb-3">
                                <label for="variacao_id" class="form-label">Variação (Produto - Descrição)</label>
                                <select id="variacao_id" name="variacao_id" class="form-select" required>
                                    <option value="">Selecione a Variação</option>
                                    <?php foreach ($variacoes as $v): ?>
                                        <option value="<?= $v['id'] ?>" <?= (isset($data['variacao_id']) && $data['variacao_id'] == $v['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($v['nome']) ?> —
                                            <?= htmlspecialchars($v['descricao']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="number" id="quantidade" name="quantidade" min="0" required
                                    class="form-control" value="<?= htmlspecialchars($data['quantidade'] ?? '') ?>">
                            </div>
                            <button class="btn btn-success w-100" type="submit">
                                <i class="bi bi-save"></i> Salvar Estoque
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i> Estoque Cadastrado</h5>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Produto</th>
                            <th>Variação</th>
                            <th>Quantidade</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estoques as $e): ?>
                            <tr>
                                <td><?= htmlspecialchars($e['produto_nome']) ?></td>
                                <td><?= htmlspecialchars($e['variacao_descricao']) ?></td>
                                <td><?= htmlspecialchars($e['quantidade']) ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        <a href="/estoque/<?= $e['id'] ?>" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form method="POST" action="/estoque/<?= $e['id'] ?>"
                                            onsubmit="return confirm('Confirma exclusão?')" class="m-0 p-0">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button class="btn btn-danger btn-sm" title="Excluir" type="submit">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($estoques)): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Nenhum estoque cadastrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>