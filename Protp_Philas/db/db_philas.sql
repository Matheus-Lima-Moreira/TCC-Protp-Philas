-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2021 at 09:28 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `protp_tcc_philas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_atendimento`
--

CREATE TABLE `tb_atendimento` (
  `id` int(11) NOT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `tempo_previsto` int(11) DEFAULT NULL,
  `data_marcada` datetime DEFAULT NULL,
  `data_iniciada` datetime DEFAULT NULL,
  `data_finalizada` datetime DEFAULT NULL,
  `cod_tipo` int(11) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_atendimento`
--

INSERT INTO `tb_atendimento` (`id`, `descricao`, `tempo_previsto`, `data_marcada`, `data_iniciada`, `data_finalizada`, `cod_tipo`, `cod_usuario`) VALUES
(1, NULL, NULL, '2021-06-14 12:30:00', NULL, NULL, 2, 1),
(2, NULL, NULL, '2021-06-14 12:45:00', NULL, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tipo`
--

CREATE TABLE `tb_tipo` (
  `id` int(11) NOT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `tempo_previsto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tipo`
--

INSERT INTO `tb_tipo` (`id`, `descricao`, `tempo_previsto`) VALUES
(1, 'Realizar Matricula', 45),
(2, 'Retirada de Documentos', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `tel` varchar(13) DEFAULT NULL,
  `cpf` varchar(12) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_usuario`
--

INSERT INTO `tb_usuario` (`id`, `nome`, `tel`, `cpf`, `login`, `senha`, `email`, `tipo`) VALUES
(1, 'Luis Guerra', '17 982174688', '160125420 20', 'Danilo_xD', 'abcd*1234', 'luisguerra@email.com', 'Admin'),
(2, 'Carlos Gabriel', '23 935478552', '324388640 60', NULL, '1234', 'carlos.gabriel@email.com', 'Comum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_atendimento`
--
ALTER TABLE `tb_atendimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_tipo` (`cod_tipo`),
  ADD KEY `fk_id_usuario` (`cod_usuario`);

--
-- Indexes for table `tb_tipo`
--
ALTER TABLE `tb_tipo`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tipo`
--
ALTER TABLE `tb_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_atendimento`
--
ALTER TABLE `tb_atendimento`
  ADD CONSTRAINT `fk_id_tipo` FOREIGN KEY (`cod_tipo`) REFERENCES `tb_tipo` (`id`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `tb_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
