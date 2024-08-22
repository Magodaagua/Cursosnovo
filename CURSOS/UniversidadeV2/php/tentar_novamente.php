<?php
    include_once("conexao.php");

    $id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);
    $prova_id = filter_input(INPUT_POST, 'prova_id', FILTER_SANITIZE_NUMBER_INT);
    $aula_id = filter_input(INPUT_POST, 'aula_id', FILTER_SANITIZE_NUMBER_INT);
    $modulo_id = filter_input(INPUT_POST, 'modulo_id', FILTER_SANITIZE_NUMBER_INT);
    $curso_id = filter_input(INPUT_POST, 'curso_id', FILTER_SANITIZE_NUMBER_INT);
    $ordem = filter_input(INPUT_POST, 'ordem', FILTER_SANITIZE_NUMBER_INT);

    $query_prova_feita = "SELECT tentativas FROM provafeita WHERE prova_id = :prova_id AND usuario_id = :usuario_id";
    $stmt_prova_feita = $con->prepare($query_prova_feita);
    $stmt_prova_feita->bindParam(':prova_id', $prova_id, PDO::PARAM_INT);
    $stmt_prova_feita->bindParam(':usuario_id', $id_user, PDO::PARAM_INT);
    $stmt_prova_feita->execute();
    $prova_feita = $stmt_prova_feita->fetch(PDO::FETCH_ASSOC);

    if ($prova_feita && $prova_feita['tentativas'] == 2) {
        $tentativas = 3;
    } else {
        $tentativas = $prova_feita['tentativas'] + 1;
    }

    $query = "UPDATE provafeita SET tentativas = :tentativas WHERE prova_id = :prova_id AND usuario_id = :usuario_id";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':tentativas', $tentativas, PDO::PARAM_INT);
    $stmt->bindParam(':prova_id', $prova_id, PDO::PARAM_INT);
    $stmt->bindParam(':usuario_id', $id_user, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: ../visualizar_aula.php?id=$aula_id&id_user=$id_user&modulo_id=$modulo_id&curso_id=$curso_id&ordem=$ordem");
    exit();
?>
