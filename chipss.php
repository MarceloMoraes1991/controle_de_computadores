<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se a pesquisa foi enviada
    if (isset($_GET["search"])) {
        // Recupere o valor da pesquisa
        $search = $_GET["search"];
        // Consulta SQL para recuperar as atividades que correspondem à pesquisa
        $sql = "SELECT * FROM atividades WHERE titulo LIKE '%$search%' OR aberto_por LIKE '%$search%' OR observacao LIKE '%$search%' OR fomentar LIKE '%$search%' OR data_criacao LIKE '%$search%'";
    } else {
        // Consulta SQL original para recuperar todas as atividades
        $sql = "SELECT * FROM atividades";
    }

    $result = mysqli_query($con, $sql);

    // Defina o número de atividades a serem exibidas por página
    $registros_por_pagina = 10;
    $pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcule o deslocamento para a consulta SQL
    $offset = ($pagina_atual - 1) * $registros_por_pagina;

    // Consulta SQL para recuperar as atividades de acordo com a pesquisa e a paginação
    if (isset($_GET["search"])) {
        // Recupere o valor da pesquisa
        $search = $_GET["search"];
        // Consulta SQL para recuperar as atividades que correspondem à pesquisa
        $sql = "SELECT * FROM atividades WHERE titulo LIKE '%$search%' OR aberto_por LIKE '%$search%' OR observacao LIKE '%$search%' OR fomentar LIKE '%$search%' OR data_criacao LIKE '%$search%' LIMIT $registros_por_pagina OFFSET $offset";
    } else {
        // Consulta SQL original para recuperar todas as atividades
        $sql = "SELECT * FROM atividades LIMIT $registros_por_pagina OFFSET $offset";
    }

    $result = mysqli_query($con, $sql);

    // Consulta SQL para contar o total de registros
    $sql_contagem = "SELECT COUNT(*) AS total_registros FROM atividades";
    $result_contagem = mysqli_query($con, $sql_contagem);
    $row_contagem = mysqli_fetch_assoc($result_contagem);
    $total_registros = $row_contagem['total_registros'];

    // Calcule o número total de páginas
    $total_paginas = ceil($total_registros / $registros_por_pagina);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Atividades</title>
    <!-- Importe o CSS do Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Importe Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* Estilos personalizados aqui (se necessário) */
        body {
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .atividade {
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
        }

        .atividade h2 {
            margin-top: 0;
            font-size: 24px;
            color: #26a69a;
        }

        .atividade p {
            margin: 0;
            color: #333;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .button-container button {
            margin-left: 10px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            color: #333;
            text-decoration: none;
        }

        .pagination a.active {
            color: #26a69a;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <form method="POST" action="atividades_arquivadas.php">
                    <button class="btn waves-effect waves-light btn-search" type="submit">
                        Buscar Arquivados
                    </button>
                </form>
            </div>
        </div>
        <h1 class="center-align">Lista de Atividades</h1>
        <div class="input-field">
            <!-- Formulário de pesquisa -->
            <form method="GET" action="chipss.php">
                <input type="text" name="search" id="search" placeholder="Pesquisar...">
                <label for="search">Pesquisar</label>
                <button class="btn waves-effect waves-light" type="submit">Buscar</button>
            </form>
        </div>

        <?php
        // Verifique se existem atividades
        if (mysqli_num_rows($result) > 0) {
            // Loop através dos resultados
            while ($row = mysqli_fetch_assoc($result)) {
                // Extraia os valores das colunas
                $id = $row['id'];
                $titulo = $row['titulo'];
                $abertoPor = $row['aberto_por'];
                $observacao = $row['observacao'];
                $fomentar = $row['fomentar'];
                $dataCriacao = $row['data_criacao'];
        ?>
        <div class="atividade">
            <h2><?php echo $titulo; ?></h2>
            <p><strong>Aberto por:</strong> <?php echo $abertoPor; ?></p>
            <p><strong>Observação:</strong> <?php echo $observacao; ?></p>
            <p><strong>Fomentar:</strong> <?php echo $fomentar; ?></p>
            <p><strong>Data de Criação:</strong> <?php echo $dataCriacao; ?></p>
            <div class="button-container">
                <button class="btn waves-effect waves-light" onclick="editarAtividade(<?php echo $id; ?>)">Editar</button>
                <button class="btn waves-effect waves-light" onclick="fecharAtividade(<?php echo $id; ?>)">Fechar Chamado</button>
            </div>
        </div>
        <?php
            } // Fim do loop
        } else {
            // Caso não existam atividades
            echo "<p class='center-align'>Nenhuma atividade encontrada.</p>";
        }
        ?>

        <!-- Navegação da paginação -->
        <ul class="pagination">
            <?php
            // Exiba os links de paginação
            for ($i = 1; $i <= $total_paginas; $i++) {
                // Defina a classe "active" para a página atual
                $active_class = ($i == $pagina_atual) ? "active" : "";
                echo "<li class='$active_class'><a href='chipss.php?pagina=$i'>$i</a></li>";
            }
            ?>
        </ul>
    </div>
    <div class="fixed-action-btn">
        <a href="atividade.php" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">add</i></a>
    </div>

    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        function editarAtividade(id) {
            // Redirecione o usuário para a página de edição da atividade
            window.location.href = "editar_atividades.php?id=" + id;
        }

        function fecharAtividade(id) {
            // Redirecione o usuário para a página de fechamento da atividade
            window.location.href = "arquivar_atividade.php?id=" + id;
        }
    </script>
</body>
</html>
