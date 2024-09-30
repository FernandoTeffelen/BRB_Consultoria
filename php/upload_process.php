<?php
include '../connect/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $valor_de_venda = $_POST['valor_de_venda'];
    $vagas_totais = $_POST['vagas_totais'];
    $area_privativa = $_POST['area_privativa'];
    $valor_condominio = $_POST['valor_condominio'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];

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
    $stmt = $conn->prepare("INSERT INTO imoveis (Endereco, Bairro, Imagem, ValorDeVenda, VagasTotais, AreaPrivativa, ValorCondominio, Tipo, Descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdissss", $endereco, $bairro, $images_string, $valor_de_venda, $vagas_totais, $area_privativa, $valor_condominio, $tipo, $descricao);

    if ($stmt->execute()) {
        header("Location: ../controller/reservas.php?message=Dados enviados com sucesso!");
    } else {
        header("Location: ../controller/reservas.php?message=Erro ao enviar dados.");
    }

    $stmt->close();
    $conn->close();
}
?>
