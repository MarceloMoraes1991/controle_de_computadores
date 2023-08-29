<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o formulário de busca foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        // Recupere o termo de busca do formulário
        $searchTerm = $_POST["search"];

        // Consulte o banco de dados para obter as atividades arquivadas correspondentes
        $sql = "SELECT * FROM atividades_arquivadas WHERE titulo LIKE '%$searchTerm%'";
        $result = mysqli_query($con, $sql);
    } else {
        // Consulte o banco de dados para obter todas as atividades arquivadas
        $sql = "SELECT * FROM atividades_arquivadas";
        $result = mysqli_query($con, $sql);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades Arquivadas</title>
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

        .search-container {
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            width: 80%;
            margin-right: 10px;
        }

        .search-container .btn {
            margin-right: 10px;
        }

        table {
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="center-align">Atividades Arquivadas</h2>

        <div class="search-container">
            <form method="POST">
                <input type="text" name="search" placeholder="Pesquisar...">
                <button class="btn" type="submit"><i class="material-icons">search</i></button>
            </form>
        </div>

        <table class="striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Aberto por</th>
                    <th>Observação</th>
                    <th>Fomentar</th>
                    <th>Documentos</th>
                    <th>Data de Criação</th>
                    <th>Data de Encerramento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['titulo']; ?></td>
                        <td><?php echo $row['aberto_por']; ?></td>
                        <td><?php echo $row['observacao']; ?></td>
                        <td><?php echo $row['fomentar']; ?></td>
                        <td><?php echo $row['documentos']; ?></td>
                        <td><?php echo $row['data_criacao']; ?></td>
                        <td><?php echo $row['data_encerramento']; ?></td>
                        <td>
                            <a href="visualizar_atividade.php?id=<?php echo $row['id']; ?>" class="btn">Reativar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
