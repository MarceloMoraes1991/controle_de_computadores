<?php
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = $_POST["server"];
    $port = $_POST["port"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Tentar conectar ao servidor FTP
    $ftpConnection = ftp_connect($server, $port);

    // Verifica se a conexão foi bem-sucedida
    if ($ftpConnection) {
        // Tentar fazer o login no servidor FTP
        $loginResult = ftp_login($ftpConnection, $username, $password);

        // Verifica se o login foi bem-sucedido
        if ($loginResult) {
            // Redirecionar para a página com acesso aos arquivos
            header('Location: ftp_files.php');
            exit();
        } else {
            // Caso o login falhe, exiba uma mensagem de erro e redirecione de volta à página de login
            echo "<script>alert('Usuário ou senha inválidos. Tente novamente.');</script>";
            header('Location: ftp.php');
            exit();
        }
    } else {
        // Caso a conexão falhe, exiba uma mensagem de erro e redirecione de volta à página de login
        echo "<script>alert('Falha ao conectar ao servidor FTP. Verifique as configurações e tente novamente.');</script>";
        header('Location: ftp.php');
        exit();
    }
} else {
    // Caso não tenha sido enviado via POST, redirecione de volta à página de login
    header('Location: ftp.php');
    exit();
}
?>
