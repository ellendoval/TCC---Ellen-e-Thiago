<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'adm') {
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM usuarios WHERE tipo = 'artista' AND status = 'pendente'");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Painel ADM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Painel do Administrador</h2>
  <a href="logout.php" class="btn btn-danger mb-3">Sair</a>
  <h4>Artistas pendentes</h4>
  <table class="table table-bordered">
    <thead>
      <tr><th>Nome</th><th>Email</th><th>Ações</th></tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['nome'] ?></td>
        <td><?= $row['email'] ?></td>
        <td>
          <a href="aprovar.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Aprovar</a>
          <a href="rejeitar.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Rejeitar</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>