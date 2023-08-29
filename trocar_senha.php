<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o parâmetro "id" foi fornecido na URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Verifique se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recupere a nova senha do formulário
            $novaSenha = $_POST["nova_senha"];

            // Atualize a senha no banco de dados
            $sql = "UPDATE usuario SET senha = '$novaSenha' WHERE cod = $id";
            $result = mysqli_query($con, $sql);

            // Verifique se a atualização foi bem-sucedida
            if ($result) {
                echo "Senha atualizada com sucesso!";
                header("Location: lista_usuarios.php"); // Redireciona para a página lista_usuarios.php
                exit;
            } else {
                echo "Erro ao atualizar a senha: " . mysqli_error($con);
            }
        }
    }    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trocar Senha</title>
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
    <?php require_once("header.php"); ?>
    <div class="container">
        <h2 class="center-align">Trocar Senha</h2>

        <form action="trocar_senha.php?id=<?= $id ?>" method="post">
            <div class="input-field">
                <input type="password" name="nova_senha" id="nova_senha" required>
                <label for="nova_senha">Nova Senha</label>
            </div>
            <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit">Trocar Senha</button>
                <a class="btn waves-effect waves-light" href="lista_usuarios.php">Voltar</a>
            </div>
        </form>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
