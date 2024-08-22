<?php
    include_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $date = $_POST['date'];
        $text = $_POST['text'];
        $id_user = $_POST['id_user'];

        $query = "INSERT INTO lembretes (id_user, data, texto) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $id_user, $date, $text);

        if ($stmt->execute()) {
            echo "Lembrete salvo com sucesso!";
        } else {
            echo "Erro ao salvar o lembrete.";
        }

        $stmt->close();
        $conn->close();
    }
?>
