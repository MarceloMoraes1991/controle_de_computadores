<?php
    require_once("bloqueio.php");
    $cod = $_SESSION['cod'];
    if(isset($_GET['busca'])){
        $busca = $_GET['busca'];
    }else{
        $busca = '';
    }
   
    if($_SESSION['perfil'] != 1){
        $sql = "SELECT *, t.cod as codt FROM tarefas t where usuario_cod = $cod AND (titulo like '%$busca%' OR descricao like '%$busca%') order by data, hora asc";
    }else{
        $sql = "SELECT *, u.cod as codu, t.cod as codt 
        FROM tarefas t, usuario u 
        where 
        t.usuario_cod = u.cod  AND 
        (titulo like '%$busca%' OR 
        descricao like '%$busca%' OR 
        u.nome like '%$busca%') 
        order by data, hora asc";
    }
    $result_tarefas = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tarefas Diárias</title>
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/materialize/css/materialize.min.css">
</head>
<body>
<script src="assets/jquery-3.4.1.min.js"></script>
<script src="assets/materialize/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var sidenav = document.querySelectorAll('.sidenav');
        M.Sidenav.init(sidenav);
    });
</script>
    <ul id="slide-out" class="sidenav">
        <li>
            <div class="user-view">
                <div class="background indigo darken-4"></div>
                <a href="#name"><span class="white-text name">Olá, <?= $_SESSION['nome']?></span></a>
            </div>
        </li>
        <li><a href="cadastro_tarefa.php"><i class="material-icons">dash</i>Dashboard</a></li>
        <li><a href="listar_equipamento.php"><i class="material-icons">equ</i>Equipamentos</a></li>
        <li><a href="home.php"><i class="material-icons">dehaze</i>Tarefas</a></li>
        <li><a href="chips.php"><i class="material-icons">person_add</i>Operadoras</a></li>
        <li><a href="lista_usuarios.php"><i class="material-icons">list_add</i>Usuário</a></li>
        <li><a href="Listar_contratos.php"><i class="material-icons">file</i>Arquivos</a></li>
        <li><a href="visualizar_atividade.php"><i class="material-icons">task_add</i>Atividade</a></li>
        <li><a href="db/sair.php"><i class="material-icons">exit_to_app</i>Sair</a></li>
    </ul>

    <header>
    <?php $cor = ($_SESSION['perfil'] != 1) ? 'blue' : 'indigo'; ?>
    <nav class="<?=$cor?>">
        <div class="nav-wrapper">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <a href="dashboard.php" class="brand-logo">
                <img src="img/amo2.png" alt="AMO INTERNET Logo">
            </a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="listar_equipamento.php">Equipamentos</a></li>
                <li><a href="home.php">Tarefas</a></li>
                <li><a href="chips.php">Operadoras</a></li>
                <li><a href="lista_usuarios.php">Usuarios</a></li>
                <li><a href="listar_contratos.php">Arquivos</a></li>
                <li><a href="visualizar_atividade.php">Atividade</a></li>
                <li><a href="db/sair.php">Sair</a></li>
                <li><a>Olá, <?= $_SESSION['nome']?></a></li>
            </ul>
        </div>
    </nav>
</header>

</body>
</html>
