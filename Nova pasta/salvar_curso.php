<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    die('Acesso negado');
}

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];

$sql = "INSERT INTO cursos (titulo, descricao) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $titulo, $descricao);
$stmt->execute();

header("Location: cursos.php");
exit;
?>
