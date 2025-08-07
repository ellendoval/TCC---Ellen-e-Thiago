<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "raizes_unificado";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
