<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o parâmetro "id" foi fornecido na URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Recupere os dados da atividade a ser arquivada
        $sql = "SELECT * FROM atividades WHERE id = $id";
        $result = mysqli_query($con, $sql);
        
        // Verifique se a consulta retornou algum resultado
        if (mysqli_num_rows($result) > 0) {
            $atividade = mysqli_fetch_assoc($result);

            // Insira os dados na tabela de atividades arquivadas
            $titulo = $atividade['titulo'];
            $abertoPor = $atividade['aberto_por'];
            $observacao = $atividade['observacao'];
            $fomentar = $atividade['fomentar'];
            $dataCriacao = $atividade['data_criacao'];
            $dataEncerramento = date('Y-m-d H:i:s'); // Obtenha a data atual

            $sql = "INSERT INTO atividades_arquivadas (titulo, aberto_por, observacao, fomentar, data_criacao, data_encerramento, arquivada) VALUES ('$titulo', '$abertoPor', '$observacao', '$fomentar', '$dataCriacao', '$dataEncerramento', 1)";
            $result = mysqli_query($con, $sql);

            // Verifique se a inserção foi bem-sucedida
            if ($result) {
                // Exclua a atividade da tabela de atividades
                $sql = "DELETE FROM atividades WHERE id = $id";
                $result = mysqli_query($con, $sql);

                // Verifique se a exclusão foi bem-sucedida
                if ($result) {
                    echo "Atividade arquivada com sucesso!";
                } else {
                    echo "Erro ao excluir a atividade: " . mysqli_error($con);
                }
            } else {
                echo "Erro ao arquivar a atividade: " . mysqli_error($con);
            }
        } else {
            echo "Atividade não encontrada.";
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
    <title>Arquivar Atividade</title>
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
        <h2 class="center-align">Arquivar Atividade</h2>

        <p>Tem certeza de que deseja arquivar a atividade?</p>

        <div class="center-align">
            <a class="btn waves-effect waves-light" href="visualizar_atividade.php">Cancelar</a>
            <a class="btn waves-effect waves-light" href="atividades_arquivadas.php?id=<?= $id ?>">Arquivar</a>
        </div>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
