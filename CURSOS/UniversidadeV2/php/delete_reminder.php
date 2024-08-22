<?php
    include_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];

        $query = "DELETE FROM lembretes WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Lembrete excluído com sucesso!";
        } else {
            echo "Erro ao excluir o lembrete.";
        }

        $stmt->close();
        $conn->close();
    }
?>
