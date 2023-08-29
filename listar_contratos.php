<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contratos Arquivados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Importe o CSS do Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php require_once("header.php"); ?>

    <div class="container mt-4">
        <h1>Lista de Contratos Arquivados</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexão com o banco de dados
                $host = "192.168.0.105"; // Endereço do servidor de banco de dados
                $user = "root";      // Usuário do banco de dados
                $password = "652845";    // Senha do banco de dados
                $database = "tarefasdiarias"; // Nome do banco de dados

                $conexao = new mysqli($host, $user, $password, $database);
                if ($conexao->connect_error) {
                    die("Falha na conexão: " . $conexao->connect_error);
                }

                $sql = "SELECT id, titulo, caminho_arquivo FROM contratos";
                $result = $conexao->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $titulo = $row["titulo"];
                        $caminhoArquivo = $row["caminho_arquivo"];
                ?>
                <tr>
                    <td><?php echo $titulo; ?></td>
                    <td>
                        <!-- Botão para visualizar ou baixar o contrato -->
                        <a href="<?php echo $caminhoArquivo; ?>" target="_blank" class="btn btn-success">Visualizar</a>
                        <a href="<?php echo $caminhoArquivo; ?>" download class="btn btn-primary">Baixar</a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='2'>Nenhum contrato arquivado encontrado.</td></tr>";
                }
                $conexao->close();
                ?>
            </tbody>
        </table>

        <!-- Botão de Voltar -->
        <a href="dashboard.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>

    <div class="fixed-action-btn">
        <a href="cad_contrato.php" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">add</i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
