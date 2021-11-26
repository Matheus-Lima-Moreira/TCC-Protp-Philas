-- FIXME: usar o servid06_banco10??

/*criando o bd_philas*/

Create DataBase bd_philas;
use bd_philas;

/*criando as tabelas */

CREATE TABLE `tb_atendimento` (
  `id` int(11) NOT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `tempo_previsto` int(11) DEFAULT NULL,
  `data_marcada` datetime DEFAULT NULL,
  `data_iniciada` datetime DEFAULT NULL,
  `data_finalizada` datetime DEFAULT NULL,
  `cod_tipo` int(11) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL
);

INSERT INTO `tb_atendimento` (`id`, `descricao`, `tempo_previsto`, `data_marcada`, `data_iniciada`, `data_finalizada`, `cod_tipo`, `cod_usuario`) VALUES
(1, NULL, NULL, '2021-06-14 12:30:00', NULL, NULL, 2, 1),
(2, NULL, NULL, '2021-06-14 12:45:00', NULL, NULL, 1, 2);

CREATE TABLE `tb_tipo` (
  `id` int(11) NOT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `tempo_previsto` int(11) DEFAULT NULL
);

INSERT INTO `tb_tipo` (`id`, `descricao`, `tempo_previsto`) VALUES
(1, 'Realizar Matricula', 45),
(2, 'Retirada de Documentos', 15);

CREATE TABLE `tb_usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `tel` varchar(13) DEFAULT NULL,
  `cpf` varchar(12) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL
);

INSERT INTO `tb_usuario` (`id`, `nome`, `tel`, `cpf`, `login`, `senha`, `email`, `tipo`) VALUES
(1, 'Luis Guerra', '17 982174688', '160125420 20', 'Danilo_xD', 'abcd*1234', 'luisguerra@email.com', 'Admin'),
(2, 'Carlos Gabriel', '23 935478552', '324388640 60', NULL, '1234', 'carlos.gabriel@email.com', 'Comum');

ALTER TABLE `tb_atendimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_tipo` (`cod_tipo`),
  ADD KEY `fk_id_usuario` (`cod_usuario`);

ALTER TABLE `tb_tipo`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_usuario`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_atendimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tb_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tb_atendimento`
  ADD CONSTRAINT `fk_id_tipo` FOREIGN KEY (`cod_tipo`) REFERENCES `tb_tipo` (`id`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `tb_usuario` (`id`);
