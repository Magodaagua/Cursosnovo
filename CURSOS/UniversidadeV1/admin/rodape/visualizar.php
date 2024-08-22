<?php
include_once "../conexao.php";

$ID_rodape = filter_input(INPUT_GET, "ID_rodape", FILTER_SANITIZE_NUMBER_INT);

if (!empty($ID_rodape)) {

    $query_rodape = "SELECT ID_rodape, politica, termos FROM rodape WHERE ID_rodape =:ID_rodape LIMIT 1";
    $result_rodape = $conn->prepare($query_rodape);
    $result_rodape->bindParam(':ID_rodape', $ID_rodape);
    //$Datadecriacao = date('d/m/Y', strtotime($Datadecriacao));
    //$result_curso->bindParam(':Datadecriacao', $Datadecriacao);
    $result_rodape->execute();


    $row_rodape = $result_rodape->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_rodape];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma informação encontrada!</div>"];
}

echo json_encode($retorna);