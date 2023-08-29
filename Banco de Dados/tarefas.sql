CREATE DATABASE  IF NOT EXISTS `tarefas` 

-- Tabela para armazenar informações dos funcionários
CREATE TABLE funcionarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  cargo VARCHAR(50),
  data_nascimento DATE,
  endereco VARCHAR(100),
  telefone VARCHAR(20),
  email VARCHAR(100)
);

-- Tabela para armazenar informações dos equipamentos
-- CREATE TABLE equipamentos (
  --id INT PRIMARY KEY AUTO_INCREMENT,
  --nome VARCHAR(100) NOT NULL,
  --descricao TEXT,
  --data_aquisicao DATE,
  --valor DECIMAL(10, 2)
--);

-- Tabela para armazenar informações dos equipamentos atualizado
CREATE TABLE equipamentos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  descricao TEXT,
  codigo_patrimonial VARCHAR(20) UNIQUE,
  data_aquisicao DATE,
  almoxarifado_id INT,
  FOREIGN KEY (almoxarifado_id) REFERENCES almoxarifado(id) ON DELETE SET NULL ON UPDATE CASCADE
);


-- Tabela para vincular os funcionários aos equipamentos que eles pegam
CREATE TABLE funcionario_equipamento (
  id INT PRIMARY KEY AUTO_INCREMENT,
  funcionario_id INT NOT NULL,
  equipamento_id INT NOT NULL,
  data_pegar DATE NOT NULL,
  data_devolver DATE,
  FOREIGN KEY (funcionario_id) REFERENCES funcionarios (id),
  FOREIGN KEY (equipamento_id) REFERENCES equipamentos (id)
);

-- Tabela para armazenar informações dos clientes
CREATE TABLE clientes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone VARCHAR(20),
  endereco VARCHAR(100),
  cidade VARCHAR(50),
  estado VARCHAR(50),
  cep VARCHAR(10)
);

-- Tabela para armazenar informações financeiras dos clientes
CREATE TABLE financeiro_clientes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  cliente_id INT NOT NULL,
  data_pagamento DATE NOT NULL,
  valor DECIMAL(10, 2) NOT NULL,
  descricao TEXT,
  status_pagamento VARCHAR(20) NOT NULL,
  FOREIGN KEY (cliente_id) REFERENCES clientes (id)
);

-- Tabela para armazenar os chips
CREATE TABLE chips (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  numero VARCHAR(20) NOT NULL,
  qrcode VARCHAR(100) NOT NULL,
  operadora VARCHAR(50) NOT NULL,
  funcionario_cod INT, -- Adicionando a coluna para vincular ao funcionário
  FOREIGN KEY (funcionario_cod) REFERENCES funcionarios (cod) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabela para armazenar os chips cancelados
CREATE TABLE chips_cancelados (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  numero VARCHAR(20) NOT NULL,
  qrcode VARCHAR(100) NOT NULL,
  operadora VARCHAR(50) NOT NULL,
  funcionario_cod INT, -- Adicionando a coluna para vincular ao funcionário
  FOREIGN KEY (funcionario_cod) REFERENCES funcionarios (cod) ON DELETE CASCADE ON UPDATE CASCADE,
  data_cancelamento DATE NOT NULL,
  motivo_cancelamento TEXT
);

-- Tabela para armazenar os grupos
--CREATE TABLE grupos (
  --cod INT PRIMARY KEY AUTO_INCREMENT,
  --nome VARCHAR(100) NOT NULL,
  --permissao_visualizar_tarefas BOOLEAN NOT NULL DEFAULT false,
 -- permissao_visualizar_chamados BOOLEAN NOT NULL DEFAULT false,
  -- Adicione mais colunas de permissões conforme necessário para outros recursos
  -- Exemplo: permissao_visualizar_clientes BOOLEAN NOT NULL DEFAULT false,
  --         permissao_visualizar_relatorios BOOLEAN NOT NULL DEFAULT false,
  --         permissao_visualizar_outros_recursos BOOLEAN NOT NULL DEFAULT false
--);

CREATE TABLE grupos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  permissao ENUM('administrador', 'usuario') NOT NULL
);


-- Tabela para armazenar os usuários
--CREATE TABLE usuarios (
--  cod INT PRIMARY KEY AUTO_INCREMENT,
 -- nome VARCHAR(150) NOT NULL,
 -- email VARCHAR(150) NOT NULL,
--  senha VARCHAR(150) NOT NULL,
 -- grupo_cod INT NOT NULL,
 -- FOREIGN KEY (grupo_cod) REFERENCES grupos (cod) ON DELETE CASCADE ON UPDATE CASCADE
--);

CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  senha VARCHAR(150) NOT NULL,
  grupo_id INT NOT NULL,
  FOREIGN KEY (grupo_id) REFERENCES grupos(id)
);

-- Inserir grupos
INSERT INTO grupos (nome, permissao) VALUES
  ('Administradores', 'administrador'),
  ('Usuários Comuns', 'usuario');

-- Inserir usuários
INSERT INTO usuarios (nome, email, senha, grupo_id) VALUES
  ('Administrador 1', 'admin1@example.com', 'senha1', 1),
  ('Usuário 1', 'usuario1@example.com', 'senha2', 2),
  ('Usuário 2', 'usuario2@example.com', 'senha3', 2);


-- Tabela para armazenar os chamados internos
CREATE TABLE chamados (
  cod INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(100) NOT NULL,
  descricao TEXT,
  usuario_cod INT NOT NULL, -- Coluna para vincular o chamado a um usuário
  prazo_entrega DATE, -- Nova coluna para o prazo de entrega do chamado
  anexo VARCHAR(255), -- Nova coluna para o caminho/link do anexo associado ao chamado
  FOREIGN KEY (usuario_cod) REFERENCES usuarios (cod) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabela para armazenar as mensagens dos chamados
CREATE TABLE mensagens_chamado (
  id INT PRIMARY KEY AUTO_INCREMENT,
  chamado_cod INT NOT NULL, -- Coluna para vincular a mensagem a um chamado
  remetente_cod INT NOT NULL, -- Coluna para vincular o remetente da mensagem (usuário)
  mensagem TEXT,
  data_envio DATETIME NOT NULL
);

INSERT INTO chamados (titulo, descricao, usuario_cod, prazo_entrega, anexo)
VALUES ('Chamado 1', 'Descrição do Chamado 1', 1, '2023-07-30', '/caminho/para/o/anexo/arquivo.pdf');


CREATE TABLE almoxarifado (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  endereco VARCHAR(150),
  telefone VARCHAR(20)
);

CREATE TABLE produtos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  descricao TEXT,
  quantidade INT NOT NULL DEFAULT 0,
  almoxarifado_id INT,
  FOREIGN KEY (almoxarifado_id) REFERENCES almoxarifado(id) ON DELETE CASCADE ON UPDATE CASCADE
);

