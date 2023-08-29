<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        .error {
            border: 1px solid red;
        }

        .success {
            border: 1px solid green;
        }

        .back-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #26a69a;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #2bbbad;
}

    </style>
</head>
<body>
    <?php  require_once("header.php");?>

    <form action="db/cad_user.php" method="post">
        Nome:   
        <input type="text" name="nome"> <br>
        E-mail: 
        <input type="email" name="email"> <br>
        Senha: 
        <input type="password" name="senha" id="senha" onkeyup="validaSenha()"> <br>
        Confirmação de Senha: 
        <input type="password" name="senha2" id="senha2" onkeyup="validaSenha()"> <br>
        <button>Cadastrar</button>
    </form>

    <script>
        function validaSenha(){
            $senha = document.getElementById("senha").value;
            $senha2 = document.getElementById("senha2").value;
            if($senha != $senha2){
                document.getElementById("senha2").style.border = "red 1px solid";
            }else{
                document.getElementById("senha2").style.border = "green 1px solid";
            }
        }
    </script>
<?php require_once "footer.php"; ?>