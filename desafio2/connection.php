<?php
$servername = "localhost";
$username = "root";
$password = ""; // Insira aqui a senha correta
$database = "carros";

// Tente conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $database);

// Verifique se há erros de conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
