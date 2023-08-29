<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso aos Arquivos FTP</title>
    <!-- Adicione o link para seu arquivo CSS personalizado aqui -->
    <link rel="stylesheet" href="assets/materialize/css/style.css">
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <header>
            <h2>Bem-vindo à página de acesso aos arquivos FTP</h2>
        </header>
        <div class="file-list">
            <h2>Arquivos disponíveis:</h2>
            <ul>
                <li><a href="#">arquivo1.pdf</a></li>
                <li><a href="#">arquivo2.txt</a></li>
                <li><a href="#">arquivo3.jpg</a></li>
                <!-- Adicione aqui os elementos HTML para exibir os arquivos do servidor FTP -->
            </ul>
        </div>
        <div class="logout-btn">
            <a href="logout.php">Sair</a>
        </div>
    </div>
</body>
</html>
