<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/cadastro.css">
</head>

<?php
include '../connect/db_connection.php';

// Código para inserir, atualizar, excluir ou buscar dados
?>


<body>
    <div class="container mt-5">
        <h2 class="text-center">Login</h2>
        <a href="../index.php" class="btn btn-primary mt-3" style="margin-bottom: 5%;">Voltar</a>
        <div class="form-login">
            <form id="loginForm">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="mt-3 text-center">
                    <a href="novaConta.php" class="text-muted">Criar nova conta</a>
                    <br>
                    <a href="#" class="text-muted">Esqueci minha senha</a>
                </div>
                <div id="error-message" class="text-danger mt-2">
                </div>
            </form>
        </div>
    </div>

    <script src="../script/login.js"></script> <!-- Referência ao arquivo JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>