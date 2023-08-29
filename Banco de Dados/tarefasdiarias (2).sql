-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/07/2023 às 20:21
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tarefasdiarias`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades`
--

CREATE TABLE `atividades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `aberto_por` varchar(50) NOT NULL,
  `observacao` text DEFAULT NULL,
  `fomentar` varchar(50) DEFAULT NULL,
  `documentos` text DEFAULT NULL,
  `data_criacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades_arquivadas`
--

CREATE TABLE `atividades_arquivadas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `aberto_por` varchar(50) NOT NULL,
  `observacao` text DEFAULT NULL,
  `fomentar` varchar(50) DEFAULT NULL,
  `documentos` text DEFAULT NULL,
  `data_criacao` date NOT NULL,
  `data_encerramento` date DEFAULT NULL,
  `arquivada` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `atividades_arquivadas`
--

INSERT INTO `atividades_arquivadas` (`id`, `titulo`, `aberto_por`, `observacao`, `fomentar`, `documentos`, `data_criacao`, `data_encerramento`, `arquivada`) VALUES
(9, '', '', '', '', NULL, '0000-00-00', '2023-07-17', 1),
(10, 'Instalar Equipamentos', 'Marcelo', 'Instalar nos pontos adequados', 'Teste', NULL, '0000-00-00', '2023-07-17', 1),
(11, 'frgd', 'gfdgd', 'gdfg', 'gdfg', NULL, '2023-07-17', '2023-07-17', 1),
(12, 'Açougue', 'fddd', 'ad', 'dfs', NULL, '0000-00-00', '2023-07-17', 1),
(13, 'fsdd', 'gsf', 'gsfg', 'gfsg', NULL, '0000-00-00', '2023-07-17', 1),
(14, 'fsdfgs', 'gfsfgdg', 'gfdsgd', 'gdfgd', NULL, '0000-00-00', '2023-07-17', 1),
(15, '', '', '', '', NULL, '0000-00-00', '2023-07-17', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_tarefa`
--

CREATE TABLE `categoria_tarefa` (
  `cod` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `categoria_tarefa`
--

INSERT INTO `categoria_tarefa` (`cod`, `nome`) VALUES
(1, 'Trabalho'),
(2, 'Escola'),
(3, 'Estágio'),
(4, 'Compra');

-- --------------------------------------------------------

--
-- Estrutura para tabela `chips`
--

CREATE TABLE `chips` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `operadora` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `chips`
--

INSERT INTO `chips` (`id`, `nome`, `numero`, `qrcode`, `operadora`) VALUES
(1, 'Marcelo Moraes', '21982792844', '21982792844', 'TIM K2'),
(3, 'Rogerio Obra', '21982791851', '21982791851', 'TIM K2'),
(4, 'Raissa Knupp', '21982792495', '21982792495', 'TIM K2'),
(5, 'VAGO', '21982792882', '21982792882', 'TIM K2'),
(6, 'VAGO', '21982793986', '21982793986', 'TIM K2'),
(7, 'VAGO', '21982794681', '21982794681', 'TIM K2'),
(8, 'Edson Medeiros Técnico SJ', '21982794702', '21982794702', 'TIM K2'),
(9, 'Daniel Caetano', '21982794823', '21982794823', 'TIM K2'),
(10, 'Ezequiel Guapimirim', '21982795366', '21982795366', 'TIM K2'),
(11, 'Raphael Azevedo', '21982795527', '21982795527', 'TIM K2'),
(12, 'Ranis e Ronie Tecnico RB', '21982795627', '21982795627', 'TIM K2'),
(13, 'Cleber Trannin NOC', '21982795736', '21982795736', 'TIM K2'),
(14, 'Barbara Ferraz Comercial K2', '21982796454', '21982796454', 'TIM K2'),
(15, 'Vanessa Martinez Suporte ', '21982797490', '21982797490', 'TIM K2'),
(16, 'VAGO', '21982797995', '21982797995', 'TIM K2'),
(17, 'FINANCEIRO TESOURARIA ', '21982797998', '21982797998', 'TIM K2'),
(18, 'Murillo Calazans Projeto', '21982798451', '21982798451', 'TIM K2'),
(19, 'Tulio Guapimirim', '21982798825', '21982798825', 'TIM K2'),
(20, 'Diogo e Luiz Tecnico', '21982799028', '21982799028', 'TIM K2'),
(21, 'Reginaldo Tecnico SJ', '21982799088', '21982799088', 'TIM K2'),
(22, 'Magno Silvestre', '21981110151', '21981110151', 'TIM K2'),
(23, 'VAGO', '21981110693', '21981110693', 'TIM K2'),
(24, 'Sandro', '21981110939', '21981110939', 'TIM K2'),
(25, 'Kevin e Renis Tecnico RB', '21981110980', '21981110980', 'TIM K2'),
(26, 'Felipe Cardoso / Paulo Roberto   (Técnico)', '21981111077', '21981111077', 'TIM K2'),
(27, 'SMS Gammu Niver', '21981111275', '21981111275', 'TIM K2'),
(28, 'Emerson e Almir (Técnico SJ)', '21981111517', '21981111517', 'TIM K2'),
(29, 'Maick (Infra K2)', '21981111629', '21981111629', 'TIM K2'),
(30, 'VAGO', '21981111829', '21981111829', 'TIM K2'),
(31, 'Wilian (Técnico RB)', '21981111868', '21981111868', 'TIM K2'),
(32, 'Victor Hugo  (Assistente TI)', '21979540036', '21979540036', 'TIM K2'),
(33, 'Iago (NOC)', '21979540044', '21979540044', 'TIM K2'),
(34, 'Antonio (Contabilidade)', '21979540046', '21979540046', 'TIM K2'),
(35, 'Manuel (NOC)', '21979540049', '21979540049', 'TIM K2'),
(36, 'CRM VENDAS SALES (OPA! SUITE)', '21979540050', '21979540050', 'TIM K2'),
(37, 'Vitor Pimenta (Engenharia de Redes)', '21979540053', '21979540053', 'TIM K2'),
(38, 'Carlos Augusto', '21979540055', '21979540055', 'TIM K2'),
(39, 'Isis Bruno (RH)', '21979540059', '21979540059', 'TIM K2'),
(40, 'VAGO', '21979540062', '21979540062', 'TIM K2'),
(41, 'Alvany Mendes', '21979540067', '21979540067', 'TIM K2'),
(42, 'Amanda (Vendas)', '21965780241', '21965780241', 'TIM K2'),
(43, 'AUTENTICAÇÃO (LEO)', '21982351928', '21982351928', 'VIVO K2'),
(44, 'Jefferson (Infra K2)', '2982352543', '2982352543', 'VIVO K2'),
(45, 'Ulisses Miranda', '21982352908', '21982352908', 'VIVO K2'),
(46, 'Lucas Silva', '21982353193', '21982353193', 'VIVO K2'),
(47, 'LNH8D49', '21982353217', '21982353217', 'VIVO K2'),
(48, 'Maicon Perdomo', '21982353439', '21982353439', 'VIVO K2'),
(49, 'Cobrança K2', '21982354459', '21982354459', 'VIVO K2'),
(50, 'Arthur Catelani ', '21982355298', '21982355298', 'VIVO K2'),
(51, 'VAGO', '21982356311', '21982356311', 'VIVO K2'),
(52, 'Patrick ', '21982356421', '21982356421', 'VIVO K2'),
(53, 'Jhonnatan Linhares', '21983470554', '21983470554', 'VIVO K2'),
(54, 'Joel Pinheiro', '21983470742', '21983470742', 'VIVO K2'),
(55, 'RH', '21983470829', '21983470829', 'VIVO K2'),
(56, 'Wellington Correa', '21983470908', '21983470908', 'VIVO K2'),
(57, 'VAGO', '21983470909', '21983470909', 'VIVO K2'),
(58, 'Vendas AMO', '21983470943', '21983470943', 'VIVO K2'),
(59, 'Hellen Vendas', '21983471234', '21983471234', 'VIVO K2'),
(60, 'Contas a Pagar', '21983471258', '21983471258', 'VIVO K2'),
(61, 'Marcos Apoema', '21983730024', '21983730024', 'VIVO K2'),
(62, 'Magno Serra (NOC)', '21983730108', '21983730108', 'VIVO K2'),
(63, 'Uelinton Rosa ', '21983730209', '21983730209', 'VIVO K2'),
(64, 'Alberti (Projetos)', '21983730211', '21983730211', 'VIVO K2'),
(65, 'Ronan (NOC)', '21983730213', '21983730213', 'VIVO K2'),
(66, 'Pedro Curty', '21983730214', '21983730214', 'VIVO K2'),
(67, 'Matheus Pessanha', '21983730215', '21983730215', 'VIVO K2'),
(68, 'Juçara Coutinho', '21981262600', '21981262600', 'VIVO K2'),
(69, 'INFRA FTTH RESIDENCIAL', '21982350341', '21982350341', 'VIVO K2'),
(70, 'Alvaro Gary', '21982350741', '21982350741', 'VIVO K2'),
(71, 'Leonardo Campos', '21980194164', '21980194164', 'VIVO K2'),
(72, 'CERCI', '21966314589', '89550537230001983876', 'CLARO K1'),
(73, 'CERCI', '21966400529', '89550537230001983884', 'CLARO K1'),
(74, 'VAGO', '21966461291', '89550537230001983892', 'CLARO K1'),
(75, 'VAGO', '21966517837', '89550537230001983710', 'CLARO K1'),
(76, 'VAGO', '21966642834', '89550537230001983900', 'CLARO K1'),
(77, 'VAGO', '21966651257', '89550537230001983736', 'CLARO K1'),
(78, 'Marconis Controller', '21966245458', '21966245458', 'CLARO K1'),
(79, 'Alexandre Infra K2', '21966255563', '21966255563', 'CLARO K1'),
(80, 'Carlos Renato Vendas', '21966414946', '21966414946', 'CLARO K1'),
(81, 'Ana Carolina Vendas', '21966469063', '21966469063', 'CLARO K1'),
(82, 'Luiz Eduardo Infra ES', '21973857891', '21973857891', 'CLARO K1'),
(83, 'Vendas RO', '21973862043', '21973862043', 'CLARO K1'),
(84, 'Ivan da Silva Tecnico', '21973867356', '21973867356', 'CLARO K1'),
(85, 'LMF4541', '21973880076', '21973880076', 'CLARO K1'),
(86, 'Marianne Vidal', '21973883908', '21973883908', 'CLARO K1'),
(88, 'VAGO', '21973930403', '21973930403', 'CLARO K1'),
(89, 'Faturamento', '21973945242', '21973945242', 'CLARO K1'),
(90, 'Luiz Felipe Controller', '21973950688', '21973950688', 'CLARO K1'),
(91, 'VAGO (TEM ZAP NO AGUARDO)', '21973956287', '21973956287', 'CLARO K1'),
(92, 'VAGO', '21990732356', '89550537230001983728', 'CLARO K2'),
(93, 'VAGO', '21990738339', '89550537230001983744', 'CLARO K2'),
(94, 'VAGO', '21990739778', '89550537230001983769', 'CLARO K2'),
(95, 'VAGO', '21990744169', '89550537230001983751', 'CLARO K2'),
(96, 'VAGO', '21990744522', '89550537230001983777', 'CLARO K2'),
(97, 'VAGO', '21990745503', '89550537230001983785', 'CLARO K2'),
(98, 'VAGO', '21990755422', '89550537230001983793', 'CLARO K2'),
(99, 'Vendas Amo Internet', '21990820023', '21990820023', 'CLARO K2'),
(100, 'VAGO', '21990827318', '89550537230001983868', 'CLARO K2'),
(101, 'VAGO', '21990838053', '89550537230001983801', 'CLARO K2'),
(102, 'VAGO', '21990852190', '21990852190', 'CLARO K2'),
(103, 'VAGO', '21990857211', '21990857211', 'CLARO K2'),
(104, 'VAGO', '21990870319', '21990870319', 'CLARO K2'),
(105, 'VAGO', '21990876284', '21990876284', 'CLARO K2'),
(106, 'VAGO', '21990885087', '21990885087', 'CLARO K2'),
(107, 'Leandro Garcia', '21981260157', '21981260157', 'CLARO K2'),
(108, 'Anderson Heringer', '21981262555', '21981262555', 'CLARO K2'),
(109, 'VAGO', '21973590526', '21973590526', 'CLARO K2'),
(110, 'Natã Infra', '21973619432', '21973619432', 'CLARO K2'),
(111, 'VAGO', '21973600679', '21973600679', 'CLARO K2'),
(112, 'Mauro Lemos Vendas', '21973608943', '21973608943', 'CLARO K2'),
(113, 'Wellerson Infra', '21973894011', '21973894011', 'CLARO K2'),
(114, 'Juçara Coutinho', '21971355115', '21971355115', 'TIM'),
(115, 'Anderson Heringer', '21986044576', '21986044576', 'TIM'),
(116, 'Vitor Sá', '21997442613', '21997442613', 'TIM'),
(117, 'Dona Ilda', '21999440143', '21999440143', 'TIM');

-- --------------------------------------------------------

--
-- Estrutura para tabela `chips_arquivados`
--

CREATE TABLE `chips_arquivados` (
  `id` int(11) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `operadora` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `data_arquivamento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `chips_arquivados`
--

INSERT INTO `chips_arquivados` (`id`, `numero`, `qrcode`, `operadora`, `nome`, `data_arquivamento`) VALUES
(2, '21973894011', '21973894011', 'CLARO K1', 'VAGO (TEM ZAP NO AGUARDO)', '2023-07-24 17:53:57');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome_completo` varchar(100) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `tipo_pessoa` varchar(10) DEFAULT NULL,
  `nacionalidade` varchar(50) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `telefone_residencial` varchar(20) DEFAULT NULL,
  `telefone_celular` varchar(20) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `financeiro` text DEFAULT NULL,
  `atendimento` text DEFAULT NULL,
  `agenda` text DEFAULT NULL,
  `arquivos` text DEFAULT NULL,
  `observacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome_completo`, `rg`, `cpf`, `endereco`, `estado`, `cep`, `cidade`, `bairro`, `referencia`, `data_nascimento`, `tipo_pessoa`, `nacionalidade`, `sexo`, `telefone_residencial`, `telefone_celular`, `whatsapp`, `financeiro`, `atendimento`, `agenda`, `arquivos`, `observacoes`) VALUES
(1, 'Marcelo Moraes', '257557074', '14517652742', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `controle_equipamentos`
--

CREATE TABLE `controle_equipamentos` (
  `id` int(11) NOT NULL,
  `nome_funcionario` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `equipamento` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `controle_equipamentos`
--

INSERT INTO `controle_equipamentos` (`id`, `nome_funcionario`, `cpf`, `equipamento`, `modelo`, `sn`, `descricao`) VALUES
(3, 'Marcelo Moraes', '14517652742', 'notebook', 'Lenovo', '82MGS00400', 'Ideapad Gaming 3i'),
(4, 'Adelias Pereira Coelho', '844.139.213-72', 'CELULAR', 'MOTO E 32', 'UF1HSJ2QW4', 'Patrimonio: 2413 - Marca: Motorola, 4G + 64G - Numero tel: 21 96717-2489'),
(5, 'Adelias Pereira Coelho', '844.139.213-72', 'NOTEBOOK', 'V14 G2 ITL', 'PE9811C16144', 'Patrimonio: 006473 - Marca: Lenovo - Tipo: PE08E0KD'),
(6, 'ALEXANDRE WAGNER DE MATOS SILVA', '025.873.307-18', 'Notebook', 'V14 G2 ITL', 'PE08XAYJ', 'Marca: Lenovo - MTM: 82NM000YBR - MO: PE9012A12121'),
(7, 'ALEXANDRE WAGNER DE MATOS SILVA', '025.873.307-18', 'CELULAR', 'MOTO E22', 'UG3HSS3XZ3', 'Marca: Motorola - IMEI1: 359296841561872 - Numero Tel: (21) 96625-5563 - 2G + 32G'),
(8, 'ALEXANDRE WEMDERBERG RAMOS NUNES', '167.321.837-70', 'CELULAR', 'MOTO E22', 'UI5HSS2L5X', 'Marca: Motorola - IMEI1: 353689471081037 - Tel: 21990820023 - 4G + 64G'),
(9, 'ALVANY DE VASCONCELOS MENDES', '014.079.127-20', 'NOTEBOOK', 'ThinkPad', '6499', 'Patrimonio: 6499'),
(10, 'AMANDA MOREIRA BORGES', '180.606.437-54', 'CELULAR', 'MOTO E22', 'UI5HSS2L5D', 'Marca: MOTOROLA - IMEI1: 353689471080716 - 4G + 64G'),
(11, 'ANA CAROLINA DA SILVA DIAS', '161.863.857-28', 'CELULAR', 'MOTO G7 PLAY', '354130107147495', 'Marca: Motorola - IMEI1: 354130107147495 - IMEI2: 354130107147503 - 2G + 32G'),
(12, 'Arlenio Lopes Ribeiro', '072.729.977-88', 'CELULAR', 'MOTO G32', 'UG5HSQ28DR', 'Marca: Motorola - 4G + 64G'),
(13, 'CARLOS RENATO DO NASCIMENTO SANTOS', '095.804.237-33', 'NOTEBOOK', 'V14 G2 ITL', 'PE08X8S8', 'Marca: Lenovo - MO: PE9012412033 - MTM: 82NMS00000 - Patrimonio: 12062'),
(14, 'Daniel Caetano Merlim Correa', '087.447.787-59', 'CELULAR', 'MOTO G32', 'UG5HSQ28LS', 'Marca: Motorla - 4G + 128G'),
(15, 'HELLEN FRAGA PINHEIRO', '142.807.217-93', 'NOTEBOOK', 'LATITUDE 3490', 'P89G001', 'Marca: Dell - Reg Model: P89G - DP/N: 8WP20 A00'),
(16, 'HELLEN FRAGA PINHEIRO', '142.807.217-93', 'CELULAR', 'EDGE 20', 'UA3HSN2375', 'Marca: Motorola - IMEI1: 359993323830656 - 8G + 128G'),
(17, 'IAGO DE FREITAS RODRIGUES', '153.842.877-64', 'CELULAR', 'MOTO E22', 'UI5HSS3RZP', 'Marca: Motorola - IMEI1: 353689471611775 - IMEI2: 353689471611783 - 4GB/64GB'),
(18, 'ISIS BRUNO VIEIRA', '102.529.197-26', 'CELULAR', 'MOTO E22', 'UG3HSS3XPJ', 'Marca: Motorola - Tel: +55 21 97954-0059 - 2GB + 32GB - XT2239-16'),
(19, 'ISIS BRUNO VIEIRA', '102.529.197-26', 'NOTEBOOK', 'LENOVO V15', '256GB NVME', 'Marca: Lenovo V15 - 256GB NVME M.2 - 20GB RAM - *USADO*'),
(20, 'Jefferson Busquet Correa', '118.048.687-01', 'CELULAR', 'MOTO G32', 'UG5HSQ28FK', 'Marca: Motorola - 4G + 128G'),
(21, 'John Victor dos Santos Magalhães', '142.318.567-61', 'CELULAR', 'MOTO E32', 'UF1HSL33MR', 'Marca: Motorola - Modelo: XT2227-1'),
(22, 'JOEL VITOR FONSECA PINHEIRO', '133.258.197-88', 'CELULAR', 'MOTO E32', 'UF1HSL33PH', 'Marca: Motorola - Modelo: XT2227-1'),
(23, 'Leone Vianna da Silva', '119.433.177-71', 'NOTEBOOK', 'V14 G2 ITL', 'PE981 1C16144', 'Marca: Lenovo - Patrimonio: 006428 - TIPO: PE08E0KE'),
(24, 'LETÍCIA LESSA SILVA', '158.257.127-98', 'NOTEBOOK', 'V14 G2 ITL', 'SPE0AKSPR', 'Marca: Lenovo - MO: PE9013310025 - MTM: 82NMS00100D - Patrimonio: 12058'),
(25, 'LLM6E64 - STRADA', 'LLM6E64 - STRA', 'CELULAR', 'MOTO E22', 'UG3HSS2J8K', 'Marca: Motorola - Tel: 21981110980 - Técnicos: RONIE E WILLIAN - 2G + 32G - '),
(26, 'LMF4541 - FIORINO', 'LMF4541 - FIOR', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G - Tel: 21973880076 (CLARO)'),
(27, 'LMP7B02 - FIORINO', 'LMP7B02 - FIOR', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G - Tecnico: Alex e Eliel -  21967605996'),
(28, 'LMP7B10 - FIORINO', 'LMP7B10 - FIOR', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G - Técnicos: Luan e Sergio  -  Tel:  21997269268 (vivo)'),
(29, 'LMP7B18 - FIORINO', 'LMP7B18 - FIOR', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G - Tecnicos: Elder e Otton -  Tel: 21997079882'),
(30, ' LMP7B24 - FIORINO', ' LMP7B24 - FIO', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G'),
(31, 'LMP7B35 - FIORINO', 'LMP7B35 - FIOR', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G - Tel: 21972505406 - Tecnicos: Christopher e João Pedro'),
(32, 'LMX2G39 - FIORINO', 'LMX2G39 - FIOR', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G'),
(33, ' LMX2G47 – FIORINO', ' LMX2G47 – FIO', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G - Tecnicos - Saulo e Gerald - Tel: 21 982350341'),
(34, ' LMX2G55 - FIORINO', ' LMX2G55 - FIO', 'CELULAR', 'MOTO E32', 'MOTOROLA', 'tel: 21 99680-6067  - 4G + 64G - Tecnicos: Washington e João Paulo - Tel: 21 99680-6067'),
(35, 'LNH8D32 - FIORINO', 'LNH8D32 - FIOR', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G - Tel:  21 97192-5356'),
(36, 'LNH8D49 - FIORINO', 'LNH8D49 - FIOR', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G - Tel: 21 982353217 (tim) - Tecnicos: Ismael e Fabio Bento'),
(37, 'LRJ6J47 - FIORINO', 'LRJ6J47 - FIOR', 'CELULAR', 'MOTO E32', 'MOTOROLA', '4G + 64G'),
(38, 'Luan Batista Souza', '181.138.637-70', 'NOTEBOOK', 'V14 G2 ITL', 'PE089CX0', 'Marca: Lenovo - MO: PE9011B27029 - MTM: B2NMSDDE00'),
(39, 'Lucas Souza e Silva', '062.308.687-50', 'NOTEBOOK', 'V14 G2 ITL', 'PE9012412052', 'Marca: Lenovo - Patrimonio: 6456 - Modelo: 82NM000XBR - Tipo: PE08X7FG'),
(40, 'Lucas Souza e Silva', '062.308.687-50', 'CELULAR', 'XT2081-1', 'ZF52367GSM', 'Marca: Motorola '),
(41, 'Luiz Eduardo Mendes Alves', '059.110.217-06', 'CELULAR', 'MOTO G32', 'UG5HSQ29D8', 'Marca: Motorola - 4G + 128G'),
(42, 'Magno Rodrigues Serra', '132.774.457-04', 'CELULAR', 'MOTO E32', 'UF1HSL32ZJ', 'Marca: Motorola - Modelo: XT2227-1 '),
(43, 'Magno Silvestre da Silva', 'Magno Silvestr', 'CELULAR', 'MOTO G32', 'UG3HSS2LCK', 'Marca: Motorola - 4G + 128G'),
(44, 'Maick Silva Godinho', '160.865.437-04', 'CELULAR', 'MOTO G32', 'UG3HSS2L3B', 'Marca: Motorola  - 4G + 128G'),
(45, 'Maicon Perdomo Maciel', '119.937.037-13', 'CELULAR', 'MOTO G32', 'UG3HSS2L8L', 'Marca: Motorola - 4G + 128G'),
(46, 'MANUEL VICTOR JACINTHO DE CARVALHO', '125.269.697-35', 'NOTEBOOK', 'V14 G2 ITL', 'PE0AKSPY', 'Marca: Lenovo - MO: PE9013310025 - MTM: 82NMS00100'),
(47, 'MANUEL VICTOR JACINTHO DE CARVALHO', '125.269.697-35', 'CELULAR', 'MOTO E22', 'UI5HSS2DPC', 'Marca: Motorola - Tel: 21979540049 - 2G + 64G'),
(48, 'MARIANNE VIDAL CARVALHO DE ALMEIDA', '170.433.917-09', 'CELULAR', 'MOTO G32', 'SP18D55822', 'Marca: Motorola - MSN: UG5HSQ29DB - 4G + 128G'),
(49, 'MATHEUS VICENTE PESSANHA DAS DORES TEIXEIRA', '164.456.017-82', 'NOTEBOOK', 'Gamer G5', 'G5', '2 MONITORES  - MOUSE + TECLADO - DELL'),
(50, 'MURILLO LEOPOLDINO CALAZANS', '145.799.207-83', 'CELULAR', 'MOTO E22', 'UI5HSS24VM', 'Marca: Motorola - 4GB/64GB - IMEI1: 353689470873095 - IMEI2: 353689470873103'),
(51, 'NATA CORREA FERREIRA', '122.493.377-05', 'NOTEBOOK', 'V14 G2 ITL', 'PE08XAYL', 'Marca: LENOVO - MO: PE9012412121 - MTM: 82NM000YBR'),
(52, 'Nata Correa Ferreira', '122.493.377-05', 'CELULAR', 'MOTO G32', 'UG5HSQ28VD', 'Marca: Motorola - 4G + 128G');

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL,
  `nome_funcionario` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `equipamento` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `departamento` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`, `cargo`, `departamento`) VALUES
(1, 'Marcelo Moraes', 'TI', 'Tecnologia da Informação');

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil_usuario`
--

CREATE TABLE `perfil_usuario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`cod`, `nome`) VALUES
(1, 'Administrador'),
(2, 'Usuário Padrão');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `cod` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `usuario_cod` int(11) NOT NULL,
  `categoria_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tarefas`
--

INSERT INTO `tarefas` (`cod`, `titulo`, `data`, `hora`, `descricao`, `usuario_cod`, `categoria_cod`) VALUES
(7, 'Comprar Iogurte', '2019-08-23', '12:00:00', 'Teste', 5, 4),
(8, 'Estudar Matemática', '2019-08-27', '09:00:00', '', 4, 2),
(11, 'Comprar Iogurte', '2019-08-01', '12:12:00', 'Activia', 5, 3),
(12, 'Comprar Pão', '2019-08-16', '13:13:00', '', 3, 1),
(13, 'Estudar Geografia', '2019-08-31', '13:15:00', 'Estudar para a prova que será aplicada amanhã', 3, 2),
(14, 'Comprar Café', '2019-08-31', '09:09:00', 'Café Solúvel', 5, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `perfil_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`cod`, `nome`, `email`, `senha`, `perfil_cod`) VALUES
(1, 'Marcelo Moraes', 'marcelomoraes25121991@gmail.com', '1f0b9b8132cfa3d781ccfcd54a24bd81', 1),
(3, 'TASSIO', 'tassio@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(4, 'teste', 'teste@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(5, 'Administrador', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(8, 'Leonardo Campos', 'leonardo.amaral@amointernet.com.br', '1f5e88ecf1cfe69e1333d905b5c2b491', 2),
(9, 'Victor Hugo', 'victor.hugo@amointernet.com.br', '4cd51e51a4225287c8bb2fa0eb4343e1', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atividades`
--
ALTER TABLE `atividades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `atividades_arquivadas`
--
ALTER TABLE `atividades_arquivadas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categoria_tarefa`
--
ALTER TABLE `categoria_tarefa`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `chips`
--
ALTER TABLE `chips`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `chips_arquivados`
--
ALTER TABLE `chips_arquivados`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `controle_equipamentos`
--
ALTER TABLE `controle_equipamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_tarefas_usuario1` (`usuario_cod`),
  ADD KEY `fk_tarefas_categoria1` (`categoria_cod`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_usuario_perfil1_idx` (`perfil_cod`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividades`
--
ALTER TABLE `atividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `atividades_arquivadas`
--
ALTER TABLE `atividades_arquivadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `chips`
--
ALTER TABLE `chips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de tabela `chips_arquivados`
--
ALTER TABLE `chips_arquivados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `controle_equipamentos`
--
ALTER TABLE `controle_equipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_tarefas_categoria1` FOREIGN KEY (`categoria_cod`) REFERENCES `categoria_tarefa` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tarefas_usuario1` FOREIGN KEY (`usuario_cod`) REFERENCES `usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`perfil_cod`) REFERENCES `perfil_usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
