<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupere os dados do formulário
        $titulo = $_POST["titulo"];
        $abertoPor = $_POST["aberto_por"];
        $observacao = $_POST["observacao"];
        $fomentar = $_POST["fomentar"];
        
        // Insira os dados no banco de dados
        $sql = "INSERT INTO atividades (titulo, aberto_por, observacao, fomentar, data_criacao) VALUES ('$titulo', '$abertoPor', '$observacao', '$fomentar', NOW())";
        $result = mysqli_query($con, $sql);
        
        // Verifique se a inserção foi bem-sucedida
        if ($result) {
            // Redirecione para a página de cadastro atividade
            header("Location: visualizar_atividade.php");
            exit();
        } else {
            echo "Erro ao cadastrar atividade: " . mysqli_error($con);
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Atividade</title>
    <!-- Importe o CSS do Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php  require_once("header.php");?>
    <div class="container">
        <h2 class="center-align">Cadastro de Atividade</h2>

        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" name="titulo" id="titulo" required>
                        <label for="titulo">Título</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="aberto_por" id="aberto_por" required>
                        <label for="aberto_por">Aberto Por</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="observacao" id="observacao" class="materialize-textarea" required></textarea>
                        <label for="observacao">Observação</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="fomentar" id="fomentar" class="materialize-textarea" required></textarea>
                        <label for="fomentar">Fomentar</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Anexar</span>
                                <input type="file" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Selecione um ou mais arquivos">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <button class="btn waves-effect waves-light" type="submit">Gravar</button>
                        <a href="visualizar_atividade.php" class="btn waves-effect waves-light red">Fechar</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col s12">
                <a href="visualizar_atividade.php" class="btn waves-effect waves-light">Voltar às Atividades</a>
            </div>
        </div>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
