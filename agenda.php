<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Diária</title>
    <style>
        /* Estilos aqui */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        .form-container {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .form-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container input[type="time"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .agenda-list {
            list-style: none;
            padding: 0;
        }

        .agenda-item {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .agenda-item button {
            background-color: #ff6666;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php require_once("header.php"); ?>
    <!-- Formulário para adicionar serviços à agenda -->
    <div class="container">
        <h1>Agenda Diária</h1>
        <!-- Formulário para adicionar serviços à agenda -->
        <div class="form-container">
            <h3>Adicionar Serviço</h3>
            <form action="adicionar_servico.php" method="post">
                <label for="servico">Serviço:</label>
                <input type="text" name="servico" id="servico" required>

                <label for="usuario">Usuário:</label>
                <select name="usuario" id="usuario" required>
                    <option value="">Selecione um usuário</option>
                    <?php
                    // Consulta SQL para buscar os usuários cadastrados
                    $sql_usuario = "SELECT cod, nome FROM usuario";
                    $result_usuario = mysqli_query($con, $sql_usuario);

                    // Exibe os usuários no campo de seleção
                    while ($row_usuario = mysqli_fetch_assoc($result_usuario)) {
                        echo '<option value="' . $row_usuario["cod"] . '">' . $row_usuario["nome"] . '</option>';
                    }
                    ?>
                </select>

                <label for="data">Data:</label>
                <input type="date" name="data" id="data" required>

                <label for="hora">Hora:</label>
                <input type="time" name="hora" id="hora" required>

                <button type="submit">Adicionar</button>
            </form>
        </div>


        <!-- Lista dos serviços agendados -->
        <h3>Agenda</h3>
        <ul class="agenda-list">
            <?php
            // Consulta SQL para buscar os serviços agendados
            $sql_servicos_agendados = "SELECT servico, usuario, data, hora FROM servicos_agendados";
            $result_servicos_agendados = mysqli_query($con, $sql_servicos_agendados);

            // Verifica se há serviços agendados no banco de dados
            if (mysqli_num_rows($result_servicos_agendados) > 0) {
                // Exibe os serviços agendados na lista
                while ($row = mysqli_fetch_assoc($result_servicos_agendados)) {
                    echo '<li class="agenda-item">' . $row["servico"] . ' - Usuário: ' . $row["usuario"] . ' - Data: ' . $row["data"] . ' - Hora: ' . $row["hora"] . '<button onclick="removerServico(this)">Remover</button></li>';
                }
            } else {
                echo '<li class="agenda-item">Nenhum serviço agendado encontrado.</li>';
            }
            ?>
        </ul>
    </div>

    <script>
        function removerServico(button) {
            // Função para remover o serviço da lista
            button.parentNode.remove();
        }
    </script>
</body>
</html>
