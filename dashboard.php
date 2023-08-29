<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/materialize/css/materialize.min.css">
    <style>
        .status-card {
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #fff;
        }

        .status-card h4 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .status-card p {
            margin: 0;
            font-size: 14px;
        }

        .status-card.green {
            background-color: #4caf50;
        }

        .status-card.orange {
            background-color: #ff9800;
        }

        .status-card.red {
            background-color: #f44336;
        }

        .dashboard-info {
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        .dashboard-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .dashboard-info-item .material-icons {
            margin-right: 20px;
        }

        .dashboard-info-item span {
            font-size: 18px;
        }

        .hover-effect {
            transition: background-color 0.3s ease;
        }

        .hover-effect:hover {
            background-color: #f5f5f5;
        }

        .success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border-radius: 5px;
            font-weight: bold;
            animation: fadeOut 3s forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                visibility: hidden;
            }
        }
        .center-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <h2>Status</h2>

        <div class="row">
            <div class="col s12 m6">
                <div class="status-card green" id="status-card-1">
                    <h4>360 Dialog</h4>
                    <a href="https://status.360dialog.com/" target="_blank"><p>360 Dialog</p></a>
                    <p>Loading...</p>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="status-card orange" id="status-card-2">
                    <h4>Zenvia</h4>
                    <a href="https://status.zenvia.com/" target="_blank"><p>Zenvia</p></a>
                    <p>Loading...</p>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="status-card red" id="status-card-3">
                    <h4>Locaweb</h4>
                    <a href="https://statusblog.locaweb.com.br/" target="_blank"><p>Locaweb</p></a>
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>

   <!-- <div class="dashboard-info">
    <h2>Gráfico em Pizza</h2>
    <div style="width: 80%; margin: auto;">
        <canvas id="graficoPizza"></canvas>
    </div>
</div> -->

    <div class="dashboard-info">
        <h2>Informações Gerais</h2>

        <div class="row">
            <div class="col s12 m6 l4">
                <div class="dashboard-info-item hover-effect">
                    <a href="visualizar_atividade.php" class="btn-small waves-effect waves-light blue">Atividade</a>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="dashboard-info-item hover-effect">
                    <a href="listar_equipamento.php" class="btn-small waves-effect waves-light blue">Equipamentos</a>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="dashboard-info-item hover-effect">
                    <a href="home.php" class="btn-small waves-effect waves-light blue">Tarefas</a>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="dashboard-info-item hover-effect">
                    <a href="chips.php" class="btn-small waves-effect waves-light blue">Operadoras</a>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="dashboard-info-item hover-effect">
                    <a href="lista_usuarios.php" class="btn-small waves-effect waves-light blue">Usuarios</a>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="dashboard-info-item hover-effect">
                    <a href="backup.php" class="btn-small waves-effect waves-light blue">Backup</a>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="dashboard-info-item hover-effect">
                    <a href="ftp.php" class="btn-small waves-effect waves-light blue">FTP</a>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="dashboard-info-item hover-effect">
                    <a href="listar_contratos.php" class="btn-small waves-effect waves-light blue">Arquivos</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Importação dos scripts do Materialize -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/materialize/js/materialize.min.js"></script>

    <!-- Seu código JavaScript personalizado -->
    <script>
        // Função para destacar elementos no hover
        function addHoverEffect(element) {
            element.addEventListener('mouseover', function () {
                this.style.transition = 'background-color 0.3s ease';
                this.style.backgroundColor = '#f5f5f5';
            });

            element.addEventListener('mouseout', function () {
                this.style.backgroundColor = 'transparent';
            });
        }

        // Função para exibir uma mensagem de sucesso
        function showSuccessMessage(message) {
            const successMessage = document.createElement('div');
            successMessage.className = 'success-message';
            successMessage.textContent = message;
            document.body.appendChild(successMessage);

            // Remover a mensagem após alguns segundos
            setTimeout(function () {
                successMessage.remove();
            }, 3000);
        }

        // Aplicar o efeito de hover a elementos desejados
        const elementsToHighlight = document.querySelectorAll('.hover-effect');
        elementsToHighlight.forEach(function (element) {
            addHoverEffect(element);
        });

        // Exemplo de atualização de contadores com dados dinâmicos
        // Aqui é apenas um exemplo, você precisa adaptar para suas necessidades e integrar com seu backend

        // Função para obter os contadores atualizados dos dados
        function fetchCounters() {
            // Simulação de requisição AJAX para obter os contadores
            // Aqui você precisa substituir com sua própria lógica de requisição AJAX para obter os dados atualizados

            // Suponha que a resposta da requisição seja um objeto JSON com os contadores
            const response = {
                equipamentos: 10,
                chamados: 20,
                tarefas: 30
            };

            // Atualizar os contadores na página
            document.getElementById('equipamentos-counter').textContent = response.equipamentos;
            document.getElementById('chamados-counter').textContent = response.chamados;
            document.getElementById('tarefas-counter').textContent = response.tarefas;
        }

        // Atualizar os contadores inicialmente
        fetchCounters();

        // Atualizar os contadores a cada intervalo de tempo (por exemplo, a cada 5 segundos)
        setInterval(fetchCounters, 5000);

        // Exemplo de uso da função showSuccessMessage
        const successButton = document.getElementById('success-button');
        successButton.addEventListener('click', function () {
            showSuccessMessage('Operação concluída com sucesso!');
        });
        // Função para buscar os dados do gráfico em pizza via AJAX
    function fetchDadosGraficoPizza() {
        $.ajax({
            url: 'gerar_grafico_pizza.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Chame a função para criar o gráfico em pizza com os dados recebidos
                criarGraficoPizza(data);
            },
            error: function (xhr, status, error) {
                console.error('Erro ao buscar dados do gráfico em pizza:', error);
            }
        });
    }

    // Função para criar o gráfico em pizza usando Chart.js
    function criarGraficoPizza(dados) {
        var ctx = document.getElementById('graficoPizza').getContext('2d');
        var graficoPizza = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: dados.labels,
                datasets: [{
                    data: dados.dados,
                    backgroundColor: dados.cores,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Chame a função para buscar os dados e criar o gráfico inicialmente
    fetchDadosGraficoPizza();

    // Atualize o gráfico a cada intervalo de tempo (por exemplo, a cada 1 minuto)
    setInterval(fetchDadosGraficoPizza, 60000);
    </script>
</body>
</html>
