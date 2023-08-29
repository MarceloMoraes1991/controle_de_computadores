<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o parâmetro "id" foi fornecido na URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Exclua o usuário do banco de dados
        $sql = "DELETE FROM usuario WHERE cod = $id";
        $result = mysqli_query($con, $sql);

        // Verifique se a exclusão foi bem-sucedida
        if ($result) {
            echo "Usuário excluído com sucesso!";
        } else {
            echo "Erro ao excluir usuário: " . mysqli_error($con);
        }
    } else {
        echo "ID do usuário não fornecido.";
        exit;
    }

    // Redirecione de volta à tela de listagem de usuários
    header("Location: lista_usuarios.php");
    exit;
?>
