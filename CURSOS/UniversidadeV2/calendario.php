<!DOCTYPE html>
<html lang="pt-br">
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        //inclui a página que mantem o site conectado no banco de dados
        include_once("php/conexao.php");

        //faz uma busca no banco de dados e retorna tudo o que for do usuário atual
        $result_usuario = "SELECT * FROM usuario WHERE Usuario = '$usuario' ";
        $resultado_usuario = mysqli_query($conn, $result_usuario);

        // salva algumas informações do usuário atual em variaveis para facilitar
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
        <title>Calendario</title>
        <!--coloca o icone na aba da tela-->
        <link rel="icon" type="png" href="../../COMUM/img/Icons/Vermelho/imgML13.png">
        <!--CSS-->
        <link href="https://fonts.cdnfonts.com/css/community" rel="stylesheet">
        <link rel="stylesheet" href="css/tudo.css">
        <link rel="stylesheet" href="css/calendario.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body data-id-user="<?php echo $id_user; ?>">
        <?php require "titulo.php";?>
        <div class="botaovoltarteste">
            <button onclick="goBack()">
                <img src="../../COMUM/img/cursos/imagens/return.png">
            </button>
        </div>
        <div class="calendar-container">
            <div class="calendar-header">
                <button id="prev-month">←</button>
                <div class="month-year" id="month-year"></div>
                <button id="next-month">→</button>
            </div>
            <div id="kanban-calendar">
                <div class="week-days">
                    <div class="week-day">Domingo</div>
                    <div class="week-day">Segunda-feira</div>
                    <div class="week-day">Terça-feira</div>
                    <div class="week-day">Quarta-feira</div>
                    <div class="week-day">Quinta-feira</div>
                    <div class="week-day">Sexta-feira</div>
                    <div class="week-day">Sábado</div>
                </div>
                <div id="calendar" class="kanban-days"></div>
            </div>
        </div>

        <!-- Modal HTML -->
        <div class="modal-overlay-calendario" id="modal-overlay-calendario"></div>
        <div class="modal-calendario" id="modal-calendario">
            <div class="popup-content-calendario">
                <h2>Adicionar/Editar Lembrete no Dia <span id="selected-day"></span></h2>
                <form id="reminder-form-popup-calendario">
                    <input type="hidden" id="reminder-date-calendario">
                    <input type="hidden" id="reminder-id-calendario">
                    <div>
                        <label for="reminder-text-popup-calendario">Lembrete:</label>
                        <textarea id="reminder-text-popup-calendario" required></textarea>
                    </div>
                    <div>
                        <button type="submit">Salvar</button>
                        <button type="button" id="cancel-button-popup-calendario">Cancelar</button>
                        <button type="button" id="delete-button-popup-calendario">Excluir</button>
                    </div>
                </form>
            </div>
        </div>

        <?php require "rodape.php"; ?>

        <script>
            function goBack() {
                window.history.back();
            }
            $(document).ready(function() {
                const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
                const feriados = [
                    { date: "2024-01-01", name: "Ano Novo" },
                    { date: "2024-04-21", name: "Tiradentes" },
                    { date: "2024-05-01", name: "Dia do Trabalho" },
                    { date: "2024-09-07", name: "Independência do Brasil" },
                    { date: "2024-10-12", name: "Nossa Senhora Aparecida" },
                    { date: "2024-11-02", name: "Finados" },
                    { date: "2024-11-15", name: "Proclamação da República" },
                    { date: "2024-12-25", name: "Natal" }
                ];
                let today = new Date();
                let month = today.getMonth();
                let year = today.getFullYear();
                const calendar = $('#calendar');
                const monthYearDisplay = $('#month-year');

                function renderCalendar(month, year, reminders) {
                    calendar.empty();
                    monthYearDisplay.text(`${monthNames[month]} ${year}`);
                    const firstDay = new Date(year, month).getDay();
                    const daysInMonth = new Date(year, month + 1, 0).getDate();

                    let days = [];
                    for (let i = 0; i < firstDay; i++) {
                        days.push('<div class="day empty"></div>');
                    }
                    for (let i = 1; i <= daysInMonth; i++) {
                        const isToday = (i === today.getDate() && month === today.getMonth() && year === today.getFullYear());
                        const dayClass = isToday ? 'day today' : 'day';
                        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;

                        let dayContent = `<div class="day-number">${i}</div>
                                        <div class="reminders">`;

                        if (reminders[dateStr]) {
                            reminders[dateStr].forEach(reminder => {
                                dayContent += `<div class="reminder" data-id="${reminder.id}" data-text="${reminder.text}">
                                                ${reminder.text}
                                            </div>`;
                            });
                        }

                        const holiday = feriados.find(feriado => feriado.date === dateStr);
                        if (holiday) {
                            dayContent += `<div class="reminder holiday">${holiday.name}</div>`;
                        }

                        dayContent += `</div>`;

                        days.push(`<div class="${dayClass}" data-date="${dateStr}">
                                    <div class="day-content">${dayContent}</div>
                                </div>`);
                    }

                    let weekRow = $('<div class="kanban-week"></div>');
                    for (let i = 0; i < days.length; i++) {
                        weekRow.append(days[i]);
                        if ((i + 1) % 7 === 0) {
                            calendar.append(weekRow);
                            weekRow = $('<div class="kanban-week"></div>');
                        }
                    }

                    const remainingDays = 7 - (days.length % 7);
                    if (remainingDays !== 7) {
                        for (let i = 0; i < remainingDays; i++) {
                            weekRow.append('<div class="day empty"></div>');
                        }
                        calendar.append(weekRow);
                    }
                }

                function loadReminders(month, year) {
                    $.ajax({
                        url: 'php/get_reminders.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            month: month + 1,
                            year: year,
                            id_user: $('body').data('id-user')
                        },
                        success: function(response) {
                            let reminders = {};
                            response.forEach(reminder => {
                                if (!reminders[reminder.date]) {
                                    reminders[reminder.date] = [];
                                }
                                reminders[reminder.date].push(reminder);
                            });
                            renderCalendar(month, year, reminders);
                        },
                        error: function(xhr, status, error) {
                            console.error('Erro ao carregar lembretes:', status, error);
                        }
                    });
                }

                loadReminders(month, year);

                $('#prev-month').click(function() {
                    if (month === 0) {
                        month = 11;
                        year--;
                    } else {
                        month--;
                    }
                    loadReminders(month, year);
                });

                $('#next-month').click(function() {
                    if (month === 11) {
                        month = 0;
                        year++;
                    } else {
                        month++;
                    }
                    loadReminders(month, year);
                });

                $(document).on('click', '.day', function() {
                    $('#modal-overlay-calendario, #modal-calendario').addClass('active');
                    const date = $(this).data('date');
                    const dayNumber = $(this).find('.day-number').text();
                    $('#reminder-date-calendario').val(date);
                    $('#selected-day').text(dayNumber);

                    $.ajax({
                        url: 'php/get_reminders.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            date: date,
                            id_user: $('body').data('id-user')
                        },
                        success: function(response) {
                            const remindersContainer = $('#reminder-list-calendario');
                            remindersContainer.empty();
                            response.forEach(reminder => {
                                remindersContainer.append(`<div class="reminder" data-id="${reminder.id}">
                                                ${reminder.text}
                                            </div>`);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Erro ao carregar lembretes:', status, error);
                        }
                    });
                });

                // Modificar o clique na anotação para abrir o pop-up de edição
                $(document).on('click', '.reminder', function(event) {
                    event.stopPropagation();
                    const reminderDiv = $(this);
                    const reminderId = reminderDiv.data('id');
                    const reminderText = reminderDiv.data('text');
                    $('#reminder-id-calendario').val(reminderId);
                    $('#reminder-text-popup-calendario').val(reminderText);
                    $('#modal-overlay-calendario, #modal-calendario').addClass('active');
                });

                $(document).on('click', '.delete-reminder', function(event) {
                    event.stopPropagation();
                    const reminderId = $(this).closest('.reminder').data('id');
                    if (reminderId) {
                        $.ajax({
                            url: 'php/delete_reminder.php',
                            method: 'POST',
                            data: { id: reminderId },
                            success: function(response) {
                                alert('Lembrete excluído com sucesso!');
                                loadReminders(month, year);
                            },
                            error: function(xhr, status, error) {
                                alert('Erro ao excluir o lembrete.');
                                console.error('Erro ao excluir o lembrete:', status, error);
                            }
                        });
                    }
                });

                $('#cancel-button-popup-calendario, #modal-overlay-calendario').click(function() {
                    $('#modal-overlay-calendario, #modal-calendario').removeClass('active');
                    $('#reminder-id-calendario').val('');
                    $('#reminder-text-popup-calendario').val('');
                });

                $('#delete-button-popup-calendario').click(function() {
                    const reminderId = $('#reminder-id-calendario').val();
                    if (reminderId) {
                        $.ajax({
                            url: 'php/delete_reminder.php',
                            method: 'POST',
                            data: { id: reminderId },
                            success: function(response) {
                                alert('Lembrete excluído com sucesso!');
                                $('#modal-overlay-calendario, #modal-calendario').removeClass('active');
                                $('#reminder-id-calendario').val('');
                                $('#reminder-text-popup-calendario').val('');
                                loadReminders(month, year);
                            },
                            error: function(xhr, status, error) {
                                alert('Erro ao excluir o lembrete.');
                                console.error('Erro ao excluir o lembrete:', status, error);
                            }
                        });
                    }
                });

                $('#reminder-form-popup-calendario').submit(function(e) {
                    e.preventDefault();
                    const date = $('#reminder-date-calendario').val();
                    const text = $('#reminder-text-popup-calendario').val();
                    const idUser = $('body').data('id-user');
                    const reminderId = $('#reminder-id-calendario').val();

                    let ajaxUrl = 'php/save_reminder.php';
                    let ajaxData = {
                        date: date,
                        text: text,
                        id_user: idUser
                    };

                    if (reminderId) {
                        ajaxUrl = 'php/update_reminder.php';
                        ajaxData.id = reminderId;
                    }

                    $.ajax({
                        url: ajaxUrl,
                        method: 'POST',
                        data: ajaxData,
                        success: function(response) {
                            alert('Lembrete salvo com sucesso!');
                            $('#modal-overlay-calendario, #modal-calendario').removeClass('active');
                            $('#reminder-id-calendario').val('');
                            $('#reminder-text-popup-calendario').val('');
                            loadReminders(month, year); // Re-render the calendar to show new reminder
                        },
                        error: function(xhr, status, error) {
                            alert('Erro ao salvar o lembrete.');
                            console.error('Erro ao salvar o lembrete:', status, error);
                        }
                    });
                });
            });
        </script>
        <!-- javascript -->
        <script>
            function goBack() {
                window.history.back();
            }
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
    </body>
</html>