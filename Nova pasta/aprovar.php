<?php
include 'conexao.php';
$id = $_GET['id'];
$conn->query("UPDATE usuarios SET status='aprovado' WHERE id=$id");
header("Location: painel_adm.php");
?>