<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chips Arquivados</title>
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

        .fixed-action-btn {
            position: fixed;
            bottom: 40px;
            right: 40px;
        }

        /* Estilos personalizados para o botão de adicionar */
        .btn-floating.btn-add {
            background-color: #26a69a;
        }

        .btn-floating.btn-add:hover {
            background-color: #2bbbad;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h2>Chips Arquivados</h2>

        <table>
            <thead>
                <tr>
                    <th>Número</th>
                    <th>QR Code</th>
                    <th>Operadora</th>
                    <th>Nome</th>
                    <th>Data de Arquivamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Inclua o arquivo de conexão com o banco de dados
                    require_once("db/conexao.php");

                    // Recupere a lista de chips arquivados do banco de dados
                    $sql = "SELECT * FROM chips_arquivados";
                    $result = mysqli_query($con, $sql);

                    // Verifique se há chips arquivados
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Exiba os detalhes do chip arquivado na tabela
                            echo "<tr>
                                    <td>{$row['numero']}</td>
                                    <td>{$row['qrcode']}</td>
                                    <td>{$row['operadora']}</td>
                                    <td>{$row['nome']}</td>
                                    <td>{$row['data_arquivamento']}</td>
                                    <td class='actions'>
                                        <a href='recuperar_chips.php?id={$row['id']}' class='btn-small waves-effect waves-light green'>Recuperar</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        // Caso não haja chips arquivados
                        echo "<tr>
                                <td colspan='6'>Nenhum chip arquivado encontrado.</td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="fixed-action-btn">
        <a href="cadastro_chips.php" class="btn-floating btn-large waves-effect waves-light btn-add"><i class="material-icons">add_circle</i></a>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
