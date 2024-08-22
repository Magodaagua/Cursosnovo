<!DOCTYPE html>
<html lang="pt-br">
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include_once("php/conexao.php");

        $result_usuario = "SELECT * FROM usuario WHERE Usuario = '$usuario' ";
        $resultado_usuario = mysqli_query($conn, $result_usuario);

        if ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
            $id_user = $row_usuario['ID_usuario'];
            $dep = $row_usuario['Dep'];
            $nome_usuario = $row_usuario['Nome'];
            $abreviacao = $row_usuario['Abreviacao'];
        }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Anotações</title>
        <link rel="icon" type="png" href="../../COMUM/img/Icons/Vermelho/imgML13.png">
        <link href="https://fonts.cdnfonts.com/css/community" rel="stylesheet">
        <link rel="stylesheet" href="css/tudo.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    </head>
    <body data-id-user="<?php echo $id_user; ?>">
        <?php require "titulo.php"; ?>
        <div class="botaovoltarteste">
            <button onclick="goBack()">
                <img src="../../COMUM/img/cursos/imagens/return.png">
            </button>
        </div>

        <button class="add-task-button">Adicionar Tarefa</button>

        <div class="kanban-board">
            <div class="kanban-column">
                <h2>To Do</h2>
                <div id="todo" class="kanban-items-container">
                    <!-- Os itens do kanban vão aqui -->
                </div>
            </div>
            <div class="kanban-column">
                <h2>In Progress</h2>
                <div id="in-progress" class="kanban-items-container">
                    <!-- Os itens do kanban vão aqui -->
                </div>
            </div>
            <div class="kanban-column">
                <h2>Done</h2>
                <div id="done" class="kanban-items-container">
                    <!-- Os itens do kanban vão aqui -->
                </div>
            </div>
        </div>

        <div id="addTaskModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Adicionar Tarefa</h2>
                <input type="text" id="taskTitle" placeholder="Título da Tarefa">
                <select id="taskStatus">
                    <option value="todo">To Do</option>
                    <option value="in-progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
                <button id="saveTaskButton">Salvar</button>
            </div>
        </div>

        <script>
            function goBack() {
                window.history.back();
            }
            // Recupera o id_user do atributo data do body
            var id_user = $('body').data('id-user');
            $(document).ready(function() {
                var modal = $('#addTaskModal');
                var btn = $('.add-task-button');
                var span = $('.close');
                var saveBtn = $('#saveTaskButton');

                // Abrir o modal
                btn.on('click', function() {
                    modal.show();
                });

                // Fechar o modal
                span.on('click', function() {
                    modal.hide();
                });

                // Fechar o modal clicando fora do conteúdo
                $(window).on('click', function(event) {
                    if (event.target.id === 'addTaskModal') {
                        modal.hide();
                    }
                });

                // Salvar a nova tarefa
                saveBtn.on('click', function() {
                    var title = $('#taskTitle').val();
                    var status = $('#taskStatus').val();
                    var id_user = $('body').data('id-user');

                    if (title) {
                        $.ajax({
                            url: 'php/add_task.php',
                            type: 'POST',
                            data: {
                                id_user: id_user,
                                title: title,
                                status: status
                            },
                            success: function(response) {
                                var task = $('<div>')
                                    .addClass('kanban-item')
                                    .data('id', response.id)
                                    .text(title);
                                $('#' + status).append(task);
                                $('#taskTitle').val(''); // Limpa o campo do título
                                modal.hide();
                                initializeDragAndDrop(); // Re-inicializa drag and drop
                            },
                            error: function(xhr, status, error) {
                                console.error("Erro na requisição AJAX: ", status, error);
                            }
                        });
                    } else {
                        alert("O título da tarefa não pode estar vazio.");
                    }
                });

                // Função para carregar as tarefas do banco de dados
                function loadTasks() {
                    var id_user = $('body').data('id-user');
                    $.ajax({
                        url: 'php/get_tasks.php',
                        type: 'GET',
                        data: { id_user: id_user },
                        success: function(data) {
                            var tasks = JSON.parse(data);
                            tasks.forEach(function(task) {
                                var taskElement = $('<div>')
                                    .addClass('kanban-item')
                                    .data('id', task.id)
                                    .text(task.title);
                                var deleteButton = $('<button>')
                                    .addClass('delete-button')
                                    .text('X')
                                    .on('click', function() {
                                        deleteTask(task.id);
                                    });
                                taskElement.append(deleteButton);
                                $('#' + task.status).append(taskElement);
                            });
                            initializeDragAndDrop(); // Inicializa arrastar e soltar após carregar as tarefas
                        },
                        error: function(xhr, status, error) {
                            console.error("Erro na requisição AJAX: ", status, error);
                        }
                    });
                }

                // Função para excluir uma tarefa
                function deleteTask(taskId) {
                    var id_user = $('body').data('id-user');
                    $.ajax({
                        url: 'php/delete_task.php',
                        type: 'POST',
                        data: {
                            id_user: id_user,
                            task_id: taskId
                        },
                        success: function(response) {
                            console.log('Tarefa excluída:', response);
                            $('.kanban-item').filter(function() {
                                return $(this).data('id') == taskId;
                            }).remove(); // Remove o item excluído do DOM
                        },
                        error: function(xhr, status, error) {
                            console.error("Erro na requisição AJAX: ", status, error);
                        }
                    });
                }

                // Inicializa a funcionalidade de arrastar e soltar
                function initializeDragAndDrop() {
                    console.log("Inicializando drag and drop");
                    var kanbanColumns = document.querySelectorAll('.kanban-items-container');
                    kanbanColumns.forEach(function(column) {
                        new Sortable(column, {
                            group: 'shared',
                            animation: 150,
                            onEnd: function(evt) {
                                var id_user = $('body').data('id-user');
                                var item = evt.item;
                                var status = item.parentNode.id;
                                var task_id = $(item).data('id');
                                console.log("Movendo item: " + task_id + " para " + status); // Log de depuração
                                $.ajax({
                                    url: 'php/update_task_status.php',
                                    type: 'POST',
                                    data: {
                                        id_user: id_user,
                                        task_id: task_id,
                                        status: status
                                    },
                                    success: function(response) {
                                        console.log('Status atualizado:', response);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("Erro na requisição AJAX: ", status, error);
                                    }
                                });
                            }
                        });
                    });
                }

                // Carregar tarefas ao iniciar
                loadTasks();
            });
            // Recupera o id_user do atributo data do body
            var id_user = $('body').data('id-user');

            var soundPlayedAnexos = false; // Variável para rastrear se o som já foi tocado

            $(document).ready(function() {
                // Adiciona um evento de mouseover ao elemento desejado
                $('#seu-elemento').on('mouseover', function() {
                    showPopupNotificacao();
                });
            });

            setInterval(function() {
                $.ajax({
                    url: 'php/check_messages.php',
                    type: 'POST',
                    data: { id_user: id_user },
                    success: function(data) {
                        let botaoNotificacao = document.getElementById('botao-notificacao').querySelector('img');
                        if (data.trim() === 'true') {
                            botaoNotificacao.src = '../../COMUM/img/cursos/imagens/notification.png';
                            if (!soundPlayedAnexos) {
                                playNotificationSound(); // Tocar o som de notificação
                                soundPlayedAnexos = true; // Marcar que o som foi tocado
                            }
                        } else {
                            botaoNotificacao.src = '../../COMUM/img/cursos/imagens/bell.png';
                            soundPlayedAnexos = false; // Resetar a variável quando não há novas notificações
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro na requisição AJAX: ", status, error);
                    }
                });
            }, 5000); // Verifica a cada 5 segundos

        </script>
        <?php //require "rodape.php"; ?>
    </body>
</html>
