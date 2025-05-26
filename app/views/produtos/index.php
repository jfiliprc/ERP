<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Produtos - ERP</title>
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

        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Gestão de Produtos</h1>
            <p class="text-muted">Cadastre, edite e exclua seus produtos de forma prática e rápida.</p>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm mb-5">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Novo Produto</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/produtos">
                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" placeholder="Nome do Produto" required
                                    class="form-control" value="<?= htmlspecialchars($data['nome'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Valor (R$)</label>
                                <input type="number" step="0.01" min="0" name="valor" placeholder="Valor" required
                                    class="form-control" id="valor"
                                    value="<?= htmlspecialchars($data['valor'] ?? '') ?>">
                            </div>
                            <button class="btn btn-success w-100">
                                <i class="bi bi-save"></i> Salvar Produto
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i> Produtos Cadastrados</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Valor (R$)</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['nome']) ?></td>
                                <td><?= number_format($p['valor'], 2, ',', '.') ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="/produtos/<?= $p['id'] ?>" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form method="POST" action="/produtos/<?= $p['id'] ?>">
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

    </main>

    <footer class="bg-primary text-white text-center py-3">
        ERP - Sistema de Gestão &copy; <?= date('Y') ?>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const element = document.getElementById('valor');
        const maskOptions = {
            mask: 'R$ num',
            blocks: {
                num: {
                    mask: Number,
                    thousandsSeparator: '.',
                    radix: ',',
                    mapToRadix: ['.']
                }
            }
        };
        IMask(element, maskOptions);
    </script>
</body>

</html>