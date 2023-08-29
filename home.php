<?php require_once("header.php"); ?>

<main class="container">
    <div id="calendar"></div>
    
    <div class="fixed-action-btn">
        <a href="cadastro_tarefa.php" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">add</i></a>
    </div>
</main>

<?php require_once "footer.php"; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">

<style>
    .fc-toolbar {
        background-color: #f5f5f5;
        border-bottom: 1px solid #ddd;
        padding: 10px;
    }

    .fc-button {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        padding: 6px 12px;
        margin: 0 2px;
        transition: background-color 0.3s ease;
    }

    .fc-button:hover {
        background-color: #45a049;
    }

    .fc-button.active {
        background-color: #45a049;
    }

    .fc-title {
        font-weight: bold;
        color: #333;
    }

    .fc-time {
        color: #777;
    }

    /* Estilos adicionais para melhorar a aparência */
    .container {
        margin-top: 20px;
    }

    .fixed-action-btn {
        position: fixed;
        bottom: 40px;
        right: 40px;
    }
</style>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaDay,agendaWeek,month'
            },
            defaultView: 'agendaDay',
            editable: true,
            events: [
                <?php foreach ($result_tarefas as $tarefa) { ?>
                    {
                        title: '<?= $tarefa['titulo'] ?>',
                        start: '<?= $tarefa['data'] . 'T' . $tarefa['hora'] ?>',
                        url: 'visualizar_tarefa.php?cod=<?= $tarefa['codt'] ?>'
                    },
                <?php } ?>
            ],
            eventClick: function(event) {
                window.location.href = event.url;
                return false;
            }
        });
    });
</script>
