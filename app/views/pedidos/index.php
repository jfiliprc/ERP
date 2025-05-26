<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Pedidos - ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
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
            <h1 class="fw-bold text-primary">Gestão de Pedidos</h1>
            <p class="text-muted">Clique no pedido para ver os itens detalhados.</p>
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

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-check me-2"></i> Pedidos Cadastrados</h5>
            </div>
            <div class="card-body p-0">

                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 150px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pedidos)): ?>
                            <?php foreach ($pedidos as $pedido): ?>
                                <?php $collapseId = 'collapse_' . $pedido['id']; ?>
                                <tr>
                                    <td><?= htmlspecialchars($pedido['id']) ?></td>
                                    <td>
                                        <form method="POST" action="/pedido/<?= $pedido['id'] ?>/alterar-status"
                                            class="m-0 p-0">
                                            <input type="hidden" name="id" value="<?= $pedido['id'] ?>">
                                            <select name="status" class="form-select form-select-sm"
                                                onchange="this.form.submit()" aria-label="Alterar status">
                                                <?php
                                                $statusOptions = ['pendente', 'pago', 'enviado', 'cancelado'];
                                                foreach ($statusOptions as $statusOption):
                                                    ?>
                                                    <option value="<?= $statusOption ?>" <?= $pedido['status'] === $statusOption ? 'selected' : '' ?>>
                                                        <?= ucfirst($statusOption) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#<?= $collapseId ?>" aria-expanded="false"
                                            aria-controls="<?= $collapseId ?>">
                                            Detalhes
                                        </button>
                                        <form method="POST" action="/pedidos/<?= $pedido['id'] ?>/excluir"
                                            onsubmit="return confirm('Confirma exclusão do pedido?');" class="d-inline m-0 p-0">
                                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="p-0">
                                        <div class="collapse" id="<?= $collapseId ?>">
                                            <div class="card card-body">
                                                <p><strong>Total:</strong> <?= htmlspecialchars($pedido['total']) ?></p>
                                                <p><strong>Frete:</strong> <?= htmlspecialchars($pedido['frete']) ?></p>
                                                <p><strong>Endereço:</strong> <?= htmlspecialchars($pedido['endereco']) ?></p>
                                                <p><strong>CEP:</strong> <?= htmlspecialchars($pedido['cep']) ?></p>
                                                <p><strong>Quantidade:</strong> <?= htmlspecialchars($pedido['quantidade']) ?>
                                                </p>
                                                <p><strong>Preço Unitário:</strong>
                                                    <?= htmlspecialchars($pedido['preco_unitario']) ?></p>
                                                <p><strong>Produto:</strong> <?= htmlspecialchars($pedido['produto_nome']) ?>
                                                </p>
                                                <p><strong>Variação:</strong> <?= htmlspecialchars($pedido['variacao_nome']) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">Nenhum pedido encontrado.</td>
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