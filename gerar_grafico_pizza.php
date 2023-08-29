<?php
// Inclua o arquivo de conexão com o banco de dados
require_once("db/conexao.php");

// Consulta para obter os dados do gráfico em pizza (exemplo, substitua com sua consulta real)
$sql = "SELECT categoria, quantidade FROM tabela_exemplo";
$resultado = mysqli_query($con, $sql);

// Crie arrays para armazenar os dados do gráfico
$labels = array();
$dados = array();
$cores = array();

// Loop através dos resultados da consulta e armazene os dados nos arrays
while ($row = mysqli_fetch_assoc($resultado)) {
    $labels[] = $row['categoria'];
    $dados[] = $row['quantidade'];
    // Adicione cores aleatórias para os setores do gráfico (opcional)
    $cores[] = "rgba(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ",0.8)";
}

// Crie um array associativo para enviar os dados em formato JSON
$dados_grafico = array(
    'labels' => $labels,
    'dados' => $dados,
    'cores' => $cores
);

// Converta o array em JSON e envie a resposta
header('Content-type: application/json');
echo json_encode($dados_grafico);

// Feche a conexão com o banco de dados
mysqli_close($con);
?>
