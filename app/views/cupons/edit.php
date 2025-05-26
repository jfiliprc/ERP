<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Editar Cupom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="container mt-5">
    <h1 class="mb-4">Editar Cupom</h1>

    <form method="POST" action="/cupons/<?= $cupom['id'] ?>">
        <input type="hidden" name="_method" value="PUT" />

        <div class="mb-3">
            <label for="codigo" class="form-label">Código do Cupom</label>
            <input type="text" id="codigo" name="codigo" class="form-control" required
                value="<?= htmlspecialchars($cupom['codigo']) ?>" />
        </div>

        <div class="mb-3">
            <label for="desconto" class="form-label">Desconto (%)</label>
            <input type="number" step="0.01" min="0" max="100" id="desconto" name="desconto" class="form-control"
                required value="<?= htmlspecialchars($cupom['desconto']) ?>" />
        </div>

        <div class="mb-3">
            <label for="valor_minimo" class="form-label">Valor Mínimo (R$)</label>
            <input type="number" step="0.01" min="0" id="valor_minimo" name="valor_minimo" class="form-control" required
                value="<?= htmlspecialchars($cupom['valor_minimo']) ?>" />
        </div>

        <div class="mb-3">
            <label for="validade" class="form-label">Validade</label>
            <input type="date" id="validade" name="validade" class="form-control" required
                value="<?= htmlspecialchars($cupom['validade']) ?>" />
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="/cupons" class="btn btn-secondary ms-2">Cancelar</a>
    </form>

</body>

</html>