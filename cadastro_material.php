<?php
// Inclua o arquivo de conexão com o banco de dados
require_once("db/conexao.php");

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nomeFuncionario = $_POST["nome_funcionario"];
    $cpf = $_POST["cpf"];
    $equipamento = $_POST["equipamento"];
    $modelo = $_POST["modelo"];
    $sn = $_POST["sn"];
    $fabricante = $_POST["fabricante"];
    $mtm = $_POST["mtm"];
    $mo = $_POST["MO"] ?? ''; // Corrigido o nome da variável para "MO"
    $descricao = $_POST["descricao"];

    // Use prepared statements para evitar injeção de SQL
    $stmt = $con->prepare("INSERT INTO material (nome_funcionario, cpf, equipamento, modelo, sn, fabricante, mtm, mo, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $nomeFuncionario, $cpf, $equipamento, $modelo, $sn, $fabricante, $mtm, $mo, $descricao);

    // Execute a inserção no banco de dados
    if ($stmt->execute()) {
        // Verifique se o arquivo foi enviado com sucesso
        if (isset($_FILES['anexo']) && $_FILES['anexo']['error'] === UPLOAD_ERR_OK) {
            // Defina a pasta onde o arquivo será armazenado (certifique-se de que a pasta exista e tenha as permissões corretas)
            $diretorio_anexos = "equipamentos/"; // Substitua "pasta_anexos" pelo caminho da pasta que você deseja salvar os anexos.

            // Gere um nome único para o arquivo (para evitar conflitos de nomes)
            $nome_anexo = uniqid() . "_" . $_FILES['anexo']['name'];

            // Mova o arquivo temporário para a pasta de anexos
            if (move_uploaded_file($_FILES['anexo']['tmp_name'], $diretorio_anexos . $nome_anexo)) {
                // O arquivo foi carregado com sucesso, você pode armazenar o nome do arquivo no banco de dados para associá-lo ao equipamento.
                // Por exemplo: $nome_anexo;

                // Redirecione para a página de listar equipamentos
                header("Location: visualizar_material.php");
                exit();
            } else {
                echo "Erro ao carregar o anexo.";
            }
        } else {
            // Redirecione para a página de listar equipamentos
            header("Location: visualizar_material.php");
            exit();
        }
    } else {
        echo "Erro ao cadastrar equipamento: " . $stmt->error;
    }

    // Feche o statement
    $stmt->close();
}

// Resto do código HTML...
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Equipamentos</title>
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
    <?php require_once("header.php"); ?>
    <div class="container">
        <h2 class="center-align">Cadastro de Equipamentos</h2>
        
        <form action="cadastro_material.php" method="post" enctype="multipart/form-data">
            <div class="input-field">
                <input type="text" name="nome_funcionario" id="nome_funcionario" required>
                <label for="nome_funcionario">Nome do Funcionário</label>
            </div>
            <div class="input-field">
                <input type="text" name="cpf" id="cpf" required>
                <label for="cpf">CPF</label>
            </div>
            <div class="input-field">
                <input type="text" name="equipamento" id="equipamento" required>
                <label for="equipamento">Equipamento</label>
            </div>
            <div class="input-field">
                <input type="text" name="modelo" id="modelo" required>
                <label for="modelo">Modelo</label>
            </div>
            <div class="input-field">
                <input type="text" name="sn" id="sn" required>
                <label for="sn">Número de Série</label>
            </div>
            <div class="input-field">
                <input type="text" name="fabricante" id="fabricante" required>
                <label for="fabricante">Fabricante</label>
            </div>
            <div class="input-field">
                <input type="text" name="mtm" id="mtm" required>
                <label for="mtm">MTM</label>
            </div>
            <div class="input-field">
                <input type="text" name="MO" id="MO" required>
                <label for="MO">MO</label>
            </div>
            <div class="input-field">
                <textarea name="descricao" id="descricao" class="materialize-textarea" required></textarea>
                <label for="descricao">Descrição</label>
            </div>
            <!-- Novo campo para upload de anexo -->
            <div class="file-field input-field">
                <div class="btn">
                    <span>Anexo</span>
                    <input type="file" name="anexo">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit">Cadastrar Equipamento</button>
        </form>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>

