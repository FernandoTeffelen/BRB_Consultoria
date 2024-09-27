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
            <h1>Adicionar novo imóvel</h1>

            <a href="../index.php" class="btn btn-primary mt-3" style="margin-bottom: 5%;">Voltar</a>

            <?php
            if (isset($_GET['message'])) {
                echo "<p>" . htmlspecialchars($_GET['message']) . "</p>";
            }
            ?>

            <form method="post" action="../php/upload_process.php" enctype="multipart/form-data">
                <label for="name">Rua:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Bairro:</label>
                <input type="email" id="email" name="email" required>

                <div id="image-fields">
                    <label for="image1">Imagem 1:</label>
                    <input type="file" id="image1" name="images[]" accept="image/*">

                    <label for="image2">Imagem 2:</label>
                    <input type="file" id="image2" name="images[]" accept="image/*">

                    <label for="image3">Imagem 3:</label>
                    <input type="file" id="image3" name="images[]" accept="image/*">

                    <label for="image4">Imagem 4:</label>
                    <input type="file" id="image4" name="images[]" accept="image/*">

                    <label for="image5">Imagem 5:</label>
                    <input type="file" id="image5" name="images[]" accept="image/*">
                </div>

                <button type="button" class="btn btn-secondary mt-3" id="add-more-images">Mais Imagens</button>
                <button type="submit" class="btn btn-primary mt-3">Enviar</button>
            </form>

            <h2>Dados Enviados:</h2>
            <ul id="data-sent">
                <?php
                include '../connect/db_connection.php';

                $result = $conn->query("SELECT id, Nome, Email, Imagem FROM usuarios");

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $images = explode(',', $row['Imagem']);
                        echo "<li class='sent-data' data-id='{$row['id']}'>" . htmlspecialchars($row['Nome']) . " - " . htmlspecialchars($row['Email']);
                        echo "<br>";
                        if (!empty($row['Imagem'])) {
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
                            echo '</div>';
                        }
                        echo "</li>";
                    }
                } else {
                    echo "<li>Nenhum dado enviado.</li>";
                }
                ?>
            </ul>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Principais condomínios a venda</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="col mb-5" id="property-template" style="display:none;">
                    <div class="card h-100">
                        <div id="carousel-example" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner"></div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-example" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-example" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder">Imóvel: <span class="property-name"></span></h5>
                                <p>Bairro: <span class="property-neighborhood"></span></p>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="#">View Options</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; BRB - Consultoria Imobiliária 2024 from Fernando De Borba Van Teffelen</p>
        </div>
    </footer>

    <script src="../script/script.js"></script>
    <script src="../script/reservas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
