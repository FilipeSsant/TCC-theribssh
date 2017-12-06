-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: dbtheribssh
-- ------------------------------------------------------
-- Server version	5.7.20-log

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
-- Table structure for table `tbl_avaliacao`
--

DROP TABLE IF EXISTS `tbl_avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_avaliacao` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `nota` float NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(200) NOT NULL,
  PRIMARY KEY (`id_avaliacao`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_avaliacao`
--

LOCK TABLES `tbl_avaliacao` WRITE;
/*!40000 ALTER TABLE `tbl_avaliacao` DISABLE KEYS */;
INSERT INTO `tbl_avaliacao` VALUES (1,4,'Ótimo','a'),(2,3,'Bom','b'),(3,2,'Regular','c'),(4,1,'Ruim','d');
/*!40000 ALTER TABLE `tbl_avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_banco`
--

DROP TABLE IF EXISTS `tbl_banco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_banco` (
  `id_banco` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `logo` varchar(200) NOT NULL,
  PRIMARY KEY (`id_banco`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_banco`
--

LOCK TABLES `tbl_banco` WRITE;
/*!40000 ALTER TABLE `tbl_banco` DISABLE KEYS */;
INSERT INTO `tbl_banco` VALUES (1,'Mastercard','arquivos/logo_banco/mastercard-logo-473b8726a9-seeklogo.png'),(2,'Visa','arquivos/logo_banco/visa-logo-6f4057663d-seeklogo.png');
/*!40000 ALTER TABLE `tbl_banco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_boleto`
--

DROP TABLE IF EXISTS `tbl_boleto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_boleto` (
  `id_boleto` int(11) NOT NULL AUTO_INCREMENT,
  `id_banco` int(11) NOT NULL,
  `id_pedidocompra` int(11) NOT NULL,
  `num_identificacao` varchar(50) NOT NULL,
  `data_vencimento` date NOT NULL,
  `valor` float NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_boleto`),
  KEY `fk_id_pedidocompra_idx` (`id_pedidocompra`),
  KEY `fk_id_banco_idx` (`id_banco`),
  CONSTRAINT `fk_id_banco2` FOREIGN KEY (`id_banco`) REFERENCES `tbl_banco` (`id_banco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_pedidocompra2` FOREIGN KEY (`id_pedidocompra`) REFERENCES `tbl_pedidocompra` (`id_pedidocompra`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_boleto`
--

LOCK TABLES `tbl_boleto` WRITE;
/*!40000 ALTER TABLE `tbl_boleto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_boleto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cardapio`
--

DROP TABLE IF EXISTS `tbl_cardapio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cardapio` (
  `id_cardapio` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_cardapio`),
  KEY `fk_restauranteCardapio_idx` (`id_restaurante`),
  CONSTRAINT `fk_restauranteCardapio` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cardapio`
--

LOCK TABLES `tbl_cardapio` WRITE;
/*!40000 ALTER TABLE `tbl_cardapio` DISABLE KEYS */;
INSERT INTO `tbl_cardapio` VALUES (6,1,'Cardápio Oficial',1),(7,2,'Cardápio Barueri',1);
/*!40000 ALTER TABLE `tbl_cardapio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cardapioproduto`
--

DROP TABLE IF EXISTS `tbl_cardapioproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cardapioproduto` (
  `id_cardapioProduto` int(11) NOT NULL AUTO_INCREMENT,
  `id_cardapio` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `principais` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_cardapioProduto`),
  KEY `fk_cardapio_idx` (`id_cardapio`),
  KEY `fk_produtocardapio_idx` (`id_produto`),
  CONSTRAINT `fk_cardapio` FOREIGN KEY (`id_cardapio`) REFERENCES `tbl_cardapio` (`id_cardapio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtocardapio` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cardapioproduto`
--

LOCK TABLES `tbl_cardapioproduto` WRITE;
/*!40000 ALTER TABLE `tbl_cardapioproduto` DISABLE KEYS */;
INSERT INTO `tbl_cardapioproduto` VALUES (22,6,5,1),(23,6,6,0),(24,6,7,0),(25,7,5,0),(26,7,7,0);
/*!40000 ALTER TABLE `tbl_cardapioproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cargo`
--

DROP TABLE IF EXISTS `tbl_cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cargo` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cargo`
--

LOCK TABLES `tbl_cargo` WRITE;
/*!40000 ALTER TABLE `tbl_cargo` DISABLE KEYS */;
INSERT INTO `tbl_cargo` VALUES (20,'Administrador'),(21,'Cozinheiro'),(22,'Garçom');
/*!40000 ALTER TABLE `tbl_cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cargopermissao`
--

DROP TABLE IF EXISTS `tbl_cargopermissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cargopermissao` (
  `id_cargoPermissao` int(11) NOT NULL AUTO_INCREMENT,
  `id_cargo` int(11) NOT NULL,
  `id_permissao` int(11) NOT NULL,
  PRIMARY KEY (`id_cargoPermissao`),
  KEY `fk_id_cargo_idx` (`id_cargo`),
  KEY `fk_id_permissao_idx` (`id_permissao`),
  CONSTRAINT `fk_id_cargo2` FOREIGN KEY (`id_cargo`) REFERENCES `tbl_cargo` (`id_cargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_permissao` FOREIGN KEY (`id_permissao`) REFERENCES `tbl_permissao` (`id_permissao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cargopermissao`
--

LOCK TABLES `tbl_cargopermissao` WRITE;
/*!40000 ALTER TABLE `tbl_cargopermissao` DISABLE KEYS */;
INSERT INTO `tbl_cargopermissao` VALUES (89,20,1),(90,20,2),(91,20,3),(92,20,4),(93,20,5),(94,20,6),(95,20,7),(96,20,8),(97,20,9),(98,20,10),(99,20,11),(100,20,12),(101,20,13),(102,20,14),(103,20,15),(104,20,16),(105,20,17),(106,21,4),(107,21,6),(108,21,7),(109,22,1);
/*!40000 ALTER TABLE `tbl_cargopermissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cartaocredito`
--

DROP TABLE IF EXISTS `tbl_cartaocredito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cartaocredito` (
  `id_cartaocredito` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `nome_cartao` varchar(100) NOT NULL,
  `data` varchar(7) NOT NULL,
  `cvv` varchar(5) NOT NULL,
  PRIMARY KEY (`id_cartaocredito`),
  KEY `fk_id_cliente_idx` (`id_cliente`),
  KEY `fk_id_banco_idx` (`id_banco`),
  CONSTRAINT `fk_id_banco` FOREIGN KEY (`id_banco`) REFERENCES `tbl_banco` (`id_banco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_cliente3` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cartaocredito`
--

LOCK TABLES `tbl_cartaocredito` WRITE;
/*!40000 ALTER TABLE `tbl_cartaocredito` DISABLE KEYS */;
INSERT INTO `tbl_cartaocredito` VALUES (1,3,1,'6541 6546 5351 6556','BEATRIZ CASTRO','12/2017','123'),(4,7,2,'6666 6666 6666 6666','NOé','25/2018','666'),(5,8,1,'6523','YTJUHYHJ','02/2017','484');
/*!40000 ALTER TABLE `tbl_cartaocredito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `imagem` varchar(200) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (1,'Steakhouse','arquivos/icones_categorias/steak (2).png'),(3,'Vegetariano','arquivos/icones_categorias/broccoli.png'),(4,'Saúdavel','arquivos/icones_categorias/cabbage.png');
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cidade`
--

DROP TABLE IF EXISTS `tbl_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cidade` (
  `id_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  PRIMARY KEY (`id_cidade`),
  KEY `fk_id_estado_idx` (`id_estado`),
  CONSTRAINT `fk_id_estado` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5572 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cidade`
--

LOCK TABLES `tbl_cidade` WRITE;
/*!40000 ALTER TABLE `tbl_cidade` DISABLE KEYS */;
INSERT INTO `tbl_cidade` VALUES (1,1,'Jandira'),(2,1,'Barueri'),(3,1,'Osasco'),(4,2,'Niterói'),(5,2,'Angra dos Reis'),(6,2,'Paraty'),(7,1,'Carapícuiba'),(8,19,'Apiacá'),(9,19,'Aracruz'),(10,19,'Atilio Vivacqua'),(11,19,'Baixo Guandu'),(12,19,'Barra de São Francisco'),(13,19,'Boa Esperança'),(14,19,'Bom Jesus do Norte'),(15,19,'Brejetuba'),(16,19,'Cachoeiro de Itapemirim'),(17,19,'Cariacica'),(18,19,'Castelo'),(19,19,'Colatina'),(20,19,'Conceição da Barra'),(21,19,'Conceição do Castelo'),(22,19,'Divino de São Lourenço'),(23,19,'Domingos Martins'),(24,19,'Dores do Rio Preto'),(25,19,'Ecoporanga'),(26,19,'Fundão'),(27,19,'Governador Lindenberg'),(28,19,'Guaçuí'),(29,19,'Guarapari'),(30,19,'Ibatiba'),(31,19,'Ibiraçu'),(32,19,'Ibitirama'),(33,19,'Iconha'),(34,19,'Irupi'),(35,19,'Itaguaçu'),(36,19,'Itapemirim'),(37,19,'Itarana'),(38,19,'Iúna'),(39,19,'Jaguaré'),(40,19,'Jerônimo Monteiro'),(41,19,'João Neiva'),(42,19,'Laranja da Terra'),(43,19,'Linhares'),(44,19,'Mantenópolis'),(45,19,'Marataízes'),(46,19,'Marechal Floriano'),(47,19,'Marilândia'),(48,19,'Mimoso do Sul'),(49,19,'Montanha'),(50,19,'Mucurici'),(51,19,'Muniz Freire'),(52,19,'Muqui'),(53,19,'Nova Venécia'),(54,19,'Pancas'),(55,19,'Pedro Canário'),(56,19,'Pinheiros'),(57,19,'Piúma'),(58,19,'Ponto Belo'),(59,19,'Presidente Kennedy'),(60,19,'Rio Bananal'),(61,19,'Rio Novo do Sul'),(62,19,'Santa Leopoldina'),(63,19,'Santa Maria de Jetibá'),(64,19,'Santa Teresa'),(65,19,'São Domingos do Norte'),(66,19,'São Gabriel da Palha'),(67,19,'São José do Calçado'),(68,19,'São Mateus'),(69,19,'São Roque do Canaã'),(70,19,'Serra'),(71,19,'Sooretama'),(72,19,'Vargem Alta'),(73,19,'Venda Nova do Imigrante'),(74,19,'Viana'),(75,19,'Vila Pavão'),(76,19,'Vila Valério'),(77,19,'Vila Velha'),(78,19,'Vitória'),(79,3,'Acrelândia'),(80,3,'Assis Brasil'),(81,3,'Brasiléia'),(82,3,'Bujari'),(83,3,'Capixaba'),(84,3,'Cruzeiro do Sul'),(85,3,'Epitaciolândia'),(86,3,'Feijó'),(87,3,'Jordão'),(88,3,'Mâncio Lima'),(89,3,'Manoel Urbano'),(90,3,'Marechal Thaumaturgo'),(91,3,'Plácido de Castro'),(92,3,'Porto Acre'),(93,3,'Porto Walter'),(94,3,'Rio Branco'),(95,3,'Rodrigues Alves'),(96,3,'Santa Rosa do Purus'),(97,3,'Sena Madureira'),(98,3,'Senador Guiomard'),(99,3,'Tarauacá'),(100,3,'Xapuri'),(101,4,'Água Branca'),(102,4,'Anadia'),(103,4,'Arapiraca'),(104,4,'Atalaia'),(105,4,'Barra de Santo Antônio'),(106,4,'Barra de São Miguel'),(107,4,'Batalha'),(108,4,'Belém'),(109,4,'Belo Monte'),(110,4,'Boca da Mata'),(111,4,'Branquinha'),(112,4,'Cacimbinhas'),(113,4,'Cajueiro'),(114,4,'Campestre'),(115,4,'Campo Alegre'),(116,4,'Campo Grande'),(117,4,'Canapi'),(118,4,'Capela'),(119,4,'Carneiros'),(120,4,'Chã Preta'),(121,4,'Coité do Nóia'),(122,4,'Colônia Leopoldina'),(123,4,'Coqueiro Seco'),(124,4,'Coruripe'),(125,4,'Craíbas'),(126,4,'Delmiro Gouveia'),(127,4,'Dois Riachos'),(128,4,'Estrela de Alagoas'),(129,4,'Feira Grande'),(130,4,'Feliz Deserto'),(131,4,'Flexeiras'),(132,4,'Girau do Ponciano'),(133,4,'Ibateguara'),(134,4,'Igaci'),(135,4,'Igreja Nova'),(136,4,'Inhapi'),(137,4,'Jacaré dos Homens'),(138,4,'Jacuípe'),(139,4,'Japaratinga'),(140,4,'Jaramataia'),(141,4,'Jequiá da Praia'),(142,4,'Joaquim Gomes'),(143,4,'Jundiá'),(144,4,'Junqueiro'),(145,4,'Lagoa da Canoa'),(146,4,'Limoeiro de Anadia'),(147,4,'Maceió'),(148,4,'Major Isidoro'),(149,4,'Mar Vermelho'),(150,4,'Maragogi'),(151,4,'Maravilha'),(152,4,'Marechal Deodoro'),(153,4,'Maribondo'),(154,4,'Mata Grande'),(155,4,'Matriz de Camaragibe'),(156,4,'Messias'),(157,4,'Minador do Negrão'),(158,4,'Monteirópolis'),(159,4,'Murici'),(160,4,'Novo Lino'),(161,4,'Olho d`Água das Flores'),(162,4,'Olho d`Água do Casado'),(163,4,'Olho d`Água Grande'),(164,4,'Olivença'),(165,4,'Ouro Branco'),(166,4,'Palestina'),(167,4,'Palmeira dos Índios'),(168,4,'Pão de Açúcar'),(169,4,'Pariconha'),(170,4,'Paripueira'),(171,4,'Passo de Camaragibe'),(172,4,'Paulo Jacinto'),(173,4,'Penedo'),(174,4,'Piaçabuçu'),(175,4,'Pilar'),(176,4,'Pindoba'),(177,4,'Piranhas'),(178,4,'Poço das Trincheiras'),(179,4,'Porto Calvo'),(180,4,'Porto de Pedras'),(181,4,'Porto Real do Colégio'),(182,4,'Quebrangulo'),(183,4,'Rio Largo'),(184,4,'Roteiro'),(185,4,'Santa Luzia do Norte'),(186,4,'Santana do Ipanema'),(187,4,'Santana do Mundaú'),(188,4,'São Brás'),(189,4,'São José da Laje'),(190,4,'São José da Tapera'),(191,4,'São Luís do Quitunde'),(192,4,'São Miguel dos Campos'),(193,4,'São Miguel dos Milagres'),(194,4,'São Sebastião'),(195,4,'Satuba'),(196,4,'Senador Rui Palmeira'),(197,4,'Tanque d`Arca'),(198,4,'Taquarana'),(199,4,'Teotônio Vilela'),(200,4,'Traipu'),(201,4,'União dos Palmares'),(202,4,'Viçosa'),(203,7,'Amapá'),(204,7,'Calçoene'),(205,7,'Cutias'),(206,7,'Ferreira Gomes'),(207,7,'Itaubal'),(208,7,'Laranjal do Jari'),(209,7,'Macapá'),(210,7,'Mazagão'),(211,7,'Oiapoque'),(212,7,'Pedra Branca do Amaparí'),(213,7,'Porto Grande'),(214,7,'Pracuúba'),(215,7,'Santana'),(216,7,'Serra do Navio'),(217,7,'Tartarugalzinho'),(218,7,'Vitória do Jari'),(219,5,'Alvarães'),(220,5,'Amaturá'),(221,5,'Anamã'),(222,5,'Anori'),(223,5,'Apuí'),(224,5,'Atalaia do Norte'),(225,5,'Autazes'),(226,5,'Barcelos'),(227,5,'Barreirinha'),(228,5,'Benjamin Constant'),(229,5,'Beruri'),(230,5,'Boa Vista do Ramos'),(231,5,'Boca do Acre'),(232,5,'Borba'),(233,5,'Caapiranga'),(234,5,'Canutama'),(235,5,'Carauari'),(236,5,'Careiro'),(237,5,'Careiro da Várzea'),(238,5,'Coari'),(239,5,'Codajás'),(240,5,'Eirunepé'),(241,5,'Envira'),(242,5,'Fonte Boa'),(243,5,'Guajará'),(244,5,'Humaitá'),(245,5,'Ipixuna'),(246,5,'Iranduba'),(247,5,'Itacoatiara'),(248,5,'Itamarati'),(249,5,'Itapiranga'),(250,5,'Japurá'),(251,5,'Juruá'),(252,5,'Jutaí'),(253,5,'Lábrea'),(254,5,'Manacapuru'),(255,5,'Manaquiri'),(256,5,'Manaus'),(257,5,'Manicoré'),(258,5,'Maraã'),(259,5,'Maués'),(260,5,'Nhamundá'),(261,5,'Nova Olinda do Norte'),(262,5,'Novo Airão'),(263,5,'Novo Aripuanã'),(264,5,'Parintins'),(265,5,'Pauini'),(266,5,'Presidente Figueiredo'),(267,5,'Rio Preto da Eva'),(268,5,'Santa Isabel do Rio Negro'),(269,5,'Santo Antônio do Içá'),(270,5,'São Gabriel da Cachoeira'),(271,5,'São Paulo de Olivença'),(272,5,'São Sebastião do Uatumã'),(273,5,'Silves'),(274,5,'Tabatinga'),(275,5,'Tapauá'),(276,5,'Tefé'),(277,5,'Tonantins'),(278,5,'Uarini'),(279,5,'Urucará'),(280,5,'Urucurituba'),(281,11,'Abaíra'),(282,11,'Abaré'),(283,11,'Acajutiba'),(284,11,'Adustina'),(285,11,'Água Fria'),(286,11,'Aiquara'),(287,11,'Alagoinhas'),(288,11,'Alcobaça'),(289,11,'Almadina'),(290,11,'Amargosa'),(291,11,'Amélia Rodrigues'),(292,11,'América Dourada'),(293,11,'Anagé'),(294,11,'Andaraí'),(295,11,'Andorinha'),(296,11,'Angical'),(297,11,'Anguera'),(298,11,'Antas'),(299,11,'Antônio Cardoso'),(300,11,'Antônio Gonçalves'),(301,11,'Aporá'),(302,11,'Apuarema'),(303,11,'Araças'),(304,11,'Aracatu'),(305,11,'Araci'),(306,11,'Aramari'),(307,11,'Arataca'),(308,11,'Aratuípe'),(309,11,'Aurelino Leal'),(310,11,'Baianópolis'),(311,11,'Baixa Grande'),(312,11,'Banzaê'),(313,11,'Barra'),(314,11,'Barra da Estiva'),(315,11,'Barra do Choça'),(316,11,'Barra do Mendes'),(317,11,'Barra do Rocha'),(318,11,'Barreiras'),(319,11,'Barro Alto'),(320,11,'Barro Preto (antigo Gov. Lomanto Jr.)'),(321,11,'Barrocas'),(322,11,'Belmonte'),(323,11,'Belo Campo'),(324,11,'Biritinga'),(325,11,'Boa Nova'),(326,11,'Boa Vista do Tupim'),(327,11,'Bom Jesus da Lapa'),(328,11,'Bom Jesus da Serra'),(329,11,'Boninal'),(330,11,'Bonito'),(331,11,'Boquira'),(332,11,'Botuporã'),(333,11,'Brejões'),(334,11,'Brejolândia'),(335,11,'Brotas de Macaúbas'),(336,11,'Brumado'),(337,11,'Buerarema'),(338,11,'Buritirama'),(339,11,'Caatiba'),(340,11,'Cabaceiras do Paraguaçu'),(341,11,'Cachoeira'),(342,11,'Caculé'),(343,11,'Caém'),(344,11,'Caetanos'),(345,11,'Caetité'),(346,11,'Cafarnaum'),(347,11,'Cairu'),(348,11,'Caldeirão Grande'),(349,11,'Camacan'),(350,11,'Camaçari'),(351,11,'Camamu'),(352,11,'Campo Alegre de Lourdes'),(353,11,'Campo Formoso'),(354,11,'Canápolis'),(355,11,'Canarana'),(356,11,'Canavieiras'),(357,11,'Candeal'),(358,11,'Candeias'),(359,11,'Candiba'),(360,11,'Cândido Sales'),(361,11,'Cansanção'),(362,11,'Canudos'),(363,11,'Capela do Alto Alegre'),(364,11,'Capim Grosso'),(365,11,'Caraíbas'),(366,11,'Caravelas'),(367,11,'Cardeal da Silva'),(368,11,'Carinhanha'),(369,11,'Casa Nova'),(370,11,'Castro Alves'),(371,11,'Catolândia'),(372,11,'Catu'),(373,11,'Caturama'),(374,11,'Central'),(375,11,'Chorrochó'),(376,11,'Cícero Dantas'),(377,11,'Cipó'),(378,11,'Coaraci'),(379,11,'Cocos'),(380,11,'Conceição da Feira'),(381,11,'Conceição do Almeida'),(382,11,'Conceição do Coité'),(383,11,'Conceição do Jacuípe'),(384,11,'Conde'),(385,11,'Condeúba'),(386,11,'Contendas do Sincorá'),(387,11,'Coração de Maria'),(388,11,'Cordeiros'),(389,11,'Coribe'),(390,11,'Coronel João Sá'),(391,11,'Correntina'),(392,11,'Cotegipe'),(393,11,'Cravolândia'),(394,11,'Crisópolis'),(395,11,'Cristópolis'),(396,11,'Cruz das Almas'),(397,11,'Curaçá'),(398,11,'Dário Meira'),(399,11,'Dias d`Ávila'),(400,11,'Dom Basílio'),(401,11,'Dom Macedo Costa'),(402,11,'Elísio Medrado'),(403,11,'Encruzilhada'),(404,11,'Entre Rios'),(405,11,'Érico Cardoso'),(406,11,'Esplanada'),(407,11,'Euclides da Cunha'),(408,11,'Eunápolis'),(409,11,'Fátima'),(410,11,'Feira da Mata'),(411,11,'Feira de Santana'),(412,11,'Filadélfia'),(413,11,'Firmino Alves'),(414,11,'Floresta Azul'),(415,11,'Formosa do Rio Preto'),(416,11,'Gandu'),(417,11,'Gavião'),(418,11,'Gentio do Ouro'),(419,11,'Glória'),(420,11,'Gongogi'),(421,11,'Governador Mangabeira'),(422,11,'Guajeru'),(423,11,'Guanambi'),(424,11,'Guaratinga'),(425,11,'Heliópolis'),(426,11,'Iaçu'),(427,11,'Ibiassucê'),(428,11,'Ibicaraí'),(429,11,'Ibicoara'),(430,11,'Ibicuí'),(431,11,'Ibipeba'),(432,11,'Ibipitanga'),(433,11,'Ibiquera'),(434,11,'Ibirapitanga'),(435,11,'Ibirapuã'),(436,11,'Ibirataia'),(437,11,'Ibitiara'),(438,11,'Ibititá'),(439,11,'Ibotirama'),(440,11,'Ichu'),(441,11,'Igaporã'),(442,11,'Igrapiúna'),(443,11,'Iguaí'),(444,11,'Ilhéus'),(445,11,'Inhambupe'),(446,11,'Ipecaetá'),(447,11,'Ipiaú'),(448,11,'Ipirá'),(449,11,'Ipupiara'),(450,11,'Irajuba'),(451,11,'Iramaia'),(452,11,'Iraquara'),(453,11,'Irará'),(454,11,'Irecê'),(455,11,'Itabela'),(456,11,'Itaberaba'),(457,11,'Itabuna'),(458,11,'Itacaré'),(459,11,'Itaeté'),(460,11,'Itagi'),(461,11,'Itagibá'),(462,11,'Itagimirim'),(463,11,'Itaguaçu da Bahia'),(464,11,'Itaju do Colônia'),(465,11,'Itajuípe'),(466,11,'Itamaraju'),(467,11,'Itamari'),(468,11,'Itambé'),(469,11,'Itanagra'),(470,11,'Itanhém'),(471,11,'Itaparica'),(472,11,'Itapé'),(473,11,'Itapebi'),(474,11,'Itapetinga'),(475,11,'Itapicuru'),(476,11,'Itapitanga'),(477,11,'Itaquara'),(478,11,'Itarantim'),(479,11,'Itatim'),(480,11,'Itiruçu'),(481,11,'Itiúba'),(482,11,'Itororó'),(483,11,'Ituaçu'),(484,11,'Ituberá'),(485,11,'Iuiú'),(486,11,'Jaborandi'),(487,11,'Jacaraci'),(488,11,'Jacobina'),(489,11,'Jaguaquara'),(490,11,'Jaguarari'),(491,11,'Jaguaripe'),(492,11,'Jandaíra'),(493,11,'Jequié'),(494,11,'Jeremoabo'),(495,11,'Jiquiriçá'),(496,11,'Jitaúna'),(497,11,'João Dourado'),(498,11,'Juazeiro'),(499,11,'Jucuruçu'),(500,11,'Jussara'),(501,11,'Jussari'),(502,11,'Jussiape'),(503,11,'Lafaiete Coutinho'),(504,11,'Lagoa Real'),(505,11,'Laje'),(506,11,'Lajedão'),(507,11,'Lajedinho'),(508,11,'Lajedo do Tabocal'),(509,11,'Lamarão'),(510,11,'Lapão'),(511,11,'Lauro de Freitas'),(512,11,'Lençóis'),(513,11,'Licínio de Almeida'),(514,11,'Livramento de Nossa Senhora'),(515,11,'Luís Eduardo Magalhães'),(516,11,'Macajuba'),(517,11,'Macarani'),(518,11,'Macaúbas'),(519,11,'Macururé'),(520,11,'Madre de Deus'),(521,11,'Maetinga'),(522,11,'Maiquinique'),(523,11,'Mairi'),(524,11,'Malhada'),(525,11,'Malhada de Pedras'),(526,11,'Manoel Vitorino'),(527,11,'Mansidão'),(528,11,'Maracás'),(529,11,'Maragogipe'),(530,11,'Maraú'),(531,11,'Marcionílio Souza'),(532,11,'Mascote'),(533,11,'Mata de São João'),(534,11,'Matina'),(535,11,'Medeiros Neto'),(536,11,'Miguel Calmon'),(537,11,'Milagres'),(538,11,'Mirangaba'),(539,11,'Mirante'),(540,11,'Monte Santo'),(541,11,'Morpará'),(542,11,'Morro do Chapéu'),(543,11,'Mortugaba'),(544,11,'Mucugê'),(545,11,'Mucuri'),(546,11,'Mulungu do Morro'),(547,11,'Mundo Novo'),(548,11,'Muniz Ferreira'),(549,11,'Muquém de São Francisco'),(550,11,'Muritiba'),(551,11,'Mutuípe'),(552,11,'Nazaré'),(553,11,'Nilo Peçanha'),(554,11,'Nordestina'),(555,11,'Nova Canaã'),(556,11,'Nova Fátima'),(557,11,'Nova Ibiá'),(558,11,'Nova Itarana'),(559,11,'Nova Redenção'),(560,11,'Nova Soure'),(561,11,'Nova Viçosa'),(562,11,'Novo Horizonte'),(563,11,'Novo Triunfo'),(564,11,'Olindina'),(565,11,'Oliveira dos Brejinhos'),(566,11,'Ouriçangas'),(567,11,'Ourolândia'),(568,11,'Palmas de Monte Alto'),(569,11,'Palmeiras'),(570,11,'Paramirim'),(571,11,'Paratinga'),(572,11,'Paripiranga'),(573,11,'Pau Brasil'),(574,11,'Paulo Afonso'),(575,11,'Pé de Serra'),(576,11,'Pedrão'),(577,11,'Pedro Alexandre'),(578,11,'Piatã'),(579,11,'Pilão Arcado'),(580,11,'Pindaí'),(581,11,'Pindobaçu'),(582,11,'Pintadas'),(583,11,'Piraí do Norte'),(584,11,'Piripá'),(585,11,'Piritiba'),(586,11,'Planaltino'),(587,11,'Planalto'),(588,11,'Poções'),(589,11,'Pojuca'),(590,11,'Ponto Novo'),(591,11,'Porto Seguro'),(592,11,'Potiraguá'),(593,11,'Prado'),(594,11,'Presidente Dutra'),(595,11,'Presidente Jânio Quadros'),(596,11,'Presidente Tancredo Neves'),(597,11,'Queimadas'),(598,11,'Quijingue'),(599,11,'Quixabeira'),(600,11,'Rafael Jambeiro'),(601,11,'Remanso'),(602,11,'Retirolândia'),(603,11,'Riachão das Neves'),(604,11,'Riachão do Jacuípe'),(605,11,'Riacho de Santana'),(606,11,'Ribeira do Amparo'),(607,11,'Ribeira do Pombal'),(608,11,'Ribeirão do Largo'),(609,11,'Rio de Contas'),(610,11,'Rio do Antônio'),(611,11,'Rio do Pires'),(612,11,'Rio Real'),(613,11,'Rodelas'),(614,11,'Ruy Barbosa'),(615,11,'Salinas da Margarida'),(616,11,'Salvador'),(617,11,'Santa Bárbara'),(618,11,'Santa Brígida'),(619,11,'Santa Cruz Cabrália'),(620,11,'Santa Cruz da Vitória'),(621,11,'Santa Inês'),(622,11,'Santa Luzia'),(623,11,'Santa Maria da Vitória'),(624,11,'Santa Rita de Cássia'),(625,11,'Santa Teresinha'),(626,11,'Santaluz'),(627,11,'Santana'),(628,11,'Santanópolis'),(629,11,'Santo Amaro'),(630,11,'Santo Antônio de Jesus'),(631,11,'Santo Estêvão'),(632,11,'São Desidério'),(633,11,'São Domingos'),(634,11,'São Felipe'),(635,11,'São Félix'),(636,11,'São Félix do Coribe'),(637,11,'São Francisco do Conde'),(638,11,'São Gabriel'),(639,11,'São Gonçalo dos Campos'),(640,11,'São José da Vitória'),(641,11,'São José do Jacuípe'),(642,11,'São Miguel das Matas'),(643,11,'São Sebastião do Passé'),(644,11,'Sapeaçu'),(645,11,'Sátiro Dias'),(646,11,'Saubara'),(647,11,'Saúde'),(648,11,'Seabra'),(649,11,'Sebastião Laranjeiras'),(650,11,'Senhor do Bonfim'),(651,11,'Sento Sé'),(652,11,'Serra do Ramalho'),(653,11,'Serra Dourada'),(654,11,'Serra Preta'),(655,11,'Serrinha'),(656,11,'Serrolândia'),(657,11,'Simões Filho'),(658,11,'Sítio do Mato'),(659,11,'Sítio do Quinto'),(660,11,'Sobradinho'),(661,11,'Souto Soares'),(662,11,'Tabocas do Brejo Velho'),(663,11,'Tanhaçu'),(664,11,'Tanque Novo'),(665,11,'Tanquinho'),(666,11,'Taperoá'),(667,11,'Tapiramutá'),(668,11,'Teixeira de Freitas'),(669,11,'Teodoro Sampaio'),(670,11,'Teofilândia'),(671,11,'Teolândia'),(672,11,'Terra Nova'),(673,11,'Tremedal'),(674,11,'Tucano'),(675,11,'Uauá'),(676,11,'Ubaíra'),(677,11,'Ubaitaba'),(678,11,'Ubatã'),(679,11,'Uibaí'),(680,11,'Umburanas'),(681,11,'Una'),(682,11,'Urandi'),(683,11,'Uruçuca'),(684,11,'Utinga'),(685,11,'Valença'),(686,11,'Valente'),(687,11,'Várzea da Roça'),(688,11,'Várzea do Poço'),(689,11,'Várzea Nova'),(690,11,'Varzedo'),(691,11,'Vera Cruz'),(692,11,'Vereda'),(693,11,'Vitória da Conquista'),(694,11,'Wagner'),(695,11,'Wanderley'),(696,11,'Wenceslau Guimarães'),(697,11,'Xique-Xique'),(698,12,'Abaiara'),(699,12,'Acarape'),(700,12,'Acaraú'),(701,12,'Acopiara'),(702,12,'Aiuaba'),(703,12,'Alcântaras'),(704,12,'Altaneira'),(705,12,'Alto Santo'),(706,12,'Amontada'),(707,12,'Antonina do Norte'),(708,12,'Apuiarés'),(709,12,'Aquiraz'),(710,12,'Aracati'),(711,12,'Aracoiaba'),(712,12,'Ararendá'),(713,12,'Araripe'),(714,12,'Aratuba'),(715,12,'Arneiroz'),(716,12,'Assaré'),(717,12,'Aurora'),(718,12,'Baixio'),(719,12,'Banabuiú'),(720,12,'Barbalha'),(721,12,'Barreira'),(722,12,'Barro'),(723,12,'Barroquinha'),(724,12,'Baturité'),(725,12,'Beberibe'),(726,12,'Bela Cruz'),(727,12,'Boa Viagem'),(728,12,'Brejo Santo'),(729,12,'Camocim'),(730,12,'Campos Sales'),(731,12,'Canindé'),(732,12,'Capistrano'),(733,12,'Caridade'),(734,12,'Cariré'),(735,12,'Caririaçu'),(736,12,'Cariús'),(737,12,'Carnaubal'),(738,12,'Cascavel'),(739,12,'Catarina'),(740,12,'Catunda'),(741,12,'Caucaia'),(742,12,'Cedro'),(743,12,'Chaval'),(744,12,'Choró'),(745,12,'Chorozinho'),(746,12,'Coreaú'),(747,12,'Crateús'),(748,12,'Crato'),(749,12,'Croatá'),(750,12,'Cruz'),(751,12,'Deputado Irapuan Pinheiro'),(752,12,'Ererê'),(753,12,'Eusébio'),(754,12,'Farias Brito'),(755,12,'Forquilha'),(756,12,'Fortaleza'),(757,12,'Fortim'),(758,12,'Frecheirinha'),(759,12,'General Sampaio'),(760,12,'Graça'),(761,12,'Granja'),(762,12,'Granjeiro'),(763,12,'Groaíras'),(764,12,'Guaiúba'),(765,12,'Guaraciaba do Norte'),(766,12,'Guaramiranga'),(767,12,'Hidrolândia'),(768,12,'Horizonte'),(769,12,'Ibaretama'),(770,12,'Ibiapina'),(771,12,'Ibicuitinga'),(772,12,'Icapuí'),(773,12,'Icó'),(774,12,'Iguatu'),(775,12,'Independência'),(776,12,'Ipaporanga'),(777,12,'Ipaumirim'),(778,12,'Ipu'),(779,12,'Ipueiras'),(780,12,'Iracema'),(781,12,'Irauçuba'),(782,12,'Itaiçaba'),(783,12,'Itaitinga'),(784,12,'Itapagé'),(785,12,'Itapipoca'),(786,12,'Itapiúna'),(787,12,'Itarema'),(788,12,'Itatira'),(789,12,'Jaguaretama'),(790,12,'Jaguaribara'),(791,12,'Jaguaribe'),(792,12,'Jaguaruana'),(793,12,'Jardim'),(794,12,'Jati'),(795,12,'Jijoca de Jericoacoara'),(796,12,'Juazeiro do Norte'),(797,12,'Jucás'),(798,12,'Lavras da Mangabeira'),(799,12,'Limoeiro do Norte'),(800,12,'Madalena'),(801,12,'Maracanaú'),(802,12,'Maranguape'),(803,12,'Marco'),(804,12,'Martinópole'),(805,12,'Massapê'),(806,12,'Mauriti'),(807,12,'Meruoca'),(808,12,'Milagres'),(809,12,'Milhã'),(810,12,'Miraíma'),(811,12,'Missão Velha'),(812,12,'Mombaça'),(813,12,'Monsenhor Tabosa'),(814,12,'Morada Nova'),(815,12,'Moraújo'),(816,12,'Morrinhos'),(817,12,'Mucambo'),(818,12,'Mulungu'),(819,12,'Nova Olinda'),(820,12,'Nova Russas'),(821,12,'Novo Oriente'),(822,12,'Ocara'),(823,12,'Orós'),(824,12,'Pacajus'),(825,12,'Pacatuba'),(826,12,'Pacoti'),(827,12,'Pacujá'),(828,12,'Palhano'),(829,12,'Palmácia'),(830,12,'Paracuru'),(831,12,'Paraipaba'),(832,12,'Parambu'),(833,12,'Paramoti'),(834,12,'Pedra Branca'),(835,12,'Penaforte'),(836,12,'Pentecoste'),(837,12,'Pereiro'),(838,12,'Pindoretama'),(839,12,'Piquet Carneiro'),(840,12,'Pires Ferreira'),(841,12,'Poranga'),(842,12,'Porteiras'),(843,12,'Potengi'),(844,12,'Potiretama'),(845,12,'Quiterianópolis'),(846,12,'Quixadá'),(847,12,'Quixelô'),(848,12,'Quixeramobim'),(849,12,'Quixeré'),(850,12,'Redenção'),(851,12,'Reriutaba'),(852,12,'Russas'),(853,12,'Saboeiro'),(854,12,'Salitre'),(855,12,'Santa Quitéria'),(856,12,'Santana do Acaraú'),(857,12,'Santana do Cariri'),(858,12,'São Benedito'),(859,12,'São Gonçalo do Amarante'),(860,12,'São João do Jaguaribe'),(861,12,'São Luís do Curu'),(862,12,'Senador Pompeu'),(863,12,'Senador Sá'),(864,12,'Sobral'),(865,12,'Solonópole'),(866,12,'Tabuleiro do Norte'),(867,12,'Tamboril'),(868,12,'Tarrafas'),(869,12,'Tauá'),(870,12,'Tejuçuoca'),(871,12,'Tianguá'),(872,12,'Trairi'),(873,12,'Tururu'),(874,12,'Ubajara'),(875,12,'Umari'),(876,12,'Umirim'),(877,12,'Uruburetama'),(878,12,'Uruoca'),(879,12,'Varjota'),(880,12,'Várzea Alegre'),(881,12,'Viçosa do Ceará'),(882,24,'Brasília'),(883,25,'Abadia de Goiás'),(884,25,'Abadiânia'),(885,25,'Acreúna'),(886,25,'Adelândia'),(887,25,'Água Fria de Goiás'),(888,25,'Água Limpa'),(889,25,'Águas Lindas de Goiás'),(890,25,'Alexânia'),(891,25,'Aloândia'),(892,25,'Alto Horizonte'),(893,25,'Alto Paraíso de Goiás'),(894,25,'Alvorada do Norte'),(895,25,'Amaralina'),(896,25,'Americano do Brasil'),(897,25,'Amorinópolis'),(898,25,'Anápolis'),(899,25,'Anhanguera'),(900,25,'Anicuns'),(901,25,'Aparecida de Goiânia'),(902,25,'Aparecida do Rio Doce'),(903,25,'Aporé'),(904,25,'Araçu'),(905,25,'Aragarças'),(906,25,'Aragoiânia'),(907,25,'Araguapaz'),(908,25,'Arenópolis'),(909,25,'Aruanã'),(910,25,'Aurilândia'),(911,25,'Avelinópolis'),(912,25,'Baliza'),(913,25,'Barro Alto'),(914,25,'Bela Vista de Goiás'),(915,25,'Bom Jardim de Goiás'),(916,25,'Bom Jesus de Goiás'),(917,25,'Bonfinópolis'),(918,25,'Bonópolis'),(919,25,'Brazabrantes'),(920,25,'Britânia'),(921,25,'Buriti Alegre'),(922,25,'Buriti de Goiás'),(923,25,'Buritinópolis'),(924,25,'Cabeceiras'),(925,25,'Cachoeira Alta'),(926,25,'Cachoeira de Goiás'),(927,25,'Cachoeira Dourada'),(928,25,'Caçu'),(929,25,'Caiapônia'),(930,25,'Caldas Novas'),(931,25,'Caldazinha'),(932,25,'Campestre de Goiás'),(933,25,'Campinaçu'),(934,25,'Campinorte'),(935,25,'Campo Alegre de Goiás'),(936,25,'Campo Limpo de Goiás'),(937,25,'Campos Belos'),(938,25,'Campos Verdes'),(939,25,'Carmo do Rio Verde'),(940,25,'Castelândia'),(941,25,'Catalão'),(942,25,'Caturaí'),(943,25,'Cavalcante'),(944,25,'Ceres'),(945,25,'Cezarina'),(946,25,'Chapadão do Céu'),(947,25,'Cidade Ocidental'),(948,25,'Cocalzinho de Goiás'),(949,25,'Colinas do Sul'),(950,25,'Córrego do Ouro'),(951,25,'Corumbá de Goiás'),(952,25,'Corumbaíba'),(953,25,'Cristalina'),(954,25,'Cristianópolis'),(955,25,'Crixás'),(956,25,'Cromínia'),(957,25,'Cumari'),(958,25,'Damianópolis'),(959,25,'Damolândia'),(960,25,'Davinópolis'),(961,25,'Diorama'),(962,25,'Divinópolis de Goiás'),(963,25,'Doverlândia'),(964,25,'Edealina'),(965,25,'Edéia'),(966,25,'Estrela do Norte'),(967,25,'Faina'),(968,25,'Fazenda Nova'),(969,25,'Firminópolis'),(970,25,'Flores de Goiás'),(971,25,'Formosa'),(972,25,'Formoso'),(973,25,'Gameleira de Goiás'),(974,25,'Goianápolis'),(975,25,'Goiandira'),(976,25,'Goianésia'),(977,25,'Goiânia'),(978,25,'Goianira'),(979,25,'Goiás'),(980,25,'Goiatuba'),(981,25,'Gouvelândia'),(982,25,'Guapó'),(983,25,'Guaraíta'),(984,25,'Guarani de Goiás'),(985,25,'Guarinos'),(986,25,'Heitoraí'),(987,25,'Hidrolândia'),(988,25,'Hidrolina'),(989,25,'Iaciara'),(990,25,'Inaciolândia'),(991,25,'Indiara'),(992,25,'Inhumas'),(993,25,'Ipameri'),(994,25,'Ipiranga de Goiás'),(995,25,'Iporá'),(996,25,'Israelândia'),(997,25,'Itaberaí'),(998,25,'Itaguari'),(999,25,'Itaguaru'),(1000,25,'Itajá'),(1001,25,'Itapaci'),(1002,25,'Itapirapuã'),(1003,25,'Itapuranga'),(1004,25,'Itarumã'),(1005,25,'Itauçu'),(1006,25,'Itumbiara'),(1007,25,'Ivolândia'),(1008,25,'Jandaia'),(1009,25,'Jaraguá'),(1010,25,'Jataí'),(1011,25,'Jaupaci'),(1012,25,'Jesúpolis'),(1013,25,'Joviânia'),(1014,25,'Jussara'),(1015,25,'Lagoa Santa'),(1016,25,'Leopoldo de Bulhões'),(1017,25,'Luziânia'),(1018,25,'Mairipotaba'),(1019,25,'Mambaí'),(1020,25,'Mara Rosa'),(1021,25,'Marzagão'),(1022,25,'Matrinchã'),(1023,25,'Maurilândia'),(1024,25,'Mimoso de Goiás'),(1025,25,'Minaçu'),(1026,25,'Mineiros'),(1027,25,'Moiporá'),(1028,25,'Monte Alegre de Goiás'),(1029,25,'Montes Claros de Goiás'),(1030,25,'Montividiu'),(1031,25,'Montividiu do Norte'),(1032,25,'Morrinhos'),(1033,25,'Morro Agudo de Goiás'),(1034,25,'Mossâmedes'),(1035,25,'Mozarlândia'),(1036,25,'Mundo Novo'),(1037,25,'Mutunópolis'),(1038,25,'Nazário'),(1039,25,'Nerópolis'),(1040,25,'Niquelândia'),(1041,25,'Nova América'),(1042,25,'Nova Aurora'),(1043,25,'Nova Crixás'),(1044,25,'Nova Glória'),(1045,25,'Nova Iguaçu de Goiás'),(1046,25,'Nova Roma'),(1047,25,'Nova Veneza'),(1048,25,'Novo Brasil'),(1049,25,'Novo Gama'),(1050,25,'Novo Planalto'),(1051,25,'Orizona'),(1052,25,'Ouro Verde de Goiás'),(1053,25,'Ouvidor'),(1054,25,'Padre Bernardo'),(1055,25,'Palestina de Goiás'),(1056,25,'Palmeiras de Goiás'),(1057,25,'Palmelo'),(1058,25,'Palminópolis'),(1059,25,'Panamá'),(1060,25,'Paranaiguara'),(1061,25,'Paraúna'),(1062,25,'Perolândia'),(1063,25,'Petrolina de Goiás'),(1064,25,'Pilar de Goiás'),(1065,25,'Piracanjuba'),(1066,25,'Piranhas'),(1067,25,'Pirenópolis'),(1068,25,'Pires do Rio'),(1069,25,'Planaltina'),(1070,25,'Pontalina'),(1071,25,'Porangatu'),(1072,25,'Porteirão'),(1073,25,'Portelândia'),(1074,25,'Posse'),(1075,25,'Professor Jamil'),(1076,25,'Quirinópolis'),(1077,25,'Rialma'),(1078,25,'Rianápolis'),(1079,25,'Rio Quente'),(1080,25,'Rio Verde'),(1081,25,'Rubiataba'),(1082,25,'Sanclerlândia'),(1083,25,'Santa Bárbara de Goiás'),(1084,25,'Santa Cruz de Goiás'),(1085,25,'Santa Fé de Goiás'),(1086,25,'Santa Helena de Goiás'),(1087,25,'Santa Isabel'),(1088,25,'Santa Rita do Araguaia'),(1089,25,'Santa Rita do Novo Destino'),(1090,25,'Santa Rosa de Goiás'),(1091,25,'Santa Tereza de Goiás'),(1092,25,'Santa Terezinha de Goiás'),(1093,25,'Santo Antônio da Barra'),(1094,25,'Santo Antônio de Goiás'),(1095,25,'Santo Antônio do Descoberto'),(1096,25,'São Domingos'),(1097,25,'São Francisco de Goiás'),(1098,25,'São João d`Aliança'),(1099,25,'São João da Paraúna'),(1100,25,'São Luís de Montes Belos'),(1101,25,'São Luíz do Norte'),(1102,25,'São Miguel do Araguaia'),(1103,25,'São Miguel do Passa Quatro'),(1104,25,'São Patrício'),(1105,25,'São Simão'),(1106,25,'Senador Canedo'),(1107,25,'Serranópolis'),(1108,25,'Silvânia'),(1109,25,'Simolândia'),(1110,25,'Sítio d`Abadia'),(1111,25,'Taquaral de Goiás'),(1112,25,'Teresina de Goiás'),(1113,25,'Terezópolis de Goiás'),(1114,25,'Três Ranchos'),(1115,25,'Trindade'),(1116,25,'Trombas'),(1117,25,'Turvânia'),(1118,25,'Turvelândia'),(1119,25,'Uirapuru'),(1120,25,'Uruaçu'),(1121,25,'Uruana'),(1122,25,'Urutaí'),(1123,25,'Valparaíso de Goiás'),(1124,25,'Varjão'),(1125,25,'Vianópolis'),(1126,25,'Vicentinópolis'),(1127,25,'Vila Boa'),(1128,25,'Vila Propício'),(1129,13,'Açailândia'),(1130,13,'Afonso Cunha'),(1131,13,'Água Doce do Maranhão'),(1132,13,'Alcântara'),(1133,13,'Aldeias Altas'),(1134,13,'Altamira do Maranhão'),(1135,13,'Alto Alegre do Maranhão'),(1136,13,'Alto Alegre do Pindaré'),(1137,13,'Alto Parnaíba'),(1138,13,'Amapá do Maranhão'),(1139,13,'Amarante do Maranhão'),(1140,13,'Anajatuba'),(1141,13,'Anapurus'),(1142,13,'Apicum-Açu'),(1143,13,'Araguanã'),(1144,13,'Araioses'),(1145,13,'Arame'),(1146,13,'Arari'),(1147,13,'Axixá'),(1148,13,'Bacabal'),(1149,13,'Bacabeira'),(1150,13,'Bacuri'),(1151,13,'Bacurituba'),(1152,13,'Balsas'),(1153,13,'Barão de Grajaú'),(1154,13,'Barra do Corda'),(1155,13,'Barreirinhas'),(1156,13,'Bela Vista do Maranhão'),(1157,13,'Belágua'),(1158,13,'Benedito Leite'),(1159,13,'Bequimão'),(1160,13,'Bernardo do Mearim'),(1161,13,'Boa Vista do Gurupi'),(1162,13,'Bom Jardim'),(1163,13,'Bom Jesus das Selvas'),(1164,13,'Bom Lugar'),(1165,13,'Brejo'),(1166,13,'Brejo de Areia'),(1167,13,'Buriti'),(1168,13,'Buriti Bravo'),(1169,13,'Buriticupu'),(1170,13,'Buritirana'),(1171,13,'Cachoeira Grande'),(1172,13,'Cajapió'),(1173,13,'Cajari'),(1174,13,'Campestre do Maranhão'),(1175,13,'Cândido Mendes'),(1176,13,'Cantanhede'),(1177,13,'Capinzal do Norte'),(1178,13,'Carolina'),(1179,13,'Carutapera'),(1180,13,'Caxias'),(1181,13,'Cedral'),(1182,13,'Central do Maranhão'),(1183,13,'Centro do Guilherme'),(1184,13,'Centro Novo do Maranhão'),(1185,13,'Chapadinha'),(1186,13,'Cidelândia'),(1187,13,'Codó'),(1188,13,'Coelho Neto'),(1189,13,'Colinas'),(1190,13,'Conceição do Lago-Açu'),(1191,13,'Coroatá'),(1192,13,'Cururupu'),(1193,13,'Davinópolis'),(1194,13,'Dom Pedro'),(1195,13,'Duque Bacelar'),(1196,13,'Esperantinópolis'),(1197,13,'Estreito'),(1198,13,'Feira Nova do Maranhão'),(1199,13,'Fernando Falcão'),(1200,13,'Formosa da Serra Negra'),(1201,13,'Fortaleza dos Nogueiras'),(1202,13,'Fortuna'),(1203,13,'Godofredo Viana'),(1204,13,'Gonçalves Dias'),(1205,13,'Governador Archer'),(1206,13,'Governador Edison Lobão'),(1207,13,'Governador Eugênio Barros'),(1208,13,'Governador Luiz Rocha'),(1209,13,'Governador Newton Bello'),(1210,13,'Governador Nunes Freire'),(1211,13,'Graça Aranha'),(1212,13,'Grajaú'),(1213,13,'Guimarães'),(1214,13,'Humberto de Campos'),(1215,13,'Icatu'),(1216,13,'Igarapé do Meio'),(1217,13,'Igarapé Grande'),(1218,13,'Imperatriz'),(1219,13,'Itaipava do Grajaú'),(1220,13,'Itapecuru Mirim'),(1221,13,'Itinga do Maranhão'),(1222,13,'Jatobá'),(1223,13,'Jenipapo dos Vieiras'),(1224,13,'João Lisboa'),(1225,13,'Joselândia'),(1226,13,'Junco do Maranhão'),(1227,13,'Lago da Pedra'),(1228,13,'Lago do Junco'),(1229,13,'Lago dos Rodrigues'),(1230,13,'Lago Verde'),(1231,13,'Lagoa do Mato'),(1232,13,'Lagoa Grande do Maranhão'),(1233,13,'Lajeado Novo'),(1234,13,'Lima Campos'),(1235,13,'Loreto'),(1236,13,'Luís Domingues'),(1237,13,'Magalhães de Almeida'),(1238,13,'Maracaçumé'),(1239,13,'Marajá do Sena'),(1240,13,'Maranhãozinho'),(1241,13,'Mata Roma'),(1242,13,'Matinha'),(1243,13,'Matões'),(1244,13,'Matões do Norte'),(1245,13,'Milagres do Maranhão'),(1246,13,'Mirador'),(1247,13,'Miranda do Norte'),(1248,13,'Mirinzal'),(1249,13,'Monção'),(1250,13,'Montes Altos'),(1251,13,'Morros'),(1252,13,'Nina Rodrigues'),(1253,13,'Nova Colinas'),(1254,13,'Nova Iorque'),(1255,13,'Nova Olinda do Maranhão'),(1256,13,'Olho d`Água das Cunhãs'),(1257,13,'Olinda Nova do Maranhão'),(1258,13,'Paço do Lumiar'),(1259,13,'Palmeirândia'),(1260,13,'Paraibano'),(1261,13,'Parnarama'),(1262,13,'Passagem Franca'),(1263,13,'Pastos Bons'),(1264,13,'Paulino Neves'),(1265,13,'Paulo Ramos'),(1266,13,'Pedreiras'),(1267,13,'Pedro do Rosário'),(1268,13,'Penalva'),(1269,13,'Peri Mirim'),(1270,13,'Peritoró'),(1271,13,'Pindaré-Mirim'),(1272,13,'Pinheiro'),(1273,13,'Pio XII'),(1274,13,'Pirapemas'),(1275,13,'Poção de Pedras'),(1276,13,'Porto Franco'),(1277,13,'Porto Rico do Maranhão'),(1278,13,'Presidente Dutra'),(1279,13,'Presidente Juscelino'),(1280,13,'Presidente Médici'),(1281,13,'Presidente Sarney'),(1282,13,'Presidente Vargas'),(1283,13,'Primeira Cruz'),(1284,13,'Raposa'),(1285,13,'Riachão'),(1286,13,'Ribamar Fiquene'),(1287,13,'Rosário'),(1288,13,'Sambaíba'),(1289,13,'Santa Filomena do Maranhão'),(1290,13,'Santa Helena'),(1291,13,'Santa Inês'),(1292,13,'Santa Luzia'),(1293,13,'Santa Luzia do Paruá'),(1294,13,'Santa Quitéria do Maranhão'),(1295,13,'Santa Rita'),(1296,13,'Santana do Maranhão'),(1297,13,'Santo Amaro do Maranhão'),(1298,13,'Santo Antônio dos Lopes'),(1299,13,'São Benedito do Rio Preto'),(1300,13,'São Bento'),(1301,13,'São Bernardo'),(1302,13,'São Domingos do Azeitão'),(1303,13,'São Domingos do Maranhão'),(1304,13,'São Félix de Balsas'),(1305,13,'São Francisco do Brejão'),(1306,13,'São Francisco do Maranhão'),(1307,13,'São João Batista'),(1308,13,'São João do Carú'),(1309,13,'São João do Paraíso'),(1310,13,'São João do Soter'),(1311,13,'São João dos Patos'),(1312,13,'São José de Ribamar'),(1313,13,'São José dos Basílios'),(1314,13,'São Luís'),(1315,13,'São Luís Gonzaga do Maranhão'),(1316,13,'São Mateus do Maranhão'),(1317,13,'São Pedro da Água Branca'),(1318,13,'São Pedro dos Crentes'),(1319,13,'São Raimundo das Mangabeiras'),(1320,13,'São Raimundo do Doca Bezerra'),(1321,13,'São Roberto'),(1322,13,'São Vicente Ferrer'),(1323,13,'Satubinha'),(1324,13,'Senador Alexandre Costa'),(1325,13,'Senador La Rocque'),(1326,13,'Serrano do Maranhão'),(1327,13,'Sítio Novo'),(1328,13,'Sucupira do Norte'),(1329,13,'Sucupira do Riachão'),(1330,13,'Tasso Fragoso'),(1331,13,'Timbiras'),(1332,13,'Timon'),(1333,13,'Trizidela do Vale'),(1334,13,'Tufilândia'),(1335,13,'Tuntum'),(1336,13,'Turiaçu'),(1337,13,'Turilândia'),(1338,13,'Tutóia'),(1339,13,'Urbano Santos'),(1340,13,'Vargem Grande'),(1341,13,'Viana'),(1342,13,'Vila Nova dos Martírios'),(1343,13,'Vitória do Mearim'),(1344,13,'Vitorino Freire'),(1345,13,'Zé Doca'),(1346,26,'Acorizal'),(1347,26,'Água Boa'),(1348,26,'Alta Floresta'),(1349,26,'Alto Araguaia'),(1350,26,'Alto Boa Vista'),(1351,26,'Alto Garças'),(1352,26,'Alto Paraguai'),(1353,26,'Alto Taquari'),(1354,26,'Apiacás'),(1355,26,'Araguaiana'),(1356,26,'Araguainha'),(1357,26,'Araputanga'),(1358,26,'Arenápolis'),(1359,26,'Aripuanã'),(1360,26,'Barão de Melgaço'),(1361,26,'Barra do Bugres'),(1362,26,'Barra do Garças'),(1363,26,'Bom Jesus do Araguaia'),(1364,26,'Brasnorte'),(1365,26,'Cáceres'),(1366,26,'Campinápolis'),(1367,26,'Campo Novo do Parecis'),(1368,26,'Campo Verde'),(1369,26,'Campos de Júlio'),(1370,26,'Canabrava do Norte'),(1371,26,'Canarana'),(1372,26,'Carlinda'),(1373,26,'Castanheira'),(1374,26,'Chapada dos Guimarães'),(1375,26,'Cláudia'),(1376,26,'Cocalinho'),(1377,26,'Colíder'),(1378,26,'Colniza'),(1379,26,'Comodoro'),(1380,26,'Confresa'),(1381,26,'Conquista d`Oeste'),(1382,26,'Cotriguaçu'),(1383,26,'Cuiabá'),(1384,26,'Curvelândia'),(1385,26,'Curvelândia'),(1386,26,'Denise'),(1387,26,'Diamantino'),(1388,26,'Dom Aquino'),(1389,26,'Feliz Natal'),(1390,26,'Figueirópolis d`Oeste'),(1391,26,'Gaúcha do Norte'),(1392,26,'General Carneiro'),(1393,26,'Glória d`Oeste'),(1394,26,'Guarantã do Norte'),(1395,26,'Guiratinga'),(1396,26,'Indiavaí'),(1397,26,'Ipiranga do Norte'),(1398,26,'Itanhangá'),(1399,26,'Itaúba'),(1400,26,'Itiquira'),(1401,26,'Jaciara'),(1402,26,'Jangada'),(1403,26,'Jauru'),(1404,26,'Juara'),(1405,26,'Juína'),(1406,26,'Juruena'),(1407,26,'Juscimeira'),(1408,26,'Lambari d`Oeste'),(1409,26,'Lucas do Rio Verde'),(1410,26,'Luciára'),(1411,26,'Marcelândia'),(1412,26,'Matupá'),(1413,26,'Mirassol d`Oeste'),(1414,26,'Nobres'),(1415,26,'Nortelândia'),(1416,26,'Nossa Senhora do Livramento'),(1417,26,'Nova Bandeirantes'),(1418,26,'Nova Brasilândia'),(1419,26,'Nova Canaã do Norte'),(1420,26,'Nova Guarita'),(1421,26,'Nova Lacerda'),(1422,26,'Nova Marilândia'),(1423,26,'Nova Maringá'),(1424,26,'Nova Monte verde'),(1425,26,'Nova Mutum'),(1426,26,'Nova Olímpia'),(1427,26,'Nova Santa Helena'),(1428,26,'Nova Ubiratã'),(1429,26,'Nova Xavantina'),(1430,26,'Novo Horizonte do Norte'),(1431,26,'Novo Mundo'),(1432,26,'Novo Santo Antônio'),(1433,26,'Novo São Joaquim'),(1434,26,'Paranaíta'),(1435,26,'Paranatinga'),(1436,26,'Pedra Preta'),(1437,26,'Peixoto de Azevedo'),(1438,26,'Planalto da Serra'),(1439,26,'Poconé'),(1440,26,'Pontal do Araguaia'),(1441,26,'Ponte Branca'),(1442,26,'Pontes e Lacerda'),(1443,26,'Porto Alegre do Norte'),(1444,26,'Porto dos Gaúchos'),(1445,26,'Porto Esperidião'),(1446,26,'Porto Estrela'),(1447,26,'Poxoréo'),(1448,26,'Primavera do Leste'),(1449,26,'Querência'),(1450,26,'Reserva do Cabaçal'),(1451,26,'Ribeirão Cascalheira'),(1452,26,'Ribeirãozinho'),(1453,26,'Rio Branco'),(1454,26,'Rondolândia'),(1455,26,'Rondonópolis'),(1456,26,'Rosário Oeste'),(1457,26,'Salto do Céu'),(1458,26,'Santa Carmem'),(1459,26,'Santa Cruz do Xingu'),(1460,26,'Santa Rita do Trivelato'),(1461,26,'Santa Terezinha'),(1462,26,'Santo Afonso'),(1463,26,'Santo Antônio do Leste'),(1464,26,'Santo Antônio do Leverger'),(1465,26,'São Félix do Araguaia'),(1466,26,'São José do Povo'),(1467,26,'São José do Rio Claro'),(1468,26,'São José do Xingu'),(1469,26,'São José dos Quatro Marcos'),(1470,26,'São Pedro da Cipa'),(1471,26,'Sapezal'),(1472,26,'Serra Nova Dourada'),(1473,26,'Sinop'),(1474,26,'Sorriso'),(1475,26,'Tabaporã'),(1476,26,'Tangará da Serra'),(1477,26,'Tapurah'),(1478,26,'Terra Nova do Norte'),(1479,26,'Tesouro'),(1480,26,'Torixoréu'),(1481,26,'União do Sul'),(1482,26,'Vale de São Domingos'),(1483,26,'Várzea Grande'),(1484,26,'Vera'),(1485,26,'Vila Bela da Santíssima Trindade'),(1486,26,'Vila Rica'),(1487,27,'Água Clara'),(1488,27,'Alcinópolis'),(1489,27,'Amambaí'),(1490,27,'Anastácio'),(1491,27,'Anaurilândia'),(1492,27,'Angélica'),(1493,27,'Antônio João'),(1494,27,'Aparecida do Taboado'),(1495,27,'Aquidauana'),(1496,27,'Aral Moreira'),(1497,27,'Bandeirantes'),(1498,27,'Bataguassu'),(1499,27,'Bataiporã'),(1500,27,'Bela Vista'),(1501,27,'Bodoquena'),(1502,27,'Bonito'),(1503,27,'Brasilândia'),(1504,27,'Caarapó'),(1505,27,'Camapuã'),(1506,27,'Campo Grande'),(1507,27,'Caracol'),(1508,27,'Cassilândia'),(1509,27,'Chapadão do Sul'),(1510,27,'Corguinho'),(1511,27,'Coronel Sapucaia'),(1512,27,'Corumbá'),(1513,27,'Costa Rica'),(1514,27,'Coxim'),(1515,27,'Deodápolis'),(1516,27,'Dois Irmãos do Buriti'),(1517,27,'Douradina'),(1518,27,'Dourados'),(1519,27,'Eldorado'),(1520,27,'Fátima do Sul'),(1521,27,'Figueirão'),(1522,27,'Glória de Dourados'),(1523,27,'Guia Lopes da Laguna'),(1524,27,'Iguatemi'),(1525,27,'Inocência'),(1526,27,'Itaporã'),(1527,27,'Itaquiraí'),(1528,27,'Ivinhema'),(1529,27,'Japorã'),(1530,27,'Jaraguari'),(1531,27,'Jardim'),(1532,27,'Jateí'),(1533,27,'Juti'),(1534,27,'Ladário'),(1535,27,'Laguna Carapã'),(1536,27,'Maracaju'),(1537,27,'Miranda'),(1538,27,'Mundo Novo'),(1539,27,'Naviraí'),(1540,27,'Nioaque'),(1541,27,'Nova Alvorada do Sul'),(1542,27,'Nova Andradina'),(1543,27,'Novo Horizonte do Sul'),(1544,27,'Paranaíba'),(1545,27,'Paranhos'),(1546,27,'Pedro Gomes'),(1547,27,'Ponta Porã'),(1548,27,'Porto Murtinho'),(1549,27,'Ribas do Rio Pardo'),(1550,27,'Rio Brilhante'),(1551,27,'Rio Negro'),(1552,27,'Rio Verde de Mato Grosso'),(1553,27,'Rochedo'),(1554,27,'Santa Rita do Pardo'),(1555,27,'São Gabriel do Oeste'),(1556,27,'Selvíria'),(1557,27,'Sete Quedas'),(1558,27,'Sidrolândia'),(1559,27,'Sonora'),(1560,27,'Tacuru'),(1561,27,'Taquarussu'),(1562,27,'Terenos'),(1563,27,'Três Lagoas'),(1564,27,'Vicentina'),(1565,20,'Abadia dos Dourados'),(1566,20,'Abaeté'),(1567,20,'Abre Campo'),(1568,20,'Acaiaca'),(1569,20,'Açucena'),(1570,20,'Água Boa'),(1571,20,'Água Comprida'),(1572,20,'Aguanil'),(1573,20,'Águas Formosas'),(1574,20,'Águas Vermelhas'),(1575,20,'Aimorés'),(1576,20,'Aiuruoca'),(1577,20,'Alagoa'),(1578,20,'Albertina'),(1579,20,'Além Paraíba'),(1580,20,'Alfenas'),(1581,20,'Alfredo Vasconcelos'),(1582,20,'Almenara'),(1583,20,'Alpercata'),(1584,20,'Alpinópolis'),(1585,20,'Alterosa'),(1586,20,'Alto Caparaó'),(1587,20,'Alto Jequitibá'),(1588,20,'Alto Rio Doce'),(1589,20,'Alvarenga'),(1590,20,'Alvinópolis'),(1591,20,'Alvorada de Minas'),(1592,20,'Amparo do Serra'),(1593,20,'Andradas'),(1594,20,'Andrelândia'),(1595,20,'Angelândia'),(1596,20,'Antônio Carlos'),(1597,20,'Antônio Dias'),(1598,20,'Antônio Prado de Minas'),(1599,20,'Araçaí'),(1600,20,'Aracitaba'),(1601,20,'Araçuaí'),(1602,20,'Araguari'),(1603,20,'Arantina'),(1604,20,'Araponga'),(1605,20,'Araporã'),(1606,20,'Arapuá'),(1607,20,'Araújos'),(1608,20,'Araxá'),(1609,20,'Arceburgo'),(1610,20,'Arcos'),(1611,20,'Areado'),(1612,20,'Argirita'),(1613,20,'Aricanduva'),(1614,20,'Arinos'),(1615,20,'Astolfo Dutra'),(1616,20,'Ataléia'),(1617,20,'Augusto de Lima'),(1618,20,'Baependi'),(1619,20,'Baldim'),(1620,20,'Bambuí'),(1621,20,'Bandeira'),(1622,20,'Bandeira do Sul'),(1623,20,'Barão de Cocais'),(1624,20,'Barão de Monte Alto'),(1625,20,'Barbacena'),(1626,20,'Barra Longa'),(1627,20,'Barroso'),(1628,20,'Bela Vista de Minas'),(1629,20,'Belmiro Braga'),(1630,20,'Belo Horizonte'),(1631,20,'Belo Oriente'),(1632,20,'Belo Vale'),(1633,20,'Berilo'),(1634,20,'Berizal'),(1635,20,'Bertópolis'),(1636,20,'Betim'),(1637,20,'Bias Fortes'),(1638,20,'Bicas'),(1639,20,'Biquinhas'),(1640,20,'Boa Esperança'),(1641,20,'Bocaina de Minas'),(1642,20,'Bocaiúva'),(1643,20,'Bom Despacho'),(1644,20,'Bom Jardim de Minas'),(1645,20,'Bom Jesus da Penha'),(1646,20,'Bom Jesus do Amparo'),(1647,20,'Bom Jesus do Galho'),(1648,20,'Bom Repouso'),(1649,20,'Bom Sucesso'),(1650,20,'Bonfim'),(1651,20,'Bonfinópolis de Minas'),(1652,20,'Bonito de Minas'),(1653,20,'Borda da Mata'),(1654,20,'Botelhos'),(1655,20,'Botumirim'),(1656,20,'Brás Pires'),(1657,20,'Brasilândia de Minas'),(1658,20,'Brasília de Minas'),(1659,20,'Brasópolis'),(1660,20,'Braúnas'),(1661,20,'Brumadinho'),(1662,20,'Bueno Brandão'),(1663,20,'Buenópolis'),(1664,20,'Bugre'),(1665,20,'Buritis'),(1666,20,'Buritizeiro'),(1667,20,'Cabeceira Grande'),(1668,20,'Cabo Verde'),(1669,20,'Cachoeira da Prata'),(1670,20,'Cachoeira de Minas'),(1671,20,'Cachoeira de Pajeú'),(1672,20,'Cachoeira Dourada'),(1673,20,'Caetanópolis'),(1674,20,'Caeté'),(1675,20,'Caiana'),(1676,20,'Cajuri'),(1677,20,'Caldas'),(1678,20,'Camacho'),(1679,20,'Camanducaia'),(1680,20,'Cambuí'),(1681,20,'Cambuquira'),(1682,20,'Campanário'),(1683,20,'Campanha'),(1684,20,'Campestre'),(1685,20,'Campina Verde'),(1686,20,'Campo Azul'),(1687,20,'Campo Belo'),(1688,20,'Campo do Meio'),(1689,20,'Campo Florido'),(1690,20,'Campos Altos'),(1691,20,'Campos Gerais'),(1692,20,'Cana Verde'),(1693,20,'Canaã'),(1694,20,'Canápolis'),(1695,20,'Candeias'),(1696,20,'Cantagalo'),(1697,20,'Caparaó'),(1698,20,'Capela Nova'),(1699,20,'Capelinha'),(1700,20,'Capetinga'),(1701,20,'Capim Branco'),(1702,20,'Capinópolis'),(1703,20,'Capitão Andrade'),(1704,20,'Capitão Enéas'),(1705,20,'Capitólio'),(1706,20,'Caputira'),(1707,20,'Caraí'),(1708,20,'Caranaíba'),(1709,20,'Carandaí'),(1710,20,'Carangola'),(1711,20,'Caratinga'),(1712,20,'Carbonita'),(1713,20,'Careaçu'),(1714,20,'Carlos Chagas'),(1715,20,'Carmésia'),(1716,20,'Carmo da Cachoeira'),(1717,20,'Carmo da Mata'),(1718,20,'Carmo de Minas'),(1719,20,'Carmo do Cajuru'),(1720,20,'Carmo do Paranaíba'),(1721,20,'Carmo do Rio Claro'),(1722,20,'Carmópolis de Minas'),(1723,20,'Carneirinho'),(1724,20,'Carrancas'),(1725,20,'Carvalhópolis'),(1726,20,'Carvalhos'),(1727,20,'Casa Grande'),(1728,20,'Cascalho Rico'),(1729,20,'Cássia'),(1730,20,'Cataguases'),(1731,20,'Catas Altas'),(1732,20,'Catas Altas da Noruega'),(1733,20,'Catuji'),(1734,20,'Catuti'),(1735,20,'Caxambu'),(1736,20,'Cedro do Abaeté'),(1737,20,'Central de Minas'),(1738,20,'Centralina'),(1739,20,'Chácara'),(1740,20,'Chalé'),(1741,20,'Chapada do Norte'),(1742,20,'Chapada Gaúcha'),(1743,20,'Chiador'),(1744,20,'Cipotânea'),(1745,20,'Claraval'),(1746,20,'Claro dos Poções'),(1747,20,'Cláudio'),(1748,20,'Coimbra'),(1749,20,'Coluna'),(1750,20,'Comendador Gomes'),(1751,20,'Comercinho'),(1752,20,'Conceição da Aparecida'),(1753,20,'Conceição da Barra de Minas'),(1754,20,'Conceição das Alagoas'),(1755,20,'Conceição das Pedras'),(1756,20,'Conceição de Ipanema'),(1757,20,'Conceição do Mato Dentro'),(1758,20,'Conceição do Pará'),(1759,20,'Conceição do Rio Verde'),(1760,20,'Conceição dos Ouros'),(1761,20,'Cônego Marinho'),(1762,20,'Confins'),(1763,20,'Congonhal'),(1764,20,'Congonhas'),(1765,20,'Congonhas do Norte'),(1766,20,'Conquista'),(1767,20,'Conselheiro Lafaiete'),(1768,20,'Conselheiro Pena'),(1769,20,'Consolação'),(1770,20,'Contagem'),(1771,20,'Coqueiral'),(1772,20,'Coração de Jesus'),(1773,20,'Cordisburgo'),(1774,20,'Cordislândia'),(1775,20,'Corinto'),(1776,20,'Coroaci'),(1777,20,'Coromandel'),(1778,20,'Coronel Fabriciano'),(1779,20,'Coronel Murta'),(1780,20,'Coronel Pacheco'),(1781,20,'Coronel Xavier Chaves'),(1782,20,'Córrego Danta'),(1783,20,'Córrego do Bom Jesus'),(1784,20,'Córrego Fundo'),(1785,20,'Córrego Novo'),(1786,20,'Couto de Magalhães de Minas'),(1787,20,'Crisólita'),(1788,20,'Cristais'),(1789,20,'Cristália'),(1790,20,'Cristiano Otoni'),(1791,20,'Cristina'),(1792,20,'Crucilândia'),(1793,20,'Cruzeiro da Fortaleza'),(1794,20,'Cruzília'),(1795,20,'Cuparaque'),(1796,20,'Curral de Dentro'),(1797,20,'Curvelo'),(1798,20,'Datas'),(1799,20,'Delfim Moreira'),(1800,20,'Delfinópolis'),(1801,20,'Delta'),(1802,20,'Descoberto'),(1803,20,'Desterro de Entre Rios'),(1804,20,'Desterro do Melo'),(1805,20,'Diamantina'),(1806,20,'Diogo de Vasconcelos'),(1807,20,'Dionísio'),(1808,20,'Divinésia'),(1809,20,'Divino'),(1810,20,'Divino das Laranjeiras'),(1811,20,'Divinolândia de Minas'),(1812,20,'Divinópolis'),(1813,20,'Divisa Alegre'),(1814,20,'Divisa Nova'),(1815,20,'Divisópolis'),(1816,20,'Dom Bosco'),(1817,20,'Dom Cavati'),(1818,20,'Dom Joaquim'),(1819,20,'Dom Silvério'),(1820,20,'Dom Viçoso'),(1821,20,'Dona Eusébia'),(1822,20,'Dores de Campos'),(1823,20,'Dores de Guanhães'),(1824,20,'Dores do Indaiá'),(1825,20,'Dores do Turvo'),(1826,20,'Doresópolis'),(1827,20,'Douradoquara'),(1828,20,'Durandé'),(1829,20,'Elói Mendes'),(1830,20,'Engenheiro Caldas'),(1831,20,'Engenheiro Navarro'),(1832,20,'Entre Folhas'),(1833,20,'Entre Rios de Minas'),(1834,20,'Ervália'),(1835,20,'Esmeraldas'),(1836,20,'Espera Feliz'),(1837,20,'Espinosa'),(1838,20,'Espírito Santo do Dourado'),(1839,20,'Estiva'),(1840,20,'Estrela Dalva'),(1841,20,'Estrela do Indaiá'),(1842,20,'Estrela do Sul'),(1843,20,'Eugenópolis'),(1844,20,'Ewbank da Câmara'),(1845,20,'Extrema'),(1846,20,'Fama'),(1847,20,'Faria Lemos'),(1848,20,'Felício dos Santos'),(1849,20,'Felisburgo'),(1850,20,'Felixlândia'),(1851,20,'Fernandes Tourinho'),(1852,20,'Ferros'),(1853,20,'Fervedouro'),(1854,20,'Florestal'),(1855,20,'Formiga'),(1856,20,'Formoso'),(1857,20,'Fortaleza de Minas'),(1858,20,'Fortuna de Minas'),(1859,20,'Francisco Badaró'),(1860,20,'Francisco Dumont'),(1861,20,'Francisco Sá'),(1862,20,'Franciscópolis'),(1863,20,'Frei Gaspar'),(1864,20,'Frei Inocêncio'),(1865,20,'Frei Lagonegro'),(1866,20,'Fronteira'),(1867,20,'Fronteira dos Vales'),(1868,20,'Fruta de Leite'),(1869,20,'Frutal'),(1870,20,'Funilândia'),(1871,20,'Galiléia'),(1872,20,'Gameleiras'),(1873,20,'Glaucilândia'),(1874,20,'Goiabeira'),(1875,20,'Goianá'),(1876,20,'Gonçalves'),(1877,20,'Gonzaga'),(1878,20,'Gouveia'),(1879,20,'Governador Valadares'),(1880,20,'Grão Mogol'),(1881,20,'Grupiara'),(1882,20,'Guanhães'),(1883,20,'Guapé'),(1884,20,'Guaraciaba'),(1885,20,'Guaraciama'),(1886,20,'Guaranésia'),(1887,20,'Guarani'),(1888,20,'Guarará'),(1889,20,'Guarda-Mor'),(1890,20,'Guaxupé'),(1891,20,'Guidoval'),(1892,20,'Guimarânia'),(1893,20,'Guiricema'),(1894,20,'Gurinhatã'),(1895,20,'Heliodora'),(1896,20,'Iapu'),(1897,20,'Ibertioga'),(1898,20,'Ibiá'),(1899,20,'Ibiaí'),(1900,20,'Ibiracatu'),(1901,20,'Ibiraci'),(1902,20,'Ibirité'),(1903,20,'Ibitiúra de Minas'),(1904,20,'Ibituruna'),(1905,20,'Icaraí de Minas'),(1906,20,'Igarapé'),(1907,20,'Igaratinga'),(1908,20,'Iguatama'),(1909,20,'Ijaci'),(1910,20,'Ilicínea'),(1911,20,'Imbé de Minas'),(1912,20,'Inconfidentes'),(1913,20,'Indaiabira'),(1914,20,'Indianópolis'),(1915,20,'Ingaí'),(1916,20,'Inhapim'),(1917,20,'Inhaúma'),(1918,20,'Inimutaba'),(1919,20,'Ipaba'),(1920,20,'Ipanema'),(1921,20,'Ipatinga'),(1922,20,'Ipiaçu'),(1923,20,'Ipuiúna'),(1924,20,'Iraí de Minas'),(1925,20,'Itabira'),(1926,20,'Itabirinha de Mantena'),(1927,20,'Itabirito'),(1928,20,'Itacambira'),(1929,20,'Itacarambi'),(1930,20,'Itaguara'),(1931,20,'Itaipé'),(1932,20,'Itajubá'),(1933,20,'Itamarandiba'),(1934,20,'Itamarati de Minas'),(1935,20,'Itambacuri'),(1936,20,'Itambé do Mato Dentro'),(1937,20,'Itamogi'),(1938,20,'Itamonte'),(1939,20,'Itanhandu'),(1940,20,'Itanhomi'),(1941,20,'Itaobim'),(1942,20,'Itapagipe'),(1943,20,'Itapecerica'),(1944,20,'Itapeva'),(1945,20,'Itatiaiuçu'),(1946,20,'Itaú de Minas'),(1947,20,'Itaúna'),(1948,20,'Itaverava'),(1949,20,'Itinga'),(1950,20,'Itueta'),(1951,20,'Ituiutaba'),(1952,20,'Itumirim'),(1953,20,'Iturama'),(1954,20,'Itutinga'),(1955,20,'Jaboticatubas'),(1956,20,'Jacinto'),(1957,20,'Jacuí'),(1958,20,'Jacutinga'),(1959,20,'Jaguaraçu'),(1960,20,'Jaíba'),(1961,20,'Jampruca'),(1962,20,'Janaúba'),(1963,20,'Januária'),(1964,20,'Japaraíba'),(1965,20,'Japonvar'),(1966,20,'Jeceaba'),(1967,20,'Jenipapo de Minas'),(1968,20,'Jequeri'),(1969,20,'Jequitaí'),(1970,20,'Jequitibá'),(1971,20,'Jequitinhonha'),(1972,20,'Jesuânia'),(1973,20,'Joaíma'),(1974,20,'Joanésia'),(1975,20,'João Monlevade'),(1976,20,'João Pinheiro'),(1977,20,'Joaquim Felício'),(1978,20,'Jordânia'),(1979,20,'José Gonçalves de Minas'),(1980,20,'José Raydan'),(1981,20,'Josenópolis'),(1982,20,'Juatuba'),(1983,20,'Juiz de Fora'),(1984,20,'Juramento'),(1985,20,'Juruaia'),(1986,20,'Juvenília'),(1987,20,'Ladainha'),(1988,20,'Lagamar'),(1989,20,'Lagoa da Prata'),(1990,20,'Lagoa dos Patos'),(1991,20,'Lagoa Dourada'),(1992,20,'Lagoa Formosa'),(1993,20,'Lagoa Grande'),(1994,20,'Lagoa Santa'),(1995,20,'Lajinha'),(1996,20,'Lambari'),(1997,20,'Lamim'),(1998,20,'Laranjal'),(1999,20,'Lassance'),(2000,20,'Lavras'),(2001,20,'Leandro Ferreira'),(2002,20,'Leme do Prado'),(2003,20,'Leopoldina'),(2004,20,'Liberdade'),(2005,20,'Lima Duarte'),(2006,20,'Limeira do Oeste'),(2007,20,'Lontra'),(2008,20,'Luisburgo'),(2009,20,'Luislândia'),(2010,20,'Luminárias'),(2011,20,'Luz'),(2012,20,'Machacalis'),(2013,20,'Machado'),(2014,20,'Madre de Deus de Minas'),(2015,20,'Malacacheta'),(2016,20,'Mamonas'),(2017,20,'Manga'),(2018,20,'Manhuaçu'),(2019,20,'Manhumirim'),(2020,20,'Mantena'),(2021,20,'Mar de Espanha'),(2022,20,'Maravilhas'),(2023,20,'Maria da Fé'),(2024,20,'Mariana'),(2025,20,'Marilac'),(2026,20,'Mário Campos'),(2027,20,'Maripá de Minas'),(2028,20,'Marliéria'),(2029,20,'Marmelópolis'),(2030,20,'Martinho Campos'),(2031,20,'Martins Soares'),(2032,20,'Mata Verde'),(2033,20,'Materlândia'),(2034,20,'Mateus Leme'),(2035,20,'Mathias Lobato'),(2036,20,'Matias Barbosa'),(2037,20,'Matias Cardoso'),(2038,20,'Matipó'),(2039,20,'Mato Verde'),(2040,20,'Matozinhos'),(2041,20,'Matutina'),(2042,20,'Medeiros'),(2043,20,'Medina'),(2044,20,'Mendes Pimentel'),(2045,20,'Mercês'),(2046,20,'Mesquita'),(2047,20,'Minas Novas'),(2048,20,'Minduri'),(2049,20,'Mirabela'),(2050,20,'Miradouro'),(2051,20,'Miraí'),(2052,20,'Miravânia'),(2053,20,'Moeda'),(2054,20,'Moema'),(2055,20,'Monjolos'),(2056,20,'Monsenhor Paulo'),(2057,20,'Montalvânia'),(2058,20,'Monte Alegre de Minas'),(2059,20,'Monte Azul'),(2060,20,'Monte Belo'),(2061,20,'Monte Carmelo'),(2062,20,'Monte Formoso'),(2063,20,'Monte Santo de Minas'),(2064,20,'Monte Sião'),(2065,20,'Montes Claros'),(2066,20,'Montezuma'),(2067,20,'Morada Nova de Minas'),(2068,20,'Morro da Garça'),(2069,20,'Morro do Pilar'),(2070,20,'Munhoz'),(2071,20,'Muriaé'),(2072,20,'Mutum'),(2073,20,'Muzambinho'),(2074,20,'Nacip Raydan'),(2075,20,'Nanuque'),(2076,20,'Naque'),(2077,20,'Natalândia'),(2078,20,'Natércia'),(2079,20,'Nazareno'),(2080,20,'Nepomuceno'),(2081,20,'Ninheira'),(2082,20,'Nova Belém'),(2083,20,'Nova Era'),(2084,20,'Nova Lima'),(2085,20,'Nova Módica'),(2086,20,'Nova Ponte'),(2087,20,'Nova Porteirinha'),(2088,20,'Nova Resende'),(2089,20,'Nova Serrana'),(2090,20,'Nova União'),(2091,20,'Novo Cruzeiro'),(2092,20,'Novo Oriente de Minas'),(2093,20,'Novorizonte'),(2094,20,'Olaria'),(2095,20,'Olhos-d`Água'),(2096,20,'Olímpio Noronha'),(2097,20,'Oliveira'),(2098,20,'Oliveira Fortes'),(2099,20,'Onça de Pitangui'),(2100,20,'Oratórios'),(2101,20,'Orizânia'),(2102,20,'Ouro Branco'),(2103,20,'Ouro Fino'),(2104,20,'Ouro Preto'),(2105,20,'Ouro Verde de Minas'),(2106,20,'Padre Carvalho'),(2107,20,'Padre Paraíso'),(2108,20,'Pai Pedro'),(2109,20,'Paineiras'),(2110,20,'Pains'),(2111,20,'Paiva'),(2112,20,'Palma'),(2113,20,'Palmópolis'),(2114,20,'Papagaios'),(2115,20,'Pará de Minas'),(2116,20,'Paracatu'),(2117,20,'Paraguaçu'),(2118,20,'Paraisópolis'),(2119,20,'Paraopeba'),(2120,20,'Passa Quatro'),(2121,20,'Passa Tempo'),(2122,20,'Passabém'),(2123,20,'Passa-Vinte'),(2124,20,'Passos'),(2125,20,'Patis'),(2126,20,'Patos de Minas'),(2127,20,'Patrocínio'),(2128,20,'Patrocínio do Muriaé'),(2129,20,'Paula Cândido'),(2130,20,'Paulistas'),(2131,20,'Pavão'),(2132,20,'Peçanha'),(2133,20,'Pedra Azul'),(2134,20,'Pedra Bonita'),(2135,20,'Pedra do Anta'),(2136,20,'Pedra do Indaiá'),(2137,20,'Pedra Dourada'),(2138,20,'Pedralva'),(2139,20,'Pedras de Maria da Cruz'),(2140,20,'Pedrinópolis'),(2141,20,'Pedro Leopoldo'),(2142,20,'Pedro Teixeira'),(2143,20,'Pequeri'),(2144,20,'Pequi'),(2145,20,'Perdigão'),(2146,20,'Perdizes'),(2147,20,'Perdões'),(2148,20,'Periquito'),(2149,20,'Pescador'),(2150,20,'Piau'),(2151,20,'Piedade de Caratinga'),(2152,20,'Piedade de Ponte Nova'),(2153,20,'Piedade do Rio Grande'),(2154,20,'Piedade dos Gerais'),(2155,20,'Pimenta'),(2156,20,'Pingo-d`Água'),(2157,20,'Pintópolis'),(2158,20,'Piracema'),(2159,20,'Pirajuba'),(2160,20,'Piranga'),(2161,20,'Piranguçu'),(2162,20,'Piranguinho'),(2163,20,'Pirapetinga'),(2164,20,'Pirapora'),(2165,20,'Piraúba'),(2166,20,'Pitangui'),(2167,20,'Piumhi'),(2168,20,'Planura'),(2169,20,'Poço Fundo'),(2170,20,'Poços de Caldas'),(2171,20,'Pocrane'),(2172,20,'Pompéu'),(2173,20,'Ponte Nova'),(2174,20,'Ponto Chique'),(2175,20,'Ponto dos Volantes'),(2176,20,'Porteirinha'),(2177,20,'Porto Firme'),(2178,20,'Poté'),(2179,20,'Pouso Alegre'),(2180,20,'Pouso Alto'),(2181,20,'Prados'),(2182,20,'Prata'),(2183,20,'Pratápolis'),(2184,20,'Pratinha'),(2185,20,'Presidente Bernardes'),(2186,20,'Presidente Juscelino'),(2187,20,'Presidente Kubitschek'),(2188,20,'Presidente Olegário'),(2189,20,'Prudente de Morais'),(2190,20,'Quartel Geral'),(2191,20,'Queluzito'),(2192,20,'Raposos'),(2193,20,'Raul Soares'),(2194,20,'Recreio'),(2195,20,'Reduto'),(2196,20,'Resende Costa'),(2197,20,'Resplendor'),(2198,20,'Ressaquinha'),(2199,20,'Riachinho'),(2200,20,'Riacho dos Machados'),(2201,20,'Ribeirão das Neves'),(2202,20,'Ribeirão Vermelho'),(2203,20,'Rio Acima'),(2204,20,'Rio Casca'),(2205,20,'Rio do Prado'),(2206,20,'Rio Doce'),(2207,20,'Rio Espera'),(2208,20,'Rio Manso'),(2209,20,'Rio Novo'),(2210,20,'Rio Paranaíba'),(2211,20,'Rio Pardo de Minas'),(2212,20,'Rio Piracicaba'),(2213,20,'Rio Pomba'),(2214,20,'Rio Preto'),(2215,20,'Rio Vermelho'),(2216,20,'Ritápolis'),(2217,20,'Rochedo de Minas'),(2218,20,'Rodeiro'),(2219,20,'Romaria'),(2220,20,'Rosário da Limeira'),(2221,20,'Rubelita'),(2222,20,'Rubim'),(2223,20,'Sabará'),(2224,20,'Sabinópolis'),(2225,20,'Sacramento'),(2226,20,'Salinas'),(2227,20,'Salto da Divisa'),(2228,20,'Santa Bárbara'),(2229,20,'Santa Bárbara do Leste'),(2230,20,'Santa Bárbara do Monte Verde'),(2231,20,'Santa Bárbara do Tugúrio'),(2232,20,'Santa Cruz de Minas'),(2233,20,'Santa Cruz de Salinas'),(2234,20,'Santa Cruz do Escalvado'),(2235,20,'Santa Efigênia de Minas'),(2236,20,'Santa Fé de Minas'),(2237,20,'Santa Helena de Minas'),(2238,20,'Santa Juliana'),(2239,20,'Santa Luzia'),(2240,20,'Santa Margarida'),(2241,20,'Santa Maria de Itabira'),(2242,20,'Santa Maria do Salto'),(2243,20,'Santa Maria do Suaçuí'),(2244,20,'Santa Rita de Caldas'),(2245,20,'Santa Rita de Ibitipoca'),(2246,20,'Santa Rita de Jacutinga'),(2247,20,'Santa Rita de Minas'),(2248,20,'Santa Rita do Itueto'),(2249,20,'Santa Rita do Sapucaí'),(2250,20,'Santa Rosa da Serra'),(2251,20,'Santa Vitória'),(2252,20,'Santana da Vargem'),(2253,20,'Santana de Cataguases'),(2254,20,'Santana de Pirapama'),(2255,20,'Santana do Deserto'),(2256,20,'Santana do Garambéu'),(2257,20,'Santana do Jacaré'),(2258,20,'Santana do Manhuaçu'),(2259,20,'Santana do Paraíso'),(2260,20,'Santana do Riacho'),(2261,20,'Santana dos Montes'),(2262,20,'Santo Antônio do Amparo'),(2263,20,'Santo Antônio do Aventureiro'),(2264,20,'Santo Antônio do Grama'),(2265,20,'Santo Antônio do Itambé'),(2266,20,'Santo Antônio do Jacinto'),(2267,20,'Santo Antônio do Monte'),(2268,20,'Santo Antônio do Retiro'),(2269,20,'Santo Antônio do Rio Abaixo'),(2270,20,'Santo Hipólito'),(2271,20,'Santos Dumont'),(2272,20,'São Bento Abade'),(2273,20,'São Brás do Suaçuí'),(2274,20,'São Domingos das Dores'),(2275,20,'São Domingos do Prata'),(2276,20,'São Félix de Minas'),(2277,20,'São Francisco'),(2278,20,'São Francisco de Paula'),(2279,20,'São Francisco de Sales'),(2280,20,'São Francisco do Glória'),(2281,20,'São Geraldo'),(2282,20,'São Geraldo da Piedade'),(2283,20,'São Geraldo do Baixio'),(2284,20,'São Gonçalo do Abaeté'),(2285,20,'São Gonçalo do Pará'),(2286,20,'São Gonçalo do Rio Abaixo'),(2287,20,'São Gonçalo do Rio Preto'),(2288,20,'São Gonçalo do Sapucaí'),(2289,20,'São Gotardo'),(2290,20,'São João Batista do Glória'),(2291,20,'São João da Lagoa'),(2292,20,'São João da Mata'),(2293,20,'São João da Ponte'),(2294,20,'São João das Missões'),(2295,20,'São João del Rei'),(2296,20,'São João do Manhuaçu'),(2297,20,'São João do Manteninha'),(2298,20,'São João do Oriente'),(2299,20,'São João do Pacuí'),(2300,20,'São João do Paraíso'),(2301,20,'São João Evangelista'),(2302,20,'São João Nepomuceno'),(2303,20,'São Joaquim de Bicas'),(2304,20,'São José da Barra'),(2305,20,'São José da Lapa'),(2306,20,'São José da Safira'),(2307,20,'São José da Varginha'),(2308,20,'São José do Alegre'),(2309,20,'São José do Divino'),(2310,20,'São José do Goiabal'),(2311,20,'São José do Jacuri'),(2312,20,'São José do Mantimento'),(2313,20,'São Lourenço'),(2314,20,'São Miguel do Anta'),(2315,20,'São Pedro da União'),(2316,20,'São Pedro do Suaçuí'),(2317,20,'São Pedro dos Ferros'),(2318,20,'São Romão'),(2319,20,'São Roque de Minas'),(2320,20,'São Sebastião da Bela Vista'),(2321,20,'São Sebastião da Vargem Alegre'),(2322,20,'São Sebastião do Anta'),(2323,20,'São Sebastião do Maranhão'),(2324,20,'São Sebastião do Oeste'),(2325,20,'São Sebastião do Paraíso'),(2326,20,'São Sebastião do Rio Preto'),(2327,20,'São Sebastião do Rio Verde'),(2328,20,'São Thomé das Letras'),(2329,20,'São Tiago'),(2330,20,'São Tomás de Aquino'),(2331,20,'São Vicente de Minas'),(2332,20,'Sapucaí-Mirim'),(2333,20,'Sardoá'),(2334,20,'Sarzedo'),(2335,20,'Sem-Peixe'),(2336,20,'Senador Amaral'),(2337,20,'Senador Cortes'),(2338,20,'Senador Firmino'),(2339,20,'Senador José Bento'),(2340,20,'Senador Modestino Gonçalves'),(2341,20,'Senhora de Oliveira'),(2342,20,'Senhora do Porto'),(2343,20,'Senhora dos Remédios'),(2344,20,'Sericita'),(2345,20,'Seritinga'),(2346,20,'Serra Azul de Minas'),(2347,20,'Serra da Saudade'),(2348,20,'Serra do Salitre'),(2349,20,'Serra dos Aimorés'),(2350,20,'Serrania'),(2351,20,'Serranópolis de Minas'),(2352,20,'Serranos'),(2353,20,'Serro'),(2354,20,'Sete Lagoas'),(2355,20,'Setubinha'),(2356,20,'Silveirânia'),(2357,20,'Silvianópolis'),(2358,20,'Simão Pereira'),(2359,20,'Simonésia'),(2360,20,'Sobrália'),(2361,20,'Soledade de Minas'),(2362,20,'Tabuleiro'),(2363,20,'Taiobeiras'),(2364,20,'Taparuba'),(2365,20,'Tapira'),(2366,20,'Tapiraí'),(2367,20,'Taquaraçu de Minas'),(2368,20,'Tarumirim'),(2369,20,'Teixeiras'),(2370,20,'Teófilo Otoni'),(2371,20,'Timóteo'),(2372,20,'Tiradentes'),(2373,20,'Tiros'),(2374,20,'Tocantins'),(2375,20,'Tocos do Moji'),(2376,20,'Toledo'),(2377,20,'Tombos'),(2378,20,'Três Corações'),(2379,20,'Três Marias'),(2380,20,'Três Pontas'),(2381,20,'Tumiritinga'),(2382,20,'Tupaciguara'),(2383,20,'Turmalina'),(2384,20,'Turvolândia'),(2385,20,'Ubá'),(2386,20,'Ubaí'),(2387,20,'Ubaporanga'),(2388,20,'Uberaba'),(2389,20,'Uberlândia'),(2390,20,'Umburatiba'),(2391,20,'Unaí'),(2392,20,'União de Minas'),(2393,20,'Uruana de Minas'),(2394,20,'Urucânia'),(2395,20,'Urucuia'),(2396,20,'Vargem Alegre'),(2397,20,'Vargem Bonita'),(2398,20,'Vargem Grande do Rio Pardo'),(2399,20,'Varginha'),(2400,20,'Varjão de Minas'),(2401,20,'Várzea da Palma'),(2402,20,'Varzelândia'),(2403,20,'Vazante'),(2404,20,'Verdelândia'),(2405,20,'Veredinha'),(2406,20,'Veríssimo'),(2407,20,'Vermelho Novo'),(2408,20,'Vespasiano'),(2409,20,'Viçosa'),(2410,20,'Vieiras'),(2411,20,'Virgem da Lapa'),(2412,20,'Virgínia'),(2413,20,'Virginópolis'),(2414,20,'Virgolândia'),(2415,20,'Visconde do Rio Branco'),(2416,20,'Volta Grande'),(2417,20,'Wenceslau Braz'),(2418,28,'Abaetetuba'),(2419,28,'Abel Figueiredo'),(2420,28,'Acará'),(2421,28,'Afuá'),(2422,28,'Água Azul do Norte'),(2423,28,'Alenquer'),(2424,28,'Almeirim'),(2425,28,'Altamira'),(2426,28,'Anajás'),(2427,28,'Ananindeua'),(2428,28,'Anapu'),(2429,28,'Augusto Corrêa'),(2430,28,'Aurora do Pará'),(2431,28,'Aveiro'),(2432,28,'Bagre'),(2433,28,'Baião'),(2434,28,'Bannach'),(2435,28,'Barcarena'),(2436,28,'Belém'),(2437,28,'Belterra'),(2438,28,'Benevides'),(2439,28,'Bom Jesus do Tocantins'),(2440,28,'Bonito'),(2441,28,'Bragança'),(2442,28,'Brasil Novo'),(2443,28,'Brejo Grande do Araguaia'),(2444,28,'Breu Branco'),(2445,28,'Breves'),(2446,28,'Bujaru'),(2447,28,'Cachoeira do Arari'),(2448,28,'Cachoeira do Piriá'),(2449,28,'Cametá'),(2450,28,'Canaã dos Carajás'),(2451,28,'Capanema'),(2452,28,'Capitão Poço'),(2453,28,'Castanhal'),(2454,28,'Chaves'),(2455,28,'Colares'),(2456,28,'Conceição do Araguaia'),(2457,28,'Concórdia do Pará'),(2458,28,'Cumaru do Norte'),(2459,28,'Curionópolis'),(2460,28,'Curralinho'),(2461,28,'Curuá'),(2462,28,'Curuçá'),(2463,28,'Dom Eliseu'),(2464,28,'Eldorado dos Carajás'),(2465,28,'Faro'),(2466,28,'Floresta do Araguaia'),(2467,28,'Garrafão do Norte'),(2468,28,'Goianésia do Pará'),(2469,28,'Gurupá'),(2470,28,'Igarapé-Açu'),(2471,28,'Igarapé-Miri'),(2472,28,'Inhangapi'),(2473,28,'Ipixuna do Pará'),(2474,28,'Irituia'),(2475,28,'Itaituba'),(2476,28,'Itupiranga'),(2477,28,'Jacareacanga'),(2478,28,'Jacundá'),(2479,28,'Juruti'),(2480,28,'Limoeiro do Ajuru'),(2481,28,'Mãe do Rio'),(2482,28,'Magalhães Barata'),(2483,28,'Marabá'),(2484,28,'Maracanã'),(2485,28,'Marapanim'),(2486,28,'Marituba'),(2487,28,'Medicilândia'),(2488,28,'Melgaço'),(2489,28,'Mocajuba'),(2490,28,'Moju'),(2491,28,'Monte Alegre'),(2492,28,'Muaná'),(2493,28,'Nova Esperança do Piriá'),(2494,28,'Nova Ipixuna'),(2495,28,'Nova Timboteua'),(2496,28,'Novo Progresso'),(2497,28,'Novo Repartimento'),(2498,28,'Óbidos'),(2499,28,'Oeiras do Pará'),(2500,28,'Oriximiná'),(2501,28,'Ourém'),(2502,28,'Ourilândia do Norte'),(2503,28,'Pacajá'),(2504,28,'Palestina do Pará'),(2505,28,'Paragominas'),(2506,28,'Parauapebas'),(2507,28,'Pau d`Arco'),(2508,28,'Peixe-Boi'),(2509,28,'Piçarra'),(2510,28,'Placas'),(2511,28,'Ponta de Pedras'),(2512,28,'Portel'),(2513,28,'Porto de Moz'),(2514,28,'Prainha'),(2515,28,'Primavera'),(2516,28,'Quatipuru'),(2517,28,'Redenção'),(2518,28,'Rio Maria'),(2519,28,'Rondon do Pará'),(2520,28,'Rurópolis'),(2521,28,'Salinópolis'),(2522,28,'Salvaterra'),(2523,28,'Santa Bárbara do Pará'),(2524,28,'Santa Cruz do Arari'),(2525,28,'Santa Isabel do Pará'),(2526,28,'Santa Luzia do Pará'),(2527,28,'Santa Maria das Barreiras'),(2528,28,'Santa Maria do Pará'),(2529,28,'Santana do Araguaia'),(2530,28,'Santarém'),(2531,28,'Santarém Novo'),(2532,28,'Santo Antônio do Tauá'),(2533,28,'São Caetano de Odivelas'),(2534,28,'São Domingos do Araguaia'),(2535,28,'São Domingos do Capim'),(2536,28,'São Félix do Xingu'),(2537,28,'São Francisco do Pará'),(2538,28,'São Geraldo do Araguaia'),(2539,28,'São João da Ponta'),(2540,28,'São João de Pirabas'),(2541,28,'São João do Araguaia'),(2542,28,'São Miguel do Guamá'),(2543,28,'São Sebastião da Boa Vista'),(2544,28,'Sapucaia'),(2545,28,'Senador José Porfírio'),(2546,28,'Soure'),(2547,28,'Tailândia'),(2548,28,'Terra Alta'),(2549,28,'Terra Santa'),(2550,28,'Tomé-Açu'),(2551,28,'Tracuateua'),(2552,28,'Trairão'),(2553,28,'Tucumã'),(2554,28,'Tucuruí'),(2555,28,'Ulianópolis'),(2556,28,'Uruará'),(2557,28,'Vigia'),(2558,28,'Viseu'),(2559,28,'Vitória do Xingu'),(2560,28,'Xinguara'),(2561,14,'Água Branca'),(2562,14,'Aguiar'),(2563,14,'Alagoa Grande'),(2564,14,'Alagoa Nova'),(2565,14,'Alagoinha'),(2566,14,'Alcantil'),(2567,14,'Algodão de Jandaíra'),(2568,14,'Alhandra'),(2569,14,'Amparo'),(2570,14,'Aparecida'),(2571,14,'Araçagi'),(2572,14,'Arara'),(2573,14,'Araruna'),(2574,14,'Areia'),(2575,14,'Areia de Baraúnas'),(2576,14,'Areial'),(2577,14,'Aroeiras'),(2578,14,'Assunção'),(2579,14,'Baía da Traição'),(2580,14,'Bananeiras'),(2581,14,'Baraúna'),(2582,14,'Barra de Santa Rosa'),(2583,14,'Barra de Santana'),(2584,14,'Barra de São Miguel'),(2585,14,'Bayeux'),(2586,14,'Belém'),(2587,14,'Belém do Brejo do Cruz'),(2588,14,'Bernardino Batista'),(2589,14,'Boa Ventura'),(2590,14,'Boa Vista'),(2591,14,'Bom Jesus'),(2592,14,'Bom Sucesso'),(2593,14,'Bonito de Santa Fé'),(2594,14,'Boqueirão'),(2595,14,'Borborema'),(2596,14,'Brejo do Cruz'),(2597,14,'Brejo dos Santos'),(2598,14,'Caaporã'),(2599,14,'Cabaceiras'),(2600,14,'Cabedelo'),(2601,14,'Cachoeira dos Índios'),(2602,14,'Cacimba de Areia'),(2603,14,'Cacimba de Dentro'),(2604,14,'Cacimbas'),(2605,14,'Caiçara'),(2606,14,'Cajazeiras'),(2607,14,'Cajazeirinhas'),(2608,14,'Caldas Brandão'),(2609,14,'Camalaú'),(2610,14,'Campina Grande'),(2611,14,'Campo de Santana'),(2612,14,'Capim'),(2613,14,'Caraúbas'),(2614,14,'Carrapateira'),(2615,14,'Casserengue'),(2616,14,'Catingueira'),(2617,14,'Catolé do Rocha'),(2618,14,'Caturité'),(2619,14,'Conceição'),(2620,14,'Condado'),(2621,14,'Conde'),(2622,14,'Congo'),(2623,14,'Coremas'),(2624,14,'Coxixola'),(2625,14,'Cruz do Espírito Santo'),(2626,14,'Cubati'),(2627,14,'Cuité'),(2628,14,'Cuité de Mamanguape'),(2629,14,'Cuitegi'),(2630,14,'Curral de Cima'),(2631,14,'Curral Velho'),(2632,14,'Damião'),(2633,14,'Desterro'),(2634,14,'Diamante'),(2635,14,'Dona Inês'),(2636,14,'Duas Estradas'),(2637,14,'Emas'),(2638,14,'Esperança'),(2639,14,'Fagundes'),(2640,14,'Frei Martinho'),(2641,14,'Gado Bravo'),(2642,14,'Guarabira'),(2643,14,'Gurinhém'),(2644,14,'Gurjão'),(2645,14,'Ibiara'),(2646,14,'Igaracy'),(2647,14,'Imaculada'),(2648,14,'Ingá'),(2649,14,'Itabaiana'),(2650,14,'Itaporanga'),(2651,14,'Itapororoca'),(2652,14,'Itatuba'),(2653,14,'Jacaraú'),(2654,14,'Jericó'),(2655,14,'João Pessoa'),(2656,14,'Juarez Távora'),(2657,14,'Juazeirinho'),(2658,14,'Junco do Seridó'),(2659,14,'Juripiranga'),(2660,14,'Juru'),(2661,14,'Lagoa'),(2662,14,'Lagoa de Dentro'),(2663,14,'Lagoa Seca'),(2664,14,'Lastro'),(2665,14,'Livramento'),(2666,14,'Logradouro'),(2667,14,'Lucena'),(2668,14,'Mãe d`Água'),(2669,14,'Malta'),(2670,14,'Mamanguape'),(2671,14,'Manaíra'),(2672,14,'Marcação'),(2673,14,'Mari'),(2674,14,'Marizópolis'),(2675,14,'Massaranduba'),(2676,14,'Mataraca'),(2677,14,'Matinhas'),(2678,14,'Mato Grosso'),(2679,14,'Maturéia'),(2680,14,'Mogeiro'),(2681,14,'Montadas'),(2682,14,'Monte Horebe'),(2683,14,'Monteiro'),(2684,14,'Mulungu'),(2685,14,'Natuba'),(2686,14,'Nazarezinho'),(2687,14,'Nova Floresta'),(2688,14,'Nova Olinda'),(2689,14,'Nova Palmeira'),(2690,14,'Olho d`Água'),(2691,14,'Olivedos'),(2692,14,'Ouro Velho'),(2693,14,'Parari'),(2694,14,'Passagem'),(2695,14,'Patos'),(2696,14,'Paulista'),(2697,14,'Pedra Branca'),(2698,14,'Pedra Lavrada'),(2699,14,'Pedras de Fogo'),(2700,14,'Pedro Régis'),(2701,14,'Piancó'),(2702,14,'Picuí'),(2703,14,'Pilar'),(2704,14,'Pilões'),(2705,14,'Pilõezinhos'),(2706,14,'Pirpirituba'),(2707,14,'Pitimbu'),(2708,14,'Pocinhos'),(2709,14,'Poço Dantas'),(2710,14,'Poço de José de Moura'),(2711,14,'Pombal'),(2712,14,'Prata'),(2713,14,'Princesa Isabel'),(2714,14,'Puxinanã'),(2715,14,'Queimadas'),(2716,14,'Quixabá'),(2717,14,'Remígio'),(2718,14,'Riachão'),(2719,14,'Riachão do Bacamarte'),(2720,14,'Riachão do Poço'),(2721,14,'Riacho de Santo Antônio'),(2722,14,'Riacho dos Cavalos'),(2723,14,'Rio Tinto'),(2724,14,'Salgadinho'),(2725,14,'Salgado de São Félix'),(2726,14,'Santa Cecília'),(2727,14,'Santa Cruz'),(2728,14,'Santa Helena'),(2729,14,'Santa Inês'),(2730,14,'Santa Luzia'),(2731,14,'Santa Rita'),(2732,14,'Santa Teresinha'),(2733,14,'Santana de Mangueira'),(2734,14,'Santana dos Garrotes'),(2735,14,'Santarém'),(2736,14,'Santo André'),(2737,14,'São Bentinho'),(2738,14,'São Bento'),(2739,14,'São Domingos de Pombal'),(2740,14,'São Domingos do Cariri'),(2741,14,'São Francisco'),(2742,14,'São João do Cariri'),(2743,14,'São João do Rio do Peixe'),(2744,14,'São João do Tigre'),(2745,14,'São José da Lagoa Tapada'),(2746,14,'São José de Caiana'),(2747,14,'São José de Espinharas'),(2748,14,'São José de Piranhas'),(2749,14,'São José de Princesa'),(2750,14,'São José do Bonfim'),(2751,14,'São José do Brejo do Cruz'),(2752,14,'São José do Sabugi'),(2753,14,'São José dos Cordeiros'),(2754,14,'São José dos Ramos'),(2755,14,'São Mamede'),(2756,14,'São Miguel de Taipu'),(2757,14,'São Sebastião de Lagoa de Roça'),(2758,14,'São Sebastião do Umbuzeiro'),(2759,14,'Sapé'),(2760,14,'Seridó'),(2761,14,'Serra Branca'),(2762,14,'Serra da Raiz'),(2763,14,'Serra Grande'),(2764,14,'Serra Redonda'),(2765,14,'Serraria'),(2766,14,'Sertãozinho'),(2767,14,'Sobrado'),(2768,14,'Solânea'),(2769,14,'Soledade'),(2770,14,'Sossêgo'),(2771,14,'Sousa'),(2772,14,'Sumé'),(2773,14,'Taperoá'),(2774,14,'Tavares'),(2775,14,'Teixeira'),(2776,14,'Tenório'),(2777,14,'Triunfo'),(2778,14,'Uiraúna'),(2779,14,'Umbuzeiro'),(2780,14,'Várzea'),(2781,14,'Vieirópolis'),(2782,14,'Vista Serrana'),(2783,14,'Zabelê'),(2784,21,'Abatiá'),(2785,21,'Adrianópolis'),(2786,21,'Agudos do Sul'),(2787,21,'Almirante Tamandaré'),(2788,21,'Altamira do Paraná'),(2789,21,'Alto Paraíso'),(2790,21,'Alto Paraná'),(2791,21,'Alto Piquiri'),(2792,21,'Altônia'),(2793,21,'Alvorada do Sul'),(2794,21,'Amaporã'),(2795,21,'Ampére'),(2796,21,'Anahy'),(2797,21,'Andirá'),(2798,21,'Ângulo'),(2799,21,'Antonina'),(2800,21,'Antônio Olinto'),(2801,21,'Apucarana'),(2802,21,'Arapongas'),(2803,21,'Arapoti'),(2804,21,'Arapuã'),(2805,21,'Araruna'),(2806,21,'Araucária'),(2807,21,'Ariranha do Ivaí'),(2808,21,'Assaí'),(2809,21,'Assis Chateaubriand'),(2810,21,'Astorga'),(2811,21,'Atalaia'),(2812,21,'Balsa Nova'),(2813,21,'Bandeirantes'),(2814,21,'Barbosa Ferraz'),(2815,21,'Barra do Jacaré'),(2816,21,'Barracão'),(2817,21,'Bela Vista da Caroba'),(2818,21,'Bela Vista do Paraíso'),(2819,21,'Bituruna'),(2820,21,'Boa Esperança'),(2821,21,'Boa Esperança do Iguaçu'),(2822,21,'Boa Ventura de São Roque'),(2823,21,'Boa Vista da Aparecida'),(2824,21,'Bocaiúva do Sul'),(2825,21,'Bom Jesus do Sul'),(2826,21,'Bom Sucesso'),(2827,21,'Bom Sucesso do Sul'),(2828,21,'Borrazópolis'),(2829,21,'Braganey'),(2830,21,'Brasilândia do Sul'),(2831,21,'Cafeara'),(2832,21,'Cafelândia'),(2833,21,'Cafezal do Sul'),(2834,21,'Califórnia'),(2835,21,'Cambará'),(2836,21,'Cambé'),(2837,21,'Cambira'),(2838,21,'Campina da Lagoa'),(2839,21,'Campina do Simão'),(2840,21,'Campina Grande do Sul'),(2841,21,'Campo Bonito'),(2842,21,'Campo do Tenente'),(2843,21,'Campo Largo'),(2844,21,'Campo Magro'),(2845,21,'Campo Mourão'),(2846,21,'Cândido de Abreu'),(2847,21,'Candói'),(2848,21,'Cantagalo'),(2849,21,'Capanema'),(2850,21,'Capitão Leônidas Marques'),(2851,21,'Carambeí'),(2852,21,'Carlópolis'),(2853,21,'Cascavel'),(2854,21,'Castro'),(2855,21,'Catanduvas'),(2856,21,'Centenário do Sul'),(2857,21,'Cerro Azul'),(2858,21,'Céu Azul'),(2859,21,'Chopinzinho'),(2860,21,'Cianorte'),(2861,21,'Cidade Gaúcha'),(2862,21,'Clevelândia'),(2863,21,'Colombo'),(2864,21,'Colorado'),(2865,21,'Congonhinhas'),(2866,21,'Conselheiro Mairinck'),(2867,21,'Contenda'),(2868,21,'Corbélia'),(2869,21,'Cornélio Procópio'),(2870,21,'Coronel Domingos Soares'),(2871,21,'Coronel Vivida'),(2872,21,'Corumbataí do Sul'),(2873,21,'Cruz Machado'),(2874,21,'Cruzeiro do Iguaçu'),(2875,21,'Cruzeiro do Oeste'),(2876,21,'Cruzeiro do Sul'),(2877,21,'Cruzmaltina'),(2878,21,'Curitiba'),(2879,21,'Curiúva'),(2880,21,'Diamante d`Oeste'),(2881,21,'Diamante do Norte'),(2882,21,'Diamante do Sul'),(2883,21,'Dois Vizinhos'),(2884,21,'Douradina'),(2885,21,'Doutor Camargo'),(2886,21,'Doutor Ulysses'),(2887,21,'Enéas Marques'),(2888,21,'Engenheiro Beltrão'),(2889,21,'Entre Rios do Oeste'),(2890,21,'Esperança Nova'),(2891,21,'Espigão Alto do Iguaçu'),(2892,21,'Farol'),(2893,21,'Faxinal'),(2894,21,'Fazenda Rio Grande'),(2895,21,'Fênix'),(2896,21,'Fernandes Pinheiro'),(2897,21,'Figueira'),(2898,21,'Flor da Serra do Sul'),(2899,21,'Floraí'),(2900,21,'Floresta'),(2901,21,'Florestópolis'),(2902,21,'Flórida'),(2903,21,'Formosa do Oeste'),(2904,21,'Foz do Iguaçu'),(2905,21,'Foz do Jordão'),(2906,21,'Francisco Alves'),(2907,21,'Francisco Beltrão'),(2908,21,'General Carneiro'),(2909,21,'Godoy Moreira'),(2910,21,'Goioerê'),(2911,21,'Goioxim'),(2912,21,'Grandes Rios'),(2913,21,'Guaíra'),(2914,21,'Guairaçá'),(2915,21,'Guamiranga'),(2916,21,'Guapirama'),(2917,21,'Guaporema'),(2918,21,'Guaraci'),(2919,21,'Guaraniaçu'),(2920,21,'Guarapuava'),(2921,21,'Guaraqueçaba'),(2922,21,'Guaratuba'),(2923,21,'Honório Serpa'),(2924,21,'Ibaiti'),(2925,21,'Ibema'),(2926,21,'Ibiporã'),(2927,21,'Icaraíma'),(2928,21,'Iguaraçu'),(2929,21,'Iguatu'),(2930,21,'Imbaú'),(2931,21,'Imbituva'),(2932,21,'Inácio Martins'),(2933,21,'Inajá'),(2934,21,'Indianópolis'),(2935,21,'Ipiranga'),(2936,21,'Iporã'),(2937,21,'Iracema do Oeste'),(2938,21,'Irati'),(2939,21,'Iretama'),(2940,21,'Itaguajé'),(2941,21,'Itaipulândia'),(2942,21,'Itambaracá'),(2943,21,'Itambé'),(2944,21,'Itapejara d`Oeste'),(2945,21,'Itaperuçu'),(2946,21,'Itaúna do Sul'),(2947,21,'Ivaí'),(2948,21,'Ivaiporã'),(2949,21,'Ivaté'),(2950,21,'Ivatuba'),(2951,21,'Jaboti'),(2952,21,'Jacarezinho'),(2953,21,'Jaguapitã'),(2954,21,'Jaguariaíva'),(2955,21,'Jandaia do Sul'),(2956,21,'Janiópolis'),(2957,21,'Japira'),(2958,21,'Japurá'),(2959,21,'Jardim Alegre'),(2960,21,'Jardim Olinda'),(2961,21,'Jataizinho'),(2962,21,'Jesuítas'),(2963,21,'Joaquim Távora'),(2964,21,'Jundiaí do Sul'),(2965,21,'Juranda'),(2966,21,'Jussara'),(2967,21,'Kaloré'),(2968,21,'Lapa'),(2969,21,'Laranjal'),(2970,21,'Laranjeiras do Sul'),(2971,21,'Leópolis'),(2972,21,'Lidianópolis'),(2973,21,'Lindoeste'),(2974,21,'Loanda'),(2975,21,'Lobato'),(2976,21,'Londrina'),(2977,21,'Luiziana'),(2978,21,'Lunardelli'),(2979,21,'Lupionópolis'),(2980,21,'Mallet'),(2981,21,'Mamborê'),(2982,21,'Mandaguaçu'),(2983,21,'Mandaguari'),(2984,21,'Mandirituba'),(2985,21,'Manfrinópolis'),(2986,21,'Mangueirinha'),(2987,21,'Manoel Ribas'),(2988,21,'Marechal Cândido Rondon'),(2989,21,'Maria Helena'),(2990,21,'Marialva'),(2991,21,'Marilândia do Sul'),(2992,21,'Marilena'),(2993,21,'Mariluz'),(2994,21,'Maringá'),(2995,21,'Mariópolis'),(2996,21,'Maripá'),(2997,21,'Marmeleiro'),(2998,21,'Marquinho'),(2999,21,'Marumbi'),(3000,21,'Matelândia'),(3001,21,'Matinhos'),(3002,21,'Mato Rico'),(3003,21,'Mauá da Serra'),(3004,21,'Medianeira'),(3005,21,'Mercedes'),(3006,21,'Mirador'),(3007,21,'Miraselva'),(3008,21,'Missal'),(3009,21,'Moreira Sales'),(3010,21,'Morretes'),(3011,21,'Munhoz de Melo'),(3012,21,'Nossa Senhora das Graças'),(3013,21,'Nova Aliança do Ivaí'),(3014,21,'Nova América da Colina'),(3015,21,'Nova Aurora'),(3016,21,'Nova Cantu'),(3017,21,'Nova Esperança'),(3018,21,'Nova Esperança do Sudoeste'),(3019,21,'Nova Fátima'),(3020,21,'Nova Laranjeiras'),(3021,21,'Nova Londrina'),(3022,21,'Nova Olímpia'),(3023,21,'Nova Prata do Iguaçu'),(3024,21,'Nova Santa Bárbara'),(3025,21,'Nova Santa Rosa'),(3026,21,'Nova Tebas'),(3027,21,'Novo Itacolomi'),(3028,21,'Ortigueira'),(3029,21,'Ourizona'),(3030,21,'Ouro Verde do Oeste'),(3031,21,'Paiçandu'),(3032,21,'Palmas'),(3033,21,'Palmeira'),(3034,21,'Palmital'),(3035,21,'Palotina'),(3036,21,'Paraíso do Norte'),(3037,21,'Paranacity'),(3038,21,'Paranaguá'),(3039,21,'Paranapoema'),(3040,21,'Paranavaí'),(3041,21,'Pato Bragado'),(3042,21,'Pato Branco'),(3043,21,'Paula Freitas'),(3044,21,'Paulo Frontin'),(3045,21,'Peabiru'),(3046,21,'Perobal'),(3047,21,'Pérola'),(3048,21,'Pérola d`Oeste'),(3049,21,'Piên'),(3050,21,'Pinhais'),(3051,21,'Pinhal de São Bento'),(3052,21,'Pinhalão'),(3053,21,'Pinhão'),(3054,21,'Piraí do Sul'),(3055,21,'Piraquara'),(3056,21,'Pitanga'),(3057,21,'Pitangueiras'),(3058,21,'Planaltina do Paraná'),(3059,21,'Planalto'),(3060,21,'Ponta Grossa'),(3061,21,'Pontal do Paraná'),(3062,21,'Porecatu'),(3063,21,'Porto Amazonas'),(3064,21,'Porto Barreiro'),(3065,21,'Porto Rico'),(3066,21,'Porto Vitória'),(3067,21,'Prado Ferreira'),(3068,21,'Pranchita'),(3069,21,'Presidente Castelo Branco'),(3070,21,'Primeiro de Maio'),(3071,21,'Prudentópolis'),(3072,21,'Quarto Centenário'),(3073,21,'Quatiguá'),(3074,21,'Quatro Barras'),(3075,21,'Quatro Pontes'),(3076,21,'Quedas do Iguaçu'),(3077,21,'Querência do Norte'),(3078,21,'Quinta do Sol'),(3079,21,'Quitandinha'),(3080,21,'Ramilândia'),(3081,21,'Rancho Alegre'),(3082,21,'Rancho Alegre d`Oeste'),(3083,21,'Realeza'),(3084,21,'Rebouças'),(3085,21,'Renascença'),(3086,21,'Reserva'),(3087,21,'Reserva do Iguaçu'),(3088,21,'Ribeirão Claro'),(3089,21,'Ribeirão do Pinhal'),(3090,21,'Rio Azul'),(3091,21,'Rio Bom'),(3092,21,'Rio Bonito do Iguaçu'),(3093,21,'Rio Branco do Ivaí'),(3094,21,'Rio Branco do Sul'),(3095,21,'Rio Negro'),(3096,21,'Rolândia'),(3097,21,'Roncador'),(3098,21,'Rondon'),(3099,21,'Rosário do Ivaí'),(3100,21,'Sabáudia'),(3101,21,'Salgado Filho'),(3102,21,'Salto do Itararé'),(3103,21,'Salto do Lontra'),(3104,21,'Santa Amélia'),(3105,21,'Santa Cecília do Pavão'),(3106,21,'Santa Cruz de Monte Castelo'),(3107,21,'Santa Fé'),(3108,21,'Santa Helena'),(3109,21,'Santa Inês'),(3110,21,'Santa Isabel do Ivaí'),(3111,21,'Santa Izabel do Oeste'),(3112,21,'Santa Lúcia'),(3113,21,'Santa Maria do Oeste'),(3114,21,'Santa Mariana'),(3115,21,'Santa Mônica'),(3116,21,'Santa Tereza do Oeste'),(3117,21,'Santa Terezinha de Itaipu'),(3118,21,'Santana do Itararé'),(3119,21,'Santo Antônio da Platina'),(3120,21,'Santo Antônio do Caiuá'),(3121,21,'Santo Antônio do Paraíso'),(3122,21,'Santo Antônio do Sudoeste'),(3123,21,'Santo Inácio'),(3124,21,'São Carlos do Ivaí'),(3125,21,'São Jerônimo da Serra'),(3126,21,'São João'),(3127,21,'São João do Caiuá'),(3128,21,'São João do Ivaí'),(3129,21,'São João do Triunfo'),(3130,21,'São Jorge d`Oeste'),(3131,21,'São Jorge do Ivaí'),(3132,21,'São Jorge do Patrocínio'),(3133,21,'São José da Boa Vista'),(3134,21,'São José das Palmeiras'),(3135,21,'São José dos Pinhais'),(3136,21,'São Manoel do Paraná'),(3137,21,'São Mateus do Sul'),(3138,21,'São Miguel do Iguaçu'),(3139,21,'São Pedro do Iguaçu'),(3140,21,'São Pedro do Ivaí'),(3141,21,'São Pedro do Paraná'),(3142,21,'São Sebastião da Amoreira'),(3143,21,'São Tomé'),(3144,21,'Sapopema'),(3145,21,'Sarandi'),(3146,21,'Saudade do Iguaçu'),(3147,21,'Sengés'),(3148,21,'Serranópolis do Iguaçu'),(3149,21,'Sertaneja'),(3150,21,'Sertanópolis'),(3151,21,'Siqueira Campos'),(3152,21,'Sulina'),(3153,21,'Tamarana'),(3154,21,'Tamboara'),(3155,21,'Tapejara'),(3156,21,'Tapira'),(3157,21,'Teixeira Soares'),(3158,21,'Telêmaco Borba'),(3159,21,'Terra Boa'),(3160,21,'Terra Rica'),(3161,21,'Terra Roxa'),(3162,21,'Tibagi'),(3163,21,'Tijucas do Sul'),(3164,21,'Toledo'),(3165,21,'Tomazina'),(3166,21,'Três Barras do Paraná'),(3167,21,'Tunas do Paraná'),(3168,21,'Tuneiras do Oeste'),(3169,21,'Tupãssi'),(3170,21,'Turvo'),(3171,21,'Ubiratã'),(3172,21,'Umuarama'),(3173,21,'União da Vitória'),(3174,21,'Uniflor'),(3175,21,'Uraí'),(3176,21,'Ventania'),(3177,21,'Vera Cruz do Oeste'),(3178,21,'Verê'),(3179,21,'Virmond'),(3180,21,'Vitorino'),(3181,21,'Wenceslau Braz'),(3182,21,'Xambrê'),(3183,15,'Abreu e Lima'),(3184,15,'Afogados da Ingazeira'),(3185,15,'Afrânio'),(3186,15,'Agrestina'),(3187,15,'Água Preta'),(3188,15,'Águas Belas'),(3189,15,'Alagoinha'),(3190,15,'Aliança'),(3191,15,'Altinho'),(3192,15,'Amaraji'),(3193,15,'Angelim'),(3194,15,'Araçoiaba'),(3195,15,'Araripina'),(3196,15,'Arcoverde'),(3197,15,'Barra de Guabiraba'),(3198,15,'Barreiros'),(3199,15,'Belém de Maria'),(3200,15,'Belém de São Francisco'),(3201,15,'Belo Jardim'),(3202,15,'Betânia'),(3203,15,'Bezerros'),(3204,15,'Bodocó'),(3205,15,'Bom Conselho'),(3206,15,'Bom Jardim'),(3207,15,'Bonito'),(3208,15,'Brejão'),(3209,15,'Brejinho'),(3210,15,'Brejo da Madre de Deus'),(3211,15,'Buenos Aires'),(3212,15,'Buíque'),(3213,15,'Cabo de Santo Agostinho'),(3214,15,'Cabrobó'),(3215,15,'Cachoeirinha'),(3216,15,'Caetés'),(3217,15,'Calçado'),(3218,15,'Calumbi'),(3219,15,'Camaragibe'),(3220,15,'Camocim de São Félix'),(3221,15,'Camutanga'),(3222,15,'Canhotinho'),(3223,15,'Capoeiras'),(3224,15,'Carnaíba'),(3225,15,'Carnaubeira da Penha'),(3226,15,'Carpina'),(3227,15,'Caruaru'),(3228,15,'Casinhas'),(3229,15,'Catende'),(3230,15,'Cedro'),(3231,15,'Chã de Alegria'),(3232,15,'Chã Grande'),(3233,15,'Condado'),(3234,15,'Correntes'),(3235,15,'Cortês'),(3236,15,'Cumaru'),(3237,15,'Cupira'),(3238,15,'Custódia'),(3239,15,'Dormentes'),(3240,15,'Escada'),(3241,15,'Exu'),(3242,15,'Feira Nova'),(3243,15,'Fernando de Noronha'),(3244,15,'Ferreiros'),(3245,15,'Flores'),(3246,15,'Floresta'),(3247,15,'Frei Miguelinho'),(3248,15,'Gameleira'),(3249,15,'Garanhuns'),(3250,15,'Glória do Goitá'),(3251,15,'Goiana'),(3252,15,'Granito'),(3253,15,'Gravatá'),(3254,15,'Iati'),(3255,15,'Ibimirim'),(3256,15,'Ibirajuba'),(3257,15,'Igarassu'),(3258,15,'Iguaraci'),(3259,15,'Ilha de Itamaracá'),(3260,15,'Inajá'),(3261,15,'Ingazeira'),(3262,15,'Ipojuca'),(3263,15,'Ipubi'),(3264,15,'Itacuruba'),(3265,15,'Itaíba'),(3266,15,'Itambé'),(3267,15,'Itapetim'),(3268,15,'Itapissuma'),(3269,15,'Itaquitinga'),(3270,15,'Jaboatão dos Guararapes'),(3271,15,'Jaqueira'),(3272,15,'Jataúba'),(3273,15,'Jatobá'),(3274,15,'João Alfredo'),(3275,15,'Joaquim Nabuco'),(3276,15,'Jucati'),(3277,15,'Jupi'),(3278,15,'Jurema'),(3279,15,'Lagoa do Carro'),(3280,15,'Lagoa do Itaenga'),(3281,15,'Lagoa do Ouro'),(3282,15,'Lagoa dos Gatos'),(3283,15,'Lagoa Grande'),(3284,15,'Lajedo'),(3285,15,'Limoeiro'),(3286,15,'Macaparana'),(3287,15,'Machados'),(3288,15,'Manari'),(3289,15,'Maraial'),(3290,15,'Mirandiba'),(3291,15,'Moreilândia'),(3292,15,'Moreno'),(3293,15,'Nazaré da Mata'),(3294,15,'Olinda'),(3295,15,'Orobó'),(3296,15,'Orocó'),(3297,15,'Ouricuri'),(3298,15,'Palmares'),(3299,15,'Palmeirina'),(3300,15,'Panelas'),(3301,15,'Paranatama'),(3302,15,'Parnamirim'),(3303,15,'Passira'),(3304,15,'Paudalho'),(3305,15,'Paulista'),(3306,15,'Pedra'),(3307,15,'Pesqueira'),(3308,15,'Petrolândia'),(3309,15,'Petrolina'),(3310,15,'Poção'),(3311,15,'Pombos'),(3312,15,'Primavera'),(3313,15,'Quipapá'),(3314,15,'Quixaba'),(3315,15,'Recife'),(3316,15,'Riacho das Almas'),(3317,15,'Ribeirão'),(3318,15,'Rio Formoso'),(3319,15,'Sairé'),(3320,15,'Salgadinho'),(3321,15,'Salgueiro'),(3322,15,'Saloá'),(3323,15,'Sanharó'),(3324,15,'Santa Cruz'),(3325,15,'Santa Cruz da Baixa Verde'),(3326,15,'Santa Cruz do Capibaribe'),(3327,15,'Santa Filomena'),(3328,15,'Santa Maria da Boa Vista'),(3329,15,'Santa Maria do Cambucá'),(3330,15,'Santa Terezinha'),(3331,15,'São Benedito do Sul'),(3332,15,'São Bento do Una'),(3333,15,'São Caitano'),(3334,15,'São João'),(3335,15,'São Joaquim do Monte'),(3336,15,'São José da Coroa Grande'),(3337,15,'São José do Belmonte'),(3338,15,'São José do Egito'),(3339,15,'São Lourenço da Mata'),(3340,15,'São Vicente Ferrer'),(3341,15,'Serra Talhada'),(3342,15,'Serrita'),(3343,15,'Sertânia'),(3344,15,'Sirinhaém'),(3345,15,'Solidão'),(3346,15,'Surubim'),(3347,15,'Tabira'),(3348,15,'Tacaimbó'),(3349,15,'Tacaratu'),(3350,15,'Tamandaré'),(3351,15,'Taquaritinga do Norte'),(3352,15,'Terezinha'),(3353,15,'Terra Nova'),(3354,15,'Timbaúba'),(3355,15,'Toritama'),(3356,15,'Tracunhaém'),(3357,15,'Trindade'),(3358,15,'Triunfo'),(3359,15,'Tupanatinga'),(3360,15,'Tuparetama'),(3361,15,'Venturosa'),(3362,15,'Verdejante'),(3363,15,'Vertente do Lério'),(3364,15,'Vertentes'),(3365,15,'Vicência'),(3366,15,'Vitória de Santo Antão'),(3367,15,'Xexéu'),(3368,16,'Acauã'),(3369,16,'Agricolândia'),(3370,16,'Água Branca'),(3371,16,'Alagoinha do Piauí'),(3372,16,'Alegrete do Piauí'),(3373,16,'Alto Longá'),(3374,16,'Altos'),(3375,16,'Alvorada do Gurguéia'),(3376,16,'Amarante'),(3377,16,'Angical do Piauí'),(3378,16,'Anísio de Abreu'),(3379,16,'Antônio Almeida'),(3380,16,'Aroazes'),(3381,16,'Aroeiras do Itaim'),(3382,16,'Arraial'),(3383,16,'Assunção do Piauí'),(3384,16,'Avelino Lopes'),(3385,16,'Baixa Grande do Ribeiro'),(3386,16,'Barra d`Alcântara'),(3387,16,'Barras'),(3388,16,'Barreiras do Piauí'),(3389,16,'Barro Duro'),(3390,16,'Batalha'),(3391,16,'Bela Vista do Piauí'),(3392,16,'Belém do Piauí'),(3393,16,'Beneditinos'),(3394,16,'Bertolínia'),(3395,16,'Betânia do Piauí'),(3396,16,'Boa Hora'),(3397,16,'Bocaina'),(3398,16,'Bom Jesus'),(3399,16,'Bom Princípio do Piauí'),(3400,16,'Bonfim do Piauí'),(3401,16,'Boqueirão do Piauí'),(3402,16,'Brasileira'),(3403,16,'Brejo do Piauí'),(3404,16,'Buriti dos Lopes'),(3405,16,'Buriti dos Montes'),(3406,16,'Cabeceiras do Piauí'),(3407,16,'Cajazeiras do Piauí'),(3408,16,'Cajueiro da Praia'),(3409,16,'Caldeirão Grande do Piauí'),(3410,16,'Campinas do Piauí'),(3411,16,'Campo Alegre do Fidalgo'),(3412,16,'Campo Grande do Piauí'),(3413,16,'Campo Largo do Piauí'),(3414,16,'Campo Maior'),(3415,16,'Canavieira'),(3416,16,'Canto do Buriti'),(3417,16,'Capitão de Campos'),(3418,16,'Capitão Gervásio Oliveira'),(3419,16,'Caracol'),(3420,16,'Caraúbas do Piauí'),(3421,16,'Caridade do Piauí'),(3422,16,'Castelo do Piauí'),(3423,16,'Caxingó'),(3424,16,'Cocal'),(3425,16,'Cocal de Telha'),(3426,16,'Cocal dos Alves'),(3427,16,'Coivaras'),(3428,16,'Colônia do Gurguéia'),(3429,16,'Colônia do Piauí'),(3430,16,'Conceição do Canindé'),(3431,16,'Coronel José Dias'),(3432,16,'Corrente'),(3433,16,'Cristalândia do Piauí'),(3434,16,'Cristino Castro'),(3435,16,'Curimatá'),(3436,16,'Currais'),(3437,16,'Curral Novo do Piauí'),(3438,16,'Curralinhos'),(3439,16,'Demerval Lobão'),(3440,16,'Dirceu Arcoverde'),(3441,16,'Dom Expedito Lopes'),(3442,16,'Dom Inocêncio'),(3443,16,'Domingos Mourão'),(3444,16,'Elesbão Veloso'),(3445,16,'Eliseu Martins'),(3446,16,'Esperantina'),(3447,16,'Fartura do Piauí'),(3448,16,'Flores do Piauí'),(3449,16,'Floresta do Piauí'),(3450,16,'Floriano'),(3451,16,'Francinópolis'),(3452,16,'Francisco Ayres'),(3453,16,'Francisco Macedo'),(3454,16,'Francisco Santos'),(3455,16,'Fronteiras'),(3456,16,'Geminiano'),(3457,16,'Gilbués'),(3458,16,'Guadalupe'),(3459,16,'Guaribas'),(3460,16,'Hugo Napoleão'),(3461,16,'Ilha Grande'),(3462,16,'Inhuma'),(3463,16,'Ipiranga do Piauí'),(3464,16,'Isaías Coelho'),(3465,16,'Itainópolis'),(3466,16,'Itaueira'),(3467,16,'Jacobina do Piauí'),(3468,16,'Jaicós'),(3469,16,'Jardim do Mulato'),(3470,16,'Jatobá do Piauí'),(3471,16,'Jerumenha'),(3472,16,'João Costa'),(3473,16,'Joaquim Pires'),(3474,16,'Joca Marques'),(3475,16,'José de Freitas'),(3476,16,'Juazeiro do Piauí'),(3477,16,'Júlio Borges'),(3478,16,'Jurema'),(3479,16,'Lagoa Alegre'),(3480,16,'Lagoa de São Francisco'),(3481,16,'Lagoa do Barro do Piauí'),(3482,16,'Lagoa do Piauí'),(3483,16,'Lagoa do Sítio'),(3484,16,'Lagoinha do Piauí'),(3485,16,'Landri Sales'),(3486,16,'Luís Correia'),(3487,16,'Luzilândia'),(3488,16,'Madeiro'),(3489,16,'Manoel Emídio'),(3490,16,'Marcolândia'),(3491,16,'Marcos Parente'),(3492,16,'Massapê do Piauí'),(3493,16,'Matias Olímpio'),(3494,16,'Miguel Alves'),(3495,16,'Miguel Leão'),(3496,16,'Milton Brandão'),(3497,16,'Monsenhor Gil'),(3498,16,'Monsenhor Hipólito'),(3499,16,'Monte Alegre do Piauí'),(3500,16,'Morro Cabeça no Tempo'),(3501,16,'Morro do Chapéu do Piauí'),(3502,16,'Murici dos Portelas'),(3503,16,'Nazaré do Piauí'),(3504,16,'Nossa Senhora de Nazaré'),(3505,16,'Nossa Senhora dos Remédios'),(3506,16,'Nova Santa Rita'),(3507,16,'Novo Oriente do Piauí'),(3508,16,'Novo Santo Antônio'),(3509,16,'Oeiras'),(3510,16,'Olho d`Água do Piauí'),(3511,16,'Padre Marcos'),(3512,16,'Paes Landim'),(3513,16,'Pajeú do Piauí'),(3514,16,'Palmeira do Piauí'),(3515,16,'Palmeirais'),(3516,16,'Paquetá'),(3517,16,'Parnaguá'),(3518,16,'Parnaíba'),(3519,16,'Passagem Franca do Piauí'),(3520,16,'Patos do Piauí'),(3521,16,'Pau d`Arco do Piauí'),(3522,16,'Paulistana'),(3523,16,'Pavussu'),(3524,16,'Pedro II'),(3525,16,'Pedro Laurentino'),(3526,16,'Picos'),(3527,16,'Pimenteiras'),(3528,16,'Pio IX'),(3529,16,'Piracuruca'),(3530,16,'Piripiri'),(3531,16,'Porto'),(3532,16,'Porto Alegre do Piauí'),(3533,16,'Prata do Piauí'),(3534,16,'Queimada Nova'),(3535,16,'Redenção do Gurguéia'),(3536,16,'Regeneração'),(3537,16,'Riacho Frio'),(3538,16,'Ribeira do Piauí'),(3539,16,'Ribeiro Gonçalves'),(3540,16,'Rio Grande do Piauí'),(3541,16,'Santa Cruz do Piauí'),(3542,16,'Santa Cruz dos Milagres'),(3543,16,'Santa Filomena'),(3544,16,'Santa Luz'),(3545,16,'Santa Rosa do Piauí'),(3546,16,'Santana do Piauí'),(3547,16,'Santo Antônio de Lisboa'),(3548,16,'Santo Antônio dos Milagres'),(3549,16,'Santo Inácio do Piauí'),(3550,16,'São Braz do Piauí'),(3551,16,'São Félix do Piauí'),(3552,16,'São Francisco de Assis do Piauí'),(3553,16,'São Francisco do Piauí'),(3554,16,'São Gonçalo do Gurguéia'),(3555,16,'São Gonçalo do Piauí'),(3556,16,'São João da Canabrava'),(3557,16,'São João da Fronteira'),(3558,16,'São João da Serra'),(3559,16,'São João da Varjota'),(3560,16,'São João do Arraial'),(3561,16,'São João do Piauí'),(3562,16,'São José do Divino'),(3563,16,'São José do Peixe'),(3564,16,'São José do Piauí'),(3565,16,'São Julião'),(3566,16,'São Lourenço do Piauí'),(3567,16,'São Luis do Piauí'),(3568,16,'São Miguel da Baixa Grande'),(3569,16,'São Miguel do Fidalgo'),(3570,16,'São Miguel do Tapuio'),(3571,16,'São Pedro do Piauí'),(3572,16,'São Raimundo Nonato'),(3573,16,'Sebastião Barros'),(3574,16,'Sebastião Leal'),(3575,16,'Sigefredo Pacheco'),(3576,16,'Simões'),(3577,16,'Simplício Mendes'),(3578,16,'Socorro do Piauí'),(3579,16,'Sussuapara'),(3580,16,'Tamboril do Piauí'),(3581,16,'Tanque do Piauí'),(3582,16,'Teresina'),(3583,16,'União'),(3584,16,'Uruçuí'),(3585,16,'Valença do Piauí'),(3586,16,'Várzea Branca'),(3587,16,'Várzea Grande'),(3588,16,'Vera Mendes'),(3589,16,'Vila Nova do Piauí'),(3590,16,'Wall Ferraz'),(3592,2,'Aperibé'),(3593,2,'Araruama'),(3594,2,'Areal'),(3595,2,'Armação dos Búzios'),(3596,2,'Arraial do Cabo'),(3597,2,'Barra do Piraí'),(3598,2,'Barra Mansa'),(3599,2,'Belford Roxo'),(3600,2,'Bom Jardim'),(3601,2,'Bom Jesus do Itabapoana'),(3602,2,'Cabo Frio'),(3603,2,'Cachoeiras de Macacu'),(3604,2,'Cambuci'),(3605,2,'Campos dos Goytacazes'),(3606,2,'Cantagalo'),(3607,2,'Carapebus'),(3608,2,'Cardoso Moreira'),(3609,2,'Carmo'),(3610,2,'Casimiro de Abreu'),(3611,2,'Comendador Levy Gasparian'),(3612,2,'Conceição de Macabu'),(3613,2,'Cordeiro'),(3614,2,'Duas Barras'),(3615,2,'Duque de Caxias'),(3616,2,'Engenheiro Paulo de Frontin'),(3617,2,'Guapimirim'),(3618,2,'Iguaba Grande'),(3619,2,'Itaboraí'),(3620,2,'Itaguaí'),(3621,2,'Italva'),(3622,2,'Itaocara'),(3623,2,'Itaperuna'),(3624,2,'Itatiaia'),(3625,2,'Japeri'),(3626,2,'Laje do Muriaé'),(3627,2,'Macaé'),(3628,2,'Macuco'),(3629,2,'Magé'),(3630,2,'Mangaratiba'),(3631,2,'Maricá'),(3632,2,'Mendes'),(3633,2,'Mesquita'),(3634,2,'Miguel Pereira'),(3635,2,'Miracema'),(3636,2,'Natividade'),(3637,2,'Nilópolis'),(3639,2,'Nova Friburgo'),(3640,2,'Nova Iguaçu'),(3641,2,'Paracambi'),(3642,2,'Paraíba do Sul'),(3644,2,'Paty do Alferes'),(3645,2,'Petrópolis'),(3646,2,'Pinheiral'),(3647,2,'Piraí'),(3648,2,'Porciúncula'),(3649,2,'Porto Real'),(3650,2,'Quatis'),(3651,2,'Queimados'),(3652,2,'Quissamã'),(3653,2,'Resende'),(3654,2,'Rio Bonito'),(3655,2,'Rio Claro'),(3656,2,'Rio das Flores'),(3657,2,'Rio das Ostras'),(3658,2,'Rio de Janeiro'),(3659,2,'Santa Maria Madalena'),(3660,2,'Santo Antônio de Pádua'),(3661,2,'São Fidélis'),(3662,2,'São Francisco de Itabapoana'),(3663,2,'São Gonçalo'),(3664,2,'São João da Barra'),(3665,2,'São João de Meriti'),(3666,2,'São José de Ubá'),(3667,2,'São José do Vale do Rio Pret'),(3668,2,'São Pedro da Aldeia'),(3669,2,'São Sebastião do Alto'),(3670,2,'Sapucaia'),(3671,2,'Saquarema'),(3672,2,'Seropédica'),(3673,2,'Silva Jardim'),(3674,2,'Sumidouro'),(3675,2,'Tanguá'),(3676,2,'Teresópolis'),(3677,2,'Trajano de Morais'),(3678,2,'Três Rios'),(3679,2,'Valença'),(3680,2,'Varre-Sai'),(3681,2,'Vassouras'),(3682,2,'Volta Redonda'),(3683,17,'Acari'),(3684,17,'Açu'),(3685,17,'Afonso Bezerra'),(3686,17,'Água Nova'),(3687,17,'Alexandria'),(3688,17,'Almino Afonso'),(3689,17,'Alto do Rodrigues'),(3690,17,'Angicos'),(3691,17,'Antônio Martins'),(3692,17,'Apodi'),(3693,17,'Areia Branca'),(3694,17,'Arês'),(3695,17,'Augusto Severo'),(3696,17,'Baía Formosa'),(3697,17,'Baraúna'),(3698,17,'Barcelona'),(3699,17,'Bento Fernandes'),(3700,17,'Bodó'),(3701,17,'Bom Jesus'),(3702,17,'Brejinho'),(3703,17,'Caiçara do Norte'),(3704,17,'Caiçara do Rio do Vento'),(3705,17,'Caicó'),(3706,17,'Campo Redondo'),(3707,17,'Canguaretama'),(3708,17,'Caraúbas'),(3709,17,'Carnaúba dos Dantas'),(3710,17,'Carnaubais'),(3711,17,'Ceará-Mirim'),(3712,17,'Cerro Corá'),(3713,17,'Coronel Ezequiel'),(3714,17,'Coronel João Pessoa'),(3715,17,'Cruzeta'),(3716,17,'Currais Novos'),(3717,17,'Doutor Severiano'),(3718,17,'Encanto'),(3719,17,'Equador'),(3720,17,'Espírito Santo'),(3721,17,'Extremoz'),(3722,17,'Felipe Guerra'),(3723,17,'Fernando Pedroza'),(3724,17,'Florânia'),(3725,17,'Francisco Dantas'),(3726,17,'Frutuoso Gomes'),(3727,17,'Galinhos'),(3728,17,'Goianinha'),(3729,17,'Governador Dix-Sept Rosado'),(3730,17,'Grossos'),(3731,17,'Guamaré'),(3732,17,'Ielmo Marinho'),(3733,17,'Ipanguaçu'),(3734,17,'Ipueira'),(3735,17,'Itajá'),(3736,17,'Itaú'),(3737,17,'Jaçanã'),(3738,17,'Jandaíra'),(3739,17,'Janduís'),(3740,17,'Januário Cicco'),(3741,17,'Japi'),(3742,17,'Jardim de Angicos'),(3743,17,'Jardim de Piranhas'),(3744,17,'Jardim do Seridó'),(3745,17,'João Câmara'),(3746,17,'João Dias'),(3747,17,'José da Penha'),(3748,17,'Jucurutu'),(3749,17,'Jundiá'),(3750,17,'Lagoa d`Anta'),(3751,17,'Lagoa de Pedras'),(3752,17,'Lagoa de Velhos'),(3753,17,'Lagoa Nova'),(3754,17,'Lagoa Salgada'),(3755,17,'Lajes'),(3756,17,'Lajes Pintadas'),(3757,17,'Lucrécia'),(3758,17,'Luís Gomes'),(3759,17,'Macaíba'),(3760,17,'Macau'),(3761,17,'Major Sales'),(3762,17,'Marcelino Vieira'),(3763,17,'Martins'),(3764,17,'Maxaranguape'),(3765,17,'Messias Targino'),(3766,17,'Montanhas'),(3767,17,'Monte Alegre'),(3768,17,'Monte das Gameleiras'),(3769,17,'Mossoró'),(3770,17,'Natal'),(3771,17,'Nísia Floresta'),(3772,17,'Nova Cruz'),(3773,17,'Olho-d`Água do Borges'),(3774,17,'Ouro Branco'),(3775,17,'Paraná'),(3776,17,'Paraú'),(3777,17,'Parazinho'),(3778,17,'Parelhas'),(3779,17,'Parnamirim'),(3780,17,'Passa e Fica'),(3781,17,'Passagem'),(3782,17,'Patu'),(3783,17,'Pau dos Ferros'),(3784,17,'Pedra Grande'),(3785,17,'Pedra Preta'),(3786,17,'Pedro Avelino'),(3787,17,'Pedro Velho'),(3788,17,'Pendências'),(3789,17,'Pilões'),(3790,17,'Poço Branco'),(3791,17,'Portalegre'),(3792,17,'Porto do Mangue'),(3793,17,'Presidente Juscelino'),(3794,17,'Pureza'),(3795,17,'Rafael Fernandes'),(3796,17,'Rafael Godeiro'),(3797,17,'Riacho da Cruz'),(3798,17,'Riacho de Santana'),(3799,17,'Riachuelo'),(3800,17,'Rio do Fogo'),(3801,17,'Rodolfo Fernandes'),(3802,17,'Ruy Barbosa'),(3803,17,'Santa Cruz'),(3804,17,'Santa Maria'),(3805,17,'Santana do Matos'),(3806,17,'Santana do Seridó'),(3807,17,'Santo Antônio'),(3808,17,'São Bento do Norte'),(3809,17,'São Bento do Trairí'),(3810,17,'São Fernando'),(3811,17,'São Francisco do Oeste'),(3812,17,'São Gonçalo do Amarante'),(3813,17,'São João do Sabugi'),(3814,17,'São José de Mipibu'),(3815,17,'São José do Campestre'),(3816,17,'São José do Seridó'),(3817,17,'São Miguel'),(3818,17,'São Miguel do Gostoso'),(3819,17,'São Paulo do Potengi'),(3820,17,'São Pedro'),(3821,17,'São Rafael'),(3822,17,'São Tomé'),(3823,17,'São Vicente'),(3824,17,'Senador Elói de Souza'),(3825,17,'Senador Georgino Avelino'),(3826,17,'Serra de São Bento'),(3827,17,'Serra do Mel'),(3828,17,'Serra Negra do Norte'),(3829,17,'Serrinha'),(3830,17,'Serrinha dos Pintos'),(3831,17,'Severiano Melo'),(3832,17,'Sítio Novo'),(3833,17,'Taboleiro Grande'),(3834,17,'Taipu'),(3835,17,'Tangará'),(3836,17,'Tenente Ananias'),(3837,17,'Tenente Laurentino Cruz'),(3838,17,'Tibau'),(3839,17,'Tibau do Sul'),(3840,17,'Timbaúba dos Batistas'),(3841,17,'Touros'),(3842,17,'Triunfo Potiguar'),(3843,17,'Umarizal'),(3844,17,'Upanema'),(3845,17,'Várzea'),(3846,17,'Venha-Ver'),(3847,17,'Vera Cruz'),(3848,17,'Viçosa'),(3849,17,'Vila Flor'),(3850,23,'Aceguá'),(3851,23,'Água Santa'),(3852,23,'Agudo'),(3853,23,'Ajuricaba'),(3854,23,'Alecrim'),(3855,23,'Alegrete'),(3856,23,'Alegria'),(3857,23,'Almirante Tamandaré do Sul'),(3858,23,'Alpestre'),(3859,23,'Alto Alegre'),(3860,23,'Alto Feliz'),(3861,23,'Alvorada'),(3862,23,'Amaral Ferrador'),(3863,23,'Ametista do Sul'),(3864,23,'André da Rocha'),(3865,23,'Anta Gorda'),(3866,23,'Antônio Prado'),(3867,23,'Arambaré'),(3868,23,'Araricá'),(3869,23,'Aratiba'),(3870,23,'Arroio do Meio'),(3871,23,'Arroio do Padre'),(3872,23,'Arroio do Sal'),(3873,23,'Arroio do Tigre'),(3874,23,'Arroio dos Ratos'),(3875,23,'Arroio Grande'),(3876,23,'Arvorezinha'),(3877,23,'Augusto Pestana'),(3878,23,'Áurea'),(3879,23,'Bagé'),(3880,23,'Balneário Pinhal'),(3881,23,'Barão'),(3882,23,'Barão de Cotegipe'),(3883,23,'Barão do Triunfo'),(3884,23,'Barra do Guarita'),(3885,23,'Barra do Quaraí'),(3886,23,'Barra do Ribeiro'),(3887,23,'Barra do Rio Azul'),(3888,23,'Barra Funda'),(3889,23,'Barracão'),(3890,23,'Barros Cassal'),(3891,23,'Benjamin Constant do Sul'),(3892,23,'Bento Gonçalves'),(3893,23,'Boa Vista das Missões'),(3894,23,'Boa Vista do Buricá'),(3895,23,'Boa Vista do Cadeado'),(3896,23,'Boa Vista do Incra'),(3897,23,'Boa Vista do Sul'),(3898,23,'Bom Jesus'),(3899,23,'Bom Princípio'),(3900,23,'Bom Progresso'),(3901,23,'Bom Retiro do Sul'),(3902,23,'Boqueirão do Leão'),(3903,23,'Bossoroca'),(3904,23,'Bozano'),(3905,23,'Braga'),(3906,23,'Brochier'),(3907,23,'Butiá'),(3908,23,'Caçapava do Sul'),(3909,23,'Cacequi'),(3910,23,'Cachoeira do Sul'),(3911,23,'Cachoeirinha'),(3912,23,'Cacique Doble'),(3913,23,'Caibaté'),(3914,23,'Caiçara'),(3915,23,'Camaquã'),(3916,23,'Camargo'),(3917,23,'Cambará do Sul'),(3918,23,'Campestre da Serra'),(3919,23,'Campina das Missões'),(3920,23,'Campinas do Sul'),(3921,23,'Campo Bom'),(3922,23,'Campo Novo'),(3923,23,'Campos Borges'),(3924,23,'Candelária'),(3925,23,'Cândido Godói'),(3926,23,'Candiota'),(3927,23,'Canela'),(3928,23,'Canguçu'),(3929,23,'Canoas'),(3930,23,'Canudos do Vale'),(3931,23,'Capão Bonito do Sul'),(3932,23,'Capão da Canoa'),(3933,23,'Capão do Cipó'),(3934,23,'Capão do Leão'),(3935,23,'Capela de Santana'),(3936,23,'Capitão'),(3937,23,'Capivari do Sul'),(3938,23,'Caraá'),(3939,23,'Carazinho'),(3940,23,'Carlos Barbosa'),(3941,23,'Carlos Gomes'),(3942,23,'Casca'),(3943,23,'Caseiros'),(3944,23,'Catuípe'),(3945,23,'Caxias do Sul'),(3946,23,'Centenário'),(3947,23,'Cerrito'),(3948,23,'Cerro Branco'),(3949,23,'Cerro Grande'),(3950,23,'Cerro Grande do Sul'),(3951,23,'Cerro Largo'),(3952,23,'Chapada'),(3953,23,'Charqueadas'),(3954,23,'Charrua'),(3955,23,'Chiapeta'),(3956,23,'Chuí'),(3957,23,'Chuvisca'),(3958,23,'Cidreira'),(3959,23,'Ciríaco'),(3960,23,'Colinas'),(3961,23,'Colorado'),(3962,23,'Condor'),(3963,23,'Constantina'),(3964,23,'Coqueiro Baixo'),(3965,23,'Coqueiros do Sul'),(3966,23,'Coronel Barros'),(3967,23,'Coronel Bicaco'),(3968,23,'Coronel Pilar'),(3969,23,'Cotiporã'),(3970,23,'Coxilha'),(3971,23,'Crissiumal'),(3972,23,'Cristal'),(3973,23,'Cristal do Sul'),(3974,23,'Cruz Alta'),(3975,23,'Cruzaltense'),(3976,23,'Cruzeiro do Sul'),(3977,23,'David Canabarro'),(3978,23,'Derrubadas'),(3979,23,'Dezesseis de Novembro'),(3980,23,'Dilermando de Aguiar'),(3981,23,'Dois Irmãos'),(3982,23,'Dois Irmãos das Missões'),(3983,23,'Dois Lajeados'),(3984,23,'Dom Feliciano'),(3985,23,'Dom Pedrito'),(3986,23,'Dom Pedro de Alcântara'),(3987,23,'Dona Francisca'),(3988,23,'Doutor Maurício Cardoso'),(3989,23,'Doutor Ricardo'),(3990,23,'Eldorado do Sul'),(3991,23,'Encantado'),(3992,23,'Encruzilhada do Sul'),(3993,23,'Engenho Velho'),(3994,23,'Entre Rios do Sul'),(3995,23,'Entre-Ijuís'),(3996,23,'Erebango'),(3997,23,'Erechim'),(3998,23,'Ernestina'),(3999,23,'Erval Grande'),(4000,23,'Erval Seco'),(4001,23,'Esmeralda'),(4002,23,'Esperança do Sul'),(4003,23,'Espumoso'),(4004,23,'Estação'),(4005,23,'Estância Velha'),(4006,23,'Esteio'),(4007,23,'Estrela'),(4008,23,'Estrela Velha'),(4009,23,'Eugênio de Castro'),(4010,23,'Fagundes Varela'),(4011,23,'Farroupilha'),(4012,23,'Faxinal do Soturno'),(4013,23,'Faxinalzinho'),(4014,23,'Fazenda Vilanova'),(4015,23,'Feliz'),(4016,23,'Flores da Cunha'),(4017,23,'Floriano Peixoto'),(4018,23,'Fontoura Xavier'),(4019,23,'Formigueiro'),(4020,23,'Forquetinha'),(4021,23,'Fortaleza dos Valos'),(4022,23,'Frederico Westphalen'),(4023,23,'Garibaldi'),(4024,23,'Garruchos'),(4025,23,'Gaurama'),(4026,23,'General Câmara'),(4027,23,'Gentil'),(4028,23,'Getúlio Vargas'),(4029,23,'Giruá'),(4030,23,'Glorinha'),(4031,23,'Gramado'),(4032,23,'Gramado dos Loureiros'),(4033,23,'Gramado Xavier'),(4034,23,'Gravataí'),(4035,23,'Guabiju'),(4036,23,'Guaíba'),(4037,23,'Guaporé'),(4038,23,'Guarani das Missões'),(4039,23,'Harmonia'),(4040,23,'Herval'),(4041,23,'Herveiras'),(4042,23,'Horizontina'),(4043,23,'Hulha Negra'),(4044,23,'Humaitá'),(4045,23,'Ibarama'),(4046,23,'Ibiaçá'),(4047,23,'Ibiraiaras'),(4048,23,'Ibirapuitã'),(4049,23,'Ibirubá'),(4050,23,'Igrejinha'),(4051,23,'Ijuí'),(4052,23,'Ilópolis'),(4053,23,'Imbé'),(4054,23,'Imigrante'),(4055,23,'Independência'),(4056,23,'Inhacorá'),(4057,23,'Ipê'),(4058,23,'Ipiranga do Sul'),(4059,23,'Iraí'),(4060,23,'Itaara'),(4061,23,'Itacurubi'),(4062,23,'Itapuca'),(4063,23,'Itaqui'),(4064,23,'Itati'),(4065,23,'Itatiba do Sul'),(4066,23,'Ivorá'),(4067,23,'Ivoti'),(4068,23,'Jaboticaba'),(4069,23,'Jacuizinho'),(4070,23,'Jacutinga'),(4071,23,'Jaguarão'),(4072,23,'Jaguari'),(4073,23,'Jaquirana'),(4074,23,'Jari'),(4075,23,'Jóia'),(4076,23,'Júlio de Castilhos'),(4077,23,'Lagoa Bonita do Sul'),(4078,23,'Lagoa dos Três Cantos'),(4079,23,'Lagoa Vermelha'),(4080,23,'Lagoão'),(4081,23,'Lajeado'),(4082,23,'Lajeado do Bugre'),(4083,23,'Lavras do Sul'),(4084,23,'Liberato Salzano'),(4085,23,'Lindolfo Collor'),(4086,23,'Linha Nova'),(4087,23,'Maçambara'),(4088,23,'Machadinho'),(4089,23,'Mampituba'),(4090,23,'Manoel Viana'),(4091,23,'Maquiné'),(4092,23,'Maratá'),(4093,23,'Marau'),(4094,23,'Marcelino Ramos'),(4095,23,'Mariana Pimentel'),(4096,23,'Mariano Moro'),(4097,23,'Marques de Souza'),(4098,23,'Mata'),(4099,23,'Mato Castelhano'),(4100,23,'Mato Leitão'),(4101,23,'Mato Queimado'),(4102,23,'Maximiliano de Almeida'),(4103,23,'Minas do Leão'),(4104,23,'Miraguaí'),(4105,23,'Montauri'),(4106,23,'Monte Alegre dos Campos'),(4107,23,'Monte Belo do Sul'),(4108,23,'Montenegro'),(4109,23,'Mormaço'),(4110,23,'Morrinhos do Sul'),(4111,23,'Morro Redondo'),(4112,23,'Morro Reuter'),(4113,23,'Mostardas'),(4114,23,'Muçum'),(4115,23,'Muitos Capões'),(4116,23,'Muliterno'),(4117,23,'Não-Me-Toque'),(4118,23,'Nicolau Vergueiro'),(4119,23,'Nonoai'),(4120,23,'Nova Alvorada'),(4121,23,'Nova Araçá'),(4122,23,'Nova Bassano'),(4123,23,'Nova Boa Vista'),(4124,23,'Nova Bréscia'),(4125,23,'Nova Candelária'),(4126,23,'Nova Esperança do Sul'),(4127,23,'Nova Hartz'),(4128,23,'Nova Pádua'),(4129,23,'Nova Palma'),(4130,23,'Nova Petrópolis'),(4131,23,'Nova Prata'),(4132,23,'Nova Ramada'),(4133,23,'Nova Roma do Sul'),(4134,23,'Nova Santa Rita'),(4135,23,'Novo Barreiro'),(4136,23,'Novo Cabrais'),(4137,23,'Novo Hamburgo'),(4138,23,'Novo Machado'),(4139,23,'Novo Tiradentes'),(4140,23,'Novo Xingu'),(4141,23,'Osório'),(4142,23,'Paim Filho'),(4143,23,'Palmares do Sul'),(4144,23,'Palmeira das Missões'),(4145,23,'Palmitinho'),(4146,23,'Panambi'),(4147,23,'Pantano Grande'),(4148,23,'Paraí'),(4149,23,'Paraíso do Sul'),(4150,23,'Pareci Novo'),(4151,23,'Parobé'),(4152,23,'Passa Sete'),(4153,23,'Passo do Sobrado'),(4154,23,'Passo Fundo'),(4155,23,'Paulo Bento'),(4156,23,'Paverama'),(4157,23,'Pedras Altas'),(4158,23,'Pedro Osório'),(4159,23,'Pejuçara'),(4160,23,'Pelotas'),(4161,23,'Picada Café'),(4162,23,'Pinhal'),(4163,23,'Pinhal da Serra'),(4164,23,'Pinhal Grande'),(4165,23,'Pinheirinho do Vale'),(4166,23,'Pinheiro Machado'),(4167,23,'Pirapó'),(4168,23,'Piratini'),(4169,23,'Planalto'),(4170,23,'Poço das Antas'),(4171,23,'Pontão'),(4172,23,'Ponte Preta'),(4173,23,'Portão'),(4174,23,'Porto Alegre'),(4175,23,'Porto Lucena'),(4176,23,'Porto Mauá'),(4177,23,'Porto Vera Cruz'),(4178,23,'Porto Xavier'),(4179,23,'Pouso Novo'),(4180,23,'Presidente Lucena'),(4181,23,'Progresso'),(4182,23,'Protásio Alves'),(4183,23,'Putinga'),(4184,23,'Quaraí'),(4185,23,'Quatro Irmãos'),(4186,23,'Quevedos'),(4187,23,'Quinze de Novembro'),(4188,23,'Redentora'),(4189,23,'Relvado'),(4190,23,'Restinga Seca'),(4191,23,'Rio dos Índios'),(4192,23,'Rio Grande'),(4193,23,'Rio Pardo'),(4194,23,'Riozinho'),(4195,23,'Roca Sales'),(4196,23,'Rodeio Bonito'),(4197,23,'Rolador'),(4198,23,'Rolante'),(4199,23,'Ronda Alta'),(4200,23,'Rondinha'),(4201,23,'Roque Gonzales'),(4202,23,'Rosário do Sul'),(4203,23,'Sagrada Família'),(4204,23,'Saldanha Marinho'),(4205,23,'Salto do Jacuí'),(4206,23,'Salvador das Missões'),(4207,23,'Salvador do Sul'),(4208,23,'Sananduva'),(4209,23,'Santa Bárbara do Sul'),(4210,23,'Santa Cecília do Sul'),(4211,23,'Santa Clara do Sul'),(4212,23,'Santa Cruz do Sul'),(4213,23,'Santa Margarida do Sul'),(4214,23,'Santa Maria'),(4215,23,'Santa Maria do Herval'),(4216,23,'Santa Rosa'),(4217,23,'Santa Tereza'),(4218,23,'Santa Vitória do Palmar'),(4219,23,'Santana da Boa Vista'),(4220,23,'Santana do Livramento'),(4221,23,'Santiago'),(4222,23,'Santo Ângelo'),(4223,23,'Santo Antônio da Patrulha'),(4224,23,'Santo Antônio das Missões'),(4225,23,'Santo Antônio do Palma'),(4226,23,'Santo Antônio do Planalto'),(4227,23,'Santo Augusto'),(4228,23,'Santo Cristo'),(4229,23,'Santo Expedito do Sul'),(4230,23,'São Borja'),(4231,23,'São Domingos do Sul'),(4232,23,'São Francisco de Assis'),(4233,23,'São Francisco de Paula'),(4234,23,'São Gabriel'),(4235,23,'São Jerônimo'),(4236,23,'São João da Urtiga'),(4237,23,'São João do Polêsine'),(4238,23,'São Jorge'),(4239,23,'São José das Missões'),(4240,23,'São José do Herval'),(4241,23,'São José do Hortêncio'),(4242,23,'São José do Inhacorá'),(4243,23,'São José do Norte'),(4244,23,'São José do Ouro'),(4245,23,'São José do Sul'),(4246,23,'São José dos Ausentes'),(4247,23,'São Leopoldo'),(4248,23,'São Lourenço do Sul'),(4249,23,'São Luiz Gonzaga'),(4250,23,'São Marcos'),(4251,23,'São Martinho'),(4252,23,'São Martinho da Serra'),(4253,23,'São Miguel das Missões'),(4254,23,'São Nicolau'),(4255,23,'São Paulo das Missões'),(4256,23,'São Pedro da Serra'),(4257,23,'São Pedro das Missões'),(4258,23,'São Pedro do Butiá'),(4259,23,'São Pedro do Sul'),(4260,23,'São Sebastião do Caí'),(4261,23,'São Sepé'),(4262,23,'São Valentim'),(4263,23,'São Valentim do Sul'),(4264,23,'São Valério do Sul'),(4265,23,'São Vendelino'),(4266,23,'São Vicente do Sul'),(4267,23,'Sapiranga'),(4268,23,'Sapucaia do Sul'),(4269,23,'Sarandi'),(4270,23,'Seberi'),(4271,23,'Sede Nova'),(4272,23,'Segredo'),(4273,23,'Selbach'),(4274,23,'Senador Salgado Filho'),(4275,23,'Sentinela do Sul'),(4276,23,'Serafina Corrêa'),(4277,23,'Sério'),(4278,23,'Sertão'),(4279,23,'Sertão Santana'),(4280,23,'Sete de Setembro'),(4281,23,'Severiano de Almeida'),(4282,23,'Silveira Martins'),(4283,23,'Sinimbu'),(4284,23,'Sobradinho'),(4285,23,'Soledade'),(4286,23,'Tabaí'),(4287,23,'Tapejara'),(4288,23,'Tapera'),(4289,23,'Tapes'),(4290,23,'Taquara'),(4291,23,'Taquari'),(4292,23,'Taquaruçu do Sul'),(4293,23,'Tavares'),(4294,23,'Tenente Portela'),(4295,23,'Terra de Areia'),(4296,23,'Teutônia'),(4297,23,'Tio Hugo'),(4298,23,'Tiradentes do Sul'),(4299,23,'Toropi'),(4300,23,'Torres'),(4301,23,'Tramandaí'),(4302,23,'Travesseiro'),(4303,23,'Três Arroios'),(4304,23,'Três Cachoeiras'),(4305,23,'Três Coroas'),(4306,23,'Três de Maio'),(4307,23,'Três Forquilhas'),(4308,23,'Três Palmeiras'),(4309,23,'Três Passos'),(4310,23,'Trindade do Sul'),(4311,23,'Triunfo'),(4312,23,'Tucunduva'),(4313,23,'Tunas'),(4314,23,'Tupanci do Sul'),(4315,23,'Tupanciretã'),(4316,23,'Tupandi'),(4317,23,'Tuparendi'),(4318,23,'Turuçu'),(4319,23,'Ubiretama'),(4320,23,'União da Serra'),(4321,23,'Unistalda'),(4322,23,'Uruguaiana'),(4323,23,'Vacaria'),(4324,23,'Vale do Sol'),(4325,23,'Vale Real'),(4326,23,'Vale Verde'),(4327,23,'Vanini'),(4328,23,'Venâncio Aires'),(4329,23,'Vera Cruz'),(4330,23,'Veranópolis'),(4331,23,'Vespasiano Correa'),(4332,23,'Viadutos'),(4333,23,'Viamão'),(4334,23,'Vicente Dutra'),(4335,23,'Victor Graeff'),(4336,23,'Vila Flores'),(4337,23,'Vila Lângaro'),(4338,23,'Vila Maria'),(4339,23,'Vila Nova do Sul'),(4340,23,'Vista Alegre'),(4341,23,'Vista Alegre do Prata'),(4342,23,'Vista Gaúcha'),(4343,23,'Vitória das Missões'),(4344,23,'Westfália'),(4345,23,'Xangri-lá'),(4346,10,'Alta Floresta d`Oeste'),(4347,10,'Alto Alegre dos Parecis'),(4348,10,'Alto Paraíso'),(4349,10,'Alvorada d`Oeste'),(4350,10,'Ariquemes'),(4351,10,'Buritis'),(4352,10,'Cabixi'),(4353,10,'Cacaulândia'),(4354,10,'Cacoal'),(4355,10,'Campo Novo de Rondônia'),(4356,10,'Candeias do Jamari'),(4357,10,'Castanheiras'),(4358,10,'Cerejeiras'),(4359,10,'Chupinguaia'),(4360,10,'Colorado do Oeste'),(4361,10,'Corumbiara'),(4362,10,'Costa Marques'),(4363,10,'Cujubim'),(4364,10,'Espigão d`Oeste'),(4365,10,'Governador Jorge Teixeira'),(4366,10,'Guajará-Mirim'),(4367,10,'Itapuã do Oeste'),(4368,10,'Jaru'),(4369,10,'Ji-Paraná'),(4370,10,'Machadinho d`Oeste'),(4371,10,'Ministro Andreazza'),(4372,10,'Mirante da Serra'),(4373,10,'Monte Negro'),(4374,10,'Nova Brasilândia d`Oeste'),(4375,10,'Nova Mamoré'),(4376,10,'Nova União'),(4377,10,'Novo Horizonte do Oeste'),(4378,10,'Ouro Preto do Oeste'),(4379,10,'Parecis'),(4380,10,'Pimenta Bueno'),(4381,10,'Pimenteiras do Oeste'),(4382,10,'Porto Velho'),(4383,10,'Presidente Médici'),(4384,10,'Primavera de Rondônia'),(4385,10,'Rio Crespo'),(4386,10,'Rolim de Moura'),(4387,10,'Santa Luzia d`Oeste'),(4388,10,'São Felipe d`Oeste'),(4389,10,'São Francisco do Guaporé'),(4390,10,'São Miguel do Guaporé'),(4391,10,'Seringueiras'),(4392,10,'Teixeirópolis'),(4393,10,'Theobroma'),(4394,10,'Urupá'),(4395,10,'Vale do Anari'),(4396,10,'Vale do Paraíso'),(4397,10,'Vilhena'),(4398,6,'Alto Alegre'),(4399,6,'Amajari'),(4400,6,'Boa Vista'),(4401,6,'Bonfim'),(4402,6,'Cantá'),(4403,6,'Caracaraí'),(4404,6,'Caroebe'),(4405,6,'Iracema'),(4406,6,'Mucajaí'),(4407,6,'Normandia'),(4408,6,'Pacaraima'),(4409,6,'Rorainópolis'),(4410,6,'São João da Baliza'),(4411,6,'São Luiz'),(4412,6,'Uiramutã'),(4413,22,'Abdon Batista'),(4414,22,'Abelardo Luz'),(4415,22,'Agrolândia'),(4416,22,'Agronômica'),(4417,22,'Água Doce'),(4418,22,'Águas de Chapecó'),(4419,22,'Águas Frias'),(4420,22,'Águas Mornas'),(4421,22,'Alfredo Wagner'),(4422,22,'Alto Bela Vista'),(4423,22,'Anchieta'),(4424,22,'Angelina'),(4425,22,'Anita Garibaldi'),(4426,22,'Anitápolis'),(4427,22,'Antônio Carlos'),(4428,22,'Apiúna'),(4429,22,'Arabutã'),(4430,22,'Araquari'),(4431,22,'Araranguá'),(4432,22,'Armazém'),(4433,22,'Arroio Trinta'),(4434,22,'Arvoredo'),(4435,22,'Ascurra'),(4436,22,'Atalanta'),(4437,22,'Aurora'),(4438,22,'Balneário Arroio do Silva'),(4439,22,'Balneário Barra do Sul'),(4440,22,'Balneário Camboriú'),(4441,22,'Balneário Gaivota'),(4442,22,'Bandeirante'),(4443,22,'Barra Bonita'),(4444,22,'Barra Velha'),(4445,22,'Bela Vista do Toldo'),(4446,22,'Belmonte'),(4447,22,'Benedito Novo'),(4448,22,'Biguaçu'),(4449,22,'Blumenau'),(4450,22,'Bocaina do Sul'),(4451,22,'Bom Jardim da Serra'),(4452,22,'Bom Jesus'),(4453,22,'Bom Jesus do Oeste'),(4454,22,'Bom Retiro'),(4455,22,'Bombinhas'),(4456,22,'Botuverá'),(4457,22,'Braço do Norte'),(4458,22,'Braço do Trombudo'),(4459,22,'Brunópolis'),(4460,22,'Brusque'),(4461,22,'Caçador'),(4462,22,'Caibi'),(4463,22,'Calmon'),(4464,22,'Camboriú'),(4465,22,'Campo Alegre'),(4466,22,'Campo Belo do Sul'),(4467,22,'Campo Erê'),(4468,22,'Campos Novos'),(4469,22,'Canelinha'),(4470,22,'Canoinhas'),(4471,22,'Capão Alto'),(4472,22,'Capinzal'),(4473,22,'Capivari de Baixo'),(4474,22,'Catanduvas'),(4475,22,'Caxambu do Sul'),(4476,22,'Celso Ramos'),(4477,22,'Cerro Negro'),(4478,22,'Chapadão do Lageado'),(4479,22,'Chapecó'),(4480,22,'Cocal do Sul'),(4481,22,'Concórdia'),(4482,22,'Cordilheira Alta'),(4483,22,'Coronel Freitas'),(4484,22,'Coronel Martins'),(4485,22,'Correia Pinto'),(4486,22,'Corupá'),(4487,22,'Criciúma'),(4488,22,'Cunha Porã'),(4489,22,'Cunhataí'),(4490,22,'Curitibanos'),(4491,22,'Descanso'),(4492,22,'Dionísio Cerqueira'),(4493,22,'Dona Emma'),(4494,22,'Doutor Pedrinho'),(4495,22,'Entre Rios'),(4496,22,'Ermo'),(4497,22,'Erval Velho'),(4498,22,'Faxinal dos Guedes'),(4499,22,'Flor do Sertão'),(4500,22,'Florianópolis'),(4501,22,'Formosa do Sul'),(4502,22,'Forquilhinha'),(4503,22,'Fraiburgo'),(4504,22,'Frei Rogério'),(4505,22,'Galvão'),(4506,22,'Garopaba'),(4507,22,'Garuva'),(4508,22,'Gaspar'),(4509,22,'Governador Celso Ramos'),(4510,22,'Grão Pará'),(4511,22,'Gravatal'),(4512,22,'Guabiruba'),(4513,22,'Guaraciaba'),(4514,22,'Guaramirim'),(4515,22,'Guarujá do Sul'),(4516,22,'Guatambú'),(4517,22,'Herval d`Oeste'),(4518,22,'Ibiam'),(4519,22,'Ibicaré'),(4520,22,'Ibirama'),(4521,22,'Içara'),(4522,22,'Ilhota'),(4523,22,'Imaruí'),(4524,22,'Imbituba'),(4525,22,'Imbuia'),(4526,22,'Indaial'),(4527,22,'Iomerê'),(4528,22,'Ipira'),(4529,22,'Iporã do Oeste'),(4530,22,'Ipuaçu'),(4531,22,'Ipumirim'),(4532,22,'Iraceminha'),(4533,22,'Irani'),(4534,22,'Irati'),(4535,22,'Irineópolis'),(4536,22,'Itá'),(4537,22,'Itaiópolis'),(4538,22,'Itajaí'),(4539,22,'Itapema'),(4540,22,'Itapiranga'),(4541,22,'Itapoá'),(4542,22,'Ituporanga'),(4543,22,'Jaborá'),(4544,22,'Jacinto Machado'),(4545,22,'Jaguaruna'),(4546,22,'Jaraguá do Sul'),(4547,22,'Jardinópolis'),(4548,22,'Joaçaba'),(4549,22,'Joinville'),(4550,22,'José Boiteux'),(4551,22,'Jupiá'),(4552,22,'Lacerdópolis'),(4553,22,'Lages'),(4554,22,'Laguna'),(4555,22,'Lajeado Grande'),(4556,22,'Laurentino'),(4557,22,'Lauro Muller'),(4558,22,'Lebon Régis'),(4559,22,'Leoberto Leal'),(4560,22,'Lindóia do Sul'),(4561,22,'Lontras'),(4562,22,'Luiz Alves'),(4563,22,'Luzerna'),(4564,22,'Macieira'),(4565,22,'Mafra'),(4566,22,'Major Gercino'),(4567,22,'Major Vieira'),(4568,22,'Maracajá'),(4569,22,'Maravilha'),(4570,22,'Marema'),(4571,22,'Massaranduba'),(4572,22,'Matos Costa'),(4573,22,'Meleiro'),(4574,22,'Mirim Doce'),(4575,22,'Modelo'),(4576,22,'Mondaí'),(4577,22,'Monte Carlo'),(4578,22,'Monte Castelo'),(4579,22,'Morro da Fumaça'),(4580,22,'Morro Grande'),(4581,22,'Navegantes'),(4582,22,'Nova Erechim'),(4583,22,'Nova Itaberaba'),(4584,22,'Nova Trento'),(4585,22,'Nova Veneza'),(4586,22,'Novo Horizonte'),(4587,22,'Orleans'),(4588,22,'Otacílio Costa'),(4589,22,'Ouro'),(4590,22,'Ouro Verde'),(4591,22,'Paial'),(4592,22,'Painel'),(4593,22,'Palhoça'),(4594,22,'Palma Sola'),(4595,22,'Palmeira'),(4596,22,'Palmitos'),(4597,22,'Papanduva'),(4598,22,'Paraíso'),(4599,22,'Passo de Torres'),(4600,22,'Passos Maia'),(4601,22,'Paulo Lopes'),(4602,22,'Pedras Grandes'),(4603,22,'Penha'),(4604,22,'Peritiba'),(4605,22,'Petrolândia'),(4606,22,'Piçarras'),(4607,22,'Pinhalzinho'),(4608,22,'Pinheiro Preto'),(4609,22,'Piratuba'),(4610,22,'Planalto Alegre'),(4611,22,'Pomerode'),(4612,22,'Ponte Alta'),(4613,22,'Ponte Alta do Norte'),(4614,22,'Ponte Serrada'),(4615,22,'Porto Belo'),(4616,22,'Porto União'),(4617,22,'Pouso Redondo'),(4618,22,'Praia Grande'),(4619,22,'Presidente Castelo Branco'),(4620,22,'Presidente Getúlio'),(4621,22,'Presidente Nereu'),(4622,22,'Princesa'),(4623,22,'Quilombo'),(4624,22,'Rancho Queimado'),(4625,22,'Rio das Antas'),(4626,22,'Rio do Campo'),(4627,22,'Rio do Oeste'),(4628,22,'Rio do Sul'),(4629,22,'Rio dos Cedros'),(4630,22,'Rio Fortuna'),(4631,22,'Rio Negrinho'),(4632,22,'Rio Rufino'),(4633,22,'Riqueza'),(4634,22,'Rodeio'),(4635,22,'Romelândia'),(4636,22,'Salete'),(4637,22,'Saltinho'),(4638,22,'Salto Veloso'),(4639,22,'Sangão'),(4640,22,'Santa Cecília'),(4641,22,'Santa Helena'),(4642,22,'Santa Rosa de Lima'),(4643,22,'Santa Rosa do Sul'),(4644,22,'Santa Terezinha'),(4645,22,'Santa Terezinha do Progresso'),(4646,22,'Santiago do Sul'),(4647,22,'Santo Amaro da Imperatriz'),(4648,22,'São Bento do Sul'),(4649,22,'São Bernardino'),(4650,22,'São Bonifácio'),(4651,22,'São Carlos'),(4652,22,'São Cristovão do Sul'),(4653,22,'São Domingos'),(4654,22,'São Francisco do Sul'),(4655,22,'São João Batista'),(4656,22,'São João do Itaperiú'),(4657,22,'São João do Oeste'),(4658,22,'São João do Sul'),(4659,22,'São Joaquim'),(4660,22,'São José'),(4661,22,'São José do Cedro'),(4662,22,'São José do Cerrito'),(4663,22,'São Lourenço do Oeste'),(4664,22,'São Ludgero'),(4665,22,'São Martinho'),(4666,22,'São Miguel da Boa Vista'),(4667,22,'São Miguel do Oeste'),(4668,22,'São Pedro de Alcântara'),(4669,22,'Saudades'),(4670,22,'Schroeder'),(4671,22,'Seara'),(4672,22,'Serra Alta'),(4673,22,'Siderópolis'),(4674,22,'Sombrio'),(4675,22,'Sul Brasil'),(4676,22,'Taió'),(4677,22,'Tangará'),(4678,22,'Tigrinhos'),(4679,22,'Tijucas'),(4680,22,'Timbé do Sul'),(4681,22,'Timbó'),(4682,22,'Timbó Grande'),(4683,22,'Três Barras'),(4684,22,'Treviso'),(4685,22,'Treze de Maio'),(4686,22,'Treze Tílias'),(4687,22,'Trombudo Central'),(4688,22,'Tubarão'),(4689,22,'Tunápolis'),(4690,22,'Turvo'),(4691,22,'União do Oeste'),(4692,22,'Urubici'),(4693,22,'Urupema'),(4694,22,'Urussanga'),(4695,22,'Vargeão'),(4696,22,'Vargem'),(4697,22,'Vargem Bonita'),(4698,22,'Vidal Ramos'),(4699,22,'Videira'),(4700,22,'Vitor Meireles'),(4701,22,'Witmarsum'),(4702,22,'Xanxerê'),(4703,22,'Xavantina'),(4704,22,'Xaxim'),(4705,22,'Zortéa'),(4706,1,'Adamantina'),(4707,1,'Adolfo'),(4708,1,'Aguaí'),(4709,1,'Águas da Prata'),(4710,1,'Águas de Lindóia'),(4711,1,'Águas de Santa Bárbara'),(4712,1,'Águas de São Pedro'),(4713,1,'Agudos'),(4714,1,'Alambari'),(4715,1,'Alfredo Marcondes'),(4716,1,'Altair'),(4717,1,'Altinópolis'),(4718,1,'Alto Alegre'),(4719,1,'Alumínio'),(4720,1,'Álvares Florence'),(4721,1,'Álvares Machado'),(4722,1,'Álvaro de Carvalho'),(4723,1,'Alvinlândia'),(4724,1,'Americana'),(4725,1,'Américo Brasiliense'),(4726,1,'Américo de Campos'),(4727,1,'Amparo'),(4728,1,'Analândia'),(4729,1,'Andradina'),(4730,1,'Angatuba'),(4731,1,'Anhembi'),(4732,1,'Anhumas'),(4733,1,'Aparecida'),(4734,1,'Aparecida d`Oeste'),(4735,1,'Apiaí'),(4736,1,'Araçariguama'),(4737,1,'Araçatuba'),(4738,1,'Araçoiaba da Serra'),(4739,1,'Aramina'),(4740,1,'Arandu'),(4741,1,'Arapeí'),(4742,1,'Araraquara'),(4743,1,'Araras'),(4744,1,'Arco-Íris'),(4745,1,'Arealva'),(4746,1,'Areias'),(4747,1,'Areiópolis'),(4748,1,'Ariranha'),(4749,1,'Artur Nogueira'),(4750,1,'Arujá'),(4751,1,'Aspásia'),(4752,1,'Assis'),(4753,1,'Atibaia'),(4754,1,'Auriflama'),(4755,1,'Avaí'),(4756,1,'Avanhandava'),(4757,1,'Avaré'),(4758,1,'Bady Bassitt'),(4759,1,'Balbinos'),(4760,1,'Bálsamo'),(4761,1,'Bananal'),(4762,1,'Barão de Antonina'),(4763,1,'Barbosa'),(4764,1,'Bariri'),(4765,1,'Barra Bonita'),(4766,1,'Barra do Chapéu'),(4767,1,'Barra do Turvo'),(4768,1,'Barretos'),(4769,1,'Barrinha'),(4771,1,'Bastos'),(4772,1,'Batatais'),(4773,1,'Bauru'),(4774,1,'Bebedouro'),(4775,1,'Bento de Abreu'),(4776,1,'Bernardino de Campos'),(4777,1,'Bertioga'),(4778,1,'Bilac'),(4779,1,'Birigui'),(4780,1,'Biritiba-Mirim'),(4781,1,'Boa Esperança do Sul'),(4782,1,'Bocaina'),(4783,1,'Bofete'),(4784,1,'Boituva'),(4785,1,'Bom Jesus dos Perdões'),(4786,1,'Bom Sucesso de Itararé'),(4787,1,'Borá'),(4788,1,'Boracéia'),(4789,1,'Borborema'),(4790,1,'Borebi'),(4791,1,'Botucatu'),(4792,1,'Bragança Paulista'),(4793,1,'Braúna'),(4794,1,'Brejo Alegre'),(4795,1,'Brodowski'),(4796,1,'Brotas'),(4797,1,'Buri'),(4798,1,'Buritama'),(4799,1,'Buritizal'),(4800,1,'Cabrália Paulista'),(4801,1,'Cabreúva'),(4802,1,'Caçapava'),(4803,1,'Cachoeira Paulista'),(4804,1,'Caconde'),(4805,1,'Cafelândia'),(4806,1,'Caiabu'),(4807,1,'Caieiras'),(4808,1,'Caiuá'),(4809,1,'Cajamar'),(4810,1,'Cajati'),(4811,1,'Cajobi'),(4812,1,'Cajuru'),(4813,1,'Campina do Monte Alegre'),(4814,1,'Campinas'),(4815,1,'Campo Limpo Paulista'),(4816,1,'Campos do Jordão'),(4817,1,'Campos Novos Paulista'),(4818,1,'Cananéia'),(4819,1,'Canas'),(4820,1,'Cândido Mota'),(4821,1,'Cândido Rodrigues'),(4822,1,'Canitar'),(4823,1,'Capão Bonito'),(4824,1,'Capela do Alto'),(4825,1,'Capivari'),(4826,1,'Caraguatatuba'),(4827,1,'Carapicuíba'),(4828,1,'Cardoso'),(4829,1,'Casa Branca'),(4830,1,'Cássia dos Coqueiros'),(4831,1,'Castilho'),(4832,1,'Catanduva'),(4833,1,'Catiguá'),(4834,1,'Cedral'),(4835,1,'Cerqueira César'),(4836,1,'Cerquilho'),(4837,1,'Cesário Lange'),(4838,1,'Charqueada'),(4839,1,'Chavantes'),(4840,1,'Clementina'),(4841,1,'Colina'),(4842,1,'Colômbia'),(4843,1,'Conchal'),(4844,1,'Conchas'),(4845,1,'Cordeirópolis'),(4846,1,'Coroados'),(4847,1,'Coronel Macedo'),(4848,1,'Corumbataí'),(4849,1,'Cosmópolis'),(4850,1,'Cosmorama'),(4851,1,'Cotia'),(4852,1,'Cravinhos'),(4853,1,'Cristais Paulista'),(4854,1,'Cruzália'),(4855,1,'Cruzeiro'),(4856,1,'Cubatão'),(4857,1,'Cunha'),(4858,1,'Descalvado'),(4859,1,'Diadema'),(4860,1,'Dirce Reis'),(4861,1,'Divinolândia'),(4862,1,'Dobrada'),(4863,1,'Dois Córregos'),(4864,1,'Dolcinópolis'),(4865,1,'Dourado'),(4866,1,'Dracena'),(4867,1,'Duartina'),(4868,1,'Dumont'),(4869,1,'Echaporã'),(4870,1,'Eldorado'),(4871,1,'Elias Fausto'),(4872,1,'Elisiário'),(4873,1,'Embaúba'),(4874,1,'Embu'),(4875,1,'Embu-Guaçu'),(4876,1,'Emilianópolis'),(4877,1,'Engenheiro Coelho'),(4878,1,'Espírito Santo do Pinhal'),(4879,1,'Espírito Santo do Turvo'),(4880,1,'Estiva Gerbi'),(4881,1,'Estrela d`Oeste'),(4882,1,'Estrela do Norte'),(4883,1,'Euclides da Cunha Paulista'),(4884,1,'Fartura'),(4885,1,'Fernando Prestes'),(4886,1,'Fernandópolis'),(4887,1,'Fernão'),(4888,1,'Ferraz de Vasconcelos'),(4889,1,'Flora Rica'),(4890,1,'Floreal'),(4891,1,'Flórida Paulista'),(4892,1,'Florínia'),(4893,1,'Franca'),(4894,1,'Francisco Morato'),(4895,1,'Franco da Rocha'),(4896,1,'Gabriel Monteiro'),(4897,1,'Gália'),(4898,1,'Garça'),(4899,1,'Gastão Vidigal'),(4900,1,'Gavião Peixoto'),(4901,1,'General Salgado'),(4902,1,'Getulina'),(4903,1,'Glicério'),(4904,1,'Guaiçara'),(4905,1,'Guaimbê'),(4906,1,'Guaíra'),(4907,1,'Guapiaçu'),(4908,1,'Guapiara'),(4909,1,'Guará'),(4910,1,'Guaraçaí'),(4911,1,'Guaraci'),(4912,1,'Guarani d`Oeste'),(4913,1,'Guarantã'),(4914,1,'Guararapes'),(4915,1,'Guararema'),(4916,1,'Guaratinguetá'),(4917,1,'Guareí'),(4918,1,'Guariba'),(4919,1,'Guarujá'),(4920,1,'Guarulhos'),(4921,1,'Guatapará'),(4922,1,'Guzolândia'),(4923,1,'Herculândia'),(4924,1,'Holambra'),(4925,1,'Hortolândia'),(4926,1,'Iacanga'),(4927,1,'Iacri'),(4928,1,'Iaras'),(4929,1,'Ibaté'),(4930,1,'Ibirá'),(4931,1,'Ibirarema'),(4932,1,'Ibitinga'),(4933,1,'Ibiúna'),(4934,1,'Icém'),(4935,1,'Iepê'),(4936,1,'Igaraçu do Tietê'),(4937,1,'Igarapava'),(4938,1,'Igaratá'),(4939,1,'Iguape'),(4940,1,'Ilha Comprida'),(4941,1,'Ilha Solteira'),(4942,1,'Ilhabela'),(4943,1,'Indaiatuba'),(4944,1,'Indiana'),(4945,1,'Indiaporã'),(4946,1,'Inúbia Paulista'),(4947,1,'Ipaussu'),(4948,1,'Iperó'),(4949,1,'Ipeúna'),(4950,1,'Ipiguá'),(4951,1,'Iporanga'),(4952,1,'Ipuã'),(4953,1,'Iracemápolis'),(4954,1,'Irapuã'),(4955,1,'Irapuru'),(4956,1,'Itaberá'),(4957,1,'Itaí'),(4958,1,'Itajobi'),(4959,1,'Itaju'),(4960,1,'Itanhaém'),(4961,1,'Itaóca'),(4962,1,'Itapecerica da Serra'),(4963,1,'Itapetininga'),(4964,1,'Itapeva'),(4965,1,'Itapevi'),(4966,1,'Itapira'),(4967,1,'Itapirapuã Paulista'),(4968,1,'Itápolis'),(4969,1,'Itaporanga'),(4970,1,'Itapuí'),(4971,1,'Itapura'),(4972,1,'Itaquaquecetuba'),(4973,1,'Itararé'),(4974,1,'Itariri'),(4975,1,'Itatiba'),(4976,1,'Itatinga'),(4977,1,'Itirapina'),(4978,1,'Itirapuã'),(4979,1,'Itobi'),(4980,1,'Itu'),(4981,1,'Itupeva'),(4982,1,'Ituverava'),(4983,1,'Jaborandi'),(4984,1,'Jaboticabal'),(4985,1,'Jacareí'),(4986,1,'Jaci'),(4987,1,'Jacupiranga'),(4988,1,'Jaguariúna'),(4989,1,'Jales'),(4990,1,'Jambeiro'),(4992,1,'Jardinópolis'),(4993,1,'Jarinu'),(4994,1,'Jaú'),(4995,1,'Jeriquara'),(4996,1,'Joanópolis'),(4997,1,'João Ramalho'),(4998,1,'José Bonifácio'),(4999,1,'Júlio Mesquita'),(5000,1,'Jumirim'),(5001,1,'Jundiaí'),(5002,1,'Junqueirópolis'),(5003,1,'Juquiá'),(5004,1,'Juquitiba'),(5005,1,'Lagoinha'),(5006,1,'Laranjal Paulista'),(5007,1,'Lavínia'),(5008,1,'Lavrinhas'),(5009,1,'Leme'),(5010,1,'Lençóis Paulista'),(5011,1,'Limeira'),(5012,1,'Lindóia'),(5013,1,'Lins'),(5014,1,'Lorena'),(5015,1,'Lourdes'),(5016,1,'Louveira'),(5017,1,'Lucélia'),(5018,1,'Lucianópolis'),(5019,1,'Luís Antônio'),(5020,1,'Luiziânia'),(5021,1,'Lupércio'),(5022,1,'Lutécia'),(5023,1,'Macatuba'),(5024,1,'Macaubal'),(5025,1,'Macedônia'),(5026,1,'Magda'),(5027,1,'Mairinque'),(5028,1,'Mairiporã'),(5029,1,'Manduri'),(5030,1,'Marabá Paulista'),(5031,1,'Maracaí'),(5032,1,'Marapoama'),(5033,1,'Mariápolis'),(5034,1,'Marília'),(5035,1,'Marinópolis'),(5036,1,'Martinópolis'),(5037,1,'Matão'),(5038,1,'Mauá'),(5039,1,'Mendonça'),(5040,1,'Meridiano'),(5041,1,'Mesópolis'),(5042,1,'Miguelópolis'),(5043,1,'Mineiros do Tietê'),(5044,1,'Mira Estrela'),(5045,1,'Miracatu'),(5046,1,'Mirandópolis'),(5047,1,'Mirante do Paranapanema'),(5048,1,'Mirassol'),(5049,1,'Mirassolândia'),(5050,1,'Mococa'),(5051,1,'Mogi das Cruzes'),(5052,1,'Mogi Guaçu'),(5053,1,'Moji Mirim'),(5054,1,'Mombuca'),(5055,1,'Monções'),(5056,1,'Mongaguá'),(5057,1,'Monte Alegre do Sul'),(5058,1,'Monte Alto'),(5059,1,'Monte Aprazível'),(5060,1,'Monte Azul Paulista'),(5061,1,'Monte Castelo'),(5062,1,'Monte Mor'),(5063,1,'Monteiro Lobato'),(5064,1,'Morro Agudo'),(5065,1,'Morungaba'),(5066,1,'Motuca'),(5067,1,'Murutinga do Sul'),(5068,1,'Nantes'),(5069,1,'Narandiba'),(5070,1,'Natividade da Serra'),(5071,1,'Nazaré Paulista'),(5072,1,'Neves Paulista'),(5073,1,'Nhandeara'),(5074,1,'Nipoã'),(5075,1,'Nova Aliança'),(5076,1,'Nova Campina'),(5077,1,'Nova Canaã Paulista'),(5078,1,'Nova Castilho'),(5079,1,'Nova Europa'),(5080,1,'Nova Granada'),(5081,1,'Nova Guataporanga'),(5082,1,'Nova Independência'),(5083,1,'Nova Luzitânia'),(5084,1,'Nova Odessa'),(5085,1,'Novais'),(5086,1,'Novo Horizonte'),(5087,1,'Nuporanga'),(5088,1,'Ocauçu'),(5089,1,'Óleo'),(5090,1,'Olímpia'),(5091,1,'Onda Verde'),(5092,1,'Oriente'),(5093,1,'Orindiúva'),(5094,1,'Orlândia'),(5096,1,'Oscar Bressane'),(5097,1,'Osvaldo Cruz'),(5098,1,'Ourinhos'),(5099,1,'Ouro Verde'),(5100,1,'Ouroeste'),(5101,1,'Pacaembu'),(5102,1,'Palestina'),(5103,1,'Palmares Paulista'),(5104,1,'Palmeira d`Oeste'),(5105,1,'Palmital'),(5106,1,'Panorama'),(5107,1,'Paraguaçu Paulista'),(5108,1,'Paraibuna'),(5109,1,'Paraíso'),(5110,1,'Paranapanema'),(5111,1,'Paranapuã'),(5112,1,'Parapuã'),(5113,1,'Pardinho'),(5114,1,'Pariquera-Açu'),(5115,1,'Parisi'),(5116,1,'Patrocínio Paulista'),(5117,1,'Paulicéia'),(5118,1,'Paulínia'),(5119,1,'Paulistânia'),(5120,1,'Paulo de Faria'),(5121,1,'Pederneiras'),(5122,1,'Pedra Bela'),(5123,1,'Pedranópolis'),(5124,1,'Pedregulho'),(5125,1,'Pedreira'),(5126,1,'Pedrinhas Paulista'),(5127,1,'Pedro de Toledo'),(5128,1,'Penápolis'),(5129,1,'Pereira Barreto'),(5130,1,'Pereiras'),(5131,1,'Peruíbe'),(5132,1,'Piacatu'),(5133,1,'Piedade'),(5134,1,'Pilar do Sul'),(5135,1,'Pindamonhangaba'),(5136,1,'Pindorama'),(5137,1,'Pinhalzinho'),(5138,1,'Piquerobi'),(5139,1,'Piquete'),(5140,1,'Piracaia'),(5141,1,'Piracicaba'),(5142,1,'Piraju'),(5143,1,'Pirajuí'),(5144,1,'Pirangi'),(5145,1,'Pirapora do Bom Jesus'),(5146,1,'Pirapozinho'),(5147,1,'Pirassununga'),(5148,1,'Piratininga'),(5149,1,'Pitangueiras'),(5150,1,'Planalto'),(5151,1,'Platina'),(5152,1,'Poá'),(5153,1,'Poloni'),(5154,1,'Pompéia'),(5155,1,'Pongaí'),(5156,1,'Pontal'),(5157,1,'Pontalinda'),(5158,1,'Pontes Gestal'),(5159,1,'Populina'),(5160,1,'Porangaba'),(5161,1,'Porto Feliz'),(5162,1,'Porto Ferreira'),(5163,1,'Potim'),(5164,1,'Potirendaba'),(5165,1,'Pracinha'),(5166,1,'Pradópolis'),(5167,1,'Praia Grande'),(5168,1,'Pratânia'),(5169,1,'Presidente Alves'),(5170,1,'Presidente Bernardes'),(5171,1,'Presidente Epitácio'),(5172,1,'Presidente Prudente'),(5173,1,'Presidente Venceslau'),(5174,1,'Promissão'),(5175,1,'Quadra'),(5176,1,'Quatá'),(5177,1,'Queiroz'),(5178,1,'Queluz'),(5179,1,'Quintana'),(5180,1,'Rafard'),(5181,1,'Rancharia'),(5182,1,'Redenção da Serra'),(5183,1,'Regente Feijó'),(5184,1,'Reginópolis'),(5185,1,'Registro'),(5186,1,'Restinga'),(5187,1,'Ribeira'),(5188,1,'Ribeirão Bonito'),(5189,1,'Ribeirão Branco'),(5190,1,'Ribeirão Corrente'),(5191,1,'Ribeirão do Sul'),(5192,1,'Ribeirão dos Índios'),(5193,1,'Ribeirão Grande'),(5194,1,'Ribeirão Pires'),(5195,1,'Ribeirão Preto'),(5196,1,'Rifaina'),(5197,1,'Rincão'),(5198,1,'Rinópolis'),(5199,1,'Rio Claro'),(5200,1,'Rio das Pedras'),(5201,1,'Rio Grande da Serra'),(5202,1,'Riolândia'),(5203,1,'Riversul'),(5204,1,'Rosana'),(5205,1,'Roseira'),(5206,1,'Rubiácea'),(5207,1,'Rubinéia'),(5208,1,'Sabino'),(5209,1,'Sagres'),(5210,1,'Sales'),(5211,1,'Sales Oliveira'),(5212,1,'Salesópolis'),(5213,1,'Salmourão'),(5214,1,'Saltinho'),(5215,1,'Salto'),(5216,1,'Salto de Pirapora'),(5217,1,'Salto Grande'),(5218,1,'Sandovalina'),(5219,1,'Santa Adélia'),(5220,1,'Santa Albertina'),(5221,1,'Santa Bárbara d`Oeste'),(5222,1,'Santa Branca'),(5223,1,'Santa Clara d`Oeste'),(5224,1,'Santa Cruz da Conceição'),(5225,1,'Santa Cruz da Esperança'),(5226,1,'Santa Cruz das Palmeiras'),(5227,1,'Santa Cruz do Rio Pardo'),(5228,1,'Santa Ernestina'),(5229,1,'Santa Fé do Sul'),(5230,1,'Santa Gertrudes'),(5231,1,'Santa Isabel'),(5232,1,'Santa Lúcia'),(5233,1,'Santa Maria da Serra'),(5234,1,'Santa Mercedes'),(5235,1,'Santa Rita d`Oeste'),(5236,1,'Santa Rita do Passa Quatro'),(5237,1,'Santa Rosa de Viterbo'),(5238,1,'Santa Salete'),(5239,1,'Santana da Ponte Pensa'),(5240,1,'Santana de Parnaíba'),(5241,1,'Santo Anastácio'),(5242,1,'Santo André'),(5243,1,'Santo Antônio da Alegria'),(5244,1,'Santo Antônio de Posse'),(5245,1,'Santo Antônio do Aracanguá'),(5246,1,'Santo Antônio do Jardim'),(5247,1,'Santo Antônio do Pinhal'),(5248,1,'Santo Expedito'),(5249,1,'Santópolis do Aguapeí'),(5250,1,'Santos'),(5251,1,'São Bento do Sapucaí'),(5252,1,'São Bernardo do Campo'),(5253,1,'São Caetano do Sul'),(5254,1,'São Carlos'),(5255,1,'São Francisco'),(5256,1,'São João da Boa Vista'),(5257,1,'São João das Duas Pontes'),(5258,1,'São João de Iracema'),(5259,1,'São João do Pau d`Alho'),(5260,1,'São Joaquim da Barra'),(5261,1,'São José da Bela Vista'),(5262,1,'São José do Barreiro'),(5263,1,'São José do Rio Pardo'),(5264,1,'São José do Rio Preto'),(5265,1,'São José dos Campos'),(5266,1,'São Lourenço da Serra'),(5267,1,'São Luís do Paraitinga'),(5268,1,'São Manuel'),(5269,1,'São Miguel Arcanjo'),(5270,1,'São Paulo'),(5271,1,'São Pedro'),(5272,1,'São Pedro do Turvo'),(5273,1,'São Roque'),(5274,1,'São Sebastião'),(5275,1,'São Sebastião da Grama'),(5276,1,'São Simão'),(5277,1,'São Vicente'),(5278,1,'Sarapuí'),(5279,1,'Sarutaiá'),(5280,1,'Sebastianópolis do Sul'),(5281,1,'Serra Azul'),(5282,1,'Serra Negra'),(5283,1,'Serrana'),(5284,1,'Sertãozinho'),(5285,1,'Sete Barras'),(5286,1,'Severínia'),(5287,1,'Silveiras'),(5288,1,'Socorro'),(5289,1,'Sorocaba'),(5290,1,'Sud Mennucci'),(5291,1,'Sumaré'),(5292,1,'Suzanápolis'),(5293,1,'Suzano'),(5294,1,'Tabapuã'),(5295,1,'Tabatinga'),(5296,1,'Taboão da Serra'),(5297,1,'Taciba'),(5298,1,'Taguaí'),(5299,1,'Taiaçu'),(5300,1,'Taiúva'),(5301,1,'Tambaú'),(5302,1,'Tanabi'),(5303,1,'Tapiraí'),(5304,1,'Tapiratiba'),(5305,1,'Taquaral'),(5306,1,'Taquaritinga'),(5307,1,'Taquarituba'),(5308,1,'Taquarivaí'),(5309,1,'Tarabai'),(5310,1,'Tarumã'),(5311,1,'Tatuí'),(5312,1,'Taubaté'),(5313,1,'Tejupá'),(5314,1,'Teodoro Sampaio'),(5315,1,'Terra Roxa'),(5316,1,'Tietê'),(5317,1,'Timburi'),(5318,1,'Torre de Pedra'),(5319,1,'Torrinha'),(5320,1,'Trabiju'),(5321,1,'Tremembé'),(5322,1,'Três Fronteiras'),(5323,1,'Tuiuti'),(5324,1,'Tupã'),(5325,1,'Tupi Paulista'),(5326,1,'Turiúba'),(5327,1,'Turmalina'),(5328,1,'Ubarana'),(5329,1,'Ubatuba'),(5330,1,'Ubirajara'),(5331,1,'Uchoa'),(5332,1,'União Paulista'),(5333,1,'Urânia'),(5334,1,'Uru'),(5335,1,'Urupês'),(5336,1,'Valentim Gentil'),(5337,1,'Valinhos'),(5338,1,'Valparaíso'),(5339,1,'Vargem'),(5340,1,'Vargem Grande do Sul'),(5341,1,'Vargem Grande Paulista'),(5342,1,'Várzea Paulista'),(5343,1,'Vera Cruz'),(5344,1,'Vinhedo'),(5345,1,'Viradouro'),(5346,1,'Vista Alegre do Alto'),(5347,1,'Vitória Brasil'),(5348,1,'Votorantim'),(5349,1,'Votuporanga'),(5350,1,'Zacarias'),(5351,18,'Amparo de São Francisco'),(5352,18,'Aquidabã'),(5353,18,'Aracaju'),(5354,18,'Arauá'),(5355,18,'Areia Branca'),(5356,18,'Barra dos Coqueiros'),(5357,18,'Boquim'),(5358,18,'Brejo Grande'),(5359,18,'Campo do Brito'),(5360,18,'Canhoba'),(5361,18,'Canindé de São Francisco'),(5362,18,'Capela'),(5363,18,'Carira'),(5364,18,'Carmópolis'),(5365,18,'Cedro de São João'),(5366,18,'Cristinápolis'),(5367,18,'Cumbe'),(5368,18,'Divina Pastora'),(5369,18,'Estância'),(5370,18,'Feira Nova'),(5371,18,'Frei Paulo'),(5372,18,'Gararu'),(5373,18,'General Maynard'),(5374,18,'Gracho Cardoso'),(5375,18,'Ilha das Flores'),(5376,18,'Indiaroba'),(5377,18,'Itabaiana'),(5378,18,'Itabaianinha'),(5379,18,'Itabi'),(5380,18,'Itaporanga d`Ajuda'),(5381,18,'Japaratuba'),(5382,18,'Japoatã'),(5383,18,'Lagarto'),(5384,18,'Laranjeiras'),(5385,18,'Macambira'),(5386,18,'Malhada dos Bois'),(5387,18,'Malhador'),(5388,18,'Maruim'),(5389,18,'Moita Bonita'),(5390,18,'Monte Alegre de Sergipe'),(5391,18,'Muribeca'),(5392,18,'Neópolis'),(5393,18,'Nossa Senhora Aparecida'),(5394,18,'Nossa Senhora da Glória'),(5395,18,'Nossa Senhora das Dores'),(5396,18,'Nossa Senhora de Lourdes'),(5397,18,'Nossa Senhora do Socorro'),(5398,18,'Pacatuba'),(5399,18,'Pedra Mole'),(5400,18,'Pedrinhas'),(5401,18,'Pinhão'),(5402,18,'Pirambu'),(5403,18,'Poço Redondo'),(5404,18,'Poço Verde'),(5405,18,'Porto da Folha'),(5406,18,'Propriá'),(5407,18,'Riachão do Dantas'),(5408,18,'Riachuelo'),(5409,18,'Ribeirópolis'),(5410,18,'Rosário do Catete'),(5411,18,'Salgado'),(5412,18,'Santa Luzia do Itanhy'),(5413,18,'Santa Rosa de Lima'),(5414,18,'Santana do São Francisco'),(5415,18,'Santo Amaro das Brotas'),(5416,18,'São Cristóvão'),(5417,18,'São Domingos'),(5418,18,'São Francisco'),(5419,18,'São Miguel do Aleixo'),(5420,18,'Simão Dias'),(5421,18,'Siriri'),(5422,18,'Telha'),(5423,18,'Tobias Barreto'),(5424,18,'Tomar do Geru'),(5425,18,'Umbaúba'),(5426,9,'Abreulândia'),(5427,9,'Aguiarnópolis'),(5428,9,'Aliança do Tocantins'),(5429,9,'Almas'),(5430,9,'Alvorada'),(5431,9,'Ananás'),(5432,9,'Angico'),(5433,9,'Aparecida do Rio Negro'),(5434,9,'Aragominas'),(5435,9,'Araguacema'),(5436,9,'Araguaçu'),(5437,9,'Araguaína'),(5438,9,'Araguanã'),(5439,9,'Araguatins'),(5440,9,'Arapoema'),(5441,9,'Arraias'),(5442,9,'Augustinópolis'),(5443,9,'Aurora do Tocantins'),(5444,9,'Axixá do Tocantins'),(5445,9,'Babaçulândia'),(5446,9,'Bandeirantes do Tocantins'),(5447,9,'Barra do Ouro'),(5448,9,'Barrolândia'),(5449,9,'Bernardo Sayão'),(5450,9,'Bom Jesus do Tocantins'),(5451,9,'Brasilândia do Tocantins'),(5452,9,'Brejinho de Nazaré'),(5453,9,'Buriti do Tocantins'),(5454,9,'Cachoeirinha'),(5455,9,'Campos Lindos'),(5456,9,'Cariri do Tocantins'),(5457,9,'Carmolândia'),(5458,9,'Carrasco Bonito'),(5459,9,'Caseara'),(5460,9,'Centenário'),(5461,9,'Chapada da Natividade'),(5462,9,'Chapada de Areia'),(5463,9,'Colinas do Tocantins'),(5464,9,'Colméia'),(5465,9,'Combinado'),(5466,9,'Conceição do Tocantins'),(5467,9,'Couto de Magalhães'),(5468,9,'Cristalândia'),(5469,9,'Crixás do Tocantins'),(5470,9,'Darcinópolis'),(5471,9,'Dianópolis'),(5472,9,'Divinópolis do Tocantins'),(5473,9,'Dois Irmãos do Tocantins'),(5474,9,'Dueré'),(5475,9,'Esperantina'),(5476,9,'Fátima'),(5477,9,'Figueirópolis'),(5478,9,'Filadélfia'),(5479,9,'Formoso do Araguaia'),(5480,9,'Fortaleza do Tabocão'),(5481,9,'Goianorte'),(5482,9,'Goiatins'),(5483,9,'Guaraí'),(5484,9,'Gurupi'),(5485,9,'Ipueiras'),(5486,9,'Itacajá'),(5487,9,'Itaguatins'),(5488,9,'Itapiratins'),(5489,9,'Itaporã do Tocantins'),(5490,9,'Jaú do Tocantins'),(5491,9,'Juarina'),(5492,9,'Lagoa da Confusão'),(5493,9,'Lagoa do Tocantins'),(5494,9,'Lajeado'),(5495,9,'Lavandeira'),(5496,9,'Lizarda'),(5497,9,'Luzinópolis'),(5498,9,'Marianópolis do Tocantins'),(5499,9,'Mateiros'),(5500,9,'Maurilândia do Tocantins'),(5501,9,'Miracema do Tocantins'),(5502,9,'Miranorte'),(5503,9,'Monte do Carmo'),(5504,9,'Monte Santo do Tocantins'),(5505,9,'Muricilândia'),(5506,9,'Natividade'),(5507,9,'Nazaré'),(5508,9,'Nova Olinda'),(5509,9,'Nova Rosalândia'),(5510,9,'Novo Acordo'),(5511,9,'Novo Alegre'),(5512,9,'Novo Jardim'),(5513,9,'Oliveira de Fátima'),(5514,9,'Palmas'),(5515,9,'Palmeirante'),(5516,9,'Palmeiras do Tocantins'),(5517,9,'Palmeirópolis'),(5518,9,'Paraíso do Tocantins'),(5519,9,'Paranã'),(5520,9,'Pau d`Arco'),(5521,9,'Pedro Afonso'),(5522,9,'Peixe'),(5523,9,'Pequizeiro'),(5524,9,'Pindorama do Tocantins'),(5525,9,'Piraquê'),(5526,9,'Pium'),(5527,9,'Ponte Alta do Bom Jesus'),(5528,9,'Ponte Alta do Tocantins'),(5529,9,'Porto Alegre do Tocantins'),(5530,9,'Porto Nacional'),(5531,9,'Praia Norte'),(5532,9,'Presidente Kennedy'),(5533,9,'Pugmil'),(5534,9,'Recursolândia'),(5535,9,'Riachinho'),(5536,9,'Rio da Conceição'),(5537,9,'Rio dos Bois'),(5538,9,'Rio Sono'),(5539,9,'Sampaio'),(5540,9,'Sandolândia'),(5541,9,'Santa Fé do Araguaia'),(5542,9,'Santa Maria do Tocantins'),(5543,9,'Santa Rita do Tocantins'),(5544,9,'Santa Rosa do Tocantins'),(5545,9,'Santa Tereza do Tocantins'),(5546,9,'Santa Terezinha do Tocantins'),(5547,9,'São Bento do Tocantins'),(5548,9,'São Félix do Tocantins'),(5549,9,'São Miguel do Tocantins'),(5550,9,'São Salvador do Tocantins'),(5551,9,'São Sebastião do Tocantins'),(5552,9,'São Valério da Natividade'),(5553,9,'Silvanópolis'),(5554,9,'Sítio Novo do Tocantins'),(5555,9,'Sucupira'),(5556,9,'Taguatinga'),(5557,9,'Taipas do Tocantins'),(5558,9,'Talismã'),(5559,9,'Tocantínia'),(5560,9,'Tocantinópolis'),(5561,9,'Tupirama'),(5562,9,'Tupiratins'),(5563,9,'Wanderlândia'),(5564,9,'Xambioá'),(5565,19,'Afonso Cláudio'),(5566,19,'Água Doce do Norte'),(5567,19,'Águia Branca'),(5568,19,'Alegre'),(5569,19,'Alfredo Chaves'),(5570,19,'Alto Rio Novo'),(5571,19,'Anchieta');
/*!40000 ALTER TABLE `tbl_cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cliente`
--

DROP TABLE IF EXISTS `tbl_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_endereco` int(11) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_id_endereco3_idx` (`id_endereco`),
  CONSTRAINT `fk_id_endereco4` FOREIGN KEY (`id_endereco`) REFERENCES `tbl_endereco` (`id_endereco`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente`
--

LOCK TABLES `tbl_cliente` WRITE;
/*!40000 ALTER TABLE `tbl_cliente` DISABLE KEYS */;
INSERT INTO `tbl_cliente` VALUES (1,1,'jailson4524','ja','Jailson Mendes','Laranjal','(11) 23213-2131','(12) 3123-1230','jailson.mendes@gmail.com','arquivos/foto_usuario/mickeyilson.png'),(2,2,'filipe','filipe','Filipe da Silva','Santos','(11) 85198-1156','(11) 9848-9489','filipe@gmail.com','arquivos/foto_usuario/sanik.png'),(3,3,'bia','sonico','Beatriz','Castro','(11) 97024-1518','(11) 4303-5101','biia@gmail.com','arquivos/foto_usuario/sonicwut.jpg'),(4,7,'pablo_azul','pablo','Pablo','Backyardigan','(11) 98045-6878','(11) 4205-4575','pablo@backyardigan.com','arquivos/foto_usuario/inventor_pablo_grimacing_the_backyardigans.png'),(7,39,'Mfrota','123','Matheus ','Machado Frota','(11) 98553-8302','(11) 4136-8749','matheus.frota25052000@gmail.com','arquivos/foto_usuario/fausto-silva.jpg'),(8,40,'eilane','123','Eilane','Sousa','(11) 58475-1255','(11) 4175-8246','eilane99@hotmail.com','arquivos/foto_usuario/standardUser.png'),(9,49,'echobiel','00','Gabriel','Ferreira','(11)95467-8473','(11)4167-1640','razzer757@gmail.com','arquivos/foto_usuario/standardUser.png'),(10,NULL,NULL,NULL,'teste','teste',NULL,NULL,'teste@gmail.com',NULL),(11,NULL,NULL,NULL,'teste','teste',NULL,NULL,'teste2',NULL);
/*!40000 ALTER TABLE `tbl_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contabancaria`
--

DROP TABLE IF EXISTS `tbl_contabancaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contabancaria` (
  `id_contabancaria` int(11) NOT NULL AUTO_INCREMENT,
  `id_funcionario` int(11) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `agencia` varchar(5) NOT NULL,
  `conta_corrente` varchar(12) NOT NULL,
  PRIMARY KEY (`id_contabancaria`),
  KEY `fk_id_funcionario3_idx` (`id_funcionario`),
  KEY `fk_id_banco3_idx` (`id_banco`),
  CONSTRAINT `fk_id_banco3` FOREIGN KEY (`id_banco`) REFERENCES `tbl_banco` (`id_banco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_funcionario3` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contabancaria`
--

LOCK TABLES `tbl_contabancaria` WRITE;
/*!40000 ALTER TABLE `tbl_contabancaria` DISABLE KEYS */;
INSERT INTO `tbl_contabancaria` VALUES (6,21,1,'4165','74849839'),(7,22,1,'4451','11546515-1'),(8,23,1,'1421','55678945-4');
/*!40000 ALTER TABLE `tbl_contabancaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_credito`
--

DROP TABLE IF EXISTS `tbl_credito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_credito` (
  `id_credito` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `quantidade` float NOT NULL,
  PRIMARY KEY (`id_credito`),
  KEY `fk_id_pedido_idx` (`id_pedido`),
  CONSTRAINT `fk_id_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `tbl_pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_credito`
--

LOCK TABLES `tbl_credito` WRITE;
/*!40000 ALTER TABLE `tbl_credito` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_credito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_endereco`
--

DROP TABLE IF EXISTS `tbl_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `id_cidade` int(11) NOT NULL,
  `logradouro` varchar(200) DEFAULT NULL,
  `bairro` varchar(200) NOT NULL,
  `rua` varchar(200) NOT NULL,
  `aptbloco` varchar(50) DEFAULT NULL,
  `numero` varchar(10) NOT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `fk_id_cidade_idx` (`id_cidade`),
  CONSTRAINT `fk_id_cidade` FOREIGN KEY (`id_cidade`) REFERENCES `tbl_cidade` (`id_cidade`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_endereco`
--

LOCK TABLES `tbl_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_endereco` DISABLE KEYS */;
INSERT INTO `tbl_endereco` VALUES (1,3,'','Machado de Assis','Rua das Oliveires','-','487'),(2,1,'Rua Ancião Sebastião Antonini','Jardim das Margaridas','Rua Ancião Sebastião Antonini','31-27','61'),(3,2,'Bar do Zé','Jd. Silveira','Maria Siqueira','-','102'),(5,1,'Próximo ao Centro','Jardim Tupã','Rua Fernando Pessoa','-','32'),(6,7,'O mundo inteiro no nosso quintal','Diversão','Casa','-','25'),(7,2,'Perto da única casa que tem aqui','Illusion Paradise','Quintal ','-','45'),(8,2,'Bar do Away','Sonicolândia','Rua das Argolas Douradas','-','133'),(9,2,'32123','jardim','Rua das Flroes','-','213'),(24,7,'casa 12','Vila Dirce ','Av. Inocêncio Seráfico ','-','3021'),(31,1,'Escola SENAI Jandira','Jardim das Rosas','Antônio Figueredo','-','41'),(32,1,'Escola SENAI Jandira','Jardim das Rosas','Antônio Figueredo','-','41'),(33,3,'Perto do Bar do Pudim','Jardim dos Confeitos','Rua da Clara de Ovo','-','13'),(34,1,'Escola SENAI Jandira','Jardim das Rosas','Rua da Clara de Ovooooo','-','41'),(35,2,'96','amado','francisco','52-7','528'),(36,1,'Perto da Loja do seu Zé','Espinafre verde','Pudim Reluzente','-','452'),(37,2,'','Marechal Teodoro','Ouro Verde',NULL,'543'),(38,6,'hgfh','dsfd','francisco','52-45','858'),(39,7,'casa 1','Vila Dirce ','Av. Inocêncio Seráfico ','-','3021'),(40,2,'96','amado','francisco','52-7','456'),(41,4,'asdsad','dsadas','dsadsasa','-','das'),(42,4,'adsadsasdad','','asdsadasd',NULL,''),(43,3,'','Machado de Assis','Rua das Oliveires',NULL,'487'),(46,1,'123','4124','21312',NULL,'123'),(47,1,'','Azul Celeste','Rua das Flores',NULL,'123'),(48,2,'','Bairro','Rua',NULL,'123'),(49,7,'Ali','Um aÃ­','Aquela lÃ¡',NULL,'112'),(50,4814,'','Aurélio Lopes','Rua Primária','-','45');
/*!40000 ALTER TABLE `tbl_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_enquete`
--

DROP TABLE IF EXISTS `tbl_enquete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_enquete` (
  `id_enquete` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_enquete`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_enquete`
--

LOCK TABLES `tbl_enquete` WRITE;
/*!40000 ALTER TABLE `tbl_enquete` DISABLE KEYS */;
INSERT INTO `tbl_enquete` VALUES (2,'Rendimento dos Garçons',0),(3,'Cor do Site',1),(4,'a',0);
/*!40000 ALTER TABLE `tbl_enquete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado`
--

DROP TABLE IF EXISTS `tbl_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `id_regiao` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `uf` varchar(2) NOT NULL,
  PRIMARY KEY (`id_estado`),
  KEY `fk_id_regiao_idx` (`id_regiao`),
  CONSTRAINT `fk_id_regiao` FOREIGN KEY (`id_regiao`) REFERENCES `tbl_regiao` (`id_regiao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado`
--

LOCK TABLES `tbl_estado` WRITE;
/*!40000 ALTER TABLE `tbl_estado` DISABLE KEYS */;
INSERT INTO `tbl_estado` VALUES (1,9,'São Paulo','SP'),(2,9,'Rio de Janeiro','RJ'),(3,10,'Acre','AC'),(4,11,'Alagoas','AL'),(5,10,'Amazonas','AM'),(6,10,'Roraima ','RR'),(7,10,'Amapá','AP'),(9,10,'Tocantins','TO'),(10,10,'Rondônia','RO'),(11,11,'Bahia','BA'),(12,11,'Ceará','CE'),(13,11,'Maranhão','MA'),(14,11,'Paraíba','PB'),(15,11,'Pernambuco','PE'),(16,11,'Piauí','PI'),(17,11,'Rio Grande do Norte','RN'),(18,11,'Sergipe','SE'),(19,9,'Espírito Santo','ES'),(20,9,'Minas Gerais','MG'),(21,13,'Paraná','PR'),(22,13,'Santa Catarina','SC'),(23,13,'Rio Grande do Sul','RS'),(24,12,'Distrito Federal','DF'),(25,12,'Goiás','GO'),(26,12,'Mato Grosso','MT'),(27,12,'Mato Grosso do Sul','MS'),(28,11,'Pará','PA');
/*!40000 ALTER TABLE `tbl_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estoque`
--

DROP TABLE IF EXISTS `tbl_estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_estoque` (
  `id_estoque` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  PRIMARY KEY (`id_estoque`),
  KEY `fk_id_restaurante_idx` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estoque`
--

LOCK TABLES `tbl_estoque` WRITE;
/*!40000 ALTER TABLE `tbl_estoque` DISABLE KEYS */;
INSERT INTO `tbl_estoque` VALUES (2,1,'Estoque Jandira'),(3,2,'Estoque Barueri');
/*!40000 ALTER TABLE `tbl_estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_faleconosco`
--

DROP TABLE IF EXISTS `tbl_faleconosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_faleconosco` (
  `id_faleconosco` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipoInfo` int(11) NOT NULL,
  `id_restaurante` int(11) DEFAULT NULL,
  `nome_completo` varchar(40) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `obs` text,
  PRIMARY KEY (`id_faleconosco`),
  KEY `fk_id_tipoInfo_idx` (`id_tipoInfo`),
  KEY `fk_id_restaurante_idx` (`id_restaurante`),
  CONSTRAINT `fk_id_restaurante4` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_tipoInfo` FOREIGN KEY (`id_tipoInfo`) REFERENCES `tbl_tipoinfo` (`id_tipoInfo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_faleconosco`
--

LOCK TABLES `tbl_faleconosco` WRITE;
/*!40000 ALTER TABLE `tbl_faleconosco` DISABLE KEYS */;
INSERT INTO `tbl_faleconosco` VALUES (3,1,1,'Jailson Mendes','(11) 54564-5616','(11) 9848-9489','jaja@gmail.com','Muda a cor do site.'),(4,1,1,'José Mariano','(11) 98045-6165','(11) 4202-0650','jose@gmail.com','A comida precisa de mais sal!'),(5,1,1,'Jõao neves','(66) 66666-6666','(66) 6666-6666','joaopingolao@gmail.com','dfvdfvsdv');
/*!40000 ALTER TABLE `tbl_faleconosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_faq`
--

DROP TABLE IF EXISTS `tbl_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_faq` (
  `id_faq` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` varchar(200) NOT NULL,
  `resposta` text NOT NULL,
  PRIMARY KEY (`id_faq`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_faq`
--

LOCK TABLES `tbl_faq` WRITE;
/*!40000 ALTER TABLE `tbl_faq` DISABLE KEYS */;
INSERT INTO `tbl_faq` VALUES (5,'Como acessar meu perfil?','Depois de logado, é necessário passar o mouse em cima sua imagem de perfil e assim aparecerá uma pequena janela flutuante.'),(6,'Por que não consigo fazer minhas reservas?','A reserva só pode ser feita após 24 horas da criação da conta.');
/*!40000 ALTER TABLE `tbl_faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_feedback`
--

DROP TABLE IF EXISTS `tbl_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_feedback` (
  `id_feedback` int(11) NOT NULL AUTO_INCREMENT,
  `id_avaliacao` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  PRIMARY KEY (`id_feedback`),
  KEY `fk_id_avaliacao_idx` (`id_avaliacao`),
  KEY `fk_id_pedido2_idx` (`id_pedido`),
  CONSTRAINT `fk_id_avaliacao` FOREIGN KEY (`id_avaliacao`) REFERENCES `tbl_avaliacao` (`id_avaliacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_pedido3` FOREIGN KEY (`id_pedido`) REFERENCES `tbl_pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_feedback`
--

LOCK TABLES `tbl_feedback` WRITE;
/*!40000 ALTER TABLE `tbl_feedback` DISABLE KEYS */;
INSERT INTO `tbl_feedback` VALUES (1,3,1),(2,2,2),(3,2,3),(4,1,4),(5,4,5),(6,1,6);
/*!40000 ALTER TABLE `tbl_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fornecedor`
--

DROP TABLE IF EXISTS `tbl_fornecedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fornecedor` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(18) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  PRIMARY KEY (`id_fornecedor`),
  UNIQUE KEY `cnpj_UNIQUE` (`cnpj`),
  KEY `fk_id_endereco_idx` (`id_endereco`),
  CONSTRAINT `fk_id_endereco3` FOREIGN KEY (`id_endereco`) REFERENCES `tbl_endereco` (`id_endereco`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fornecedor`
--

LOCK TABLES `tbl_fornecedor` WRITE;
/*!40000 ALTER TABLE `tbl_fornecedor` DISABLE KEYS */;
INSERT INTO `tbl_fornecedor` VALUES (1,'12.412.421/4214-21','Atacadão Paulista',43);
/*!40000 ALTER TABLE `tbl_fornecedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_funcionario`
--

DROP TABLE IF EXISTS `tbl_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_funcionario` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) DEFAULT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `nome_completo` varchar(200) NOT NULL,
  `num_registro` varchar(12) NOT NULL,
  `sexo` char(1) NOT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `celular` varchar(15) NOT NULL,
  `salario` float(11,2) NOT NULL,
  `dt_nasc` date NOT NULL,
  `statusMDM` tinyint(1) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `email` varchar(80) NOT NULL,
  `dia_pagamento` varchar(2) NOT NULL,
  `comissao` float(3,2) DEFAULT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  PRIMARY KEY (`id_funcionario`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_id_restaurante_idx` (`id_restaurante`),
  KEY `fk_id_endereco_idx` (`id_endereco`),
  KEY `fk_id_cargo_idx` (`id_cargo`),
  CONSTRAINT `fk_id_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `tbl_cargo` (`id_cargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_endereco` FOREIGN KEY (`id_endereco`) REFERENCES `tbl_endereco` (`id_endereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_restaurante` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcionario`
--

LOCK TABLES `tbl_funcionario` WRITE;
/*!40000 ALTER TABLE `tbl_funcionario` DISABLE KEYS */;
INSERT INTO `tbl_funcionario` VALUES (21,1,20,34,'894.989.789-48','DEVSOFT CORPORATION','156.156.561','M','(11) 4511-6515','(11) 98465-1651',15000.00,'2000-01-13',0,'arquivos/foto_perfilFuncionario/screenshot_118.png','devsoft@gmail.com','15',0.00,'devsoft','dev'),(22,1,21,36,'515.616.516-51','PALMIRINHA ONOFRE','451.651.651','F','(11) 4561-2313','(11) 98054-6515',2500.00,'1931-06-29',1,'arquivos/foto_perfilFuncionario/yuzk9zom.jpeg','palmirinha@ribs.com','12',0.00,'palmirinha','123'),(23,1,22,50,'156.165.116-51','JOÃO DA NICA','541.654.564','M','','(11) 97800-5130',1625.00,'1972-05-11',0,'arquivos/foto_perfilFuncionario/a.png','jhonofthenight@gmail.com','10',0.14,'jhon','123');
/*!40000 ALTER TABLE `tbl_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_home`
--

DROP TABLE IF EXISTS `tbl_home`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_home` (
  `id_home` int(11) NOT NULL AUTO_INCREMENT,
  `caminho_imagemSuperior` varchar(200) NOT NULL,
  `caminho_imagemInferior` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_home`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_home`
--

LOCK TABLES `tbl_home` WRITE;
/*!40000 ALTER TABLE `tbl_home` DISABLE KEYS */;
INSERT INTO `tbl_home` VALUES (3,'arquivos/midia_home/q-grill-camden-1.jpg','arquivos/midia_home/steak_1472646321611_5895592_ver1.0.jpg',1);
/*!40000 ALTER TABLE `tbl_home` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ingrediente`
--

DROP TABLE IF EXISTS `tbl_ingrediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ingrediente` (
  `id_ingrediente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  PRIMARY KEY (`id_ingrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ingrediente`
--

LOCK TABLES `tbl_ingrediente` WRITE;
/*!40000 ALTER TABLE `tbl_ingrediente` DISABLE KEYS */;
INSERT INTO `tbl_ingrediente` VALUES (1,'Tomate'),(2,'Alface'),(3,'Salsinha'),(4,'Cebolinha'),(5,'Filé Mignon'),(6,'Contrafilé'),(7,'Alcatra'),(8,'Picanha'),(9,'Carne Patinho'),(10,'Carne Fraldinha'),(11,'Carne Maminha'),(12,'Filé de Costela'),(13,'Batata'),(14,'Queijo'),(15,'Azeite'),(16,'Sal'),(17,'Cenoura'),(18,'Macarrão'),(19,'Água de Coco'),(20,'Melancia'),(21,'Gengibre'),(22,'Laranja'),(23,'Água');
/*!40000 ALTER TABLE `tbl_ingrediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ingredienteproduto`
--

DROP TABLE IF EXISTS `tbl_ingredienteproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ingredienteproduto` (
  `id_ingredienteProduto` int(11) NOT NULL AUTO_INCREMENT,
  `id_ingrediente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_tipounit` int(11) NOT NULL,
  `quantidade` float NOT NULL,
  `detalhe` varchar(45) NOT NULL,
  PRIMARY KEY (`id_ingredienteProduto`),
  KEY `fk_id_ingrediente_idx` (`id_ingrediente`),
  KEY `fk_id_produto_idx` (`id_produto`),
  KEY `fk_id_tipounit2_idx` (`id_tipounit`),
  CONSTRAINT `fk_id_ingrediente2` FOREIGN KEY (`id_ingrediente`) REFERENCES `tbl_ingrediente` (`id_ingrediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_produto2` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_tipounit4` FOREIGN KEY (`id_tipounit`) REFERENCES `tbl_tipounit` (`id_tipounit`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ingredienteproduto`
--

LOCK TABLES `tbl_ingredienteproduto` WRITE;
/*!40000 ALTER TABLE `tbl_ingredienteproduto` DISABLE KEYS */;
INSERT INTO `tbl_ingredienteproduto` VALUES (55,5,5,4,400,''),(59,17,5,4,2,'Picada'),(60,17,6,6,1,'Ralada'),(61,18,6,4,250,'Tipo Penne'),(63,23,7,7,1,''),(64,22,7,6,2,''),(65,21,7,6,1,''),(66,12,5,4,20,'');
/*!40000 ALTER TABLE `tbl_ingredienteproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_materiaprima`
--

DROP TABLE IF EXISTS `tbl_materiaprima`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_materiaprima` (
  `id_materiaprima` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedidocompra` int(11) NOT NULL,
  `id_tipounit` int(11) NOT NULL,
  `id_estoque` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  `quantidade` float NOT NULL,
  PRIMARY KEY (`id_materiaprima`),
  KEY `fk_id_estoque_idx` (`id_estoque`),
  KEY `fk_id_tipounit_idx` (`id_tipounit`),
  KEY `fk_id_pedidocompra_idx` (`id_pedidocompra`),
  KEY `fk_id_ingrediente_idx` (`id_ingrediente`),
  CONSTRAINT `fk_id_estoque` FOREIGN KEY (`id_estoque`) REFERENCES `tbl_estoque` (`id_estoque`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_ingrediente` FOREIGN KEY (`id_ingrediente`) REFERENCES `tbl_ingrediente` (`id_ingrediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_pedidocompra` FOREIGN KEY (`id_pedidocompra`) REFERENCES `tbl_pedidocompra` (`id_pedidocompra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_tipounit` FOREIGN KEY (`id_tipounit`) REFERENCES `tbl_tipounit` (`id_tipounit`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_materiaprima`
--

LOCK TABLES `tbl_materiaprima` WRITE;
/*!40000 ALTER TABLE `tbl_materiaprima` DISABLE KEYS */;
INSERT INTO `tbl_materiaprima` VALUES (10,10,5,2,12,90),(11,11,5,2,10,120),(12,12,5,2,10,2),(13,13,7,2,15,90),(14,14,7,2,19,20),(15,15,6,2,17,300),(16,16,5,3,14,500),(17,17,5,2,12,1200);
/*!40000 ALTER TABLE `tbl_materiaprima` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mesa`
--

DROP TABLE IF EXISTS `tbl_mesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mesa` (
  `id_mesa` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) NOT NULL,
  `id_tipomesa` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id_mesa`),
  KEY `fk_id_restaurante_idx` (`id_restaurante`),
  KEY `fk_id_tipomesa_idx` (`id_tipomesa`),
  CONSTRAINT `fk_id_restaurante3` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_tipomesa` FOREIGN KEY (`id_tipomesa`) REFERENCES `tbl_tipomesa` (`id_tipomesa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mesa`
--

LOCK TABLES `tbl_mesa` WRITE;
/*!40000 ALTER TABLE `tbl_mesa` DISABLE KEYS */;
INSERT INTO `tbl_mesa` VALUES (1,1,1,'A1'),(2,2,2,'A5'),(3,2,1,'A2');
/*!40000 ALTER TABLE `tbl_mesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_opcao`
--

DROP TABLE IF EXISTS `tbl_opcao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_opcao` (
  `id_opcao` int(11) NOT NULL AUTO_INCREMENT,
  `id_pergunta` int(11) NOT NULL,
  `alternativa1` varchar(100) NOT NULL,
  `alternativa2` varchar(100) NOT NULL,
  `alternativa3` varchar(100) DEFAULT NULL,
  `alternativa4` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_opcao`),
  KEY `fk_id_pergunta_idx` (`id_pergunta`),
  CONSTRAINT `fk_id_pergunta` FOREIGN KEY (`id_pergunta`) REFERENCES `tbl_pergunta` (`id_pergunta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_opcao`
--

LOCK TABLES `tbl_opcao` WRITE;
/*!40000 ALTER TABLE `tbl_opcao` DISABLE KEYS */;
INSERT INTO `tbl_opcao` VALUES (30,1,'Bom','Razoável','Ruim','Péssimo'),(31,3,'Sim','Não','','');
/*!40000 ALTER TABLE `tbl_opcao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pais`
--

DROP TABLE IF EXISTS `tbl_pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pais` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pais`
--

LOCK TABLES `tbl_pais` WRITE;
/*!40000 ALTER TABLE `tbl_pais` DISABLE KEYS */;
INSERT INTO `tbl_pais` VALUES (1,'Brasil');
/*!40000 ALTER TABLE `tbl_pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_paletacor`
--

DROP TABLE IF EXISTS `tbl_paletacor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_paletacor` (
  `id_paletacor` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `cor_primaria` varchar(8) NOT NULL,
  `cor_secundaria` varchar(8) NOT NULL,
  `cor_terciaria` varchar(8) NOT NULL,
  `cor_quartenaria` varchar(8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_paletacor`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_paletacor`
--

LOCK TABLES `tbl_paletacor` WRITE;
/*!40000 ALTER TABLE `tbl_paletacor` DISABLE KEYS */;
INSERT INTO `tbl_paletacor` VALUES (56,'Cor Padrão','#500b0b','#ffffff','#200b00','#441a1a',1);
/*!40000 ALTER TABLE `tbl_paletacor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pedido`
--

DROP TABLE IF EXISTS `tbl_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_funcionario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_id_funcionario_idx` (`id_funcionario`),
  KEY `fk_id_cliente_idx` (`id_cliente`),
  KEY `fk_id_mesa5_idx` (`id_mesa`),
  CONSTRAINT `fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_mesa5` FOREIGN KEY (`id_mesa`) REFERENCES `tbl_mesa` (`id_mesa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedido`
--

LOCK TABLES `tbl_pedido` WRITE;
/*!40000 ALTER TABLE `tbl_pedido` DISABLE KEYS */;
INSERT INTO `tbl_pedido` VALUES (1,23,2,1,'2017-11-16 00:00:00'),(2,23,2,1,'2017-11-16 00:00:00'),(3,23,2,1,'2017-11-16 00:00:00'),(4,23,9,1,'2017-11-27 14:08:03'),(5,23,11,1,'2017-11-27 14:11:29'),(6,23,9,1,'2017-11-27 14:15:47');
/*!40000 ALTER TABLE `tbl_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pedidocompra`
--

DROP TABLE IF EXISTS `tbl_pedidocompra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pedidocompra` (
  `id_pedidocompra` int(11) NOT NULL AUTO_INCREMENT,
  `id_fornecedor` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `data` date NOT NULL,
  `precounitario` float NOT NULL,
  PRIMARY KEY (`id_pedidocompra`),
  KEY `fk_id_fornecedor_idx` (`id_fornecedor`),
  CONSTRAINT `fk_id_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbl_fornecedor` (`id_fornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedidocompra`
--

LOCK TABLES `tbl_pedidocompra` WRITE;
/*!40000 ALTER TABLE `tbl_pedidocompra` DISABLE KEYS */;
INSERT INTO `tbl_pedidocompra` VALUES (10,1,'Atacadão Paulista',1,'2017-11-25',5.5),(11,1,'Atacadão Paulista',1,'2017-11-25',4.5),(12,1,'Atacadão Paulista',1,'2017-11-25',4.5),(13,1,'Atacadão Paulista',1,'2017-11-25',20),(14,1,'Atacadão Paulista',1,'2017-11-25',15.2),(15,1,'Atacadão Paulista',1,'2017-11-25',2.5),(16,1,'Atacadão Paulista',1,'2017-11-27',4.5),(17,1,'Atacadão Paulista',1,'2017-11-29',0.2);
/*!40000 ALTER TABLE `tbl_pedidocompra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pedidoproduto`
--

DROP TABLE IF EXISTS `tbl_pedidoproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pedidoproduto` (
  `id_pedidoProduto` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  PRIMARY KEY (`id_pedidoProduto`),
  KEY `fk_id_pedido_idx` (`id_pedido`),
  KEY `fk_id_produto_idx` (`id_produto`),
  CONSTRAINT `fk_id_pedido2` FOREIGN KEY (`id_pedido`) REFERENCES `tbl_pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_produto` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedidoproduto`
--

LOCK TABLES `tbl_pedidoproduto` WRITE;
/*!40000 ALTER TABLE `tbl_pedidoproduto` DISABLE KEYS */;
INSERT INTO `tbl_pedidoproduto` VALUES (1,1,6),(2,1,7),(3,1,5),(4,4,6),(5,6,6),(6,2,7),(7,3,6),(8,5,5);
/*!40000 ALTER TABLE `tbl_pedidoproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pergunta`
--

DROP TABLE IF EXISTS `tbl_pergunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pergunta` (
  `id_pergunta` int(11) NOT NULL AUTO_INCREMENT,
  `id_enquete` int(11) NOT NULL,
  `pergunta` varchar(200) NOT NULL,
  PRIMARY KEY (`id_pergunta`),
  KEY `fk_id_enquete_idx` (`id_enquete`),
  CONSTRAINT `fk_id_enquete` FOREIGN KEY (`id_enquete`) REFERENCES `tbl_enquete` (`id_enquete`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pergunta`
--

LOCK TABLES `tbl_pergunta` WRITE;
/*!40000 ALTER TABLE `tbl_pergunta` DISABLE KEYS */;
INSERT INTO `tbl_pergunta` VALUES (1,2,'Qual o desempenho dos nossos garçons?'),(3,3,'A cor do site está agradável?');
/*!40000 ALTER TABLE `tbl_pergunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_periodo`
--

DROP TABLE IF EXISTS `tbl_periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_periodo` (
  `id_periodo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `horario_inicial` time NOT NULL,
  `horario_final` time NOT NULL,
  PRIMARY KEY (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_periodo`
--

LOCK TABLES `tbl_periodo` WRITE;
/*!40000 ALTER TABLE `tbl_periodo` DISABLE KEYS */;
INSERT INTO `tbl_periodo` VALUES (1,'Manhã','06:00:00','12:00:00'),(2,'Tarde','12:00:00','18:00:00');
/*!40000 ALTER TABLE `tbl_periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_periodorestaurante`
--

DROP TABLE IF EXISTS `tbl_periodorestaurante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_periodorestaurante` (
  `id_periodoRestaurante` int(11) NOT NULL AUTO_INCREMENT,
  `id_periodo` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  PRIMARY KEY (`id_periodoRestaurante`),
  KEY `fk_id_periodo_idx` (`id_periodo`),
  KEY `fk_id_periodo_idx1` (`id_restaurante`),
  CONSTRAINT `fk_id_periodo` FOREIGN KEY (`id_periodo`) REFERENCES `tbl_periodo` (`id_periodo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_restaurante2` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_periodorestaurante`
--

LOCK TABLES `tbl_periodorestaurante` WRITE;
/*!40000 ALTER TABLE `tbl_periodorestaurante` DISABLE KEYS */;
INSERT INTO `tbl_periodorestaurante` VALUES (1,1,1),(2,2,2),(3,1,2);
/*!40000 ALTER TABLE `tbl_periodorestaurante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permissao`
--

DROP TABLE IF EXISTS `tbl_permissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permissao` (
  `id_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id_permissao`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permissao`
--

LOCK TABLES `tbl_permissao` WRITE;
/*!40000 ALTER TABLE `tbl_permissao` DISABLE KEYS */;
INSERT INTO `tbl_permissao` VALUES (1,'Fechamento do Pedido'),(2,'Aprovacao do Produto'),(3,'Crud Paleta de Cores'),(4,'Crud Cardápio'),(5,'Crud Home'),(6,'Crud de Produtos'),(7,'Crud Categorias'),(8,'Crud Funcionários'),(9,'Crud Cargos'),(10,'Crud Usuários Cadastrados'),(11,'Crud Mesas'),(12,'Crud Reservas'),(13,'Crud Enquetes'),(14,'Crud Sobre Nós'),(15,'Crud Fale Conosco'),(16,'Crud FAQ'),(17,'Crud Redes Sociais');
/*!40000 ALTER TABLE `tbl_permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `nome` varchar(200) NOT NULL,
  `imagem` varchar(200) NOT NULL,
  `preco` float NOT NULL,
  `statusAprovacao` tinyint(1) NOT NULL,
  `statusTabelaNuticional` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `fk_id_categoria_idx` (`id_categoria`),
  CONSTRAINT `fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (5,1,'E quando o filé mignon ainda é acompanhado por um molho gostoso, você pode ter certeza que estará diante de um prato maravilhoso. Como o molho madeira que irá acompanhar o filé mignon em nossa receita.','Filé Mignon ao Molho Madeira','arquivos/foto_produtos/asdsasasd.png',40.5,1,0),(6,3,'Uma mistura de ingredientes que harmonizam, dando um sabor diferenciado e incomum aos paladares.','Salada de Penne','arquivos/foto_produtos/4037_original.jpg',25.5,1,0),(7,4,'Um suco feito à base de folhas verdes escuras que carregam em si a clorofila. ','Suco Verde','arquivos/foto_produtos/capturar.png',4,1,0);
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_redesocial`
--

DROP TABLE IF EXISTS `tbl_redesocial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_redesocial` (
  `id_redesocial` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(200) NOT NULL,
  `link` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_redesocial`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_redesocial`
--

LOCK TABLES `tbl_redesocial` WRITE;
/*!40000 ALTER TABLE `tbl_redesocial` DISABLE KEYS */;
INSERT INTO `tbl_redesocial` VALUES (6,'Twitter','arquivos/imagem_redesSociais/qfy0krip_400x400.jpg','http://www.twitter.com',1),(7,'Facebook','arquivos/imagem_redesSociais/fa.png','http://www.facebook.com',1),(8,'LinkedIn','arquivos/imagem_redesSociais/1200x630bb.jpg','http://www.linkedin.com',1);
/*!40000 ALTER TABLE `tbl_redesocial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_regiao`
--

DROP TABLE IF EXISTS `tbl_regiao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_regiao` (
  `id_regiao` int(11) NOT NULL AUTO_INCREMENT,
  `id_pais` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  PRIMARY KEY (`id_regiao`),
  KEY `fk_id_pais_idx` (`id_pais`),
  CONSTRAINT `fk_id_pais` FOREIGN KEY (`id_pais`) REFERENCES `tbl_pais` (`id_pais`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_regiao`
--

LOCK TABLES `tbl_regiao` WRITE;
/*!40000 ALTER TABLE `tbl_regiao` DISABLE KEYS */;
INSERT INTO `tbl_regiao` VALUES (9,1,'Sudeste'),(10,1,'Norte'),(11,1,'Nordeste'),(12,1,'Centro-Oeste'),(13,1,'Sul');
/*!40000 ALTER TABLE `tbl_regiao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reserva`
--

DROP TABLE IF EXISTS `tbl_reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `id_status` tinyint(4) NOT NULL,
  `horarioDataFeita` datetime NOT NULL,
  `dataMarcada` date NOT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `fk_id_cliente_idx` (`id_cliente`),
  KEY `fk_id_status_idx` (`id_status`),
  KEY `fk_id_periodo_idx` (`id_periodo`),
  KEY `fk_id_mesa_idx` (`id_mesa`),
  KEY `fk_id_restaurante3_idx` (`id_restaurante`),
  CONSTRAINT `fk_id_cliente2` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `tbl_mesa` (`id_mesa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_periodo2` FOREIGN KEY (`id_periodo`) REFERENCES `tbl_periodo` (`id_periodo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_restaurante8` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reserva`
--

LOCK TABLES `tbl_reserva` WRITE;
/*!40000 ALTER TABLE `tbl_reserva` DISABLE KEYS */;
INSERT INTO `tbl_reserva` VALUES (44,2,1,1,1,1,'2017-11-09 15:15:12','2017-11-10'),(45,8,1,1,1,1,'2017-11-13 14:31:11','2017-11-15');
/*!40000 ALTER TABLE `tbl_reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_respostaenquete`
--

DROP TABLE IF EXISTS `tbl_respostaenquete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_respostaenquete` (
  `id_respostaEnquete` int(11) NOT NULL AUTO_INCREMENT,
  `id_enquete` int(11) NOT NULL,
  `alternativa` varchar(45) NOT NULL,
  PRIMARY KEY (`id_respostaEnquete`),
  KEY `fk_id_enquete2_idx` (`id_enquete`),
  CONSTRAINT `fk_id_enquete2` FOREIGN KEY (`id_enquete`) REFERENCES `tbl_enquete` (`id_enquete`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_respostaenquete`
--

LOCK TABLES `tbl_respostaenquete` WRITE;
/*!40000 ALTER TABLE `tbl_respostaenquete` DISABLE KEYS */;
INSERT INTO `tbl_respostaenquete` VALUES (1,3,'alternativa1'),(2,3,'alternativa2'),(3,3,'alternativa1'),(4,3,'alternativa2'),(5,3,'alternativa2'),(6,3,'alternativa1'),(7,3,'alternativa2'),(8,3,'alternativa2'),(9,3,'alternativa1'),(10,3,'alternativa1'),(11,3,'alternativa1'),(12,3,'alternativa2');
/*!40000 ALTER TABLE `tbl_respostaenquete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_restaurante`
--

DROP TABLE IF EXISTS `tbl_restaurante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_restaurante` (
  `id_restaurante` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  `imagem` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id_restaurante`),
  KEY `fk_id_endereco_idx` (`id_endereco`),
  CONSTRAINT `fk_id_endereco2` FOREIGN KEY (`id_endereco`) REFERENCES `tbl_endereco` (`id_endereco`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_restaurante`
--

LOCK TABLES `tbl_restaurante` WRITE;
/*!40000 ALTER TABLE `tbl_restaurante` DISABLE KEYS */;
INSERT INTO `tbl_restaurante` VALUES (1,'The Ribs Steakhouse Jandira',5,'arquivos/foto_restaurante/charcoal-2.jpg','Um restaurante renomado na arte da churrascaria local, trazido de diversas épocas contemporâneas e tradicionais para hoje.'),(2,'The Ribs Steakhouse Barueri',37,'arquivos/foto_restaurante/barco-1.jpg','Um restaurante encontrado no mesmo local portém com culturas varíaveis.');
/*!40000 ALTER TABLE `tbl_restaurante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobrenos`
--

DROP TABLE IF EXISTS `tbl_sobrenos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sobrenos` (
  `id_sobrenos` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `caminho_imagem` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_sobrenos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobrenos`
--

LOCK TABLES `tbl_sobrenos` WRITE;
/*!40000 ALTER TABLE `tbl_sobrenos` DISABLE KEYS */;
INSERT INTO `tbl_sobrenos` VALUES (1,'Artigo 1','O restaurante tem como objetivo atender ao público com gostos diversos, temos vários tipos de pratos desde o prato destinado aos apreciantes da arte do churrasco, quanto aos tem uma preferência à saladas.','arquivos/midia_sobreNos/reserva1.jpg',1);
/*!40000 ALTER TABLE `tbl_sobrenos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_status`
--

LOCK TABLES `tbl_status` WRITE;
/*!40000 ALTER TABLE `tbl_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipoinfo`
--

DROP TABLE IF EXISTS `tbl_tipoinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipoinfo` (
  `id_tipoInfo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipoInfo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipoinfo`
--

LOCK TABLES `tbl_tipoinfo` WRITE;
/*!40000 ALTER TABLE `tbl_tipoinfo` DISABLE KEYS */;
INSERT INTO `tbl_tipoinfo` VALUES (1,'Reclamação'),(2,'Sugestão'),(3,'Informação');
/*!40000 ALTER TABLE `tbl_tipoinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipomesa`
--

DROP TABLE IF EXISTS `tbl_tipomesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipomesa` (
  `id_tipomesa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipomesa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipomesa`
--

LOCK TABLES `tbl_tipomesa` WRITE;
/*!40000 ALTER TABLE `tbl_tipomesa` DISABLE KEYS */;
INSERT INTO `tbl_tipomesa` VALUES (1,'4'),(2,'8'),(3,'12');
/*!40000 ALTER TABLE `tbl_tipomesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipounit`
--

DROP TABLE IF EXISTS `tbl_tipounit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipounit` (
  `id_tipounit` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `sigla` varchar(4) NOT NULL,
  PRIMARY KEY (`id_tipounit`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipounit`
--

LOCK TABLES `tbl_tipounit` WRITE;
/*!40000 ALTER TABLE `tbl_tipounit` DISABLE KEYS */;
INSERT INTO `tbl_tipounit` VALUES (4,'Grama','g'),(5,'Kilo','kg'),(6,'Unidade',''),(7,'Litro','L'),(8,'Mililitro','mL');
/*!40000 ALTER TABLE `tbl_tipounit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-29 16:07:56
