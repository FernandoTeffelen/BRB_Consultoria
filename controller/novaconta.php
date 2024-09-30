<?php
include '../connect/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmarSenha'];

    if ($senha !== $confirmarSenha) {
        echo "<script>alert('As senhas não coincidem.'); window.location.href='../views/novaConta.html';</script>";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Verifica se o email já existe na tabela "conta"
        $sql = "SELECT * FROM contas WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Já existe uma conta com esse e-mail.'); window.location.href='../views/novaConta.html';</script>";
        } else {
            // Insere o novo usuário na tabela "conta"
            $sql = "INSERT INTO conta (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nome, $email, $senhaHash);

            if ($stmt->execute()) {
                echo "<script>alert('Conta criada com sucesso!'); window.location.href='../views/login.html';</script>";
            } else {
                echo "<script>alert('Erro ao criar a conta.'); window.location.href='../views/novaConta.html';</script>";
            }
        }
    }
}
?>
