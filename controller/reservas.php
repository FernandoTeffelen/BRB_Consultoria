<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas FODAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <section class="booking-form py-5">
        <div class="container-form">
            <h1>Adicionar Novo Imóvel</h1>

            <a href="../index.html" class="btn btn-primary mt-3" style="margin-bottom: 2%;">Voltar</a>

            <?php
            if (isset($_GET['message'])) {
                echo "<p class='alert alert-info'>" . htmlspecialchars($_GET['message']) . "</p>";
            }
            ?>

            <form method="post" action="../php/upload_process.php" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-column">
                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço:</label>
                            <input type="text" id="endereco" name="endereco" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="bairro" class="form-label">Bairro:</label>
                            <input type="text" id="bairro" name="bairro" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="valor_de_venda" class="form-label">Valor de Venda:</label>
                            <input type="text" id="valor_de_venda" name="valor_de_venda" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="vagas_totais" class="form-label">Vagas Totais:</label>
                            <input type="text" id="vagas_totais" name="vagas_totais" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="mb-3">
                            <label for="area_privativa" class="form-label">Área Privativa:</label>
                            <input type="text" id="area_privativa" name="area_privativa" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="valor_condominio" class="form-label">Valor do Condomínio:</label>
                            <input type="text" id="valor_condominio" name="valor_condominio" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo:</label>
                            <input type="text" id="tipo" name="tipo" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição:</label>
                            <input type="text" id="descricao" name="descricao" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div id="image-fields">
                    <label for="image1" class="form-label">Imagem 1:</label>
                    <input type="file" id="image1" name="images[]" class="form-control" accept="image/*">
                    
                    <label for="image2" class="form-label">Imagem 2:</label>
                    <input type="file" id="image2" name="images[]" class="form-control" accept="image/*">

                    <label for="image3" class="form-label">Imagem 3:</label>
                    <input type="file" id="image3" name="images[]" class="form-control" accept="image/*">
                </div>

                <button type="button" class="btn btn-secondary mt-3" id="add-more-images">Mais Imagens</button>
                <button type="submit" class="btn btn-primary mt-3">Enviar</button>
            </form>

            <h2 class="mt-5">Imóveis Registrados:</h2>
            <div class="row" id="data-sent">
                <?php
                include '../connect/db_connection.php';

                $result = $conn->query("SELECT id, Endereco, Bairro, Imagem, ValorDeVenda, VagasTotais, AreaPrivativa, ValorCondominio, Tipo, Descricao FROM imoveis");

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $images = explode(',', $row['Imagem']);
                        echo "<div class='imoveis-container col mb-5'>"; // Altera para a coluna da Bootstrap
                        echo "<div class='imovel-card card h-100'>"; // Início do cartão
                        echo '<div id="carousel-' . $row['id'] . '" class="carousel slide" data-bs-ride="carousel">';
                        echo '<div class="carousel-inner">';

                        $active = true;
                        foreach ($images as $image) {
                            echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                            echo '<img class="d-block w-100" src="../uploads/' . htmlspecialchars($image) . '" alt="Image">';
                            echo '</div>';
                            $active = false;
                        }
                        echo '</div>';
                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#carousel-' . $row['id'] . '" data-bs-slide="prev">';
                        echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Previous</span>';
                        echo '</button>';
                        echo '<button class="carousel-control-next" type="button" data-bs-target="#carousel-' . $row['id'] . '" data-bs-slide="next">';
                        echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Next</span>';
                        echo '</button>';
                        echo '</div>'; // Fim do carousel

                        // Detalhes do imóvel
                        echo "<div class='card-body p-4 text-center'>";
                        echo "<h5 class='fw-bolder'>" . htmlspecialchars($row['Endereco']) . "</h5>";
                        echo "<p class='mb-0'>Bairro: " . htmlspecialchars($row['Bairro']) . "</p>";
                        echo "<p class='mb-0'>Valor de Venda: " . htmlspecialchars($row['ValorDeVenda']) . "</p>";
                        echo "<p class='mb-0'>Vagas Totais: " . htmlspecialchars($row['VagasTotais']) . "</p>";
                        echo "<p class='mb-0'>Área Privativa: " . htmlspecialchars($row['AreaPrivativa']) . "</p>";
                        echo "<p class='mb-0'>Valor do Condomínio: " . htmlspecialchars($row['ValorCondominio']) . "</p>";
                        echo "<p class='mb-0'>Tipo: " . htmlspecialchars($row['Tipo']) . "</p>";
                        echo "<p class='mb-0'>Descrição: " . htmlspecialchars($row['Descricao']) . "</p>";
                        echo "</div>";

                        // Botões de mais informações e edição
                        echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>";
                        echo "<div class='text-center'>";
                        echo "<a class='btn btn-outline-dark mt-auto' href='#'>Mais informações</a>";
                        echo "<button class='btn btn-outline-secondary mt-auto edit-button' style='margin-left: 5%' data-id='" . $row['id'] . "' data-endereco='" . htmlspecialchars($row['Endereco']) . "' data-bairro='" . htmlspecialchars($row['Bairro']) . "' data-valor='" . htmlspecialchars($row['ValorDeVenda']) . "' data-vagas='" . htmlspecialchars($row['VagasTotais']) . "' data-area='" . htmlspecialchars($row['AreaPrivativa']) . "' data-condominio='" . htmlspecialchars($row['ValorCondominio']) . "' data-tipo='" . htmlspecialchars($row['Tipo']) . "' data-descricao='" . htmlspecialchars($row['Descricao']) . "'>
                              <i class='bi bi-pencil'></i>
                          </button>";
                        echo "</div>";
                        echo "</div>";

                        echo "</div>"; // Fim do cartão
                        echo "</div>"; // Fecha a coluna
                    }
                } else {
                    echo "<div class='col-12'>Nenhum dado enviado.</div>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Modal de Edição -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Imóvel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="post" action="../php/edit_process.php" enctype="multipart/form-data">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editEndereco" class="form-label">Endereço:</label>
                            <input type="text" id="editEndereco" name="endereco" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editBairro" class="form-label">Bairro:</label>
                            <input type="text" id="editBairro" name="bairro" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editValor" class="form-label">Valor de Venda:</label>
                            <input type="text" id="editValor" name="valor_de_venda" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editVagas" class="form-label">Vagas Totais:</label>
                            <input type="text" id="editVagas" name="vagas_totais" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editArea" class="form-label">Área Privativa:</label>
                            <input type="text" id="editArea" name="area_privativa" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCondominio" class="form-label">Valor do Condomínio:</label>
                            <input type="text" id="editCondominio" name="valor_condominio" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTipo" class="form-label">Tipo:</label>
                            <input type="text" id="editTipo" name="tipo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescricao" class="form-label">Descrição:</label>
                            <input type="text" id="editDescricao" name="descricao" class="form-control" required>
                        </div>
                        <div id="editImageFields">
                            <label for="editImage1" class="form-label">Imagem 1:</label>
                            <input type="file" id="editImage1" name="images[]" class="form-control" accept="image/*">
                            
                            <label for="editImage2" class="form-label">Imagem 2:</label>
                            <input type="file" id="editImage2" name="images[]" class="form-control" accept="image/*">

                            <label for="editImage3" class="form-label">Imagem 3:</label>
                            <input type="file" id="editImage3" name="images[]" class="form-control" accept="image/*">
                        </div>
                        <button type="button" class="btn btn-secondary mt-3" id="add-more-edit-images">Mais Imagens</button>
                        <button type="submit" class="btn btn-primary mt-3">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editButtons = document.querySelectorAll('.edit-button');
        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        const editForm = document.getElementById('editForm');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const endereco = button.getAttribute('data-endereco');
                const bairro = button.getAttribute('data-bairro');
                const valor = button.getAttribute('data-valor');
                const vagas = button.getAttribute('data-vagas');
                const area = button.getAttribute('data-area');
                const condominio = button.getAttribute('data-condominio');
                const tipo = button.getAttribute('data-tipo');
                const descricao = button.getAttribute('data-descricao');

                document.getElementById('editId').value = id;
                document.getElementById('editEndereco').value = endereco;
                document.getElementById('editBairro').value = bairro;
                document.getElementById('editValor').value = valor;
                document.getElementById('editVagas').value = vagas;
                document.getElementById('editArea').value = area;
                document.getElementById('editCondominio').value = condominio;
                document.getElementById('editTipo').value = tipo;
                document.getElementById('editDescricao').value = descricao;

                editModal.show();
            });
        });

        document.getElementById('add-more-images').addEventListener('click', function () {
            const imageFields = document.createElement('div');
            imageFields.innerHTML = `
                <label for="image" class="form-label">Imagem:</label>
                <input type="file" name="images[]" class="form-control" accept="image/*">
            `;
            document.getElementById('image-fields').appendChild(imageFields);
        });

        document.getElementById('add-more-edit-images').addEventListener('click', function () {
            const editImageFields = document.createElement('div');
            editImageFields.innerHTML = `
                <label for="editImage" class="form-label">Imagem:</label>
                <input type="file" name="images[]" class="form-control" accept="image/*">
            `;
            document.getElementById('editImageFields').appendChild(editImageFields);
        });
    </script>
</body>

</html>
