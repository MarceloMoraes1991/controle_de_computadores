<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o parâmetro "id" foi fornecido na URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Recupere os dados do usuário pelo ID
        $sql = "SELECT * FROM usuario WHERE cod = $id";
        $result = mysqli_query($con, $sql);
        $usuario = mysqli_fetch_assoc($result);

        // Verifique se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recupere os dados atualizados do formulário
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $perfil = $_POST["perfil_cod"];

            // Atualize os dados no banco de dados
            $sql = "UPDATE usuario SET nome = '$nome', email = '$email', perfil_cod = '$perfil' WHERE cod = $id";
            $result = mysqli_query($con, $sql);

            // Verifique se a atualização foi bem-sucedida
            if ($result) {
                // Redirecione para a página de listar Usuarios
                header("Location: lista_usuarios.php");
                exit();
            } else {
                echo "Erro ao atualizar usuario: " . mysqli_error($con);
            }
        }
    } else {
        echo "ID do usuário não fornecido.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Usuário</title>
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
        <h2 class="center-align">Editar Usuário</h2>

        <form action="editar_usuario.php?id=<?= $id ?>" method="post">
            <div class="input-field">
                <input type="text" name="nome" id="nome" value="<?= $usuario['nome'] ?>" required>
                <label for="nome">Nome</label>
            </div>
            <div class="input-field">
                <input type="text" name="email" id="email" value="<?= $usuario['email'] ?>" required>
                <label for="email">Email</label>
            </div>
            <div class="input-field">
                <input type="text" name="perfil_cod" id="perfil_cod" value="<?= $usuario['perfil_cod'] ?>" required>
                <label for="perfil_cod">Perfil</label>
            </div>
            <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit">Salvar</button>
                <a class="btn waves-effect waves-light" href="lista_usuarios.php">Voltar</a>
            </div>
        </form>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
