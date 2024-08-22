<?php
    // Inclua sua conexão com o banco de dados e outras configurações necessárias
    include_once "conexao.php";
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set('America/Sao_Paulo');

    // Substitua 'id_user' pelo ID do usuário logado
    $id_user = $_POST['id_user'] ?? null;

    if (!$id_user) {
        echo json_encode([]);
        exit;
    }

    // Selecione mensagens não lidas
    $stmt = $con->prepare("SELECT m.mensagem, m.data_hora, u.Nome as Nome, u.FotoPerfil as FotoPerfil
    FROM mensagens_zap m
    JOIN usuario u ON m.id_user_envio = u.ID_usuario
    WHERE m.id_user_recebe = ? AND m.mensagem_lida = 0
    ORDER BY m.data_hora DESC");
    $stmt->execute([$id_user]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Formate a data e hora
    foreach ($results as $key => $value) {
        $data_hora_obj = date_create_from_format('Y-m-d H:i:s', $value['data_hora']);
        $results[$key]['data_hora'] = $data_hora_obj->format('d-m-Y H:i');
    }

    // Selecione eventos da última semana
    $stmt = $con->prepare("SELECT Evento, Descricao, DataEvento, DataPublicado, Arquivo
    FROM eventos
    WHERE DataPublicado >= NOW() - INTERVAL 1 WEEK
    ORDER BY DataEvento DESC");
    $stmt->execute();
    $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Formate a data do evento e da publicação
    foreach ($eventos as $key => $value) {
        $data_evento_obj = date_create_from_format('Y-m-d', $value['DataEvento']);
        $eventos[$key]['DataEvento'] = $data_evento_obj->format('d-m-Y');

        $data_publicado_obj = date_create_from_format('Y-m-d', $value['DataPublicado']);
        $eventos[$key]['DataPublicado'] = $data_publicado_obj->format('d-m-Y');
    }

    // Selecione comunicados da última semana
    $stmt = $con->prepare("SELECT Categoria as Nome, Titulo, Descricao, DataPublicado, Arquivo
    FROM comunicados
    WHERE DataPublicado >= NOW() - INTERVAL 1 WEEK
    ORDER BY DataPublicado DESC");
    $stmt->execute();
    $comunicados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Formate a data da publicação
    foreach ($comunicados as $key => $value) {
        $data_publicado_obj = date_create_from_format('Y-m-d', $value['DataPublicado']);
        $comunicados[$key]['DataPublicado'] = $data_publicado_obj->format('d-m-Y');
    }

    // Selecione usuários que fazem aniversário hoje
    $stmt = $con->prepare("SELECT Nome, Aniversario, FotoPerfil
    FROM usuario
    WHERE DAY(Aniversario) = DAY(CURDATE()) AND MONTH(Aniversario) = MONTH(CURDATE())");
    $stmt->execute();
    $aniversariantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Adicione uma mensagem de aniversário para cada aniversariante
    foreach ($aniversariantes as $key => $value) {
        $aniversariantes[$key]['mensagem'] = 'Feliz aniversário ' . $value['Nome'] . '!';
        $aniversariantes[$key]['data_hora'] = date('d-m-Y'); // Adicione a data e hora atual
    }

    // Selecione usuários que foram admitidos na última semana
    $stmt = $con->prepare("SELECT Nome, Admissao, FotoPerfil
    FROM usuario
    WHERE Admissao >= CURDATE() - INTERVAL 1 WEEK");
    $stmt->execute();
    $novos_funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Adicione uma mensagem de boas-vindas para cada novo funcionário
    foreach ($novos_funcionarios as $key => $value) {
        $novos_funcionarios[$key]['mensagem'] = 'Bem vindo ' . $value['Nome'] . '!';
        $novos_funcionarios[$key]['data_hora'] = date('d-m-Y'); // Adicione a data e hora atual
    }

    // Combine os resultados das mensagens, eventos, comunicados, aniversariantes e novos funcionários
    $results = array_merge($results, $eventos, $comunicados, $aniversariantes, $novos_funcionarios);

    // Verifique se há mensagens, eventos, comunicados, aniversariantes ou novos funcionários
    if ($results) {
        echo json_encode($results);
    } else {
        echo json_encode([]);
    }
?>
