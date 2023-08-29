<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Cliente</title>
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
        <h1>Adicionar Cliente</h1>

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
            $nomeCompleto = $_POST["nome_completo"];
            $rg = $_POST["rg"];
            $cpf = $_POST["cpf"];
            $endereco = $_POST["endereco"];
            $estado = $_POST["estado"];
            $cep = $_POST["cep"];
            $cidade = $_POST["cidade"];
            $bairro = $_POST["bairro"];
            $referencia = $_POST["referencia"];
            $dataNascimento = $_POST["data_nascimento"];
            $tipoPessoa = $_POST["tipo_pessoa"];
            $nacionalidade = $_POST["nacionalidade"];
            $sexo = $_POST["sexo"];
            $telefoneResidencial = $_POST["telefone_residencial"];
            $telefoneCelular = $_POST["telefone_celular"];
            $whatsapp = $_POST["whatsapp"];
            $financeiro = $_POST["financeiro"];
            $atendimento = $_POST["atendimento"];
            $agenda = $_POST["agenda"];
            $arquivos = $_POST["arquivos"];
            $observacoes = $_POST["observacoes"];

            // Prepara e executa a consulta SQL para inserir o novo cliente
            $stmt = $conn->prepare("INSERT INTO clientes (nome_completo, rg, cpf, endereco, estado, cep, cidade, bairro, referencia, data_nascimento, tipo_pessoa, nacionalidade, sexo, telefone_residencial, telefone_celular, whatsapp, financeiro, atendimento, agenda, arquivos, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssssssssssss", $nomeCompleto, $rg, $cpf, $endereco, $estado, $cep, $cidade, $bairro, $referencia, $dataNascimento, $tipoPessoa, $nacionalidade, $sexo, $telefoneResidencial, $telefoneCelular, $whatsapp, $financeiro, $atendimento, $agenda, $arquivos, $observacoes);
            $stmt->execute();

            // Verifica se o cliente foi adicionado com sucesso
            if ($stmt->affected_rows > 0) {
                echo '<div class="alert alert-success" role="alert">Cliente adicionado com sucesso!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Erro ao adicionar o cliente. Por favor, tente novamente.</div>';
            }

            // Fecha a conexão com o banco de dados
            $stmt->close();
            $conn->close();
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="nome_completo">Nome Completo:</label>
                <input type="text" class="form-control" id="nome_completo" name="nome_completo" required>
            </div>
            <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" class="form-control" id="rg" name="rg" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" class="form-control" id="endereco" name="endereco">
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado">
            </div>
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep">
            </div>
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade">
            </div>
            <div class="form-group">
                <label for="bairro">Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro">
            </div>
            <div class="form-group">
                <label for="referencia">Referência:</label>
                <input type="text" class="form-control" id="referencia" name="referencia">
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
            </div>
            <div class="form-group">
                <label for="tipo_pessoa">Tipo de Pessoa:</label>
                <input type="text" class="form-control" id="tipo_pessoa" name="tipo_pessoa">
            </div>
            <div class="form-group">
                <label for="nacionalidade">Nacionalidade:</label>
                <input type="text" class="form-control" id="nacionalidade" name="nacionalidade">
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <input type="text" class="form-control" id="sexo" name="sexo">
            </div>
            <div class="form-group">
                <label for="telefone_residencial">Telefone Residencial:</label>
                <input type="text" class="form-control" id="telefone_residencial" name="telefone_residencial">
            </div>
            <div class="form-group">
                <label for="telefone_celular">Telefone Celular:</label>
                <input type="text" class="form-control" id="telefone_celular" name="telefone_celular">
            </div>
            <div class="form-group">
                <label for="whatsapp">WhatsApp:</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp">
            </div>
            <div class="form-group">
                <label for="financeiro">Financeiro:</label>
                <textarea class="form-control" id="financeiro" name="financeiro"></textarea>
            </div>
            <div class="form-group">
                <label for="atendimento">Atendimento:</label>
                <textarea class="form-control" id="atendimento" name="atendimento"></textarea>
            </div>
            <div class="form-group">
                <label for="agenda">Agenda:</label>
                <textarea class="form-control" id="agenda" name="agenda"></textarea>
            </div>
            <div class="form-group">
                <label for="arquivos">Arquivos:</label>
                <textarea class="form-control" id="arquivos" name="arquivos"></textarea>
            </div>
            <div class="form-group">
                <label for="observacoes">Observações:</label>
                <textarea class="form-control" id="observacoes" name="observacoes"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-submit">Adicionar Cliente</button>
        </form>
    </div>

    <!-- Adicione os scripts JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
