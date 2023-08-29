<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Funcionário</title>
    <!-- Adicione o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h1>Adicionar Funcionário</h1>

        <?php
        // Verifica se o formulário foi submetido
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            // Obtém os dados do formulário
            $nome = $_POST["nome"];
            $cargo = $_POST["cargo"];
            $departamento = $_POST["departamento"];

            // Prepara e executa a consulta SQL para inserir o novo funcionário
            $stmt = $conn->prepare("INSERT INTO funcionarios (nome, cargo, departamento) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $cargo, $departamento);
            $stmt->execute();

            // Verifica se o funcionário foi adicionado com sucesso
            if ($stmt->affected_rows > 0) {
                echo '<div class="alert alert-success" role="alert">Funcionário adicionado com sucesso!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Erro ao adicionar o funcionário. Por favor, tente novamente.</div>';
            }

            // Fecha a conexão com o banco de dados
            $stmt->close();
            $conn->close();
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" class="form-control" id="cargo" name="cargo" required>
            </div>
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <input type="text" class="form-control" id="departamento" name="departamento" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Funcionário</button>
        </form>
    </div>

    <!-- Adicione os scripts JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
