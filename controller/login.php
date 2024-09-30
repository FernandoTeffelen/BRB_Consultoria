<?php
include '../connect/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o email existe na tabela "conta"
    $sql = "SELECT * FROM contas WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Verifica a senha
        if (password_verify($senha, $user['senha'])) {
            header("Location: ../controller/reservas.php"); // Redireciona para reservas
        } else {
            echo "<script>alert('Senha incorreta'); window.location.href='../views/login.html';</script>";
        }
    } else {
        echo "<script>alert('Email incorreto'); window.location.href='../views/login.html';</script>";
    }
}
?>
