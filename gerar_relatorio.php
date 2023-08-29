<?php
// Inclua o arquivo de conexão com o banco de dados
require_once("db/conexao.php");

// Verifique o tipo de relatório solicitado
if (isset($_GET['tipo_relatorio'])) {
    $tipoRelatorio = $_GET['tipo_relatorio'];

    // Lógica para gerar diferentes tipos de relatórios
    switch ($tipoRelatorio) {
        case 'chips':
            gerarRelatorioChips();
            break;
        case 'controle_equipamentos':
            gerarRelatorioEquipamentos();
            break;
        case 'outro_tipo_de_relatorio':
            // Lógica para gerar outro tipo de relatório
            break;
        // Adicione mais casos para outros tipos de relatórios, se necessário
        default:
            echo "Tipo de relatório inválido.";
            break;
    }
} else {
    echo "Tipo de relatório não especificado.";
}

// Função para gerar relatório de chips
function gerarRelatorioChips() {
    global $con;

    $sql = "SELECT * FROM chips";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<h1>Relatório de Chips</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Nome</th><th>Numero</th><th>Operadora</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['nome']}</td>";
            echo "<td>{$row['numero']}</td>";
            echo "<td>{$row['operadora']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Erro ao gerar o relatório de chips: " . mysqli_error($con);
    }
}

// Função para gerar relatório de equipamentos
function gerarRelatorioEquipamentos() {
    global $con;

    $sql = "SELECT * FROM controle_equipamentos";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<h1>Relatório de Equipamentos</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Nome do Funcionario</th><th>CPF</th><th>Equipamento</th><th>Modelo</th><th>SN</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['nome_funcionario']}</td>";
            echo "<td>{$row['cpf']}</td>";
            echo "<td>{$row['equipamento']}</td>";
            echo "<td>{$row['modelo']}</td>";
            echo "<td>{$row['sn']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Erro ao gerar o relatório de equipamentos: " . mysqli_error($con);
    }
}

// Feche a conexão com o banco de dados
mysqli_close($con);
?>
