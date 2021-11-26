-- CRIA O BANCO
CREATE DATABASE `tcc_protp_philas`; -- COMMENT 'Protótipo do TCC'

-- CRIA A TABEAL USUÁRIO
CREATE TABLE `tcc_protp_philas`.`usuario` (
  `id`        INT           NOT NULL  AUTO_INCREMENT  COMMENT 'ID do usuário',
  `nome`      VARCHAR(255)  NULL                      COMMENT 'Nome do usuário',
  `login`     VARCHAR(255)  NOT NULL                  COMMENT 'Usuário do usuário no login',
  `senha`     VARCHAR(255)  NOT NULL                  COMMENT 'Senha que do usuário no login',
  `email`     VARCHAR(255)  NULL                      COMMENT 'E-mail para contato do usuário',
  `telefone`  VARCHAR(20)   NULL                      COMMENT 'Telefone para contato do usuário',
  `cpf`       VARCHAR(14)   NOT NULL                  COMMENT 'Campo para validação do usuário (?)',
  `tipo`      VARCHAR(255)  NOT NULL  DEFAULT 'Comum' COMMENT 'Definição dos privilégios do usuário',
  PRIMARY KEY (`id`),
  UNIQUE `login_unique` (`login`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci COMMENT = 'Tabela para dados do usuário';

-- CRIA A TABELA MOTIVO
CREATE TABLE `tcc_protp_philas`.`motivo` (
  `id`              INT             NOT NULL AUTO_INCREMENT COMMENT 'ID do motivo',
  `descricao`       VARCHAR(255)    NOT NULL                COMMENT 'Título do motivo (e.g. Matrícula)',
  `tempo_previsto`  INT             NOT NULL                COMMENT 'Tempo previsto para dado motivo',
  PRIMARY KEY (`id`),
  UNIQUE `descricao_unique` (`descricao`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci COMMENT = 'Tabela para complementar o atendimento (chave estrangeira)';

-- CRIA A TABELA ATENDIMENTO
CREATE TABLE `tcc_protp_philas`.`atendimento` (
  `id`              INT       NOT NULL AUTO_INCREMENT COMMENT 'ID do atendimento',
  `cod_motivo`      INT       NULL                    COMMENT 'Chave Estrangeria para complemento',
  `descricao`       TEXT      NULL                    COMMENT 'Descrição fornecida pelo atendido sobre seu atendimento',
  `tempo_previsto`  INT       NULL                    COMMENT 'Tempo previsto fornecido pelo funcionário para o atendimento',
  `data_marcada`    DATETIME  NULL                    COMMENT 'Data marcada para o atendimento',
  `data_iniciada`   DATETIME  NULL                    COMMENT 'Data de início do atendimento',
  `data_finalizada` DATETIME  NULL                    COMMENT 'Data de finalização do atendimento',
  `cod_atendido`    INT       NULL                    COMMENT 'Chave Estrangeira do usuário que será atendido',
  `cod_atendente`   INT       NULL                    COMMENT 'Chave Estrangeira do usuário que realizará o atendimento',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci COMMENT = 'Tabela para dados do atendimento';

-- ADICIONA CONSTRAINS ÀS CHAVES ESTRANGEIRAS NA TABELA ATENDIEMENTO
ALTER TABLE `tcc_protp_philas`.`atendimento`
  ADD CONSTRAINT `fk_id_motivo` 
    FOREIGN KEY (`cod_motivo`) REFERENCES `motivo`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_usuario_ato`
    FOREIGN KEY (`cod_atendido`) REFERENCES `usuario`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_usuario_ate`
    FOREIGN KEY (`cod_atendente`) REFERENCES `usuario`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- SELECIONA O BANCO
USE `tcc_protp_philas`;

-- INSERÇÃO DE NECESSÁRIOS
INSERT INTO `usuario` 
  (`id`, `nome`, `login`, `senha`, `email`, `telefone`, `cpf`, `tipo`)
VALUES
  (NULL, 'Lorem ipsum dolor sit amet', 'Admin', '$2y$10$mbkpPmoCjCCFqZvqJSD8b.UCEZoL8uTIFk4vIavTcDuV912PXZ3QK', 'admin@example.com', '11111111111', '95788537002', 'Admin');
