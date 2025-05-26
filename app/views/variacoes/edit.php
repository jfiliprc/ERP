<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Editar Variação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="container mt-5">
    <h1 class="mb-4">Editar Variação</h1>

    <form method="POST" action="/variacoes/<?= $variacao['id'] ?>">
        <input type="hidden" name="_method" value="PUT" />

        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto</label>
            <select id="produto_id" name="produto_id" class="form-select" required>
                <?php foreach ($produtos as $produto): ?>
                    <option value="<?= $produto['id'] ?>" <?= $produto['id'] == $variacao['produto_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($produto['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição da Variação</label>
            <input type="text" id="descricao" name="descricao" class="form-control" required
                value="<?= htmlspecialchars($variacao['descricao']) ?>" />
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="/variacoes" class="btn btn-secondary ms-2">Cancelar</a>
    </form>

</body>

</html>