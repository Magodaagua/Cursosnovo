<?php
    include 'conexao.php';

    $sql = "SELECT ID_usuario, Nome FROM usuario";
    $result = $con->query($sql);

    if (!$result) {
        die('Erro na consulta: ' . $con->error);
    }
    
    $clientes = array();
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }

    // Defina o cabeçalho da resposta como JSON
    header('Content-Type: application/json');

    // Limpar o buffer de saída para garantir que não haja saída HTML anterior
    ob_clean();

    // Envie o JSON como resposta
    echo json_encode($clientes);
    exit; // Certifique-se de encerrar o script após enviar a resposta JSON

?>