<?php
include_once "../conexao.php";

$ID_parceiro = filter_input(INPUT_GET, "ID_parceiro", FILTER_SANITIZE_NUMBER_INT);

if (!empty($ID_parceiro)) {

    $query_parceiro = "SELECT ID_parceiro, Nome, Descricao, link, imagem FROM parceiro WHERE ID_parceiro =:ID_parceiro LIMIT 1";
    $result_parceiro = $conn->prepare($query_parceiro);
    $result_parceiro->bindParam(':ID_parceiro', $ID_parceiro);
    $result_parceiro->execute();

    $row_parceiro = $result_parceiro->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_parceiro];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma empresa encontrada!</div>"];
}

echo json_encode($retorna);