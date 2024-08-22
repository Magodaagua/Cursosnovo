<?php
    include_once("conexao.php");

    if (isset($_POST['user_id']) && isset($_POST['group_id'])) {
        $user_id = $_POST['user_id'];
        $group_id = $_POST['group_id'];

        // Remover o usuário do grupo
        $query = "DELETE FROM inscricao_grupo WHERE id_cliente = ? AND id_grupo = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("ii", $user_id, $group_id);
            if ($stmt->execute()) {
                echo "removido";
            } else {
                echo "Erro ao remover usuário: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }
    } else {
        echo "Dados incompletos.";
    }

    $conn->close();
?>
