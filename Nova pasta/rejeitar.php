<?php
include 'conexao.php';
$id = $_GET['id'];
$conn->query("DELETE FROM usuarios WHERE id=$id");
header("Location: painel_adm.php");
?>