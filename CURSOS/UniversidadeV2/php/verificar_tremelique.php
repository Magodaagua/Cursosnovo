<?php
    include_once("conexao.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : null;

    // Busca por tremeliques não validados
    $stmt = $conn->prepare("SELECT * FROM tremelique WHERE contato_id = ? AND validacao = 1");
    $stmt->bind_param("i", $id_user);

    if (!$stmt->execute()) {
        echo "Erro na execução da consulta: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Se houver um tremelique não validado, retorna '1'
            echo '1';

            // Aguarda 10 segundos
            sleep(10);

            // Atualiza a validação de '1' para '0'
            $stmt = $conn->prepare("UPDATE tremelique SET validacao = 0 WHERE contato_id = ? AND validacao = 1");
            $stmt->bind_param("i", $id_user);
            $stmt->execute();
        } else {
            // Se não houver um tremelique não validado, retorna '0'
            echo '0';
        }
    }
?>
