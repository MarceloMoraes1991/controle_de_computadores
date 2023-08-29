CREATE DATABASE IF NOT EXISTS `itmtechnology` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `itmtechnology`;

-- Table structure for table `categoria_tarefa`
DROP TABLE IF EXISTS `categoria_tarefa`;
CREATE TABLE `categoria_tarefa` (
  `cod` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `cliente`
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Table structure for table `controle_equipamentos`
DROP TABLE IF EXISTS `controle_equipamentos`;
CREATE TABLE `controle_equipamentos` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome_funcionario` varchar(150) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `equipamento` varchar(150) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `sn` varchar(45) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `usuario_cod` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `fk_controle_equipamentos_usuario_idx` (`usuario_cod`),
  CONSTRAINT `fk_controle_equipamentos_usuario` FOREIGN KEY (`usuario_cod`) REFERENCES `usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `equipamentos`
DROP TABLE IF EXISTS `equipamentos`;
CREATE TABLE `equipamentos` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `estoque`
DROP TABLE IF EXISTS `estoque`;
CREATE TABLE `estoque` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `equipamento_cod` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `fornecedor` varchar(150) DEFAULT NULL,
  `data_entrada` date NOT NULL,
  `localizacao` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `fk_estoque_equipamentos1_idx` (`equipamento_cod`),
  CONSTRAINT `fk_estoque_equipamentos1` FOREIGN KEY (`equipamento_cod`) REFERENCES `equipamentos` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Table structure for table `perfil_usuario`
DROP TABLE IF EXISTS `perfil_usuario`;
CREATE TABLE `perfil_usuario` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `perfil_usuario` (`nome`, `descricao`) VALUES
('Administrador', 'Perfil de administrador com acesso total'),
('Usuário Padrão', 'Perfil de usuário padrão com acesso limitado');


-- Table structure for table `tarefas`
DROP TABLE IF EXISTS `tarefas`;
CREATE TABLE `tarefas` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `usuario_cod` int(11) NOT NULL,
  `categoria_cod` int(11) NOT NULL,
  `remetente_cod` int(11) DEFAULT NULL,
  `mensagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `fk_tarefas_usuario1` (`usuario_cod`),
  KEY `fk_tarefas_categoria1` (`categoria_cod`),
  KEY `fk_tarefas_usuario2` (`remetente_cod`),
  CONSTRAINT `fk_tarefas_categoria1` FOREIGN KEY (`categoria_cod`) REFERENCES `categoria_tarefa` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tarefas_usuario1` FOREIGN KEY (`usuario_cod`) REFERENCES `usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tarefas_usuario2` FOREIGN KEY (`remetente_cod`) REFERENCES `usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Table structure for table `usuario`
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `perfil_cod` int(11) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `bairro` varchar(150) NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `fk_usuario_perfil1_idx` (`perfil_cod`),
  CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`perfil_cod`) REFERENCES `perfil_usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `usuario` (`cod`, `nome`, `email`, `senha`, `perfil_cod`, `cpf`, `endereco`, `cep`, `bairro`, `estado`) VALUES
(1, 'Marcelo Moraes', 'marcelomoraes25121991@gmail.com', '652845', 3, '14517652742', 'RJ 116 KM28', '28680000', 'Japuiba', 'RJ');


-- Table structure for table `celulares`
CREATE TABLE numeros_celulares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(20) NOT NULL,
    nome VARCHAR(100),
    operadora VARCHAR(50)
);

