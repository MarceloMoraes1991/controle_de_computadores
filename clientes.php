<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <!-- Adicione o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .tab-content {
            padding: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        .btn-new {
            margin-top: 20px;
        }

        .btn-delete {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h1>Lista de Clientes</h1>

        <?php
        // Conexão com o banco de dados
        $servername = "192.168.0.105";
        $username = "root";
        $password = "652845";
        $dbname = "tarefasdiarias";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica se há erro na conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Consulta para obter a lista de clientes
        $sql = "SELECT * FROM clientes";
        $result = $conn->query($sql);

        // Verifica se há clientes na lista
        if ($result->num_rows > 0) {
            // Cria a estrutura das abas
            echo '<ul class="nav nav-tabs" id="clientTabs">';
            while ($row = $result->fetch_assoc()) {
                // Obtém os dados do cliente
                $id = $row['id'];
                $nomeCompleto = $row['nome_completo'];

                // Cria um identificador único para cada aba
                $tabId = 'tab-' . $id;

                // Cria o link da aba
                echo '<li class="nav-item">';
                echo '<a class="nav-link" id="' . $tabId . '-tab" data-toggle="tab" href="#' . $tabId . '" role="tab" aria-controls="' . $tabId . '" aria-selected="false">' . $nomeCompleto . '</a>';
                echo '</li>';
            }
            echo '</ul>';

            // Cria o conteúdo das abas
            echo '<div class="tab-content" id="clientTabsContent">';
            $result->data_seek(0); // Reinicia o ponteiro do resultado para o início
            while ($row = $result->fetch_assoc()) {
                // Obtém os dados do cliente
                $id = $row['id'];
                $nomeCompleto = $row['nome_completo'];

                // Cria um identificador único para cada aba
                $tabId = 'tab-' . $id;

                // Cria o conteúdo da aba
                echo '<div class="tab-pane fade" id="' . $tabId . '" role="tabpanel" aria-labelledby="' . $tabId . '-tab">';
                // Aqui você pode exibir os campos específicos do cliente
                echo '<h2>' . $nomeCompleto . '</h2>';
                echo '<p>RG: ' . $row['rg'] . '</p>';
                echo '<p>CPF: ' . $row['cpf'] . '</p>';
                // ...

                // Botão Delete
                echo '<a class="btn btn-danger btn-block btn-delete" href="delete_cliente.php?id=' . $id . '">Delete</a>';

                echo '</div>';
            }
            echo '</div>';

            // Botão Novo
            echo '<a class="btn btn-primary btn-block btn-new" href="novo_cliente.php">Novo</a>';
        } else {
            echo 'Nenhum cliente encontrado.';
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
    </div>
    <div class="fixed-action-btn">
        <a href="add_clientes.php" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">add</i></a>
    </div>

    <!-- Adicione os scripts JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
