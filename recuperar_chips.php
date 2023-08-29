<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o ID do chip foi passado pela URL
    if (isset($_GET["id"])) {
        $chipId = $_GET["id"];

        // Recupere os dados do chip arquivado do banco de dados
        $sql = "SELECT * FROM chips_arquivados WHERE id = $chipId";
        $result = mysqli_query($con, $sql);
        $chip = mysqli_fetch_assoc($result);

        // Verifique se o chip existe no banco de dados
        if (!$chip) {
            // Redirecione para a página de listar chips arquivados se o chip não for encontrado
            header("Location: chips_arquivados.php");
            exit();
        }

        // Verifique se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Insira os dados recuperados na tabela de chips ativos
            $nome = $chip["nome"];
            $numero = $chip["numero"];
            $qrcode = $chip["qrcode"];
            $operadora = $chip["operadora"];

            $sql = "INSERT INTO chips (nome, numero, qrcode, operadora) VALUES ('$nome', '$numero', '$qrcode', '$operadora')";
            $result = mysqli_query($con, $sql);

            // Verifique se a inserção foi bem-sucedida
            if ($result) {
                // Exclua o chip arquivado da tabela de chips arquivados
                $sql = "DELETE FROM chips_arquivados WHERE id = $chipId";
                $result = mysqli_query($con, $sql);

                // Verifique se a exclusão foi bem-sucedida
                if ($result) {
                    // Redirecione para a página de chips arquivados
                    header("Location: chips_arquivados.php");
                    exit();
                } else {
                    echo "Erro ao excluir o chip arquivado: " . mysqli_error($con);
                }
            } else {
                echo "Erro ao recuperar o chip: " . mysqli_error($con);
            }
        }
    } else {
        // Redirecione para a página de listar chips arquivados se o ID não for fornecido
        header("Location: chips_arquivados.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Chip</title>
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
        <h2 class="center-align">Recuperar Chip</h2>

        <form action="recuperar_chips.php?id=<?= $chip['id'] ?>" method="post">
            <div class="input-field">
                <input type="text" name="numero" id="numero" value="<?= $chip['numero'] ?>" disabled>
                <label for="numero">Número</label>
            </div>
            <div class="input-field">
                <input type="text" name="qrcode" id="qrcode" value="<?= $chip['qrcode'] ?>" disabled>
                <label for="qrcode">QR Code</label>
            </div>
            <div class="input-field">
                <input type="text" name="operadora" id="operadora" value="<?= $chip['operadora'] ?>" disabled>
                <label for="operadora">Operadora</label>
            </div>
            <div class="input-field">
                <input type="text" name="nome" id="nome" value="<?= $chip['nome'] ?>" disabled>
                <label for="nome">Nome</label>
            </div>
            <div class="actions">
                <a href="chips_arquivados.php" class="btn waves-effect waves-light">Voltar</a>
                <button class="btn waves-effect waves-light" type="submit">Recuperar</button>
            </div>
        </form>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
