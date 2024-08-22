<?php
include_once "../conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_categoria = "SELECT id, Nome_cat, imagem, tipo FROM categoria WHERE id=:id LIMIT 1";
    $result_categoria = $conn->prepare($query_categoria);
    $result_categoria->bindParam(':id', $id);
    $result_categoria->execute();

    $row_categoria = $result_categoria->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_categoria];    
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma categoria encontrada!</div>"];
}

echo json_encode($retorna);