<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_user = $_POST['id_user'];
        $task_id = $_POST['task_id'];
        $status = $_POST['status'];

        $query = "UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sii", $status, $task_id, $id_user);

        if ($stmt->execute()) {
            echo "Status atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o status.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Método de requisição inválido.";
    }
?>
