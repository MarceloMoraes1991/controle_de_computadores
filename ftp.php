<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FTP Client</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    .container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #ffffff;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    form {
      display: flex;
      flex-direction: column;
    }
    label {
      font-weight: bold;
      margin-bottom: 5px;
    }
    input[type="text"],
    input[type="number"],
    input[type="password"] {
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }
    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
      border-radius: 3px;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
<?php require_once("header.php"); ?>
  <div class="container">
    <h1>FTP Client</h1>
    <form action="ftp_action.php" method="post">
      <label for="server">Servidor FTP:</label>
      <input type="text" id="server" name="server" required>
      <label for="port">Porta:</label>
      <input type="number" id="port" name="port" required>
      <label for="username">Usuário:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Senha:</label>
      <input type="password" id="password" name="password" required>
      <input type="submit" value="Conectar">
    </form>
  </div>
</body>
</html>
