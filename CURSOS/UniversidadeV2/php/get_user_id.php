<?php
    session_start();
    include_once("conexao.php");

    if (!isset($_SESSION['usuario'])) {
        echo json_encode(['error' => 'Usuário não autenticado.']);
        exit;
    }

    $usuario = $_SESSION['usuario'];

    $result_usuario = "SELECT ID_usuario FROM usuario WHERE Usuario = '$usuario'";
    $resultado_usuario = mysqli_query($conn, $result_usuario);

    if ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
        echo json_encode(['id_user' => $row_usuario['ID_usuario']]);
    } else {
        echo json_encode(['error' => 'Usuário não encontrado.']);
    }

?>