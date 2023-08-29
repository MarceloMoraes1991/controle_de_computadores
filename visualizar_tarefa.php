<?php
    require_once("bloqueio.php");
    $codu = $_SESSION['cod'];
    $sql = "SELECT * FROM categoria_tarefa";
    $result_cat = mysqli_query($con, $sql);
    $cod = $_GET['cod'];
    if($_SESSION['perfil'] != 1){
        $sql2 = "SELECT *, t.cod as codt FROM tarefas t where usuario_cod = $codu AND cod = $cod";
    }else{
        $sql2 = "SELECT *, u.cod as codu, t.cod as codt FROM tarefas t, usuario u where t.usuario_cod = u.cod AND t.cod = $cod";
    }
    $result_tarefas = mysqli_query($con, $sql2);
    $tarefa = mysqli_fetch_array($result_tarefas);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tarefa - Tarefas Diárias</title>
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/materialize/css/materialize.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            background-color: #f5f5f5;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h3 {
            margin-bottom: 30px;
            color: #333;
        }

        .task-details {
            margin-bottom: 20px;
            color: #555;
        }

        .task-details strong {
            font-weight: bold;
        }

        .task-details span {
            margin-right: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .icon {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <?php  require_once("header.php");?>
    <div class="container">
        <h3>Editar Tarefa</h3>
        <?php if($_SESSION['perfil'] == 1) { ?>
            <div class="task-details">
                <strong>Usuário:</strong> <?= $tarefa['nome'] ?>
            </div>
        <?php } ?>
        <div class="task-details">
            <strong>Título:</strong> <?= $tarefa['titulo'] ?>
        </div>
        <div class="task-details">
            <strong>Data:</strong> <?= date("d/m/Y", strtotime($tarefa['data'])); ?>
        </div>
        <div class="task-details">
            <strong>Hora:</strong> <?= $tarefa['hora'] ?>
        </div>
        <?php 
            $cod_tarefa = $tarefa['categoria_cod'];
            $sql = "SELECT * FROM categoria_tarefa WHERE cod = $cod_tarefa";
            $result_cat = mysqli_query($con, $sql);
            $cat_tarefa = mysqli_fetch_array($result_cat);
        ?>
        <div class="task-details">
            <strong>Categoria:</strong> <?= $cat_tarefa['nome'] ?>
        </div>
        <div class="task-details">
            <strong>Descrição:</strong> <?= $tarefa['descricao'] ?>
        </div>
        
        <div class="row">
            <div class="col s12">
                <a href="editar_tarefa.php?cod=<?= $tarefa['codt'] ?>" class="btn"><i class="material-icons icon">edit</i> Editar</a>
                <?php if ($_SESSION['perfil'] == 1) { ?>
                    <a href="db/excluir_tarefa.php?cod=<?= $tarefa['codt'] ?>" class="btn"><i class="material-icons icon">delete</i> Excluir</a>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- The footer code -->
</body>
</html>

