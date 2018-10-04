-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 22/05/2018 às 21:33
-- Versão do servidor: 10.1.32-MariaDB
-- Versão do PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_jogoletrasead`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `CatUsuario`
--

CREATE TABLE `CatUsuario` (
  `codCat` int(11) NOT NULL,
  `nomeCat` varchar(32) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Fazendo dump de dados para tabela `CatUsuario`
--

INSERT INTO `CatUsuario` (`codCat`, `nomeCat`) VALUES
(1, 'Jogador'),
(2, 'Professor'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Conquista`
--

CREATE TABLE `Conquista` (
  `idConquista` int(11) NOT NULL,
  `descricaoConquista` varchar(128) NOT NULL,
  `recompensa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Pergunta`
--

CREATE TABLE `Pergunta` (
  `cod` int(11) NOT NULL,
  `tema` int(11) NOT NULL,
  `descricao` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `feedbackPositivo` varchar(1024) CHARACTER SET latin1 DEFAULT NULL,
  `feedbackNegativo` varchar(1024) CHARACTER SET latin1 DEFAULT NULL,
  `vezesRespondida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Fazendo dump de dados para tabela `Pergunta`
--

INSERT INTO `Pergunta` (`cod`, `tema`, `descricao`, `feedbackPositivo`, `feedbackNegativo`, `vezesRespondida`) VALUES
(1, 2, 'começa com A e termina com *', '', '', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Resposta`
--

CREATE TABLE `Resposta` (
  `codAlt` int(11) NOT NULL,
  `respCurta` varchar(128) NOT NULL,
  `respLonga` varchar(1024) DEFAULT NULL,
  `pergunta` int(11) NOT NULL,
  `vezesEscolhida` int(11) NOT NULL,
  `certa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `Resposta`
--

INSERT INTO `Resposta` (`codAlt`, `respCurta`, `respLonga`, `pergunta`, `vezesEscolhida`, `certa`) VALUES
(1, 'A*', 'oi', 1, 0, 1),
(2, 'ew', '', 1, 0, 0),
(3, 'gA', '', 1, 0, 0),
(4, 'EWGQD', '', 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Tema`
--

CREATE TABLE `Tema` (
  `cod` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `Tema`
--

INSERT INTO `Tema` (`cod`, `nome`) VALUES
(1, 'vazio'),
(2, 'IA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Usuario`
--

CREATE TABLE `Usuario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `usuario` varchar(128) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `codCat` int(11) NOT NULL,
  `moedas` int(11) NOT NULL DEFAULT '0',
  `acertos` int(11) NOT NULL DEFAULT '0',
  `erros` int(11) NOT NULL DEFAULT '0',
  `pontos` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `Usuario`
--

INSERT INTO `Usuario` (`cod`, `nome`, `usuario`, `senha`, `codCat`, `moedas`, `acertos`, `erros`, `pontos`) VALUES
(3, 'Wesley Ferreira de Ferreira', 'WesFerr', 'TTJ2UzlZYlQ3K3BRUFpJaTZqNWxXQT09', 3, 0, 7, 5, 140),
(4, 'Jean', 'jfpcheiran', 'b2xsNGpBVE9SRitXVko1NlJnVFpSbnJ4Z1EvUlhzS29haHZaZ2sxSWhXbz0=', 2, 0, 0, 0, 0);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `CatUsuario`
--
ALTER TABLE `CatUsuario`
  ADD PRIMARY KEY (`codCat`);

--
-- Índices de tabela `Pergunta`
--
ALTER TABLE `Pergunta`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `tema` (`tema`) USING BTREE;

--
-- Índices de tabela `Resposta`
--
ALTER TABLE `Resposta`
  ADD PRIMARY KEY (`codAlt`),
  ADD KEY `pergunta` (`pergunta`) USING BTREE;

--
-- Índices de tabela `Tema`
--
ALTER TABLE `Tema`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_usuario_cat` (`codCat`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `CatUsuario`
--
ALTER TABLE `CatUsuario`
  MODIFY `codCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `Pergunta`
--
ALTER TABLE `Pergunta`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `Resposta`
--
ALTER TABLE `Resposta`
  MODIFY `codAlt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `Tema`
--
ALTER TABLE `Tema`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `Pergunta`
--
ALTER TABLE `Pergunta`
  ADD CONSTRAINT `fk1_perg_tema` FOREIGN KEY (`tema`) REFERENCES `Tema` (`cod`);

--
-- Restrições para tabelas `Resposta`
--
ALTER TABLE `Resposta`
  ADD CONSTRAINT `fk1_alt_per` FOREIGN KEY (`pergunta`) REFERENCES `Pergunta` (`cod`);

--
-- Restrições para tabelas `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_usuario_cat` FOREIGN KEY (`codCat`) REFERENCES `CatUsuario` (`codCat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
