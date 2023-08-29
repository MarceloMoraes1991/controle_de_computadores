<?php
    // Inclua os arquivos necessários e estabeleça uma conexão com o banco de dados
    require_once("bloqueio.php");
    require_once("db/conexao.php");

    // Verifique se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupere os dados do formulário
        $codigo = uniqid(); // Gerar um código único para o chamado
        $titulo = $_POST["titulo"];
        $descricao = $_POST["descricao"];
        $prioridade = $_POST["prioridade"];
        
        // Insira os dados no banco de dados
        $sql = "INSERT INTO atividades_internas (codigo, titulo, descricao, prioridade) VALUES ('$codigo', '$titulo', '$descricao', '$prioridade')";
        $result = mysqli_query($con, $sql);
        
        // Verifique se a inserção foi bem-sucedida
        if ($result) {
            echo "Chamado aberto com sucesso! Código do Chamado: $codigo";
        } else {
            echo "Erro ao abrir chamado: " . mysqli_error($con);
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Abertura de Chamado</title>
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/materialize/css/materialize.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
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
    <div class="container">
        <h2 class="center-align">Abertura de Chamado</h2>
        
        <form action="abertura_chamado.php" method="post">
            <div class="input-field">
                <input type="text" name="titulo" id="titulo" required>
                <label for="titulo">Título do Chamado</label>
            </div>
            <div class="input-field">
                <textarea name="descricao" id="descricao" class="materialize-textarea" required></textarea>
                <label for="descricao">Descrição do Chamado</label>
            </div>
            <div class="input-field">
                <select name="prioridade" id="prioridade" required>
                    <option value="" disabled selected>Selecione a Prioridade</option>
                    <option value="baixa">Baixa</option>
                    <option value="média">Média</option>
                    <option value="alta">Alta</option>
                </select>
                <label for="prioridade">Prioridade</label>
            </div>
            <div class="row">
                <div class="col s6">
                    <button class="btn waves-effect waves-light" type="submit">Abrir Chamado</button>
                </div>
                <div class="col s6">
                    <a href="home.php" class="btn waves-effect waves-light">Voltar à Página Inicial</a>
                </div>
            </div>
        </form>
        
        <h4>Registrar Mensagem</h4>
        <form action="registro_mensagem.php" method="post">
            <input type="hidden" name="codigo_chamado" value="<?= $codigo ?>">
            <div class="input-field">
                <textarea name="mensagem" id="mensagem" class="materialize-textarea" required></textarea>
                <label for="mensagem">Mensagem</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit">Registrar Mensagem</button>
        </form>
    </div>
    
    <!-- Importação dos scripts do Materialize -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/materialize/js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('select').formSelect();
        });
    </script>
</body>
</html>
