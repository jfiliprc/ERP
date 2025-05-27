<html lang="pt-BR">
<?php $title = 'Pedidos - ERP'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

<body class="bg-light">
    <div class="container-fluid py-5">

        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Gestão de Pedidos</h1>
            <p class="text-muted">Clique no pedido para ver os itens detalhados.</p>
        </div>

        <?php require __DIR__ . '/../partials/alerts.php'; ?>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-check me-2"></i> Pedidos Cadastrados</h5>
            </div>
            <div class="card-body p-0">

                <!-- Responsividade na tabela -->
                <div class="table-responsive">
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
                                            <button class="btn btn-sm btn-primary me-1" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#<?= $collapseId ?>" aria-expanded="false"
                                                aria-controls="<?= $collapseId ?>">
                                                Detalhes
                                            </button>
                                            <form method="POST" action="/pedidos/<?= $pedido['id'] ?>/excluir"
                                                onsubmit="return confirm('Confirma exclusão do pedido?');"
                                                class="d-inline m-0 p-0">
                                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="p-0">
                                            <div class="collapse" id="<?= $collapseId ?>">
                                                <div class="card card-body">
                                                    <p><strong>Nome do Comprador:</strong>
                                                        <?= htmlspecialchars($pedido['nome_completo']) ?>
                                                    </p>

                                                    <p><strong>E-mail:</strong>
                                                        <?= htmlspecialchars($pedido['email']) ?>
                                                    </p>

                                                    <p><strong>Endereço:</strong>
                                                        <?= htmlspecialchars($pedido['endereco']) ?>
                                                    </p>

                                                    <p><strong>CEP:</strong>
                                                        <?= htmlspecialchars($pedido['cep']) ?>
                                                    </p>

                                                    <hr>

                                                    <p><strong>Produto:</strong>
                                                        <?= htmlspecialchars($pedido['produto_nome']) ?>
                                                    </p>

                                                    <p><strong>Variação:</strong>
                                                        <?= htmlspecialchars($pedido['variacao_nome']) ?>
                                                    </p>

                                                    <p><strong>Quantidade:</strong>
                                                        <?= htmlspecialchars($pedido['quantidade']) ?>
                                                    </p>

                                                    <p><strong>Preço Unitário:</strong>
                                                        R$ <?= number_format($pedido['preco_unitario'], 2, ',', '.') ?>
                                                    </p>

                                                    <hr>

                                                    <p><strong>Frete:</strong>
                                                        R$ <?= number_format($pedido['frete'], 2, ',', '.') ?>
                                                    </p>

                                                    <p><strong>Total:</strong>
                                                        R$ <?= number_format($pedido['total'], 2, ',', '.') ?>
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

    </div>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>