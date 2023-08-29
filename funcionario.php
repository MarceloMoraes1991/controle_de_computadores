<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>
    <!-- Adicione o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-submit {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h1>Funcionários</h1>

        <!-- Lista de funcionários -->
        <div>
            <h2>Lista de Funcionários</h2>
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
                echo '<ul>';
                while ($row = $result->fetch_assoc()) {
                    echo '<li>' . $row['nome'] . '</li>';
                }
                echo '</ul>';
            } else {
                echo 'Nenhum funcionário encontrado.';
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
            ?>
        </div>

        <!-- Formulário para adicionar funcionário -->
        <div>
            <h2>Adicionar Funcionário</h2>
            <form action="processar_funcionario.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="cargo">Cargo:</label>
                    <input type="text" class="form-control" id="cargo" name="cargo">
                </div>
                <div class="form-group">
                    <label for="departamento">Departamento:</label>
                    <input type="text" class="form-control" id="departamento" name="departamento">
                </div>
                <button type="submit" class="btn btn-primary btn-submit">Adicionar Funcionário</button>
            </form>
        </div>
    </div>

    <!-- Adicione os scripts JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
