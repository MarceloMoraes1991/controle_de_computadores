<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Arquivamento de Contratos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f8f9fa;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
            padding-top: 20px;
            background-color: #007bff;
            color: #fff;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<?php require_once("header.php"); ?>
    

    <div class="container mt-4 form-container">
        <div class="page-header">
            <h1>Sistema de Arquivamento de Contratos</h1>
        </div>
        <form action="upload_contrato.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título do Contrato:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="arquivo">Selecione o arquivo de contrato:</label>
                <input type="file" class="form-control-file" id="arquivo" name="arquivo" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar Contrato</button>
        </form>
    </div>
</body>
</html>
