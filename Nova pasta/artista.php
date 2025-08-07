<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Artistas - Raízes Digital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="shortcut icon" href="Logo_tcc.png" type="image/x-icon">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand"></a> <img src="Logo_tcc.png"  height="50px" width="50px"> Raízes Digital</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a href="index.html"><i class="fas fa-home"></i> Início</a></li>
          <li class="nav-item"><a href="artistas.php"><i class="fas fa-paint-brush"></i> Artistas</a></li>
          <li class="nav-item"><a href="projetos.html"><i class="fas fa-lightbulb"></i> Projetos</a></li>
          <li class="nav-item"><a href="cursos.html"><i class="fas fa-book"></i> Cursos</a></li>
          <li class="nav-item"><a href="eventos.html"><i class="fas fa-calendar-alt"></i> Eventos</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container mt-5 pt-5">
    <?php
    session_start();
    include 'conexao.php';
    ?>

    <h1 class="mb-4"><i class="fas fa-paint-brush"></i> Artistas Locais</h1>
    <p>Aqui você encontra o perfil de artistas de Euclides da Cunha.</p>
    <a href="formulario.html">Se cadastre como artista</a>

    <?php if (isset($_SESSION['usuario'])): ?>
    <div class="text-end mb-3">
      <form action="logout.php" method="post">
        <button type="submit" class="btn btn-danger btn-sm">Sair</button>
      </form>
    </div>
    <?php endif; ?>

    <div class="row">
    <?php
    $sql = "SELECT * FROM dados_artistas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0):
      while($row = $result->fetch_assoc()):
    ?>
      <div class="col-md-6 mb-4">
        <div class="card p-3">
          <h5><?= htmlspecialchars($row['nome_artistico']) ?></h5>
          <p><strong>Redes:</strong> <?= nl2br(htmlspecialchars($row['redes'])) ?></p>
          <p><strong>Agenda:</strong> <?= nl2br(htmlspecialchars($row['agenda'])) ?></p>

          <?php if (isset($_SESSION['usuario']) && $_SESSION['tipo'] === 'artista' && $_SESSION['usuario']['email'] === $row['email']): ?>
          <button class="btn btn-outline-primary btn-sm mt-2" onclick="document.getElementById('formArtista').style.display='block'">Editar Meu Perfil</button>

          <div id="formArtista" class="mt-3" style="display:none;">
            <form action="salvar_artista.php" method="POST">
              <div class="mb-2">
                <label>Nome Artístico:</label>
                <input type="text" name="nome_artistico" class="form-control" value="<?= htmlspecialchars($row['nome_artistico']) ?>" required>
              </div>
              <div class="mb-2">
                <label>Redes Sociais:</label>
                <textarea name="redes" class="form-control"><?= htmlspecialchars($row['redes']) ?></textarea>
              </div>
              <div class="mb-2">
                <label>Agenda de Shows:</label>
                <textarea name="agenda" class="form-control"><?= htmlspecialchars($row['agenda']) ?></textarea>
              </div>
              <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
          </div>
          <?php endif; ?>
        </div>
      </div>
    <?php
      endwhile;
    else:
      echo "<p class='text-muted'>Nenhum artista cadastrado ainda.</p>";
    endif;
    ?>
    </div>
  </main>

  <footer class="bg-dark text-white text-center p-3 mt-5">
    <p>&copy; 2025 Cultura Nordestina - Todos os direitos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
