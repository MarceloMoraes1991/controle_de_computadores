<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o ID do chip foi passado pela URL
    if (isset($_GET["id"])) {
        $chipId = $_GET["id"];

        // Verifique se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recupere os dados do formulário
            $numero = $_POST["numero"];
            $qrcode = $_POST["qrcode"];
            $operadora = $_POST["operadora"];
            $nome = $_POST["nome"];

            // Atualize os dados no banco de dados
            $sql = "UPDATE chips SET numero = '$numero', qrcode = '$qrcode', operadora = '$operadora', nome = '$nome' WHERE id = $chipId";
            $result = mysqli_query($con, $sql);

            // Verifique se a atualização foi bem-sucedida
            if ($result) {
                // Redirecione para a página de listar chips
                header("Location: chips.php");
                exit();
            } else {
                echo "Erro ao atualizar chip: " . mysqli_error($con);
            }
        }

        // Recupere os dados do chip do banco de dados
        $sql = "SELECT * FROM chips WHERE id = $chipId";
        $result = mysqli_query($con, $sql);
        $chip = mysqli_fetch_assoc($result);
    } else {
        // Redirecione para a página de listar chips se o ID não for fornecido
        header("Location: chips.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Chip</title>
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

        .actions {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h2 class="center-align">Editar Chip</h2>

        <form action="editar_chips.php?id=<?= $chipId ?>" method="post">
            <div class="input-field">
                <input type="text" name="numero" id="numero" value="<?= $chip['numero'] ?>" required>
                <label for="numero">Número</label>
            </div>
            <div class="input-field">
                <input type="text" name="qrcode" id="qrcode" value="<?= $chip['qrcode'] ?>" required>
                <label for="qrcode">QR Code</label>
            </div>
            <div class="input-field">
                <input type="text" name="operadora" id="operadora" value="<?= $chip['operadora'] ?>" required>
                <label for="operadora">Operadora</label>
            </div>
            <div class="input-field">
                <input type="text" name="nome" id="nome" value="<?= $chip['nome'] ?>" required>
                <label for="nome">Nome</label>
            </div>
            <div class="actions">
                <a href="chips.php" class="btn waves-effect waves-light">Voltar</a>
                <button class="btn waves-effect waves-light" type="submit">Salvar</button>
            </div>
        </form>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
