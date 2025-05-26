<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Estoque - ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

    <div class="container py-5">

        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Gestão de Estoque</h1>
            <p class="text-muted">Adicione, edite e exclua registros de estoque por variação.</p>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center mb-5">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Novo Estoque</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/estoque">
                            <div class="mb-3">
                                <label class="form-label">Variação (Produto - Descrição)</label>
                                <select name="variacao_id" class="form-select" required>
                                    <option value="">Selecione a Variação</option>
                                    <?php foreach ($variacoes as $v): ?>
                                        <option value="<?= $v['id'] ?>"
                                            <?= (isset($data['variacao_id']) && $data['variacao_id'] == $v['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($v['nome']) ?> — <?= htmlspecialchars($v['descricao']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantidade</label>
                                <input type="number" name="quantidade" min="0" required class="form-control"
                                    value="<?= htmlspecialchars($data['quantidade'] ?? '') ?>">
                            </div>
                            <button class="btn btn-success w-100">
                                <i class="bi bi-save"></i> Salvar Estoque
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i> Estoque Cadastrado</h5>
            </div>
            <div class="card-body p-0">
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
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="/estoque/<?= $e['id'] ?>" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form method="POST" action="/estoque/<?= $e['id'] ?>" onsubmit="return confirm('Confirma exclusão?')">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm" title="Excluir">
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

    </div>

    <footer class="bg-primary text-white text-center py-3 mt-5">
        ERP - Sistema de Gestão &copy; <?= date('Y') ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
