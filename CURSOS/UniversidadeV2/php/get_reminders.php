<?php
    include_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $month = $_POST['month'];
        $year = $_POST['year'];
        $id_user = $_POST['id_user'];

        $query = "SELECT id, data, texto FROM lembretes WHERE MONTH(data) = ? AND YEAR(data) = ? AND id_user = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iii", $month, $year, $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        $reminders = [];
        while ($row = $result->fetch_assoc()) {
            $reminders[] = array(
                'id' => $row['id'],
                'date' => $row['data'],
                'text' => $row['texto']
            );
        }

        $stmt->close();
        $conn->close();

        echo json_encode($reminders);
    } else {
        echo "Método não permitido";
    }
?>
