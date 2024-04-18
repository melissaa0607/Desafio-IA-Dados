<?php
include 'connection.php';

function inserirRegistro($dados) {
    global $conn;

    // Acessando os dados recebidos do JSON
    $nome = $dados['nome'];
    $cadastro = date('Y-m-d');
    $ano = $dados['ano'];
    $status = $dados['status'];
    $alteracao = date('Y-m-d');

    // Executar a lógica para inserir o registro no banco de dados
    $sql = "INSERT INTO cadastro (NOME_CARROS, CADASTRO_CARROS, ANO_CARROS, STATUS_CARROS, ALTERACAO_CARROS)
            VALUES ('$nome', '$cadastro', '$ano', '$status', '$alteracao')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro inserido com sucesso!";
    } else {
        echo "Erro na inserção: " . $conn->error;
    }
}

function atualizarRegistro($id, $novosDados) {
    global $conn;

    // Inicializa um array para armazenar os fragmentos de SQL para cada campo a ser atualizado
    $updates = array();

    // Verifica se o status está presente no JSON
    if (isset($novosDados['status'])) {
        $status = $novosDados['status'];
        $updates[] = "STATUS_CARROS='$status'";
    }

    // Verifica se o nome está presente no JSON
    if (isset($novosDados['nome'])) {
        $nome = $novosDados['nome'];
        $updates[] = "NOME_CARROS='$nome'";
    }

    // Verifica se o ano está presente no JSON
    if (isset($novosDados['ano'])) {
        $ano = $novosDados['ano'];
        $updates[] = "ANO_CARROS='$ano'";
    }

    // Sempre atualiza a data de alteração
    $updates[] = "ALTERACAO_CARROS=NOW()";

    // Constrói a parte SET da consulta SQL
    $set_clause = implode(",", $updates);

    // Executar a lógica para atualizar o registro no banco de dados
    $sql = "UPDATE cadastro SET $set_clause WHERE ID_CARROS=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso!";
    } else {
        echo "Erro na atualização: " . $conn->error;
    }
}
function buscarRegistros() {
    global $conn;

    // Executar a lógica para buscar registros na tabela e retornar os resultados
    $sql = "SELECT * FROM cadastro";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
            // Organize os dados como desejar aqui
            $registro = array(
                'ID' => $row['ID_CARROS'],
                'NOME' => $row['NOME_CARROS'],
                'CADASTRO' => $row['CADASTRO_CARROS'],
                'ANO' => $row['ANO_CARROS'],
                'STATUS' => $row['STATUS_CARROS'],
                'ALTERACAO' => $row['ALTERACAO_CARROS']
            );
            $rows[] = $registro;
        }
        echo json_encode($rows);
    } else {
        echo json_encode(array('message' => 'Nenhum resultado encontrado'));
    }
}


function excluirRegistro($id) {
    global $conn;

    // Executar a lógica para excluir o registro com base no ID fornecido
    $sql = "DELETE FROM cadastro WHERE ID_CARROS=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro excluído com sucesso!";
    } else {
        echo "Erro na exclusão: " . $conn->error;
    }
}
?>