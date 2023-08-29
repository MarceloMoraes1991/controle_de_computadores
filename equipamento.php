<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupere os dados do formulário
        $nomeFuncionario = $_POST["nome_funcionario"];
        $cpf = $_POST["cpf"];
        $equipamento = $_POST["equipamento"];
        $modelo = $_POST["modelo"];
        $sn = $_POST["sn"];
        $descricao = $_POST["descricao"];
        
        // Insira os dados no banco de dados
        $sql = "INSERT INTO controle_equipamentos (nome_funcionario, cpf, equipamento, modelo, sn, descricao) VALUES ('$nomeFuncionario', '$cpf', '$equipamento', '$modelo', '$sn', '$descricao')";
        $result = mysqli_query($con, $sql);
        
        // Verifique se a inserção foi bem-sucedida
        if ($result) {
            // Redirecione para a página de listar equipamentos
            header("Location: listar_equipamento.php");
            exit();
        } else {
            echo "Erro ao cadastrar equipamento: " . mysqli_error($con);
        }
    }

    // Recupere a lista de equipamentos do banco de dados
    $sql = "SELECT * FROM controle_equipamentos";
    $result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle de Equipamentos</title>
    <!-- Importe o CSS do Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        header {
            padding: 0 20px;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 800px;
            margin-top: 20px;
        }

        form {
            margin-top: 2rem;
        }

        .input-field label {
            color: #26a69a;
        }

        .input-field input[type="text"]:focus + label,
        .input-field textarea:focus + label {
            color: #26a69a;
        }

        .input-field input[type="text"]:focus,
        .input-field textarea:focus {
            border-bottom: 1px solid #26a69a;
            box-shadow: 0 1px 0 0 #26a69a;
        }

        .btn {
            background-color: #26a69a;
        }

        .btn:hover {
            background-color: #2bbbad;
        }
    </style>
</head>
<body>
    <?php  require_once("header.php");?>
    <div class="container">
        <h2 class="center-align">Controle de Equipamentos</h2>
        
        <form action="equipamento.php" method="post">
            <div class="input-field">
                <input type="text" name="nome_funcionario" id="nome_funcionario" required>
                <label for="nome_funcionario">Nome do Funcionário</label>
            </div>
            <div class="input-field">
                <input type="text" name="cpf" id="cpf" required>
                <label for="cpf">CPF</label>
            </div>
            <div class="input-field">
                <input type="text" name="equipamento" id="equipamento" required>
                <label for="equipamento">Equipamento</label>
            </div>
            <div class="input-field">
                <input type="text" name="modelo" id="modelo" required>
                <label for="modelo">Modelo</label>
            </div>
            <div class="input-field">
                <input type="text" name="sn" id="sn" required>
                <label for="sn">Número de Série</label>
            </div>
            <div class="input-field">
                <textarea name="descricao" id="descricao" class="materialize-textarea" required></textarea>
                <label for="descricao">Descrição</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit">Cadastrar Equipamento</button>
        </form>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
