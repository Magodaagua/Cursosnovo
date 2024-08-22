<?php
include_once "../conexao.php";

$ID_usuario = filter_input(INPUT_GET, "ID_usuario", FILTER_SANITIZE_NUMBER_INT);

if (!empty($ID_usuario)) {

    $query_usuario = "SELECT ID_usuario, Nome, CPF, RG, Cargo, email, senha FROM usuario WHERE ID_usuario =:ID_usuario LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':ID_usuario', $ID_usuario);
    $result_usuario->execute();

    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_usuario];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}

echo json_encode($retorna);