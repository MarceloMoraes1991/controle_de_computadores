<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listar Usuários</title>
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/materialize/css/materialize.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .btn-container {
            text-align: center;
            margin-bottom: 0px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
            transition: background-color 0.3s ease;
        }

        .grupo {
            text-transform: capitalize;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            width: 80%;
            margin-right: 10px;
        }

        .search-container .btn-floating {
            margin-right: 10px;
        }

    </style>
</head>
<body>
    <?php  require_once("header.php");?>

    <div class="container">
        <!-- The user listing content -->
        <?php
            // Include the necessary files and establish a database connection
            require_once("bloqueio.php");
            require_once("db/conexao.php");

            // Retrieve the user data from the database
            $sql = "SELECT * FROM usuario";
            $result = mysqli_query($con, $sql);

            // Check if any users are found
            if (mysqli_num_rows($result) > 0) {
                // Display the user data
                echo '<h2 class="center-align">Listar Usuários</h2>';
                
                // Search container
                echo '<div class="search-container center-align">';
                echo '<input type="text" id="search" placeholder="Pesquisar..." onkeyup="filterTable()" style="width: 50%;">';
                echo '<a class="btn-floating btn-small waves-effect waves-light" id="search-btn"><i class="material-icons">search</i></a>';
                echo '</div>';
                
                echo '<table class="striped">';
                echo '<thead><tr><th>Name</th><th>Email</th><th>Grupo</th></tr></thead>';
                echo '<tbody>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['nome'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td class="perfil_cod">' . $row['perfil_cod'] . '</td>';
                    echo '<td>';
                    echo '<a href="editar_usuario.php?id=' . $row['cod'] . '" class="btn">Editar</a>';
                    echo '<a href="trocar_senha.php?id=' . $row['cod'] . '" class="btn">Trocar Senha</a>';
                    echo '<a href="excluir_usuario.php?id=' . $row['cod'] . '" class="btn">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody></table>';
            } else {
                echo '<h2 class="center-align">Listar Usuários</h2>';
                echo '<p class="center-align">No registered users found.</p>';
            }

            // Close the database connection
            mysqli_close($con);
        ?>
    </div>
    <div class="fixed-action-btn">
        <a href="cadastro.php" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">add</i></a>
    </div>

    <!-- Import the JavaScript for filtering the table -->
    <script>
        function filterTable() {
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

                if (match) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }

        // Add event listener for search button click
        document.getElementById('search-btn').addEventListener('click', filterTable);
    </script>
    
    <!-- The footer code -->
</body>
</html>
