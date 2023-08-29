<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");
    // Inclua o arquivo da biblioteca PHPWord
    require_once 'caminho/para/PHPWord/Autoloader.php';
    
    // Verifique se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupere os dados do formulário
        $nomeFuncionario = $_POST["nome_funcionario"];
        $cpf = $_POST["cpf"];
        $equipamento = $_POST["equipamento"];
        $modelo = $_POST["modelo"];
        $sn = $_POST["sn"];
        $descricao = $_POST["descricao"];
        
        // Insira os dados no banco de dados
        $sql = "INSERT INTO controle_equipamentos (nome_funcionario, cpf, equipamento, modelo, sn, descricao) VALUES ('$nomeFuncionario', '$cpf', '$equipamento', '$modelo', '$sn', '$descricao')";
        $result = mysqli_query($con, $sql);
        
        // Verifique se a inserção foi bem-sucedida
        if ($result) {
            echo "Equipamento cadastrado com sucesso!";
            
            // Gerar o termo com as informações do equipamento
            $phpWord = new \PhpOffice\PhpWord\PhpWord();

            // Carregar o modelo do documento do Word
            $template = $phpWord->loadTemplate('caminho/para/modelo.docx');

            // Substituir as variáveis do modelo com as informações do equipamento
            $template->setValue('NOME_FUNCIONARIO', $nomeFuncionario);
            $template->setValue('CPF', $cpf);
            $template->setValue('EQUIPAMENTO', $equipamento);
            $template->setValue('MODELO', $modelo);
            $template->setValue('SN', $sn);
            $template->setValue('DESCRICAO', $descricao);

            // Salvar o documento preenchido
            $outputFile = 'caminho/para/termo_preenchido.docx';
            $template->saveAs($outputFile);
        } else {
            echo "Erro ao cadastrar equipamento: " . mysqli_error($con);
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Equipamentos</title>
    <!-- Importe o CSS do Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* Estilos aqui */
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h2>Formulário de Equipamento</h2>
        
        <form action="gerar_termo.php" method="post">
            <!-- Campos do formulário -->
            <button class="btn waves-effect waves-light" type="submit">Cadastrar Equipamento</button>
        </form>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
