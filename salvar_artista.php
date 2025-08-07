<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'artista') {
    echo "Acesso negado.";
    exit;
}

$email = $_SESSION['usuario'];
$nome_artistico = $_POST['nome_artistico'];
$redes = $_POST['redes'];
$agenda = $_POST['agenda'];

// Cria a tabela se não existir
$conn->query("CREATE TABLE IF NOT EXISTS dados_artista (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100),
    nome_artistico VARCHAR(100),
    redes TEXT,
    agenda TEXT
)");

$stmt = $conn->prepare("INSERT INTO dados_artista (email, nome_artistico, redes, agenda) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $email, $nome_artistico, $redes, $agenda);

if ($stmt->execute()) {
    echo "Dados do artista salvos com sucesso!";
} else {
    echo "Erro ao salvar dados: " . $conn->error;
}
?>
