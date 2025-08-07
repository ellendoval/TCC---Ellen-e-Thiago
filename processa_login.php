<?php
session_start();
include 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    $_SESSION['usuario'] = $usuario;
    $_SESSION['tipo'] = $usuario['tipo'];

    if ($usuario['tipo'] === 'adm') {
        header("Location: painel_adm.php");
    } else if ($usuario['tipo'] === 'artista') {
        if ($usuario['status'] === 'aprovado') {
            header("Location: artistas.php"); // redireciona para artistas.php
        } else {
            echo "Seu cadastro ainda está pendente de aprovação pelo administrador.";
        }
    } else {
        echo "Tipo de usuário não reconhecido.";
    }
} else {
    header("Location: login.php?erro=1");
}
?>
