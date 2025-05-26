<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Finalizar Pedido - Minha Loja</title>
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
        <h1 class="mb-4 text-center text-primary">Finalizar Pedido</h1>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm p-4 mb-4">
            <h4 class="text-primary">Resumo do Pedido</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Valor Total (sem frete):</span>
                    <strong>R$ <?= number_format($totalCarrinho, 2, ',', '.') ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Frete:</span>
                    <strong>R$ <?= number_format($frete, 2, ',', '.') ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total com Frete:</span>
                    <strong class="text-success">R$ <?= number_format($totalFinal, 2, ',', '.') ?></strong>
                </li>
            </ul>
        </div>

        <div class="card shadow-sm p-4 mb-4">
            <h4 class="text-primary">Cupom de Desconto</h4>
            <form method="POST" action="/pedido/aplicar-cupom">
                <div class="input-group mb-3">
                    <input type="text" name="cupom" class="form-control" placeholder="Digite seu cupom"
                        value="<?= htmlspecialchars($cupomDigitado ?? '') ?>">
                    <button class="btn btn-outline-primary" type="submit" name="aplicar_cupom">Aplicar Cupom</button>
                </div>
            </form>

            <?php if (!empty($cupomMensagem)): ?>
                <div class="alert alert-info">
                    <?= htmlspecialchars($cupomMensagem) ?>
                </div>
            <?php endif; ?>

            <div class="border rounded p-3">
                <p class="mb-1">Subtotal: <strong>R$ <?= number_format($totalCarrinho, 2, ',', '.') ?></strong></p>
                <p class="mb-1">Desconto: <strong class="text-danger">R$
                        <?= number_format($desconto ?? 0, 2, ',', '.') ?></strong></p>
                <p class="mb-0">Total: <strong class="text-success">R$
                        <?= number_format(($totalFinalComDesconto ?? $totalFinal), 2, ',', '.') ?></strong></p>
            </div>
        </div>

        <form id="form-pedido" method="POST" action="/pedido">

            <!-- DADOS PESSOAIS -->
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="text-primary mb-3">Dados Pessoais</h5>

                <div class="mb-3">
                    <label for="nome_completo" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome_completo" name="nome_completo" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>

            <!-- ENDEREÇO DE ENTREGA -->
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="text-primary mb-3">Endereço de Entrega</h5>

                <div class="mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" required>
                </div>

                <div class="mb-3">
                    <label for="logradouro" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro" required>
                </div>

                <div class="mb-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" required>
                </div>

                <div class="mb-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" required>
                </div>

                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100">
                <i class="bi bi-check-circle"></i> Confirmar Pedido
            </button>
        </form>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('cep').addEventListener('blur', function () {
            const cep = this.value.replace(/\D/g, '');
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('logradouro').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('estado').value = data.uf;
                        } else {
                            alert('CEP não encontrado.');
                        }
                    })
                    .catch(() => alert('Erro ao buscar CEP.'));
            } else {
                alert('CEP inválido.');
            }
        });
    </script>

    <footer class="bg-primary text-white text-center py-3 mt-5">
        Minha Loja &copy; <?= date('Y') ?>
    </footer>
</body>

</html>