<?php
require_once("bloqueio.php");

// Conexão com o banco de dados
require_once("db/conexao.php");

// Consulta SQL para buscar as categorias
$sql_categoria = "SELECT cod, nome FROM categoria_tarefa";
$result_categoria = mysqli_query($con, $sql_categoria);

// Consulta SQL para buscar os usuários
$sql_usuario = "SELECT cod, nome FROM usuario";
$result_usuario = mysqli_query($con, $sql_usuario);

// Verifica se a tabela usuario possui registros
if (mysqli_num_rows($result_usuario) === 0) {
    echo "Nenhum usuário cadastrado. Por favor, cadastre usuários antes de adicionar uma tarefa.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de tarefa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }

        h3 {
            color: #333;
            margin-top: 0;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            cursor: pointer;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <form action="db/cad_tarefa.php" method="post">
        <h3>Cadastro de Tarefa</h3>

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo">

        <label for="data">Data:</label>
        <input type="date" name="data" id="data">

        <label for="hora">Hora:</label>
        <input type="time" name="hora" id="hora">

        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria">
            <?php
            // Consulta SQL para buscar as categorias
            $sql_categoria = "SELECT cod, nome FROM categoria_tarefa";
            $result_categoria = mysqli_query($con, $sql_categoria);

            // Exibe as categorias no campo de seleção
            while ($dados = mysqli_fetch_assoc($result_categoria)) {
                echo '<option value="' . $dados['cod'] . '">' . $dados['nome'] . '</option>';
            }
            ?>
        </select>

        <label for="usuario">Usuário:</label>
        <select name="usuario" id="usuario">
            <option value="">Selecione um usuário</option>
            <?php
            // Consulta SQL para buscar os usuários
            $sql_usuario = "SELECT cod, nome FROM usuario";
            $result_usuario = mysqli_query($con, $sql_usuario);

            // Exibe os usuários no campo de seleção
            while ($dados_usuario = mysqli_fetch_assoc($result_usuario)) {
                echo '<option value="' . $dados_usuario['cod'] . '">' . $dados_usuario['nome'] . '</option>';
            }
            ?>
        </select>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" cols="30" rows="10"></textarea>

        <button type="submit">Cadastrar</button>
    </form>

    <?php require_once "footer.php"; ?>
</body>
</html>