<?php
include_once "../conexao.php";

$ID_curso = filter_input(INPUT_GET, "ID_curso", FILTER_SANITIZE_NUMBER_INT);

if (!empty($ID_curso)) {

    $query_curso = "SELECT ID_curso, Nome, Categoria, Subcategoria, Descricao, Datadecriacao, imagem, pdf, video FROM curso WHERE ID_curso =:ID_curso LIMIT 1";
    $result_curso = $conn->prepare($query_curso);
    $result_curso->bindParam(':ID_curso', $ID_curso);
    //$Datadecriacao = date('d/m/Y', strtotime($Datadecriacao));
    //$result_curso->bindParam(':Datadecriacao', $Datadecriacao);
    $result_curso->execute();


    $row_curso = $result_curso->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_curso];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum curso encontrado!</div>"];
}

echo json_encode($retorna);