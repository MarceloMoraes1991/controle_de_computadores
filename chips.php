<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Defina o número de registros por página
    $registrosPorPagina = 20;

    // Verifique a página atual e defina o registro inicial para a consulta no banco de dados
    if (isset($_GET['pagina'])) {
        $paginaAtual = $_GET['pagina'];
    } else {
        $paginaAtual = 1;
    }

    $offset = ($paginaAtual - 1) * $registrosPorPagina;

    // Verifique se o formulário de pesquisa foi submetido
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        // Modifique a consulta SQL para incluir a cláusula WHERE com a pesquisa
        $sql = "SELECT * FROM chips WHERE nome LIKE '%$search%' OR numero LIKE '%$search%' OR qrcode LIKE '%$search%' OR operadora LIKE '%$search%' LIMIT $offset, $registrosPorPagina";
    } else {
        // Consulta SQL original com LIMIT para selecionar apenas os dados da página atual
        $sql = "SELECT * FROM chips LIMIT $offset, $registrosPorPagina";
    }

    $result = mysqli_query($con, $sql);

    // Recupere o total de registros para calcular o número total de páginas
    $totalRegistrosQuery = mysqli_query($con, "SELECT COUNT(*) AS total FROM chips");
    $totalRegistrosArray = mysqli_fetch_assoc($totalRegistrosQuery);
    $totalRegistros = $totalRegistrosArray['total'];
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Chips</title>
    <!-- Importe o CSS do Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        header {
            padding: 0 20px;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 800px;
            margin: 20px auto;
        }

        h2 {
            text-align: center;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .actions {
            display: flex;
            justify-content: space-between;
        }

        .btn-small {
            margin-right: 5px;
        }

        .fixed-action-btn {
            position: fixed;
            bottom: 40px;
            right: 40px;
        }

        .btn-search {
            background-color: #26a69a;
            margin-left: 10px;
        }

        .btn-search:hover {
            background-color: #2bbbad;
        }
        /* ... */
        /* Estilização da caixa de pesquisa */
        .search-container {
            position: relative;
            
        }

        .search-container input[type="text"] {
            padding-left: 30px; /* Espaçamento para evitar sobreposição do ícone da lupa */
        }

        .search-container i.prefix {
            position: absolute;
            top: 40%;
            left: 12px;
            transform: translateY(-50%);
            color: #888;
            pointer-events: none;
        }

        /* ... */
        /* Estilização dos links de paginação */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #26a69a;
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #26a69a;
            color: #fff;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h2>Controle de Chips</h2>

        <div class="row">
            <div class="col s12">
                <form method="POST" action="chips_arquivados.php">
                    <button class="btn waves-effect waves-light btn-search" type="submit">
                        Buscar Arquivados
                    </button>
                    <!-- Botão para gerar o relatório de chips -->
                    <a href="gerar_relatorio.php?tipo_relatorio=chips" target="_blank" class="btn waves-effect waves-light">Gerar Relatório de Chips</a>

                </form>
            </div>
        </div>
        <form method="GET" action="chips.php">
            <div class="input-field search-container">
                <input type="text" name="search" id="search" placeholder="Pesquisar...">    
            </div>
            <button type="submit" class="btn waves-effect waves-light btn-search">
                Pesquisar
            </button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Número</th>
                    <th>QR Code</th>
                    <th>Operadora</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['nome'] ?></td>
                        <td><a href="https://wa.me/55<?= $row['numero'] ?>"><?= $row['numero'] ?></a></td>
                        <td><?= $row['qrcode'] ?></td>
                        <td><?= $row['operadora'] ?></td>
                        <td class="actions">
                            <a href="editar_chips.php?id=<?= $row['id'] ?>" class="btn-small waves-effect waves-light blue">Editar</a>
                            <a href="arquivar_chips.php?id=<?= $row['id'] ?>" class="btn-small waves-effect waves-light red">Arquivar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Links de paginação -->
        <ul class="pagination">
            <?php
                for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
                    echo "<li class='waves-effect ";
                    echo ($pagina == $paginaAtual) ? 'active' : '';
                    echo "'><a href='chips.php?pagina=$pagina'>$pagina</a></li>";
                }
            ?>
        </ul>
    <div class="fixed-action-btn">
        <a href="cadastro_chips.php" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">add</i></a>
    </div>
    <script>
        // Função para filtrar os resultados da tabela com base no texto digitado na caixa de pesquisa
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]; // Aqui você pode alterar o índice para filtrar por outras colunas da tabela
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        // Event listener para acionar a função de pesquisa quando o botão de pesquisa for clicado
        document.getElementById("search-btn").addEventListener("click", function() {
            searchTable();
        });

        // Event listener para acionar a função de pesquisa quando uma tecla for pressionada na caixa de pesquisa
        document.getElementById("search").addEventListener("keyup", function() {
            searchTable();
        });
    </script>
    <!-- Importe o JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
