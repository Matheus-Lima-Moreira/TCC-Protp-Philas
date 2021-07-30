-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: servidorphiladelpho.com
-- Generation Time: Jul 30, 2021 at 04:19 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servid06_banco10`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_atendimento`
--

CREATE TABLE `tb_atendimento` (
  `id` int(11) NOT NULL,
  `descricao` varchar(280) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tempo_previsto` int(11) DEFAULT NULL,
  `data_marcada` datetime DEFAULT NULL,
  `data_iniciada` datetime DEFAULT NULL,
  `data_finalizada` datetime DEFAULT NULL,
  `cod_motivo` int(11) DEFAULT NULL,
  `cod_atendido` int(11) DEFAULT NULL,
  `cod_atendente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_motivo`
--

CREATE TABLE `tb_motivo` (
  `id` int(11) NOT NULL,
  `descricao` varchar(280) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tempo_previsto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_motivo`
--

INSERT INTO `tb_motivo` (`id`, `descricao`, `tempo_previsto`) VALUES
(1, 'Matrícula', 10),
(2, 'Boletim', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL, -- FIXME: Mantem o cpf?
  `login` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_usuario`
--

INSERT INTO `tb_usuario` (`id`, `nome`, `telefone`, `cpf`, `login`, `senha`, `email`, `tipo`) VALUES
(1, 'Luis Guerra Santa Rosa', '17982174688', '11122233344', 'Luis', '1234', 'luis.rosa36@etec.sp.gov.br', 'Comum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_atendimento`
--
ALTER TABLE `tb_atendimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_motivo` (`cod_motivo`),
  ADD KEY `fk_id_usuario_ato` (`cod_atendido`),
  ADD KEY `fk_id_usuario_ate` (`cod_atendente`);

--
-- Indexes for table `tb_motivo`
--
ALTER TABLE `tb_motivo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_atendimento`
--
ALTER TABLE `tb_atendimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_motivo`
--
ALTER TABLE `tb_motivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_atendimento`
--
ALTER TABLE `tb_atendimento`
  ADD CONSTRAINT `fk_id_motivo` FOREIGN KEY (`cod_motivo`) REFERENCES `tb_motivo` (`id`),
  ADD CONSTRAINT `fk_id_usuario_ate` FOREIGN KEY (`cod_atendente`) REFERENCES `tb_usuario` (`id`),
  ADD CONSTRAINT `fk_id_usuario_ato` FOREIGN KEY (`cod_atendido`) REFERENCES `tb_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
