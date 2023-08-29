<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o parâmetro "id" foi fornecido na URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Recupere os dados da atividade pelo ID
        $sql = "SELECT * FROM atividades WHERE id = $id";
        $result = mysqli_query($con, $sql);
        $atividade = mysqli_fetch_assoc($result);

        // Verifique se a atividade já está fechada
        if ($atividade['fechada']) {
            echo "Esta atividade já está fechada.";
            exit;
        }

        // Verifique se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Marque a atividade como fechada no banco de dados
            $sql = "UPDATE atividades SET fechada = 1 WHERE id = $id";
            $result = mysqli_query($con, $sql);

            // Verifique se a atualização foi bem-sucedida
            if ($result) {
                echo "Atividade fechada com sucesso!";
            } else {
                echo "Erro ao fechar a atividade: " . mysqli_error($con);
            }
        }
    } else {
        echo "ID da atividade não fornecido.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechar Atividade</title>
    <style>
        /* Estilos aqui */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
        }

        .button-container button {
            padding: 10px 20px;
            margin-left: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h1>Fechar Atividade</h1>

        <p><strong>Título:</strong> <?php echo $atividade['titulo']; ?></p>
        <p><strong>Aberto por:</strong> <?php echo $atividade['aberto_por']; ?></p>
        <p><strong>Observação:</strong> <?php echo $atividade['observacao']; ?></p>
        <p><strong>Fomentar:</strong> <?php echo $atividade['fomentar']; ?></p>

        <div class="button-container">
            <form action="fechar_atividade.php?id=<?= $id ?>" method="post">
                <button type="submit">Fechar Atividade</button>
            </form>
            <a href="visualizar_atividade.php" class="btn waves-effect waves-light">Voltar</a>
        </div>
    </div>
</body>
</html>
