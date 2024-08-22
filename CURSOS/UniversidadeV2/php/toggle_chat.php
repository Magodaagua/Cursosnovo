<?php
    include_once("conexao.php");

    if (isset($_POST['acao']) && isset($_POST['id_grupo'])) {
        $acao = $_POST['acao'];
        $id_grupo = $_POST['id_grupo'];

        if ($acao === 'encerrar') {
            $query = "UPDATE salas SET chat_bloqueado = 1 WHERE ID_grupo = ?";
        } else {
            $query = "UPDATE salas SET chat_bloqueado = 0 WHERE ID_grupo = ?";
        }

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $id_grupo);
            if ($stmt->execute()) {
                echo $acao === 'encerrar' ? 'fechado' : 'aberto';
            } else {
                echo "Erro ao atualizar o estado do chat.";
            }
            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta.";
        }

        $conn->close();
    } else {
        echo "Dados incompletos.";
    }
?>
