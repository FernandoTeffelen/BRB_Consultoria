<?php
include '../connect/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Diretório para upload de imagens
    $target_dir = "../uploads/";
    $uploaded_images = [];

    // Processa cada arquivo de imagem enviado
    foreach ($_FILES['images']['name'] as $key => $image_name) {
        if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK && !empty($image_name)) {
            $target_file = $target_dir . basename($image_name);
            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $target_file)) {
                $uploaded_images[] = $image_name; // Adiciona o nome da imagem à lista
            }
        }
    }

    // Junta todas as imagens em uma única string separada por vírgulas
    $images_string = implode(',', $uploaded_images);

    // Insere no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios (Nome, Email, Imagem) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $images_string);

    if ($stmt->execute()) {
        header("Location: ../controller/reservas.php?message=Dados enviados com sucesso!");
    } else {
        header("Location: ../controller/reservas.php?message=Erro ao enviar dados.");
    }

    $stmt->close();
    $conn->close();
}
?>
