<?php
include_once 'connection.php';
include_once 'controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dadosJson = file_get_contents("php://input");
    $novosDados = json_decode($dadosJson, true);
    inserirRegistro($novosDados);

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    $dadosJson = file_get_contents("php://input");
    $novosDados = json_decode($dadosJson, true);
    atualizarRegistro($_GET['id'], $novosDados);

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

    buscarRegistros();

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    excluirRegistro($_GET['id']);

} else {

    http_response_code(405);
    echo "Método HTTP não suportado";
    
}

$conn->close();
?>
