-- Cria o banco
CREATE DATABASE IF NOT EXISTS gestao_contatos
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

-- proximos comandos sao para este banco
USE gestao_contatos;

-- Cria a tabela de contatos
CREATE TABLE IF NOT EXISTS contatos (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,  -- identificador unico, gerado pelo banco
  nome        VARCHAR(100) NOT NULL,                 -- obrigatorio                 
  email       VARCHAR(150) NOT NULL,
  telefone    VARCHAR(20)  NOT NULL,
  endereco    VARCHAR(255) NOT NULL,
  created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,                 -- data/hora do cadastro
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;contatos