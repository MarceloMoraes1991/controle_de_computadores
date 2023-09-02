CREATE DATABASE  IF NOT EXISTS `tarefasdiarias` 
/*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tarefasdiarias`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: tarefasdiarias
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.29-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria_tarefa`
--

DROP TABLE IF EXISTS `categoria_tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_tarefa` (
  `cod` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_tarefa`
--

LOCK TABLES `categoria_tarefa` WRITE;
/*!40000 ALTER TABLE `categoria_tarefa` DISABLE KEYS */;
INSERT INTO `categoria_tarefa` VALUES (1,'Trabalho'),(2,'Escola'),(3,'Estágio'),(4,'Compra');
/*!40000 ALTER TABLE `categoria_tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_usuario`
--

DROP TABLE IF EXISTS `perfil_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_usuario` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_usuario`
--

LOCK TABLES `perfil_usuario` WRITE;
/*!40000 ALTER TABLE `perfil_usuario` DISABLE KEYS */;
INSERT INTO `perfil_usuario` VALUES (1,'Administrador'),(2,'Usuário Padrão');
/*!40000 ALTER TABLE `perfil_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarefas`
--

DROP TABLE IF EXISTS `tarefas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarefas` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `usuario_cod` int(11) NOT NULL,
  `categoria_cod` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `fk_tarefas_usuario1` (`usuario_cod`),
  KEY `fk_tarefas_categoria1` (`categoria_cod`),
  CONSTRAINT `fk_tarefas_categoria1` FOREIGN KEY (`categoria_cod`) REFERENCES `categoria_tarefa` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tarefas_usuario1` FOREIGN KEY (`usuario_cod`) REFERENCES `usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarefas`
--

LOCK TABLES `tarefas` WRITE;
/*!40000 ALTER TABLE `tarefas` DISABLE KEYS */;
INSERT INTO `tarefas` VALUES (7,'Comprar Iogurte','2019-08-23','12:00:00','Teste',5,4),(8,'Estudar Matemática','2019-08-27','09:00:00','',4,2),(11,'Comprar Iogurte','2019-08-01','12:12:00','Activia',5,3),(12,'Comprar Pão','2019-08-16','13:13:00','',3,1),(13,'Estudar Geografia','2019-08-31','13:15:00','Estudar para a prova que será aplicada amanhã',3,2),(14,'Comprar Café','2019-08-31','09:09:00','Café Solúvel',5,4);
/*!40000 ALTER TABLE `tarefas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `perfil_cod` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `fk_usuario_perfil1_idx` (`perfil_cod`),
  CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`perfil_cod`) REFERENCES `perfil_usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (2,'usuario','teste@gmail.com','202cb962ac59075b964b07152d234b70',2), (1,'Administrador','admin@gmail.com','21232f297a57a5a743894a0e4a801fc3',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-22 14:13:06


CREATE TABLE chips (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  numero VARCHAR(20) NOT NULL,
  qrcode VARCHAR(100) NOT NULL,
  operadora VARCHAR(50) NOT NULL
);


CREATE TABLE chips_arquivados (
  id INT PRIMARY KEY AUTO_INCREMENT,
  numero VARCHAR(20) NOT NULL,
  qrcode VARCHAR(100) NOT NULL,
  operadora VARCHAR(50) NOT NULL,
  nome VARCHAR(50) NOT NULL,
  data_arquivamento TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE clientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome_completo VARCHAR(100) NOT NULL,
    rg VARCHAR(20),
    cpf VARCHAR(14) NOT NULL,
    endereco VARCHAR(100),
    estado VARCHAR(50),
    cep VARCHAR(10),
    cidade VARCHAR(50),
    bairro VARCHAR(50),
    referencia VARCHAR(100),
    data_nascimento DATE,
    tipo_pessoa VARCHAR(10),
    nacionalidade VARCHAR(50),
    sexo VARCHAR(10),
    telefone_residencial VARCHAR(20),
    telefone_celular VARCHAR(20),
    whatsapp VARCHAR(20),
    financeiro TEXT,
    atendimento TEXT,
    agenda TEXT,
    arquivos TEXT,
    observacoes TEXT
);

CREATE TABLE atividades_arquivadas (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(100) NOT NULL,
  aberto_por VARCHAR(50) NOT NULL,
  observacao TEXT,
  fomentar VARCHAR(50),
  documentos TEXT,
  data_criacao DATE NOT NULL,
  data_encerramento DATE,
  arquivada BOOLEAN DEFAULT false
);

CREATE TABLE atividades (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(100) NOT NULL,
  aberto_por VARCHAR(50) NOT NULL,
  observacao TEXT,
  fomentar VARCHAR(50),
  documentos TEXT,
  data_criacao DATE NOT NULL
);


CREATE TABLE servicos_agendados (
  id int(11) NOT NULL AUTO_INCREMENT,
  servico varchar(255) NOT NULL,
  usuario varchar(255) NOT NULL,
  data date NOT NULL,
  hora time NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE material (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_funcionario VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    fabricante VARCHAR(100) NOT NULL,
    equipamento VARCHAR(100) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    sn VARCHAR(50) NOT NULL,
    mtm VARCHAR(50) NOT NULL,
    mo VARCHAR(50) NOT NULL,
    descricao TEXT,
    anexo VARCHAR(255)
);

