<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    die('Acesso negado');
}

$nome = $_POST['nome'];
$data = $_POST['data'];

$sql = "INSERT INTO eventos (nome, data) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nome, $data);
$stmt->execute();

header("Location: eventos.php");
exit;
?>
