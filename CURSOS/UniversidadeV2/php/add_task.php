<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_user = $_POST['id_user'];
        $title = $_POST['title'];
        $status = $_POST['status'];

        $query = "INSERT INTO tasks (title, status, user_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $title, $status, $id_user);

        if ($stmt->execute()) {
            echo json_encode(["id" => $stmt->insert_id]);
        } else {
            echo "Erro ao adicionar a tarefa.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Método de requisição inválido.";
    }
?>
