<!DOCTYPE html>
<html lang="pt-BR">

<?php $title = 'Variações - ERP'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

<body class="bg-light d-flex flex-column min-vh-100">

    <main class="container py-4 flex-grow-1">

        <div class="text-center mb-4">
            <h1 class="fw-bold text-primary">Gestão de Variações</h1>
            <p class="text-muted">Cadastre, edite e exclua variações de produtos.</p>
        </div>

    <?php require __DIR__ . '/../partials/alerts.php'; ?>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Nova Variação</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/variacoes">
                            <div class="mb-3">
                                <label class="form-label">Produto</label>
                                <select name="produto_id" class="form-select" required>
                                    <option value="">Selecione o Produto</option>
                                    <?php foreach ($produtos as $produto): ?>
                                        <option value="<?= $produto['id'] ?>" 
                                            <?= isset($data['produto_id']) && $data['produto_id'] == $produto['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($produto['nome']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descrição</label>
                                <input type="text" name="descricao" placeholder="Descrição da Variação" required
                                    class="form-control" value="<?= htmlspecialchars($data['descricao'] ?? '') ?>">
                            </div>
                            <button class="btn btn-success w-100">
                                <i class="bi bi-save"></i> Salvar Variação
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i> Variações Cadastradas</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produto</th>
                                <th>Descrição</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($variacoes as $v): ?>
                                <tr>
                                    <td><?= htmlspecialchars($v['nome']) ?></td>
                                    <td><?= htmlspecialchars($v['descricao']) ?></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="/variacoes/<?= $v['id'] ?>" class="btn btn-warning btn-sm" title="Editar">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="POST" action="/variacoes/<?= $v['id'] ?>" class="d-inline">
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

    </main>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>
