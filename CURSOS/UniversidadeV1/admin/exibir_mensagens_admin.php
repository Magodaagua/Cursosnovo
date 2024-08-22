<?php
    include 'conexao.php';

    $result_usuario = "SELECT * FROM administrador WHERE email = '$email' ";
    $resultado_usuario = mysqli_query($con, $result_usuario);
    while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
        $row_usuario['ID_admin']."<br>";		
        $row_usuario['senha']."<br>"; 

    $id_user = $row_usuario['ID_admin'];

    }
    $id_cliente = $_GET['id_cliente'];
    $nome_cliente = $_GET['nome_cliente'];

    $sql = "SELECT usuario, nome_usuario, mensagem, data_envio, tipo, id_admin
            FROM mensagens
            WHERE id_admin='$id_user' AND usuario = '$id_cliente'
            ORDER BY data_envio DESC";

    //echo "SQL: $sql<br>";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $mensagens = array();
        while ($row = $result->fetch_assoc()) {
            $mensagens[] = $row;
        }
        // Inverter a ordem das mensagens
        $mensagens = array_reverse($mensagens);
        foreach ($mensagens as $row) {
            // Adicione classes específicas com base no tipo de usuário
            $classeUsuario = ($row["tipo"] == "cliente") ? "suporte" : "cliente";
            // Formatando a data e hora
            $dataFormatada = date('d/m/Y', strtotime($row["data_envio"]));
            $horaFormatada = date('H:i', strtotime($row["data_envio"]));

            $nomeRemetente = ($row["tipo"] == "cliente") ? $row["nome_usuario"] : "Suporte";

            echo "<div class='message-balloon $classeUsuario'><strong>" . $nomeRemetente . ":</strong> " . $row["mensagem"] . "<br><span class='data'>$dataFormatada</span><span class='hora'>$horaFormatada</span></div>";
        }

        // Adicione uma função JavaScript para rolar automaticamente para o final da área de mensagens
        //echo "<script>document.getElementById('messages-container').scrollTop = document.getElementById('messages-container').scrollHeight;</script>";
    } else {
        echo "<p>Nenhuma mensagem.</p>";
    }
?>
