<?php
// Inclua o arquivo de conexão com o banco de dados
require_once("conexao.php");
session_start();

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nomeFuncionario = $_POST["nome_funcionario"];
    $cpf = $_POST["cpf"];
    $equipamento = $_POST["equipamento"];
    $modelo = $_POST["modelo"];
    $sn = $_POST["sn"];
    $descricao = $_POST["descricao"];

    // Prepare a consulta SQL para inserção dos dados
    $sql = "INSERT INTO controle_equipamentos (nome_funcionario, cpf, equipamento, modelo, sn, descricao) VALUES (?, ?, ?, ?, ?, ?)";
    echo $sql;
$resultado = mysqli_query($con, $sql);

if($resultado == true){
    header("Location:../home.php");
}
}