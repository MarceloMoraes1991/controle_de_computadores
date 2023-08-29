<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Equipamento e Gerar Termo</title>
</head>
<body>
    <h1>Adicionar Equipamento e Gerar Termo de Responsabilidade</h1>

    <!-- Formulário para adicionar o equipamento -->
    <form action="adicionar_equipamento.php" method="post">
        <!-- Campos do formulário para adicionar o equipamento -->
        <!-- ... (campos do formulário) ... -->
        <input type="submit" value="Adicionar Equipamento">
    </form>

    <?php
require_once('tcpdf/tcpdf.php');

// Função para gerar o PDF com o termo de responsabilidade
function gerarTermoResponsabilidade($equipamentoNome, $funcionarioNome, $dataPegar) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    
    // Conteúdo do termo de responsabilidade
    $conteudo = "TERMO DE RESPONSABILIDADE\n\n";
    $conteudo .= "Eu, $funcionarioNome, declaro que recebi o equipamento $equipamentoNome em $dataPegar.\n\n";
    // Mais conteúdo do termo, se necessário...

    // Adicione o conteúdo ao PDF
    $pdf->SetFont('times', '', 12);
    $pdf->MultiCell(0, 10, $conteudo);

    // Salve o PDF em um arquivo (ou faça o download, conforme sua necessidade)
    $pdf->Output('termo_responsabilidade.pdf', 'F');
}

// Exemplo de como chamar a função para gerar o termo
$equipamentoNome = "Nome do Equipamento";
$funcionarioNome = "Nome do Funcionário";
$dataPegar = "01/08/2023";
gerarTermoResponsabilidade($equipamentoNome, $funcionarioNome, $dataPegar);
?>


    <!-- Botão de impressão -->
    <a href="termo_responsabilidade.pdf" target="_blank">
        <button>Imprimir Termo de Responsabilidade</button>
    </a>

    <!-- Botão de impressão -->
<a href="ftp://seu-servidor.com/caminho-para-o-termo/termo_responsabilidade.pdf" target="_blank">
    <button>Imprimir Termo de Responsabilidade</button>
</a>

</body>
</html>
