<?php
if(isset($_GET['erro'])){
    if($_GET['erro'] == 1){
        $erro = "Acesso Negado!";
    }else if($_GET['erro'] == 2){
        $erro = "E-mail ou senha inválidos!";
    }else if($_GET['erro'] == 3){
        $erro = "Logout realizado com sucesso!";
    }
}else{
    $erro = "";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AMO INTERNET</title>
    <link rel="stylesheet" href="assets/materialize/css/materialize.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
            margin-top: 0;
        }

        .input-field {
            margin-bottom: 20px;
        }

        .error {
            color: red;
        }

        .btn {
            width: 100%;
            margin-top: 10px;
            background-color: #4CAF50;
        }

        .divider {
            margin: 20px 0;
        }

        a {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="db/verifica_login.php" method="post">
            <div class="input-field">
                <img src="img/amo.png" width="200" height="80">
            </div>
            
            <div class="input-field">
                <input type="text" name="login" id="login">
                <label for="login">E-mail</label>            
            </div>
            <div class="input-field">
                <input type="password" name="senha" id="senha">
                <label for="senha">Senha</label>   
            </div>
            <div class="input-field">
                <span class="error"><?php echo $erro; ?></span> <br>
                <button class="btn waves-effect waves-light" type="submit">Enviar</button> 
                <div class="divider"></div>
                <a href="cadastre_se.php">Cadastre-se</a>
            </div>
        </form>
    </div>
    <script src="assets/materialize/js/materialize.min.js"></script>
</body>
</html>
