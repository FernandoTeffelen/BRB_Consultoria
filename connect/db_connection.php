
<?php
$servername = "localhost:3306"; // ou seu servidor
$username = "root"; // seu nome de usuário do banco de dados
$password = "root"; // sua senha do banco de dados
$dbname = "brb_consultoria"; // o nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>

