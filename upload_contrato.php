<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o arquivo foi enviado sem erros
    if (isset($_FILES["arquivo"]) && $_FILES["arquivo"]["error"] == UPLOAD_ERR_OK) {
        // Dados do contrato
        $titulo = $_POST["titulo"];
        // Caminho onde os arquivos de contrato serão armazenados no servidor
        $pastaContratos = "contrato/";

        // Gera um nome único para o arquivo para evitar conflitos
        $nomeArquivo = uniqid() . "_" . $_FILES["arquivo"]["name"];
        // Move o arquivo para a pasta de contratos
        move_uploaded_file($_FILES["arquivo"]["tmp_name"], $pastaContratos . $nomeArquivo);

        // Salva o caminho do arquivo no banco de dados (você deve adaptar isso à sua estrutura do banco de dados)
        $conexao = new mysqli("192.168.0.105", "root", "652845", "tarefasdiarias");
        $sql = "INSERT INTO contratos (titulo, caminho_arquivo) VALUES ('$titulo', '$pastaContratos$nomeArquivo')";
        $conexao->query($sql);
        $conexao->close();

        // Redireciona para a página de listagem de contratos
        header("Location: listar_contratos.php");
        exit;
    } else {
        echo "Erro ao fazer o upload do arquivo.";
    }
}
?>
