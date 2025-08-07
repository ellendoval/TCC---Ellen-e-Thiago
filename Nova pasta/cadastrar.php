<?php
include 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografar a senha
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'artista'; // padrão artista

$verifica = $conn->query("SELECT * FROM usuarios WHERE email = '$email'");

if ($verifica->num_rows > 0) {
    echo "Este e-mail já está cadastrado. Tente fazer login.";
    exit;
}

// Removido 'status' já que a tabela não tem essa coluna
$sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha', '$tipo')";
if ($conn->query($sql)) {
    echo "Cadastro realizado com sucesso! Aguarde aprovação do administrador.";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
?>
