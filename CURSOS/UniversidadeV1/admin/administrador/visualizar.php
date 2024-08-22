<?php
include_once "../conexao.php";

$ID_admin = filter_input(INPUT_GET, "ID_admin", FILTER_SANITIZE_NUMBER_INT);

if (!empty($ID_admin)) {

    $query_admin = "SELECT ID_admin, email, senha FROM administrador WHERE ID_admin=:ID_admin LIMIT 1";
    $result_admin = $conn->prepare($query_admin);
    $result_admin->bindParam(':ID_admin', $ID_admin);
    $result_admin->execute();

    $row_admin = $result_admin->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_admin];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma conta administradora encontrada!</div>"];
}

echo json_encode($retorna);