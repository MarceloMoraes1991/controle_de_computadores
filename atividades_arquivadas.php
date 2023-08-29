<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Recupere a lista de atividades arquivadas do banco de dados
    $sql = "SELECT * FROM atividades_arquivadas";
    $result = mysqli_query($con, $sql);
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
            margin: 20px auto;
        }

        h2 {
            text-align: center;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .actions {
            display: flex;
            justify-content: space-between;
        }

        .btn-small {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h2>Atividades Arquivadas</h2>

        <table>
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
                        <td><?= $row['titulo'] ?></td>
                        <td><?= $row['aberto_por'] ?></td>
                        <td><?= $row['observacao'] ?></td>
                        <td><?= $row['fomentar'] ?></td>
                        <td><?= $row['documentos'] ?></td>
                        <td><?= $row['data_criacao'] ?></td>
                        <td><?= $row['data_encerramento'] ?></td>
                        <td class="actions">
                            <a href="editar_atividade.php?id=<?= $row['id'] ?>" class="btn-small waves-effect waves-light blue">Continuar Edição</a>
                            <a href="reativar_atividades.php?id=<?= $row['id'] ?>" class="btn-small waves-effect waves-light green">Reativar</a>
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
