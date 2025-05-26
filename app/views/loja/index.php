<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Loja - Vitrine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Minha Loja</a>
            <div>
                <a class="btn btn-outline-light me-2" href="/carrinho"><i class="bi bi-cart4"></i> Carrinho</a>
            </div>
        </div>
    </nav>

    <main class="container py-5">

        <?php if (!empty($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>


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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="bg-primary text-white text-center py-3 mt-5">
        Minha Loja &copy; <?= date('Y') ?>
    </footer>
</body>

</html>