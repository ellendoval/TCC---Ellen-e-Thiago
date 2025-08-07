<?php
session_start();
include 'conexao.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Artistas</title>
    <style>
        .artista-box {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f1f1f1;
        }
        .form-container {
            display: none;
            border: 1px solid #aaa;
            padding: 15px;
            margin-top: 20px;
            background-color: #fff;
        }
        .btn-toggle {
            margin-top: 15px;
            padding: 10px 15px;
            cursor: pointer;
        }
    </style>
    <script>
        function toggleForm() {
            var form = document.getElementById("formArtista");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }
    </script>
</head>
<body>
    <h1>Artistas Cadastrados</h1>

    <?php
    $sql = "SELECT * FROM dados_artista";
    $result = $conn->query($sql);

    if ($result->num_rows > 0):
        while($row = $result->fetch_assoc()):
    ?>
        <div class="artista-box">
            <strong><?= htmlspecialchars($row['nome_artistico']) ?></strong><br>
            Redes: <?= nl2br(htmlspecialchars($row['redes'])) ?><br>
            Agenda: <?= nl2br(htmlspecialchars($row['agenda'])) ?><br>

            <?php
            if (isset($_SESSION['usuario']) && $_SESSION['tipo'] === 'artista' && $_SESSION['usuario']['email'] === $row['email']):
            ?>
                <button class="btn-toggle" onclick="toggleForm()">Editar Meu Perfil Artístico</button>

                <div class="form-container" id="formArtista">
                    <form action="salvar_artista.php" method="POST">
                        <label>Nome Artístico:</label><br>
                        <input type="text" name="nome_artistico" value="<?= htmlspecialchars($row['nome_artistico']) ?>" required><br><br>

                        <label>Redes Sociais:</label><br>
                        <textarea name="redes" rows="3" cols="40"><?= htmlspecialchars($row['redes']) ?></textarea><br><br>

                        <label>Agenda de Shows:</label><br>
                        <textarea name="agenda" rows="3" cols="40"><?= htmlspecialchars($row['agenda']) ?></textarea><br><br>

                        <button type="submit">Salvar</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    <?php
        endwhile;
    else:
        echo "<p>Nenhum artista cadastrado ainda.</p>";
    endif;
    ?>
</body>
</html>
