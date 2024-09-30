<?php
include '../connect/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $valor_de_venda = $_POST['valor_de_venda'];
    $vagas_totais = $_POST['vagas_totais'];
    $area_privativa = $_POST['area_privativa'];
    $valor_condominio = $_POST['valor_condominio'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];

    $images = [];
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                $fileName = basename($_FILES['images']['name'][$key]);
                $targetFilePath = "../uploads/" . $fileName;
                move_uploaded_file($tmp_name, $targetFilePath);
                $images[] = $fileName;
            }
        }
    }

    // Atualiza o registro no banco de dados
    $imageString = implode(',', $images);
    $stmt = $conn->prepare("UPDATE imoveis SET Endereco=?, Bairro=?, ValorDeVenda=?, VagasTotais=?, AreaPrivativa=?, ValorCondominio=?, Tipo=?, Descricao=?, Imagem=CONCAT(IFNULL(Imagem, ''), ?, ',') WHERE id=?");
    $stmt->bind_param('ssissssssi', $endereco, $bairro, $valor_de_venda, $vagas_totais, $area_privativa, $valor_condominio, $tipo, $descricao, $imageString, $id);

    if ($stmt->execute()) {
        header("Location: ../controller/reservas.php?message=Imóvel atualizado com sucesso.");
    } else {
        header("Location: ../controller/reservas.php?message=Erro ao atualizar imóvel.");
    }
}
?>
