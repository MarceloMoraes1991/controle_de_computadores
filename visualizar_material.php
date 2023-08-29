<?php
    // Inclua o arquivo de conexão com o banco de dados
    require_once("db/conexao.php");

    // Verifique se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupere os dados do formulário
        $nomeFuncionario = $_POST["nome_funcionario"];
        $cpf = $_POST["cpf"];
        $equipamento = $_POST["equipamento"];
        $modelo = $_POST["modelo"];
        $sn = $_POST["sn"];
        $fabricante = $_POST["fabricante"];
        $mtm = $_POST["mtm"];
        $mo = $_POST["mo"];
        $descricao = $_POST["descricao"];
        
        // Insira os dados no banco de dados
        $sql = "INSERT INTO material (nome_funcionario, cpf, equipamento, modelo, sn, fabricante, mtm, mo, descricao) VALUES ('$nomeFuncionario', '$cpf', '$equipamento', '$modelo', '$sn', '$fabricante', '$mtm', '$mo', '$descricao')";
        $result = mysqli_query($con, $sql);
        
        
        // Verifique se a inserção foi bem-sucedida
        if ($result) {
            // Verifique se o arquivo foi enviado com sucesso
            if (isset($_FILES['anexo']) && $_FILES['anexo']['error'] === UPLOAD_ERR_OK) {
                // Defina a pasta onde o arquivo será armazenado (certifique-se de que a pasta exista e tenha as permissões corretas)
                $diretorio_anexos = "equipamentos/"; // Substitua "pasta_anexos" pelo caminho da pasta que você deseja salvar os anexos.

                // Gere um nome único para o arquivo (para evitar conflitos de nomes)
                $nome_anexo = uniqid() . "_" . $_FILES['anexo']['name'];

                // Mova o arquivo temporário para a pasta de anexos
                if (move_uploaded_file($_FILES['anexo']['tmp_name'], $diretorio_anexos . $nome_anexo)) {
                    // O arquivo foi carregado com sucesso, você pode armazenar o nome do arquivo no banco de dados para associá-lo ao equipamento.
                    // Por exemplo: $nome_anexo;

                    // Redirecione para a página de listar equipamentos
                    header("Location: visualizar_material.php");
                    exit();
                } else {
                    echo "Erro ao carregar o anexo.";
                }
            } else {
                // Redirecione para a página de listar equipamentos
                header("Location: visualizar_material.php");
                exit();
            }
        } else {
            echo "Erro ao cadastrar equipamento: " . mysqli_error($con);
        }
    }

    // Defina o número de registros por página
    $registrosPorPagina = 15;

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
        $sql = "SELECT * FROM material WHERE nome_funcionario LIKE '%$search%' OR cpf LIKE '%$search%' OR equipamento LIKE '%$search%' OR modelo LIKE '%$search%' OR sn LIKE '%$search%' OR descricao LIKE '%$search%' LIMIT $offset, $registrosPorPagina";
    } else {
        // Consulta SQL original com LIMIT para selecionar apenas os dados da página atual
        $sql = "SELECT * FROM material LIMIT $offset, $registrosPorPagina";
    }

    $result = mysqli_query($con, $sql);

    // Recupere o total de registros para calcular o número total de páginas
    $totalRegistrosQuery = mysqli_query($con, "SELECT COUNT(*) AS total FROM material");
    $totalRegistrosArray = mysqli_fetch_assoc($totalRegistrosQuery);
    $totalRegistros = $totalRegistrosArray['total'];
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle de Equipamentos</title>
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
            margin-top: 20px;
        }

        form {
            margin-top: 2rem;
        }

        .input-field label {
            color: #26a69a;
        }

        .input-field input[type="text"]:focus + label,
        .input-field textarea:focus + label {
            color: #26a69a;
        }

        .input-field input[type="text"]:focus,
        .input-field textarea:focus {
            border-bottom: 1px solid #26a69a;
            box-shadow: 0 1px 0 0 #26a69a;
        }

        .btn {
            background-color: #26a69a;
        }

        .btn:hover {
            background-color: #2bbbad;
        }

        .search-container {
            display: flex;
            align-items: center;
            justify-content: center; /* Centraliza a caixa de pesquisa horizontalmente */
            margin-bottom: 20px;
        }

        .search-container .search-box {
            width: 50%; /* Defina a largura desejada */
            margin-right: 10px;
        }

        .search-container .btn-floating {
            /* margin-right: 10px; Removido */
        }

        /* Estilo da caixa de pesquisa */
        .search-container .search-box input[type="text"] {
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 10px;
            width: 100%;
        }

        /* Estilo do botão de pesquisa */
        .search-container .search-box button[type="submit"] {
            background-color: #26a69a;
            color: #fff;
            border-radius: 20px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Adiciona uma transição suave para a cor de fundo */
        }

        .search-container .search-box button[type="submit"]:hover {
            background-color: #2bbbad;
        }
        /* Efeito de onda (ripple) no botão ao ser clicado */
        .search-container .search-box button[type="submit"].waves-effect {
            position: relative;
            overflow: hidden;
        }
        .search-container .search-box button[type="submit"].waves-effect:after {
            content: "";
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.7);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1);
            transform-origin: 50% 50%;
        }
        .search-container .search-box button[type="submit"].waves-effect.waves-light:after {
            background: rgba(255, 255, 255, 0.7);
        }
        

        /* Centraliza a paginação horizontalmente */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php  require_once("header.php");?>
    <div class="container">
        <h2 class="center-align">Listar Equipamentos</h2>
    </div>

    <form method="GET" action="visualizar_material.php" class="search-container">
        <div class="search-box">
            <input type="text" name="search" id="search" placeholder="Pesquisar...">
        </div>
        <button type="submit" class="waves-light">
            <i class="material-icons">search</i> <!-- Ícone de lupa -->
            
        </button>
    </form>

<!-- Restante do código PHP e HTML -->
<div class="row">
    <div class="col s12">
        <h4></h4>
        <table class="striped">
            <thead>
                <tr>
                    <th class="center-align">Nome do funcionario</th>
                    <th class="center-align">CPF</th>
                    <th>Fabricante</th>
                    <th>Equipamento</th>
                    <th>Modelo</th>
                    <th class="center-align">SN</th>
                    <th>MTM</th>
                    <th>MO</th>
                    <th class="center-align">Descrição</th>
                    <th>Arquivo Anexo</th> <!-- Novo cabeçalho da coluna de anexo -->
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="center-align"><?= $row['nome_funcionario'] ?></td>
                        <td class="center-align"><?= $row['cpf'] ?></td>
                        <td><?= $row['fabricante'] ?></td>
                        <td><?= $row['equipamento'] ?></td>
                        <td><?= $row['modelo'] ?></td>
                        <td class="center-align"><?= $row['sn'] ?></td>
                        <td><?= $row['mtm'] ?></td>
                        <td><?= $row['mo'] ?></td>
                        <td class="center-align"><?= $row['descricao'] ?></td>
                       

                        <td>
                                <?php if ($row['anexo'] !== null) { ?>
                                    <!-- Exibir o nome do arquivo anexo -->
                                    <?= $row['anexo'] ?>
                                    <!-- Botão para visualizar o arquivo anexo -->
                                    <a href="equipamentos/<?= $row['anexo'] ?>" target="_blank" class="btn-small waves-effect waves-light">Visualizar</a>
                                    <!-- Botão para baixar o arquivo anexo -->
                                    <a href="equipamentos/<?= $row['anexo'] ?>" download class="btn-small waves-effect waves-light">Baixar</a>
                                <?php } else { ?>
                                    <span>Nenhum anexo</span>
                                <?php } ?>
                            </td>

                        <td>
                            <a href="editar_equipamento.php?id=<?= $row['id'] ?>" class="btn-small waves-effect waves-light blue">Editar</a>
                            <a href="deletar_equipamento.php?id=<?= $row['id'] ?>" class="btn-small waves-effect waves-light red">Deletar</a>    
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<ul class="pagination">
    <?php
        for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
            echo "<li class='waves-effect ";
            echo ($pagina == $paginaAtual) ? 'active' : '';
            echo "'><a href='visualizar_material.php?pagina=$pagina'>$pagina</a></li>";
        }
    ?>
</ul>

<!-- Resto do código HTML e JavaScript -->
<!-- Importe o JavaScript do Materialize -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        M.Sidenav.init(elems);
    });

    document.getElementById('search-btn').addEventListener('click', function() {
        var input = document.getElementById('search');
        var filter = input.value.toLowerCase();
        var table = document.querySelector('table');
        var tr = table.getElementsByTagName('tr');

        for (var i = 0; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName('td');
            var match = false;

            for (var j = 0; j < td.length; j++) {
                var cell = td[j];

                if (cell) {
                    var value = cell.textContent || cell.innerText;
                    if (value.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }

            tr[i].style.display = match ? '' : 'none';
        }
    });
</script>

<div class="fixed-action-btn">
    <a href="cadastro_material.php" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">add</i></a>
</div>
</body>
</html>
