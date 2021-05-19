-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Maio-2021 às 14:06
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `proj_almox`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `Descricao` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Descricao`) VALUES
(1, 'Materiais de Limpeza'),
(2, 'Material de escritório'),
(3, 'Peças mecânicas'),
(4, 'Pelucia'),
(5, 'Produtos Alimentícios');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornece`
--

CREATE TABLE `fornece` (
  `idFornece` int(11) NOT NULL,
  `Produto_idProduto` int(11) NOT NULL,
  `Fornecedor_idFornecedor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `idFornecedor` int(11) NOT NULL,
  `Nome_fantasia` varchar(200) DEFAULT NULL,
  `Endereco` varchar(200) DEFAULT NULL,
  `Cidade` varchar(45) DEFAULT NULL,
  `Contato` varchar(150) NOT NULL,
  `CNPJ` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`idFornecedor`, `Nome_fantasia`, `Endereco`, `Cidade`, `Contato`, `CNPJ`) VALUES
(1, 'Aliexpress ', 'rua das ruas, 200', 'Sao Manuel', 'aliexpresssaomanuel@gmail.com', '46.455.289/0001-09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idProduto` int(11) NOT NULL,
  `Descricao` varchar(100) DEFAULT NULL,
  `Qtde_estoque` int(11) DEFAULT NULL,
  `Local_armaz` text DEFAULT NULL,
  `Categoria_idCategoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `Descricao`, `Qtde_estoque`, `Local_armaz`, `Categoria_idCategoria`) VALUES
(1, 'Sabonete em pó', 40, 'Quarto do Nambuco, prateleira 2', 0),
(2, 'Sabonete em pó', 40, 'Quarto do Nambuco, prateleira 2', 0),
(3, 'Sabonete em pó', 40, 'Quarto do Nambuco, prateleira 2', 0),
(4, 'Sabonete em pó', 40, 'Quarto do Nambuco, prateleira 2', 0),
(5, 'Sabonete em pó', 40, 'Quarto do Nambuco, prateleira 2', 0),
(6, 'Sabonete em pó', 40, 'Quarto do Nambuco, prateleira 2', 0),
(7, 'Caneta Azul', 25, 'Estante 4, prateleira 5', 0),
(8, 'Caneta Vermelha', 14, 'Estante 4, prateleira 5', 0),
(9, 'Caneta Vermelha', 14, 'Estante 4, prateleira 5', 0),
(10, 'Caneta Vermelha', 14, 'Estante 4, prateleira 5', 0),
(11, 'Caneta Preta', 60, 'Estante 4, prateleira 5', 0),
(12, 'Caneta Preta', 60, 'Estante 4, prateleira 5', 0),
(13, 'Sabonate Liquido', 18, 'Quarto do Nambuco, prateleira 2', 0),
(14, '', 0, '', 0),
(15, 'Motor a disel', 5, 'Deposito 1, quarto 2', 0),
(16, 'Motor a disel', 5, 'Deposito 1, quarto 2', 0),
(17, 'Borracha', 35, 'Estante 4, prateleira 3', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisita`
--

CREATE TABLE `requisita` (
  `idRequisita` int(11) NOT NULL,
  `Produto_idProduto` int(11) NOT NULL,
  `Requisição_idRequisição` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisitante`
--

CREATE TABLE `requisitante` (
  `idRequisitante` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Setor` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `requisitante`
--

INSERT INTO `requisitante` (`idRequisitante`, `Nome`, `Setor`) VALUES
(1, 'Gustavo', 'TI'),
(2, 'Guilherme', 'Compras'),
(3, 'Caio', 'Contabilidade'),
(4, 'Túlio', 'Dpto. Pessoal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisição`
--

CREATE TABLE `requisição` (
  `idRequisição` int(11) NOT NULL,
  `Data_retirada` varchar(45) DEFAULT NULL,
  `Requisitante_idRequisitante` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Contato` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `Usuario`, `Senha`, `Contato`) VALUES
(1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com'),
(2, 'tulio', '$2y$10$ehGERC7JZR3atOZToclUoub27gJ/Iwpdkzo28nGUKp5S.A4Ros/T2', 'tulioageronutti@gmail.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Índices para tabela `fornece`
--
ALTER TABLE `fornece`
  ADD PRIMARY KEY (`idFornece`),
  ADD KEY `fk_Fornece_Produto1_idx` (`Produto_idProduto`),
  ADD KEY `fk_Fornece_Fornecedor1_idx` (`Fornecedor_idFornecedor`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idFornecedor`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProduto`),
  ADD KEY `fk_Produto_Categoria1_idx` (`Categoria_idCategoria`);

--
-- Índices para tabela `requisita`
--
ALTER TABLE `requisita`
  ADD PRIMARY KEY (`idRequisita`),
  ADD KEY `fk_Requisita_Produto1_idx` (`Produto_idProduto`),
  ADD KEY `fk_Requisita_Requisição1_idx` (`Requisição_idRequisição`);

--
-- Índices para tabela `requisitante`
--
ALTER TABLE `requisitante`
  ADD PRIMARY KEY (`idRequisitante`);

--
-- Índices para tabela `requisição`
--
ALTER TABLE `requisição`
  ADD PRIMARY KEY (`idRequisição`),
  ADD KEY `fk_Requisição_Requisitante1_idx` (`Requisitante_idRequisitante`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `fornece`
--
ALTER TABLE `fornece`
  MODIFY `idFornece` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `requisita`
--
ALTER TABLE `requisita`
  MODIFY `idRequisita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `requisitante`
--
ALTER TABLE `requisitante`
  MODIFY `idRequisitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `requisição`
--
ALTER TABLE `requisição`
  MODIFY `idRequisição` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
