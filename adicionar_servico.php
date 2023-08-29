<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    require_once("db/conexao.php");

    // Recupera os valores enviados pelo formulário
    $servico = $_POST["servico"];
    $usuario = $_POST["usuario"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];

    // Consulta SQL para inserir o serviço na tabela de serviços agendados
    $sql_inserir_servico = "INSERT INTO servicos_agendados (servico, usuario, data, hora) VALUES ('$servico', '$usuario', '$data', '$hora')";
    $result_inserir_servico = mysqli_query($con, $sql_inserir_servico);

    // Verifica se a inserção foi bem-sucedida
    if ($result_inserir_servico) {
        // Redireciona de volta para a página da agenda
        header("Location: agenda.php");
        exit;
    } else {
        // Exibe uma mensagem de erro caso ocorra algum problema na inserção
        echo "Erro ao adicionar o serviço à agenda.";
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($con);
}
?>
