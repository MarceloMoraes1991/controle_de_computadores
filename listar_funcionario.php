<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários</title>
    <!-- Adicione o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        .btn-editar {
            margin-right: 5px;
        }

        .btn-inativar {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h1>Lista de Funcionários</h1>

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

        // Consulta para obter a lista de funcionários
        $sql = "SELECT * FROM funcionarios";
        $result = $conn->query($sql);

        // Verifica se há funcionários na lista
        if ($result->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Nome</th>';
            echo '<th>Cargo</th>';
            echo '<th>Departamento</th>';
            echo '<th>Ações</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                // Obtém os dados do funcionário
                $id = $row['id'];
                $nome = $row['nome'];
                $cargo = $row['cargo'];
                $departamento = $row['departamento'];

                echo '<tr>';
                echo '<td>' . $nome . '</td>';
                echo '<td>' . $cargo . '</td>';
                echo '<td>' . $departamento . '</td>';
                echo '<td>';
                echo '<a href="editar_funcionario.php?id=' . $id . '" class="btn btn-primary btn-editar">Editar</a>';
                echo '<a href="inativar_funcionario.php?id=' . $id . '" class="btn btn-link btn-inativar">Inativar</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-info" role="alert">Nenhum funcionário encontrado.</div>';
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>

    </div>
    <div class="fixed-action-btn">
        <a href="atividade.php" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">add</i></a>
    </div>

    <!-- Adicione os scripts JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
