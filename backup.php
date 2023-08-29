<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $backupMethod = $_POST["backupMethod"];

    // Configurações do banco de dados
    $host = "192.168.0.105";
    $dbUsername = "root";
    $dbPassword = "652845";
    $database = "143.208.21.14/tarefasdiarias/";

    // Nome do arquivo de backup
    $backupFileName = "backup_" . date("Y-m-d_H-i-s") . ".sql";

    // Caminho local para salvar o arquivo de backup
    $localBackupPath = "./" . $backupFileName;

    // Comando para realizar o backup do banco de dados
    $command = "mysqldump -h $host -u $dbUsername -p$dbPassword $database > $localBackupPath";

    // Executa o comando de backup
    exec($command);

    if ($backupMethod === "mega") {
        // Configurações do Mega.io
        $megaEmail = "seu_email";
        $megaPassword = "sua_senha";
        $megaDirectory = "/diretorio_mega/";

        // Configurações da API do Mega.io
        require 'MegaApiClient.php';

        // Cria o cliente Mega.io
        $mega = new MegaApiClient();

        // Autenticação no Mega.io
        $mega->login($megaEmail, $megaPassword);

        // Faz o upload do arquivo de backup para o Mega.io
        $mega->upload($localBackupPath, $megaDirectory);

        // Fecha a conexão do Mega.io
        $mega->logout();

        // Exclui o arquivo de backup local após o upload
        unlink($localBackupPath);

        echo "Backup realizado com sucesso usando o Mega.io!";
    } elseif ($backupMethod === "ftp") {
        // Configurações FTP
        $ftpHost = "ftp.exemplo.com";
        $ftpUsername = "seu_usuario_ftp";
        $ftpPassword = "sua_senha_ftp";
        $ftpDirectory = "/diretorio_ftp/";

        // Conexão FTP
        $ftp = ftp_connect($ftpHost);
        ftp_login($ftp, $ftpUsername, $ftpPassword);

        // Faz o upload do arquivo de backup para o servidor FTP
        ftp_put($ftp, $ftpDirectory . $backupFileName, $localBackupPath, FTP_BINARY);

        // Fecha a conexão FTP
        ftp_close($ftp);

        // Exclui o arquivo de backup local após o upload
        unlink($localBackupPath);

        echo "Backup realizado com sucesso usando o FTP!";
    } else {
        echo "Método de backup inválido!";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página de Backup</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .backup-form {
            width: 300px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .backup-form label {
            display: block;
            margin-bottom: 10px;
        }

        .backup-form input[type="text"],
        .backup-form input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .backup-form select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .backup-form button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }

        .backup-form button:hover {
            background-color: #45a049;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Página de Backup</h1>
    </div>

    <div class="backup-form">
        <form action="backup.php" method="post">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <label for="backupMethod">Método de Backup:</label>
            <select id="backupMethod" name="backupMethod">
                <option value="mega">Mega.io</option>
                <option value="ftp">FTP</option>
            </select>

            <button type="submit">Realizar Backup</button>
        </form>
    </div>
</body>
</html>
