<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $servername = "192.168.0.105";
    $username = "root";
    $password = "652845";
    $dbname = "tarefasdiarias";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se há erro na conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $cargo = $_POST["cargo"];
    $departamento = $_POST["departamento"];

    // Prepara e executa a consulta SQL para inserir o novo funcionário
    $stmt = $conn->prepare("INSERT INTO funcionarios (nome, cargo, departamento) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $cargo, $departamento);
    $stmt->execute();

    // Verifica se o funcionário foi adicionado com sucesso
    if ($stmt->affected_rows > 0) {
        echo 'Funcionário adicionado com sucesso!';
    } else {
        echo 'Erro ao adicionar o funcionário. Por favor, tente novamente.';
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
