<?php
include 'conexao.php';
session_start();

$result = $conn->query("SELECT * FROM eventos");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Eventos</title></head>
<body>
<h1>Próximos Eventos</h1>
<ul>
<?php while ($evento = $result->fetch_assoc()): ?>
    <li><strong><?= $evento['nome'] ?></strong> - <?= $evento['data'] ?></li>
<?php endwhile; ?>
</ul>
<?php if (isset($_SESSION['usuario']) && $_SESSION['tipo'] === 'admin'): ?>
    <form action="salvar_evento.php" method="post">
        <input name="nome" placeholder="Nome do Evento">
        <input name="data" type="date">
        <button type="submit">Salvar Evento</button>
    </form>
<?php endif; ?>
</body></html>
