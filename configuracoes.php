<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações de Backup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select,
        input[type="time"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        h3 {
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Configurações de Backup</h2>

        <form method="POST">
            <label for="tipo_backup">Tipo de Backup:</label>
            <select id="tipo_backup" name="tipo_backup">
                <option value="ftp" <?= $tipoBackup === "ftp" ? "selected" : "" ?>>FTP</option>
                <option value="mega" <?= $tipoBackup === "mega" ? "selected" : "" ?>>Mega.io</option>
            </select>

            <label for="hora_backup">Hora de Execução do Backup:</label>
            <input type="time" id="hora_backup" name="hora_backup" value="<?= $horaBackup ?>" required>

            <label for="dias_manter_backup">Dias para Manter os Backups:</label>
            <input type="number" id="dias_manter_backup" name="dias_manter_backup" value="<?= $diasManterBackup ?>" required>

            <button type="submit">Salvar</button>
        </form>

        <h3>Status de Backup</h3>

        <p>
            <?php
                // Verifica o status de backup
                $ultimoBackup = ""; // Aqui você pode implementar a lógica para obter o último backup realizado
                $statusBackup = $ultimoBackup !== "" ? "Backup realizado em: " . $ultimoBackup : "Nenhum backup realizado";

                echo $statusBackup;
            ?>
        </p>
    </div>
</body>
</html>
