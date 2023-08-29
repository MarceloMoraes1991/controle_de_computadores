<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o ID da atividade foi fornecido
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Consulte o banco de dados para obter os detalhes da atividade arquivada
        $sql = "SELECT * FROM atividades_arquivadas WHERE id = $id";
        $result = mysqli_query($con, $sql);

        // Verifique se a consulta foi bem-sucedida
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Recupere os dados da atividade arquivada
            $titulo = $row['titulo'];
            $abertoPor = $row['aberto_por'];
            $observacao = $row['observacao'];
            $fomentar = $row['fomentar'];
            $documentos = $row['documentos'];
            $dataCriacao = $row['data_criacao'];
            $arquivada = $row['arquivada'];

            // Reinsira os dados da atividade arquivada na tabela de atividades
            $insertSql = "INSERT INTO atividades (titulo, aberto_por, observacao, fomentar, documentos, data_criacao) 
                          VALUES ('$titulo', '$abertoPor', '$observacao', '$fomentar', '$documentos', '$dataCriacao')";
            $insertResult = mysqli_query($con, $insertSql);

            // Verifique se a reativação foi bem-sucedida
            if($insertResult) {
                // Exclua a atividade arquivada da tabela de atividades arquivadas
                $deleteSql = "DELETE FROM atividades_arquivadas WHERE id = $id";
                $deleteResult = mysqli_query($con, $deleteSql);

                if($deleteResult) {
                    echo "Atividade reativada com sucesso!";
                } else {
                    echo "Erro ao excluir a atividade arquivada: " . mysqli_error($con);
                }
            } else {
                echo "Erro ao reativar a atividade: " . mysqli_error($con);
            }
        } else {
            echo "Atividade arquivada não encontrada.";
        }
    } else {
        echo "ID da atividade não fornecido.";
    }
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reativar Atividade</title>
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

        .container {
            width: 800px;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
        }

        .card {
            padding: 20px;
        }

        .card-content {
            margin-bottom: 20px;
        }

        .card-action {
            display: flex;
            justify-content: flex-end;
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
        <div class="card">
            <div class="card-content">
                <span class="card-title">Reativar Atividade</span>
                <p>Você está prestes a reativar a seguinte atividade:</p>
                <p><strong>Título:</strong> <?php echo $titulo; ?></p>
                <p><strong>Aberto por:</strong> <?php echo $abertoPor; ?></p>
                <p><strong>Observação:</strong> <?php echo $observacao; ?></p>
                <p><strong>Fomentar:</strong> <?php echo $fomentar; ?></p>
                <p><strong>Documentos:</strong> <?php echo $documentos; ?></p>
                <p><strong>Data de Criação:</strong> <?php echo $dataCriacao; ?></p>
            </div>
            <div class="card-action">
                <a href="atividades_arquivadas.php" class="btn">Cancelar</a>
                <a href="visualizar_atividade.php?id=<?php echo $id; ?>" class="btn">Reativar</a>
            </div>
        </div>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
