<?php
include_once "../conexao.php";

$ID_usuario = filter_input(INPUT_GET, "ID_usuario", FILTER_SANITIZE_NUMBER_INT);

if (!empty($ID_usuario)) {

    $query_usuario = "DELETE FROM usuario WHERE ID_usuario=:ID_usuario";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':ID_usuario', $ID_usuario);

    if($result_usuario->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário apagado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não apagado com sucesso!</div>"];
    }

} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}

echo json_encode($retorna);