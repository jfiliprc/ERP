<html lang="pt-BR">

<?php $title = 'Loja - ERP'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

<body>

    <main class="container py-5">

        <?php require __DIR__ . '/../partials/alerts.php'; ?>

        <h1 class="mb-4 text-center text-primary">Produtos Disponíveis</h1>

        <div class="row g-4">
            <?php if (!empty($produtos)): ?>
                <?php foreach ($produtos as $produto): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100 p-3 d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($produto['nome']) ?></h5>
                            <p class="text-success fw-bold fs-5">R$ <?= number_format($produto['valor'], 2, ',', '.') ?></p>

                            <?php if (!empty($produto['variacoes'])): ?>
                                <ul class="list-group mb-3">
                                    <?php foreach ($produto['variacoes'] as $variacao): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong><?= htmlspecialchars($produto['nome']) ?></strong>
                                                <?php if (!empty($variacao['descricao'])): ?>
                                                    - <?= htmlspecialchars($variacao['descricao']) ?>
                                                <?php endif; ?>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">
                                                Estoque: <?= $variacao['estoque'] ?? 0 ?>
                                            </span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p><em>Sem variações disponíveis</em></p>
                            <?php endif; ?>

                            <div>
                                <?php if (!empty($produto['variacoes'])): ?>
                                    <form method="POST" action="/carrinho">
                                        <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
                                        <input type="hidden" name="produto_nome" value="<?= htmlspecialchars($produto['nome']) ?>">

                                        <select name="variacao_id" class="form-select mb-2" required>
                                            <option value="" selected disabled>Selecione a variação</option>
                                            <?php foreach ($produto['variacoes'] as $variacao): ?>
                                                <option value="<?= $variacao['id'] ?>"
                                                    data-desc="<?= htmlspecialchars($variacao['descricao']) ?>">
                                                    <?= htmlspecialchars($variacao['descricao']) ?> (Estoque:
                                                    <?= $variacao['estoque'] ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="number" name="quantidade" value="1" min="1" class="form-control mb-2" required>

                                        <button class="btn btn-primary w-100" type="submit">
                                            <i class="bi bi-cart-plus"></i> Adicionar ao Carrinho
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-secondary w-100" disabled>Sem variações</button>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Nenhum produto disponível no momento.</p>
            <?php endif; ?>
        </div>

    </main>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>