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

        // Verifique se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recupere os dados atualizados do formulário
            $titulo = $_POST["titulo"];
            $abertoPor = $_POST["aberto_por"];
            $observacao = $_POST["observacao"];
            $fomentar = $_POST["fomentar"];

            // Atualize os dados no banco de dados
            $sql = "UPDATE atividades SET titulo = '$titulo', aberto_por = '$abertoPor', observacao = '$observacao', fomentar = '$fomentar' WHERE id = $id";
            $result = mysqli_query($con, $sql);

            // Verifique se a atualização foi bem-sucedida
            if ($result) {
                // Redirecione para a página de Visualizar Atividade
                header("Location: visualizar_atividade.php");
                exit();
            } else {
                echo "Erro ao atualizar atividade: " . mysqli_error($con);
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
    <title>Editar Atividade</title>
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

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
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
        <h1>Editar Atividade</h1>

        <form action="editar_atividades.php?id=<?= $id ?>" method="post">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value="<?= $atividade['titulo'] ?>" required>
            </div>
            <div class="form-group">
                <label for="aberto_por">Aberto por:</label>
                <input type="text" name="aberto_por" id="aberto_por" value="<?= $atividade['aberto_por'] ?>" required>
            </div>
            <div class="form-group">
                <label for="observacao">Observação:</label>
                <textarea name="observacao" id="observacao" required><?= $atividade['observacao'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="fomentar">Fomentar:</label>
                <input type="text" name="fomentar" id="fomentar" value="<?= $atividade['fomentar'] ?>" required>
            </div>
            <div class="button-container">
                <button type="submit">Salvar</button>
                <a href="visualizar_atividade.php" class="btn waves-effect waves-light">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>
