<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o ID do equipamento foi fornecido
    if (isset($_GET["id"])) {
        // Recupere o ID do equipamento
        $id = $_GET["id"];

        // Consulta SQL para excluir o equipamento
        $sql = "DELETE FROM controle_equipamentos WHERE id = '$id'";
        $result = mysqli_query($con, $sql);

        // Verifique se o equipamento foi excluído com sucesso
        if ($result) {
            // Equipamento excluído, redirecione ou exiba uma mensagem de sucesso
            header("Location: listar_equipamento.php");
            exit();
        } else {
            // Erro ao excluir o equipamento, redirecione ou exiba uma mensagem de erro
        }
    } else {
        // ID do equipamento não fornecido, redirecione ou exiba uma mensagem de erro
        echo "ID do equipamento não fornecido.";
    }
?>
