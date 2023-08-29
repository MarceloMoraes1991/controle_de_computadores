<?php
    require_once("bloqueio.php");

    $sql = "SELECT * FROM categoria_tarefa";
    $result_cat = mysqli_query($con, $sql);
    $cod = $_GET['cod'];
    $sql2 = "SELECT * FROM tarefas where cod = $cod";
    $result_tarefas = mysqli_query($con, $sql2);
    $tarefa = mysqli_fetch_array($result_tarefas);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Tarefa</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        h3 {
            margin-bottom: 30px;
        }

        form {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form input[type="text"],
        form input[type="date"],
        form input[type="time"],
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php  require_once("header.php");?>

    <div class="container">
        <h3>Editar Tarefa</h3>
        <form action="db/edit_tarefa.php" method="post">
            <input type="hidden" value="<?=$cod?>" name="cod">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?= $tarefa['titulo']?>">
            <label for="data">Data:</label>
            <input type="date" name="data" id="data" value="<?= $tarefa['data']?>">
            <label for="hora">Inicio:</label>
            <input type="time" name="hora" id="hora" value="<?= $tarefa['hora']?>">
            <label for="hora">Fim:</label>
            <input type="time" name="hora" id="hora" value="<?= $tarefa['hora']?>">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria">
                <?php foreach($result_cat as $dados) { ?>   
                    <option value="<?php echo $dados['cod']?>" <?php if($dados['cod'] == $tarefa['categoria_cod']) echo "selected"?>>
                        <?php echo $dados['nome']?>
                    </option>
                <?php } ?>
            </select>
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10"><?= $tarefa['descricao']?></textarea>
            <button>Salvar</button>
        </form>
    </div>
    <?php require_once "footer.php"; ?>