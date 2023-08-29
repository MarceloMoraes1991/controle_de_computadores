<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <!-- Adicione o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h1>Editar Funcionário</h1>

        <?php
        // Verifica se o ID do funcionário foi fornecido na URL
        if (isset($_GET['id'])) {
            $funcionarioId = $_GET['id'];

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

            // Consulta para obter os dados do funcionário
            $sql = "SELECT * FROM funcionarios WHERE id = $funcionarioId";
            $result = $conn->query($sql);

            // Verifica se o funcionário existe
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nome = $row['nome'];
                $cargo = $row['cargo'];
                $departamento = $row['departamento'];

                // Verifica se o formulário foi submetido
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Obtém os novos dados do formulário
                    $novoNome = $_POST["nome"];
                    $novoCargo = $_POST["cargo"];
                    $novoDepartamento = $_POST["departamento"];

                    // Atualiza os dados do funcionário no banco de dados
                    $stmt = $conn->prepare("UPDATE funcionarios SET nome = ?, cargo = ?, departamento = ? WHERE id = ?");
                    $stmt->bind_param("sssi", $novoNome, $novoCargo, $novoDepartamento, $funcionarioId);
                    $stmt->execute();

                    // Verifica se a atualização foi bem-sucedida
                    if ($stmt->affected_rows > 0) {
                        echo '<div class="alert alert-success" role="alert">Funcionário atualizado com sucesso!</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Erro ao atualizar o funcionário. Por favor, tente novamente.</div>';
                    }

                    // Fecha a conexão com o banco de dados
                    $stmt->close();
                }
        ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $funcionarioId; ?>" method="post">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="cargo">Cargo:</label>
                        <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo $cargo; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="departamento">Departamento:</label>
                        <input type="text" class="form-control" id="departamento" name="departamento" value="<?php echo $departamento; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>

        <?php
            } else {
                echo '<div class="alert alert-danger" role="alert">Funcionário não encontrado.</div>';
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
        } else {
            echo '<div class="alert alert-danger" role="alert">ID do funcionário não fornecido.</div>';
        }
        ?>

    </div>

    <!-- Adicione os scripts JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
