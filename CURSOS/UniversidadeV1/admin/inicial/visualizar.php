<?php
include_once "../conexao.php";

$ID_menu = filter_input(INPUT_GET, "ID_menu", FILTER_SANITIZE_NUMBER_INT);

if (!empty($ID_menu)) {

    $query_menu = "SELECT ID_menu, texto1, texto2, texto3, titulo1, titulo2, titulo3, imagem1, imagem2, imagem3, carrosel1, carrosel2, carrosel3 FROM menu WHERE ID_menu =:ID_menu LIMIT 1";
    $result_menu = $conn->prepare($query_menu);
    $result_menu->bindParam(':ID_menu', $ID_menu);
    //$Datadecriacao = date('d/m/Y', strtotime($Datadecriacao));
    //$result_curso->bindParam(':Datadecriacao', $Datadecriacao);
    $result_menu->execute();


    $row_menu = $result_menu->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_menu];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma informação encontrada!</div>"];
}

echo json_encode($retorna);