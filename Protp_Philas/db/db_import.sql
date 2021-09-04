-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2021 at 07:25 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcc_protp_philas`
--

-- --------------------------------------------------------

--
-- Table structure for table `atendimento`
--

CREATE TABLE `atendimento` (
  `id` int(11) NOT NULL COMMENT 'ID do atendimento',
  `cod_motivo` int(11) DEFAULT NULL COMMENT 'Chave Estrangeria para complemento',
  `descricao` text DEFAULT NULL COMMENT 'Descrição fornecida pelo atendido sobre seu atendimento',
  `tempo_previsto` int(11) DEFAULT NULL COMMENT 'Tempo previsto fornecido pelo funcionário para o atendimento',
  `data_marcada` datetime DEFAULT NULL COMMENT 'Data marcada para o atendimento',
  `data_iniciada` datetime DEFAULT NULL COMMENT 'Data de início do atendimento',
  `data_finalizada` datetime DEFAULT NULL COMMENT 'Data de finalização do atendimento',
  `cod_atendido` int(11) NOT NULL COMMENT 'Chave Estrangeira do usuário que será atendido',
  `cod_atendente` int(11) DEFAULT NULL COMMENT 'Chave Estrangeira do usuário que realizará o atendimento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para dados do atendimento';

--
-- Dumping data for table `atendimento`
--

INSERT INTO `atendimento` (`id`, `cod_motivo`, `descricao`, `tempo_previsto`, `data_marcada`, `data_iniciada`, `data_finalizada`, `cod_atendido`, `cod_atendente`) VALUES
(1, 1, NULL, NULL, '2021-09-03 03:00:00', '2021-09-03 03:00:00', '2021-09-03 03:07:00', 1, 2),
(2, NULL, 'Gostaria de ter acesso ao meu boletim', NULL, NULL, NULL, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `motivo`
--

CREATE TABLE `motivo` (
  `id` int(11) NOT NULL COMMENT 'ID do motivo',
  `descricao` varchar(255) NOT NULL COMMENT 'Título do motivo (e.g. Matrícula)',
  `tempo_previsto` int(11) NOT NULL COMMENT 'Tempo previsto para dado motivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para complementar o atendimento (chave estrangeira)';

--
-- Dumping data for table `motivo`
--

INSERT INTO `motivo` (`id`, `descricao`, `tempo_previsto`) VALUES
(1, 'Matrícula', 10),
(2, 'Boletim', 5);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL COMMENT 'ID do usuário',
  `nome` varchar(255) DEFAULT NULL COMMENT 'Nome do usuário',
  `login` varchar(255) NOT NULL COMMENT 'Usuário do usuário no login',
  `senha` varchar(255) NOT NULL COMMENT 'Senha que do usuário no login',
  `email` varchar(255) DEFAULT NULL COMMENT 'E-mail para contato do usuário',
  `telefone` varchar(20) DEFAULT NULL COMMENT 'Telefone para contato do usuário',
  `cpf` varchar(14) NOT NULL COMMENT 'Campo para validação do usuário (?)',
  `tipo` varchar(255) NOT NULL DEFAULT 'Comum' COMMENT 'Definição dos privilégios do usuário'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para dados do usuário';

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `login`, `senha`, `email`, `telefone`, `cpf`, `tipo`) VALUES
(1, 'Luis Guerra Santa Rosa', 'Luis', '$2y$10$vU2M/eKzAw8emXkAU5iwjOZFZn6cHDo1iH7i/6lNPKwV.1yNrPSFO', 'luis@email.com', '17987654321', '12345678901', 'Comum'),
(2, NULL, 'Admil', '$2y$10$mbkpPmoCjCCFqZvqJSD8b.UCEZoL8uTIFk4vIavTcDuV912PXZ3QK', NULL, NULL, '12345678901', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atendimento`
--
ALTER TABLE `atendimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_motivo` (`cod_motivo`),
  ADD KEY `fk_id_usuario_ato` (`cod_atendido`),
  ADD KEY `fk_id_usuario_ate` (`cod_atendente`);

--
-- Indexes for table `motivo`
--
ALTER TABLE `motivo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descricao_unique` (`descricao`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_unique` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atendimento`
--
ALTER TABLE `atendimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do atendimento', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `motivo`
--
ALTER TABLE `motivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do motivo', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do usuário', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atendimento`
--
ALTER TABLE `atendimento`
  ADD CONSTRAINT `fk_id_motivo` FOREIGN KEY (`cod_motivo`) REFERENCES `motivo` (`id`),
  ADD CONSTRAINT `fk_id_usuario_ate` FOREIGN KEY (`cod_atendente`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_id_usuario_ato` FOREIGN KEY (`cod_atendido`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
