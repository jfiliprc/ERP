<!DOCTYPE html>
<html lang="pt-BR">

<?php $title = 'Carrinho - ERP'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

<body>
    <main class="container py-5">

        <h1 class="mb-4 text-center text-primary">Meu Carrinho</h1>

        <?php require __DIR__ . '/../partials/alerts.php'; ?>

        <?php if (empty($itens)): ?>
            <p class="text-center text-muted">Seu carrinho está vazio.</p>
            <div class="text-center">
                <a href="/loja" class="btn btn-primary"><i class="bi bi-arrow-left-circle"></i> Voltar à Loja</a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($itens as $index => $item): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100 p-3 d-flex flex-column">

                            <h5 class="card-title"><?= htmlspecialchars($item['produto_nome']) ?></h5>
                            <p class="text-success fw-bold fs-5">R$ <?= number_format($item['valor'], 2, ',', '.') ?></p>

                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?= htmlspecialchars($item['variacao_descricao']) ?></strong>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">
                                        Estoque: <?= htmlspecialchars($item['estoque_atual'] ?? '-') ?>
                                    </span>
                                </li>
                            </ul>

                            <form method="POST" action="/carrinho/<?= $index ?>">
                                <input type="hidden" name="_method" value="PUT" />
                                <div class="mb-3">
                                    <label for="qtd_<?= $index ?>" class="form-label">Quantidade</label>
                                    <input type="number" id="qtd_<?= $index ?>" name="quantidade" min="1" class="form-control"
                                        value="<?= htmlspecialchars($item['quantidade']) ?>" required>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-warning me-2">
                                        <i class="bi bi-pencil-square"></i> Atualizar
                                    </button>
                            </form>
                            <form method="POST" action="/carrinho/<?= $index ?>"
                                onsubmit="return confirm('Deseja remover este item do carrinho?');" class="m-0 p-0">
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Remover
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
            </div>

            <div class="mt-4 d-flex justify-content-between align-items-center">
                <a href="/loja" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Continuar Comprando
                </a>
                <div class="fs-4 fw-bold text-success">
                    Total: R$ <?= number_format($totalCarrinho, 2, ',', '.') ?>
                </div>
                <a href="/pedido" class="btn btn-success btn-lg">
                    <i class="bi bi-cart-check"></i> Finalizar Compra
                </a>
            </div>

        <?php endif; ?>

    </main>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>