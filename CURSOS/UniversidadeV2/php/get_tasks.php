<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id_user = $_GET['id_user'];

        $query = "SELECT id, title, status FROM tasks WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_user);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $tasks = [];

            while ($row = $result->fetch_assoc()) {
                $tasks[] = $row;
            }

            echo json_encode($tasks);
        } else {
            echo "Erro ao buscar as tarefas.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Método de requisição inválido.";
    }
?>
