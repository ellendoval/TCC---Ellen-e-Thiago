<?php
include 'conexao.php';
session_start();

$result = $conn->query("SELECT * FROM cursos");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Cursos</title></head>
<body>
<h1>Cursos Disponíveis</h1>
<ul>
<?php while ($curso = $result->fetch_assoc()): ?>
    <li><strong><?= $curso['titulo'] ?></strong>: <?= $curso['descricao'] ?></li>
<?php endwhile; ?>
</ul>
<?php if (isset($_SESSION['usuario']) && $_SESSION['tipo'] === 'admin'): ?>
    <form action="salvar_curso.php" method="post">
        <input name="titulo" placeholder="Título">
        <textarea name="descricao" placeholder="Descrição"></textarea>
        <button type="submit">Salvar Curso</button>
    </form>
<?php endif; ?>
</body></html>
