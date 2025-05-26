<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="container mt-5">
    <h1 class="mb-4">Editar Produto</h1>

    <form method="POST" action="/produtos/<?= $produto['id'] ?>">
        <input type="hidden" name="_method" value="PUT" />

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" id="nome" name="nome" class="form-control" required
                value="<?= htmlspecialchars($produto['nome']) ?>" />
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor (R$)</label>
            <input type="number" step="0.01" min="0" id="valor" name="valor" class="form-control" required
                value="<?= htmlspecialchars($produto['valor']) ?>" />
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="/produtos" class="btn btn-secondary ms-2">Cancelar</a>
    </form>

</body>

</html>