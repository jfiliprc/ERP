<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Editar Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="container mt-5">
    <h1 class="mb-4">Editar Estoque</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="/estoque/<?= $estoque['id'] ?>">
        <input type="hidden" name="_method" value="PUT" />
        <input type="hidden" name="variacao_id" value="<?= htmlspecialchars($estoque['variacao_id']) ?>" />

        <div class="mb-3">
            <label>Variação (Produto - Descrição)</label>
            <br />
            <input type="text" value="<?= htmlspecialchars(
                (($variacao['produto_nome'] ?? '') . ' - ' . ($variacao['descricao'] ?? ''))
            ) ?>" disabled />

        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" id="quantidade" name="quantidade" min="0" class="form-control" required
                value="<?= htmlspecialchars($estoque['quantidade']) ?>" />
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="/estoque" class="btn btn-secondary ms-2">Cancelar</a>
    </form>

</body>

</html>