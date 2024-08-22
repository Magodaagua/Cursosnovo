<?php
include_once("php/conexao.php");
// Verifica se todos os parâmetros necessários foram recebidos
if(isset($_POST['id_user'], $_POST['id_aula'], $_POST['favorito'], $_POST['modulo_id'], $_POST['curso_id'], $_POST['ordem'])) {
    // Atribui os parâmetros recebidos a variáveis locais
    $id_user = $_POST['id_user'];
    $id_aula = $_POST['id_aula'];
    $favorito = $_POST['favorito'];
    $modulo_id = $_POST['modulo_id'];
    $curso_id = $_POST['curso_id'];
    $ordem = $_POST['ordem'];

    //echo $id_user.'<br>'. $id_aula .'<br>'. $favorito .'<br>'. $modulo_id .'<br>'. $curso_id .'<br>'. $ordem;
    error_log('id_user: ' . $_POST['id_user']);
    error_log('id_aula: ' . $_POST['id_aula']);
    error_log('favorito: ' . $_POST['favorito']);
    error_log('modulo_id: ' . $_POST['modulo_id']);
    error_log('curso_id: ' . $_POST['curso_id']);
    error_log('ordem: ' . $_POST['ordem']);
    

    // Verifica se os parâmetros id_user e id_aula não estão vazios
    if ($id_user && $id_aula) {
        try {
            // Conexão com o banco de dados
            $pdo = new PDO('mysql:host=192.168.1.10;dbname=DevPortalCop', 'DevUser2', 'BV!A2k1$e61ms#yeQpE4j');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Prepara a query SQL de acordo com o valor de favorito
            if ($favorito == 1) {
                // Adicionar aos favoritos
                $query = "INSERT INTO aulas_favoritas (id_aula, id_cliente, id_curso, informacao) VALUES (:id_aula, :id_user, :id_curso ,1)
                          ON DUPLICATE KEY UPDATE informacao = 1";
            } else {
                // Remover dos favoritos
                $query = "UPDATE aulas_favoritas SET informacao = 0 WHERE id_cliente = :id_user AND id_aula = :id_aula AND id_curso = :id_curso";
            }
            
            // Prepara e executa a query SQL
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
            $stmt->bindParam(':id_curso', $curso_id, PDO::PARAM_INT);
            $stmt->execute();


            // Envie uma resposta de sucesso de volta para o JavaScript
            echo 'success';
            // Redireciona de volta para visualizar_aula.php com os parâmetros corretos
            //header('Location: visualizar_aula.php?id_user=' . $id_user . '&id=' . $id_aula . '&modulo_id=' . $modulo_id . '&curso_id=' . $curso_id . '&ordem=' . $ordem);
            //exit(); // Encerra o script após o redirecionamento
        } catch (PDOException $e) {
            echo 'error'. $e->getMessage(); // Exibir mensagem de erro caso ocorra uma exceção;
        }
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
