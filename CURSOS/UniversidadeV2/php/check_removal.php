<?php
    include_once("conexao.php");

    if (isset($_POST['user_id']) && isset($_POST['group_id'])) {
        $user_id = $_POST['user_id'];
        $group_id = $_POST['group_id'];

        // Verifica se o usuário ainda está no grupo
        $query = "SELECT * FROM inscricao_grupo WHERE id_cliente = ? AND id_grupo = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("ii", $user_id, $group_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo "removido";
            } else {
                echo "presente";
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
