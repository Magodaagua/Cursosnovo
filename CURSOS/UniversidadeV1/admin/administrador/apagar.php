<?php
include_once "../conexao.php";

$ID_admin = filter_input(INPUT_GET, "ID_admin", FILTER_SANITIZE_NUMBER_INT);

if (!empty($ID_admin)) {

    $query_admin = "DELETE FROM administrador WHERE ID_admin=:ID_admin";
    $result_admin = $conn->prepare($query_admin);
    $result_admin->bindParam(':ID_admin', $ID_admin);

    if($result_admin->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Conta administradora apagada com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Conta administradora não apagada com sucesso!</div>"];
    }

} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma conta administradora encontrada!</div>"];
}

echo json_encode($retorna);