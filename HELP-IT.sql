CREATE DATABASE  IF NOT EXISTS `dbchamados` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dbchamados`;
-- MariaDB dump 10.19  Distrib 10.4.20-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: dbchamados
-- ------------------------------------------------------
-- Server version	10.4.20-MariaDB

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
-- Table structure for table `tab_chamados`
--

DROP TABLE IF EXISTS `tab_chamados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_chamados` (
  `ID_CHAMADO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_CHAMADO` varchar(250) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_ATENDENTE` int(11) DEFAULT NULL,
  `ID_DPTO` int(11) DEFAULT NULL,
  `TITULO` varchar(100) NOT NULL,
  `DESCRICAO` longtext NOT NULL,
  `PRIORIDADE` int(11) DEFAULT NULL,
  `STATUS` varchar(1) NOT NULL,
  `VIEW` varchar(1) NOT NULL,
  `PRINT` int(11) DEFAULT NULL,
  `DATA_ABERTURA` datetime NOT NULL,
  `DATA_ENCERRAMENTO` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_CHAMADO`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_chamados`
--

LOCK TABLES `tab_chamados` WRITE;
/*!40000 ALTER TABLE `tab_chamados` DISABLE KEYS */;
INSERT INTO `tab_chamados` VALUES (1,'20210713181000',1,1,9,'2','NÃ£o estou conseguindo consular cadastro dos alunos',1,'F','S',NULL,'2021-07-12 00:00:00','2021-09-01 00:00:00'),(2,'20210713181059',1,1,8,'2','Teste de primeiro chamado via APP',2,'F','S',NULL,'2021-07-13 00:00:00','2021-07-13 00:00:00'),(3,'20210714145507',1,1,4,'2','TESTE PRA VER SE VAI LISTAR ALGUMA INTERAÇÃO PARA UM CHAMADO SEM INTERAÇÃO.',3,'E','S',NULL,'2021-07-14 00:00:00',NULL),(34,'20210827162615',1,1,1,'2','teste inserção de varias imagens no banco de dados no banco de dados.',3,'E','S',1,'2021-08-27 00:00:00',NULL),(35,'20210827163406',1,1,1,'3','vamos ver se salva apenas um arquivo em anexo.',3,'E','S',NULL,'2021-08-27 00:00:00',NULL),(36,'20210827164151',1,1,1,'3','teste sem arquivo.',2,'F','S',NULL,'2021-08-27 00:00:00','2022-03-29 13:50:19'),(37,'20210827164451',1,1,1,'3','teste de envio, pós ajuste de arquivo null.',3,'E','S',NULL,'2021-08-27 00:00:00',NULL),(38,'20210830143844',1,1,1,'3','teste upload',3,'E','S',NULL,'2021-08-30 00:00:00',NULL),(42,'20210903172955',8,1,1,'3','teste com video',1,'F','S',NULL,'2021-09-03 00:00:00','2021-09-15 12:28:19'),(43,'20210903174659',8,1,1,'2','teste com video em anexo.',1,'E','S',NULL,'2021-09-03 00:00:00',NULL),(44,'20210910095056',1,1,1,'2','Chamado para testar condição SLA.',2,'E','N',NULL,'2021-09-10 09:50:56',NULL),(45,'20210910102258',1,1,1,'2','Teste de SLA',3,'F','N',NULL,'2021-09-10 10:22:58','2022-03-29 13:51:09'),(46,'20210915174526',1,1,1,'3','Por favor, criar documentação do sistema.',1,'F','S',NULL,'2021-09-15 17:45:26','2022-03-31 17:22:49'),(47,'20211021152243',9,1,1,'3','1 - Sinalizar questão que deverá ser corrigida pelo professor após retorno do CRTQ;\r\n2 - Botão para ir para ir para a próxima questão e botão retornar ao banco de questões;\r\n3 - Incluir na tela de Banco de questões, botões de filtros:\r\n	* Botão Finalizadas - Mesma Cor\r\n	* Botão Edição/construção - Mesma Cor\r\n	* Botão CRTQ - Enviadas  - Mesma cor\r\n	* Botão CRTQ - Correção  - Ícone de Alerta\r\n4 - Na tela de Busca de questões incluir botões:\r\n	* Ir para próxima Questão pra editar ou Voltar ao Banco de Questões;\r\n5 - Na Aba Incluir Questão:\r\n	* Botão \"Criar nova Questão\"(Com ou sem Vinheta);\r\n6 - Excluir do banco de questões as avaliações de teste;\r\n7 - Incluir na tela de lista das questões:\r\n	* Coluna Qtde de vezes foi usada;\r\n	* Coluna Se foi usada (Sim ou Não);\r\n	* Coluna \"Data da ultima utilização\".',1,'F','S',NULL,'2021-10-21 15:22:43','2022-03-10 13:28:16'),(48,'20211021153908',1,1,1,'3','Teste De envio de email - teste 01',3,'E','N',1,'2021-10-21 15:39:08',NULL),(49,'20220308093239',1,1,1,'3','Teste de chamado com demanda select',1,'F','S',NULL,'2022-03-08 09:32:39',NULL),(50,'20220308100014',1,1,1,'4','Por favor trocar o filtro de todos os ar-condicionado do bloco B',3,'E','S',NULL,'2022-03-08 10:00:14',NULL),(51,'20220309113524',11,11,7,'2','Teste para gerar o relatório em PDF.',3,'E','S',NULL,'2022-03-09 11:35:24',NULL);
/*!40000 ALTER TABLE `tab_chamados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_demandas`
--

DROP TABLE IF EXISTS `tab_demandas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_demandas` (
  `id_demanda` int(11) NOT NULL AUTO_INCREMENT,
  `d_descricao` varchar(100) NOT NULL,
  `d_status` varchar(1) DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL,
  PRIMARY KEY (`id_demanda`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_demandas`
--

LOCK TABLES `tab_demandas` WRITE;
/*!40000 ALTER TABLE `tab_demandas` DISABLE KEYS */;
INSERT INTO `tab_demandas` VALUES (2,'Aparar a grama do campo','A','2022-03-08 09:12:42'),(3,'Troca de piso','A','2022-03-08 09:18:16'),(4,'Manutenção Ar-condicionado bloco - B','A','2022-03-08 09:58:46');
/*!40000 ALTER TABLE `tab_demandas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_departamentos`
--

DROP TABLE IF EXISTS `tab_departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_departamentos` (
  `ID_DPTO` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` varchar(100) NOT NULL,
  `DATA_CAD` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DATA_UPDATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_DPTO`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_departamentos`
--

LOCK TABLES `tab_departamentos` WRITE;
/*!40000 ALTER TABLE `tab_departamentos` DISABLE KEYS */;
INSERT INTO `tab_departamentos` VALUES (1,'T.I  - Tecnologia da Informação','2021-08-31 20:17:36','2021-08-10 20:32:44'),(2,'SECRETARIA','2021-07-12 03:00:00',NULL),(3,'UEM','2021-07-12 03:00:00',NULL),(4,'NAE','2021-07-12 03:00:00',NULL),(5,'BIBLIOTECA','2021-07-12 03:00:00',NULL),(6,'LAB. ANATOMIA','2021-07-12 03:00:00',NULL),(7,'MANUTENCAO','2021-07-12 03:00:00',NULL),(8,'RH','2021-07-12 03:00:00',NULL),(9,'Diretoria','2021-07-12 03:00:00',NULL),(10,'Pos-Graduacao','2021-07-12 03:00:00',NULL);
/*!40000 ALTER TABLE `tab_departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_funcoes`
--

DROP TABLE IF EXISTS `tab_funcoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_funcoes` (
  `ID_FUNCAO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DPTO` int(11) NOT NULL,
  `DESCRICAO` varchar(100) NOT NULL,
  `DATA_CAD` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DATA_UPDATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_FUNCAO`),
  KEY `ID_DPTO` (`ID_DPTO`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_funcoes`
--

LOCK TABLES `tab_funcoes` WRITE;
/*!40000 ALTER TABLE `tab_funcoes` DISABLE KEYS */;
INSERT INTO `tab_funcoes` VALUES (1,1,'Coordenador','2021-07-12 03:00:00',NULL),(2,1,'DESENVOLVEDOR','2021-07-12 03:00:00',NULL),(3,1,'ANALISTA DE T.I','2021-07-12 03:00:00',NULL),(4,1,'ANALISTA DE INFRA.','2021-07-12 03:00:00',NULL),(5,2,'Sec. Geral','2021-07-12 03:00:00',NULL),(6,2,'Aux. de Secretaria','2021-07-12 03:00:00',NULL),(8,3,'Aux. Administrativo','2021-07-12 03:00:00',NULL),(9,4,'Coordenador','2021-07-12 03:00:00',NULL),(11,5,'Bibliotecario','2021-07-12 03:00:00',NULL),(12,5,'Aux. de Biblioteca','2021-07-12 03:00:00',NULL),(14,6,'Aux. de Laboratorio','2021-07-12 03:00:00',NULL),(16,7,'Aux. de manutencao','2021-07-12 03:00:00',NULL),(17,8,'Analista RH','2021-07-12 03:00:00',NULL),(18,8,'Aux. de RH','2021-07-12 03:00:00',NULL),(19,9,'Dir. Geral','2021-07-12 03:00:00',NULL),(20,9,'Dir. Financeiro','2021-07-12 03:00:00',NULL),(21,9,'Dir. Academico','2021-07-12 03:00:00',NULL),(22,10,'Coordenacao','2021-07-12 03:00:00',NULL),(23,1,'Suporte I','2022-03-08 11:49:31','2022-03-08 11:49:31');
/*!40000 ALTER TABLE `tab_funcoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_imagens`
--

DROP TABLE IF EXISTS `tab_imagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_imagens` (
  `ID_IMAGEM` int(11) NOT NULL AUTO_INCREMENT,
  `IMAGEM` varchar(200) DEFAULT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  `NM_CHAMADO` varchar(200) DEFAULT NULL,
  `DATA_CAD` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_IMAGEM`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_imagens`
--

LOCK TABLES `tab_imagens` WRITE;
/*!40000 ALTER TABLE `tab_imagens` DISABLE KEYS */;
INSERT INTO `tab_imagens` VALUES (15,'grande.jpg',1,'20210827162615','2021-08-27 16:26:15'),(16,'2021-07-21_10h45_00.png',1,'20210827162615','2021-08-27 16:26:15'),(17,'2021-07-21_13h40_59.png',1,'20210827162615','2021-08-27 16:26:15'),(18,'2021-07-21_13h41_54.png',1,'20210827162615','2021-08-27 16:26:15'),(19,'2021-08-17_14h40_44.png',1,'20210827163406','2021-08-27 16:34:06'),(20,'2021-07-28_13h32_30.png',1,'20210827164451','2021-08-27 16:44:51'),(21,'2021-08-03_17h22_43.png',1,'20210830143844','2021-08-30 14:38:44'),(22,'2021-08-03_17h24_30.png',1,'20210830143844','2021-08-30 14:38:44'),(23,'2021-08-03_17h35_45.png',1,'20210830143844','2021-08-30 14:38:44'),(24,'2021-07-02_08h50_43.png',1,'20210827162615','2021-08-31 10:41:49'),(25,'2021-07-15_07h58_10.png',1,'20210827162615','2021-08-31 10:41:49'),(26,'2021-07-15_08h07_12.mp4.png',1,'20210827162615','2021-08-31 10:41:49'),(27,'2021-08-31_11h36_30.png',1,'20210713181000','2021-08-31 14:16:29'),(28,'1622484789.png',1,'20210713181000','2021-08-31 14:16:29'),(29,'grande.jpg',1,'20210713181000','2021-08-31 14:16:29'),(30,'1622484739.png',1,'20210713181059','2021-08-31 14:22:46'),(31,'1622484789.png',1,'20210713181059','2021-08-31 14:22:46'),(32,'grande.jpg',1,'20210713181059','2021-08-31 14:22:46'),(33,'1622484789.png',1,'20210827164151','2021-08-31 16:16:43'),(34,'grande.jpg',1,'20210827164151','2021-08-31 16:16:43'),(35,'imagem-1.jpg',1,'20210827164151','2021-08-31 16:16:43'),(36,'AlinhamentoEducacional (1).xlsx',1,'20210830143844','2021-09-01 09:04:31'),(37,'2021-07-02_08h50_43.png',9,'20210903172216','2021-09-03 17:22:16'),(38,'2021-07-15_07h58_10.png',9,'20210903172216','2021-09-03 17:22:16'),(39,'2021-07-15_08h07_12.mp4',9,'20210903172216','2021-09-03 17:22:16'),(40,'2021-09-03_15h46_28.png',9,'20210903172216','2021-09-03 17:22:16'),(41,'2021-09-03_15h46_28.png',9,'20210903172305','2021-09-03 17:23:05'),(42,'2021-09-03_15h46_28.png',9,'20210903172824','2021-09-03 17:28:24'),(43,'2021-09-03_15h46_28.png',9,'20210903172846','2021-09-03 17:28:46'),(44,'2021-09-03_15h46_28.png',9,'20210903172955','2021-09-03 17:29:55'),(45,'2021-07-15_08h07_12.mp4',9,'20210903174659','2021-09-03 17:46:59'),(46,'2021-09-03_15h46_28.png',1,'20210910095056','2021-09-10 09:50:56'),(47,'2021-09-01_08h28_26.png',1,'20210910102258','2021-09-10 10:22:58'),(48,'banco_questoes.png',1,'20211021152243','2021-10-25 09:24:03'),(49,'Busca_questao.png',1,'20211021152243','2021-10-25 09:24:03'),(50,'banco_questoes.png',1,'20210713181000','2021-10-27 08:25:00'),(51,'BONI.jpg',1,'20210713181000','2021-10-27 08:25:00'),(52,'Busca_questao.png',1,'20210713181000','2021-10-27 08:25:00'),(53,'WhatsApp Image 2021-10-27 at 08.45.43 (1).jpeg',1,'20211021152243','2021-10-27 08:52:36'),(54,'WhatsApp Image 2021-10-27 at 08.45.43.jpeg',1,'20211021152243','2021-10-27 08:52:36'),(55,'WhatsApp Image 2021-10-27 at 08.45.44 (1).jpeg',1,'20211021152243','2021-10-27 08:52:36'),(56,'WhatsApp Image 2021-10-27 at 08.45.44.jpeg',1,'20211021152243','2021-10-27 08:52:36'),(57,'WhatsApp Image 2021-10-27 at 08.45.43 (1).jpeg',1,'20210713181000','2021-10-27 09:21:53'),(58,'WhatsApp Image 2021-10-27 at 08.45.43.jpeg',1,'20210713181000','2021-10-27 09:21:53'),(59,'WhatsApp Image 2021-10-27 at 08.45.44 (1).jpeg',1,'20210713181000','2021-10-27 09:21:53'),(60,'WhatsApp Image 2021-10-27 at 08.45.44.jpeg',1,'20210713181000','2021-10-27 09:21:53'),(61,'2021-06-30_16h59_19.png',1,'20211021153908','2021-10-27 16:31:14'),(62,'2021-06-30_17h40_10.png',1,'20211021153908','2021-10-27 16:31:14'),(63,'2021-07-01_09h35_38.png',1,'20211021153908','2021-10-27 16:31:14'),(64,'2021-07-02_08h50_43.png',1,'20211021153908','2021-10-27 16:31:14'),(65,'2021-07-15_07h58_10.png',1,'20220308100014','2022-03-08 10:00:14'),(66,'2021-09-03_15h46_28.png',12,'20220309113524','2022-03-09 11:35:24'),(67,'2021-08-11_14h29_25.png',1,'20210903174659','2022-03-31 16:27:05'),(68,'2021-08-17_14h40_44.png',1,'20210903174659','2022-03-31 16:27:05');
/*!40000 ALTER TABLE `tab_imagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_interacao_chamados`
--

DROP TABLE IF EXISTS `tab_interacao_chamados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_interacao_chamados` (
  `ID_INTERACAO_CHAMADO` int(11) NOT NULL AUTO_INCREMENT,
  `INT_DESC_CHAMADO` longtext NOT NULL,
  `ID_CHAMADO` int(11) NOT NULL,
  `INT_DATA_CAD` date NOT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_INTERACAO_CHAMADO`),
  KEY `ID_CHAMADO` (`ID_CHAMADO`),
  CONSTRAINT `ID_CHAMADO` FOREIGN KEY (`ID_CHAMADO`) REFERENCES `tab_chamados` (`ID_CHAMADO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_interacao_chamados`
--

LOCK TABLES `tab_interacao_chamados` WRITE;
/*!40000 ALTER TABLE `tab_interacao_chamados` DISABLE KEYS */;
INSERT INTO `tab_interacao_chamados` VALUES (1,'Problema resolvido, favor tentar novamente',1,'2021-07-12',1),(4,'CHAMADO SERÃ ENCERRADO EM BREVE',2,'2021-07-14',1),(5,'TESTE NO CHAMADO  - 20210713181000',1,'2021-07-14',1),(6,'teste interaÃ§Ã£o como o usuÃ¡rio correto',1,'2021-07-14',1),(7,'teste troca de atendente',1,'2021-07-14',1),(8,'teste troca de status de aberto para em atendimento.',3,'2021-07-14',1),(12,'teste',34,'2021-08-30',1),(13,'Teste de interação com imagem.',34,'2021-08-30',1),(14,'Teste de inclusão de imagem .',34,'2021-08-30',1),(15,'TESTE',34,'2021-08-30',1),(16,'teste mais uma vez',34,'2021-08-30',1),(17,'teste de anexo de arquivo pela interacao.',34,'2021-08-31',1),(18,'teste',1,'2021-08-31',1),(19,'teste de interação parte 1000',1,'2021-08-31',1),(20,'teste em 31/08/2021 as 14:22',2,'2021-08-31',1),(21,'Teste de anexo de arquivos.',36,'2021-08-31',1),(22,'teste de arquivo diferente de imagem.',38,'2021-09-01',1),(23,'Interação realizada com sucesso.',46,'2021-09-15',1),(24,'Foi implementado botões na tela de busca de questões e na tela de banco de questões, por favor, testar!',47,'2021-10-25',1),(25,'teste de interação - envio de email',1,'2021-10-25',1),(26,'segundo teste de interação  - Envio de e-mail.',1,'2021-10-25',1),(27,'Terceiro teste de interação  - Envio de e-mail.',1,'2021-10-25',1),(28,'Quarto teste de interação - Envio de E-mail 4',42,'2021-10-25',1),(29,'teste',1,'2021-10-27',1),(30,'Prezados, bom dia. Seguem as imagens com as sugestões discutidas com os docentes para o sistema de questões.',47,'2021-10-27',1),(31,'teste via IP',1,'2021-10-27',1),(32,'teste de usuário',47,'2021-10-27',9),(33,'teste envio de vários arquivos',48,'2021-10-27',1),(34,'teste....',46,'2021-12-08',1),(35,'teste de interação sem anexo.',43,'2022-03-31',1),(36,'Novo teste de interação com anexo.',43,'2022-03-31',1),(37,'teste nova interação',43,'2022-04-01',1);
/*!40000 ALTER TABLE `tab_interacao_chamados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_pessoas`
--

DROP TABLE IF EXISTS `tab_pessoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_pessoas` (
  `ID_PESSOA` int(11) NOT NULL AUTO_INCREMENT,
  `PESSOA_NOME` varchar(100) NOT NULL,
  `PESSOA_FOTO` varchar(200) DEFAULT NULL,
  `EMAIL` varchar(45) DEFAULT NULL,
  `PESSOA_CPF` varchar(20) NOT NULL,
  `PESSOA_CEP` varchar(45) DEFAULT NULL,
  `PESSOA_END` varchar(100) DEFAULT NULL,
  `PESSOA_BAIRRO` varchar(50) DEFAULT NULL,
  `PESSOA_TEL` varchar(45) DEFAULT NULL,
  `PESSOA_STATUS` varchar(1) NOT NULL,
  `ID_DPTO` int(11) NOT NULL,
  `ID_FUNCAO` int(11) NOT NULL,
  `DATA_CAD` date NOT NULL,
  `DATA_UPDATE` datetime DEFAULT NULL,
  `USUARIO` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`ID_PESSOA`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_pessoas`
--

LOCK TABLES `tab_pessoas` WRITE;
/*!40000 ALTER TABLE `tab_pessoas` DISABLE KEYS */;
INSERT INTO `tab_pessoas` VALUES (1,'Elcinei Saldanha','1625516650.png','ti@facisb.edu.br','523.794.502-34','14.781-186','Jardim dos Coqueiros','Jardim dos Coqueiros','(17)99888-6226','A',1,1,'2021-07-02','0000-00-00 00:00:00','S'),(3,'Sergio Martins','1625669629.png','sergio@facisb.edu.br','523.794.502-88','14.780-300','Centro','Centro','(12)54461-9845','A',1,1,'2021-07-07','0000-00-00 00:00:00','S'),(6,'Franchico Antonio','1625777288.png','chico@antonio.com.br','156.126.408-38','14.780-300','Barone','Barone','(17)99865-5248','A',1,1,'2021-07-08','0000-00-00 00:00:00','S'),(7,'Viviane','1630441299.jpg','viviane@facisb.edu.br','584.552.165-46','14.780-300','Centro','Centro','(17)32216-0606','A',2,5,'2021-07-12','0000-00-00 00:00:00','S'),(8,'FULANO DE TAL','1630700283.png','fulano@fulano.com','549.494.949-49','14.780-630','Rua 26','Boa Vista','(17)33224-5897','I',7,9,'2021-09-03','2022-03-11 10:01:49','S'),(9,'Robson Aparecido dos Santos Boni','1634840381.jpg','robsonboni@facisb.edu.br','320.882.518-80','14.781-449','Avenida C-12','Cristiano de Carvalho','(17)98192-5193','A',6,9,'2021-10-21','0000-00-00 00:00:00','S'),(10,'Renato Prevideli','1637171643.png','renato@prevideli.com','007.008.009-10','14.781-471','Rua C-27','Cristiano de Carvalho','(17)33225-5888','A',9,20,'2021-11-17','0000-00-00 00:00:00','S'),(11,'Caio Renato Teixeira','1646750614.jpg','caio@facisb.edu.br','329.331.868-10','14.783-027','Avenida Sinomar Macedo Diniz','Jardim Silvia','(17)98805-1211','A',7,1,'2022-03-08','0000-00-00 00:00:00','S');
/*!40000 ALTER TABLE `tab_pessoas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_usuarios`
--

DROP TABLE IF EXISTS `tab_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_usuarios` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PESSOA` int(11) NOT NULL,
  `ID_DPTO` int(11) DEFAULT NULL,
  `EMAIL` varchar(80) NOT NULL,
  `CPF` varchar(20) DEFAULT NULL,
  `USU_LOGIN` varchar(50) NOT NULL,
  `USU_SENHA` varchar(250) NOT NULL,
  `USU_STATUS` varchar(1) NOT NULL,
  `USU_NIVEL` varchar(45) NOT NULL,
  `FOTO` varchar(200) DEFAULT NULL,
  `USU_DATA_CAD` date DEFAULT NULL,
  `USU_DATA_UPDATE` date DEFAULT NULL,
  `SENHA` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  KEY `ID_PESSOA` (`ID_PESSOA`),
  CONSTRAINT `ID_PESSOA` FOREIGN KEY (`ID_PESSOA`) REFERENCES `tab_pessoas` (`ID_PESSOA`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_usuarios`
--

LOCK TABLES `tab_usuarios` WRITE;
/*!40000 ALTER TABLE `tab_usuarios` DISABLE KEYS */;
INSERT INTO `tab_usuarios` VALUES (1,1,1,'ti@facisb.edu.br','523.794.502-34','Elcinei Saldanha','$2y$10$I/iCsnAqGiyBAA.VAmDN0O/zeCFLjPK9bdNJlVUS19jv3CIu1X1k2','A','A','1625516650.png','2021-07-08','2021-08-30','salnei'),(2,3,1,'sergio@facisb.edu.br','523.794.502-88','Sergio Martins','$2y$10$4a.R3JTHk1dXjy9klbE7zeyoCtXnM0OaWtUYCBcsI2LnrQXJIYkky','A','A','1625669629.png','2021-07-08','2021-08-10','salnei'),(6,6,2,'chico@antonio.com.br',NULL,'chico-1','$2y$10$hTkJWbTOMc/za.PjR2CL5eS6QwgpFIUupYpIdeydvFj4Y1XQNzB4.','A','C','1625777288.png','2021-07-08','2021-07-08','salnei'),(7,7,2,'viviane@facisb.edu.br','584.552.165-46','Viviane Silva','$2y$10$yXDEjLDIAPxE6BMY/IsxDuX7tUUPZaGlyjKMeYJmHMHx5pU46mjDO','A','S','1626103887.png','2021-07-29','2022-03-10','salnei'),(9,8,7,'fulano@fulano.com',NULL,'Fulano Usuário','$2y$10$Odmw1f3wtGNIv7h2kAFpEepFREeyf.uzopolRoqokylQ1NZUBzPMy','A','S','1630700283.png','2021-09-03','2021-09-03','salnei'),(10,9,6,'robsonboni@facisb.edu.br',NULL,'Robson Boni','$2y$10$Xwjvy3v0r2hWGNoGHh92k.2FVRkJDumM3vWxi9tpybPS0bhkk/fnC','A','C','1634840381.jpg','2021-10-21','2021-10-21','facisb'),(11,10,9,'renato@prevideli.com','007.008.009-10','Renatim','$2y$10$lp9AfEJzgfvd/v.7f4X45Oya6Gxv.eCkMTkphFtzinEMIY4fjp8tm','A','S','1637171643.png','2021-11-17','2021-11-17','salnei123'),(12,11,7,'caio@facisb.edu.br','329.331.868-10','Caio Teixeira','$2y$10$9L7CvZ19JKu6lrfV7SrRaufBVCPoE4KAJGuF4nQECkS2RQHkG0iti','A','S','1646750614.jpg','2022-03-08','2022-03-08','facisb');
/*!40000 ALTER TABLE `tab_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-01 11:08:36
