-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 17/08/2012 às 22h00min
-- Versão do Servidor: 5.1.63
-- Versão do PHP: 5.3.14

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `prokla`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `image` varchar(255) NOT NULL DEFAULT 'null.jpg',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ads` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ads` (`id_ads`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `region_city`
--

DROP TABLE IF EXISTS `region_city`;
CREATE TABLE IF NOT EXISTS `region_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `id_microregion` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `acronym` varchar(10) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_state` (`id_state`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `region_city`
--

INSERT INTO `region_city` (`id`, `id_state`, `id_microregion`, `name`, `acronym`, `status`) VALUES
(1, 24, 56, 'Florianópolis', 'Fpolis', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `region_country`
--

DROP TABLE IF EXISTS `region_country`;
CREATE TABLE IF NOT EXISTS `region_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `acronym` varchar(10) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-> Desativado  ||  1-> Ativado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `region_country`
--

INSERT INTO `region_country` (`id`, `name`, `acronym`, `status`) VALUES
(1, 'Brasil', 'BR', '1'),
(2, 'Argentina', 'AR', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `region_microregion`
--

DROP TABLE IF EXISTS `region_microregion`;
CREATE TABLE IF NOT EXISTS `region_microregion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `acronym` varchar(10) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_state` (`id_state`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Extraindo dados da tabela `region_microregion`
--

INSERT INTO `region_microregion` (`id`, `id_state`, `name`, `acronym`, `status`) VALUES
(2, 1, 'Rio Branco', '68', '0'),
(3, 2, 'Maceió', '82', ''),
(4, 3, 'Macapá', '96', ''),
(5, 4, 'Manaus', '92', ''),
(6, 4, 'Coari', '97', ''),
(7, 5, 'Salvador', '71', ''),
(8, 5, 'Ilhéus', '73', ''),
(9, 5, 'Juazeiro', '74', ''),
(10, 5, 'Feira de Santana', '75', ''),
(11, 5, 'Vitória da Conquista', '77', '0'),
(12, 6, 'Fortaleza', '85', '0'),
(13, 6, 'Juazeiro do Norte', '88', '0'),
(14, 7, 'Brasília', '61', '0'),
(15, 8, 'Vitória', '27', '0'),
(16, 8, 'Cachoeiro de Itapemirim', '28', '0'),
(17, 9, 'Goiânia', '62', '0'),
(18, 9, 'Rio Verde', '64', '0'),
(19, 10, 'São Luís', '98', '0'),
(20, 10, 'Imperatriz', '99', '0'),
(21, 11, 'Cuiabá', '65', '0'),
(22, 11, 'Rondonópolis', '66', '0'),
(23, 12, 'Campo Grande', '67', '0'),
(24, 13, 'Belo Horizonte', '31', '0'),
(25, 13, 'Juiz de Fora', '32', '0'),
(26, 13, 'Governador Valadares', '33', '0'),
(27, 13, 'Uberlândia', '34', '0'),
(28, 13, 'Poços de Caldas', '35', '0'),
(29, 13, 'Divinópolis', '37', '0'),
(30, 13, 'Montes Claros', '38', '0'),
(31, 14, 'Belém', '91', '0'),
(32, 14, 'Santarém', '93', '0'),
(33, 14, 'Marabá', '94', '0'),
(34, 15, 'João Pessoa', '83', '0'),
(35, 16, 'Curitiba', '41', '0'),
(36, 16, 'Ponta Grossa', '42', '0'),
(37, 16, 'Londrina', '43', '0'),
(38, 16, 'Maringá', '44', '0'),
(39, 16, 'Foz do Iguaçu', '45', '0'),
(40, 16, 'Francisco Beltrão', '46', '0'),
(41, 17, 'Recife', '81', '0'),
(42, 17, 'Petrolina', '87', '0'),
(43, 18, 'Teresina', '86', '0'),
(44, 18, 'Picos', '89', '0'),
(45, 19, 'Rio de Janeiro', '21', '0'),
(46, 19, 'Campos dos Goytacazes', '22', '0'),
(47, 19, 'Volta Redonda, Barra Mansa, Petrópolis', '24', '0'),
(48, 20, 'Natal', '84', '0'),
(49, 21, 'Porto Alegre', '51', '0'),
(50, 21, 'Pelotas', '53', '0'),
(51, 21, 'Caxias do Sul', '54', '0'),
(52, 21, 'Santa Maria', '55', '0'),
(53, 20, 'Porto Velho', '69', '0'),
(54, 23, 'Boa Vista', '95', '0'),
(55, 24, 'Joinville', '47', '0'),
(56, 24, 'Florianópolis', '48', '0'),
(57, 24, 'Chapecó', '49', '0'),
(58, 25, 'São Paulo', '11', '0'),
(59, 25, 'São José dos Campos', '12', '0'),
(60, 25, 'Santos', '13', '0'),
(61, 25, 'Bauru', '14', '0'),
(62, 25, 'Sorocaba', '15', '0'),
(63, 25, 'Ribeirão Preto', '16', '0'),
(64, 25, 'São José do Rio Preto', '17', '0'),
(65, 25, 'Presidente Prudente', '18', '0'),
(66, 25, 'Campinas', '19', '0'),
(67, 26, 'Aracaju', '79', '0'),
(68, 27, 'Palmas', '63', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `region_state`
--

DROP TABLE IF EXISTS `region_state`;
CREATE TABLE IF NOT EXISTS `region_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_country` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `acronym` varchar(10) NOT NULL,
  `status` enum('0','1') DEFAULT '0' COMMENT '0-> Desativado || 1-> Ativado',
  PRIMARY KEY (`id`),
  KEY `id_country` (`id_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `region_state`
--

INSERT INTO `region_state` (`id`, `id_country`, `name`, `acronym`, `status`) VALUES
(1, 1, 'Acre', 'AC', '0'),
(2, 1, 'Alagoas', 'AL', '0'),
(3, 1, 'Amapá', 'AP', '0'),
(4, 1, 'Amazonas', 'AM', '0'),
(5, 1, 'Bahia', 'BA', '0'),
(6, 1, 'Ceará', 'CE', '0'),
(7, 1, 'Distrito Federal', 'DF', '0'),
(8, 1, 'Espírito Santo', 'ES', '0'),
(9, 1, 'Goiás', 'GO', '0'),
(10, 1, 'Maranhão', 'MA', '0'),
(11, 1, 'Mato Grosso', 'MT', '0'),
(12, 1, 'Mato Grosso do Sul', 'MS', '0'),
(13, 1, 'Minas Gerais', 'MG', '0'),
(14, 1, 'Pará', 'PA', '0'),
(15, 1, 'Paraíba', 'PB', '0'),
(16, 1, 'Paraná', 'PR', '0'),
(17, 1, 'Pernambuco', 'PE', '0'),
(18, 1, 'Piauí', 'PI', '0'),
(19, 1, 'Rio de Janeiro', 'RJ', '0'),
(20, 1, 'Rio Grande do Norte', 'RN', '0'),
(21, 1, 'Rio Grande do Sul', 'RS', '0'),
(22, 1, 'Rondônia', 'RO', '0'),
(23, 1, 'Roraima', 'RR', '0'),
(24, 1, 'Santa Catarina', 'SC', '1'),
(25, 1, 'São Paulo', 'SP', '0'),
(26, 1, 'Sergipe', 'SE', '0'),
(27, 1, 'Tocantins', 'TO', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_ads`) REFERENCES `ads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `region_city`
--
ALTER TABLE `region_city`
  ADD CONSTRAINT `region_city_ibfk_1` FOREIGN KEY (`id_state`) REFERENCES `region_state` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrições para a tabela `region_microregion`
--
ALTER TABLE `region_microregion`
  ADD CONSTRAINT `region_microregion_ibfk_1` FOREIGN KEY (`id_state`) REFERENCES `region_state` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrições para a tabela `region_state`
--
ALTER TABLE `region_state`
  ADD CONSTRAINT `region_state_ibfk_1` FOREIGN KEY (`id_country`) REFERENCES `region_country` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
