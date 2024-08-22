<?php
    include_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $text = $_POST['text'];

        $query = "UPDATE lembretes SET texto = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $text, $id);

        if ($stmt->execute()) {
            echo "Lembrete atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar o lembrete.";
        }

        $stmt->close();
        $conn->close();
    }
?>
