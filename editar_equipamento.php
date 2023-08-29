<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o ID do equipamento foi fornecido
if (isset($_GET["id"])) {
    // Recupere o ID do equipamento
    $id = $_GET["id"];

    // Consulta SQL para recuperar os dados do equipamento
    $sql = "SELECT * FROM controle_equipamentos WHERE id = '$id'";
    $result = mysqli_query($con, $sql);

    // Verifique se a consulta retornou algum resultado
    if (mysqli_num_rows($result) > 0) {
        // Recupere os dados do equipamento
        $equipamento = mysqli_fetch_assoc($result);

        // Verifique se o formulário foi enviado (método POST)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recupere os dados atualizados do formulário
            $nomeFuncionario = $_POST["nome_funcionario"];
            $cpf = $_POST["cpf"];
            $equipamento = $_POST["equipamento"];
            $modelo = $_POST["modelo"];
            $sn = $_POST["sn"];
            $descricao = $_POST["descricao"];

            // Atualize os dados no banco de dados
            $sqlUpdate = "UPDATE controle_equipamentos SET nome_funcionario = '$nomeFuncionario', cpf = '$cpf', equipamento = '$equipamento', modelo = '$modelo', sn = '$sn', descricao = '$descricao' WHERE id = '$id'";
            $resultUpdate = mysqli_query($con, $sqlUpdate);

            // Verifique se a atualização foi bem-sucedida
            if ($resultUpdate) {
                // Redirecione para a página de listagem de equipamentos após a edição bem-sucedida
                header("Location: listar_equipamento.php");
                exit();
            } else {
                echo "Erro ao atualizar equipamento: " . mysqli_error($con);
            }
        }
    } else {
        // Equipamento não encontrado, redirecione ou exiba uma mensagem de erro
        // Por exemplo:
        echo "Equipamento não encontrado.";
    }
} else {
    // ID do equipamento não fornecido, redirecione ou exiba uma mensagem de erro
    // Por exemplo:
    echo "ID do equipamento não fornecido.";
}


?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Equipamento</title>
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
            margin-top: 20px;
        }

        form {
            margin-top: 2rem;
        }

        .input-field label {
            color: #26a69a;
        }

        .input-field input[type="text"]:focus + label,
        .input-field textarea:focus + label {
            color: #26a69a;
        }

        .input-field input[type="text"]:focus,
        .input-field textarea:focus {
            border-bottom: 1px solid #26a69a;
            box-shadow: 0 1px 0 0 #26a69a;
        }

        .btn {
            background-color: #26a69a;
        }

        .btn:hover {
            background-color: #2bbbad;
        }
    </style>
</head>
<body>
    <?php  require_once("header.php");?>
    <div class="container">
        <h2 class="center-align">Editar Equipamento</h2>
        
        <form action="editar_equipamento.php?id=<?= $id ?>" method="post">
            <div class="input-field">
                <input type="text" name="nome_funcionario" id="nome_funcionario" value="<?= $equipamento['nome_funcionario'] ?>" required>
                <label for="nome_funcionario">Nome do Funcionário</label>
            </div>
            <div class="input-field">
                <input type="text" name="cpf" id="cpf" value="<?= $equipamento['cpf'] ?>" required>
                <label for="cpf">CPF</label>
            </div>
            <div class="input-field">
                <input type="text" name="equipamento" id="equipamento" value="<?= $equipamento['equipamento'] ?>" required>
                <label for="equipamento">Equipamento</label>
            </div>
            <div class="input-field">
                <input type="text" name="modelo" id="modelo" value="<?= $equipamento['modelo'] ?>" required>
                <label for="modelo">Modelo</label>
            </div>
            <div class="input-field">
                <input type="text" name="sn" id="sn" value="<?= $equipamento['sn'] ?>" required>
                <label for="sn">Número de Série</label>
            </div>
            <div class="input-field">
                <textarea name="descricao" id="descricao" class="materialize-textarea"><?= $equipamento['descricao'] ?></textarea>
                <label for="descricao">Descrição</label>
            </div>
            <div class="row">
                <div class="col s6">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Salvar
                        <i class="material-icons right">save</i>
                    </button>
                </div>
                <div class="col s6">
                    <a class="btn waves-effect waves-light" href="listar_equipamento.php">Voltar
                        <i class="material-icons right">arrow_back</i>
                    </a>
                </div>
            </div>
        </form>
    </div>
    <?php require_once "footer.php"; ?>
</body>
</html>
