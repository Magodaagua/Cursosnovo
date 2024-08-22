<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_user = $_POST['id_user'];
        $task_id = $_POST['task_id'];

        $query = "DELETE FROM tasks WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $task_id, $id_user);

        if ($stmt->execute()) {
            echo "Tarefa excluída com sucesso.";
        } else {
            echo "Erro ao excluir a tarefa.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Método de requisição inválido.";
    }
?>
