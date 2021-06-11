-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Jun-2021 às 04:10
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj_almox`
--
CREATE DATABASE IF NOT EXISTS `proj_almox` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proj_almox`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `Descricao_categoria` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Descricao_categoria`) VALUES
(1, 'Materiais de Limpeza'),
(2, 'Material de escritório'),
(3, 'Peças mecânicas'),
(4, 'Pelucia'),
(5, 'Produtos Alimentícios'),
(7, 'Materiais de construção');

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
(1, 'AliExpress 2.0', 'Rua do Tulio, 123', 'SÃ£o Manuel - SP', 'contato@aliexpress.com.br', '67.235.335/0001-45'),
(12, 'Guzango Enterprises', 'Rua Logo ali - 1234', 'Botucat - SP', 'contato@guzangoenterprises.com.br', '93.291.292/8282-12'),
(13, 'Pardinho Pedras', 'Rua do PÃ© Vermeio - 144', 'Pardinho - SP', 'solucoes@pardinhopedras.com.br', '39.438.493/8493-43'),
(14, 'Only Cartuchos', 'Av. Dom LÃºcio - 392', 'Botucatu - SP', 'contato@onlycartuchos.com.br', '39.458.394/5893-49'),
(16, 'Nambuco Containers', 'Rua Alguma Por aÃ­ - 132', 'Botucatu - SP', 'contato@nambuco.com.br', '12.312.312/3213-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idProduto` int(11) NOT NULL,
  `Descricao` varchar(100) DEFAULT NULL,
  `Qtde_estoque` int(11) DEFAULT NULL,
  `Local_armaz` text,
  `Categoria_idCategoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `Descricao`, `Qtde_estoque`, `Local_armaz`, `Categoria_idCategoria`) VALUES
(5, 'Sabonete em pó', 40, 'Quarto do Nambuco, prateleira 2', 1),
(7, 'Caneta Azul', 25, 'Estante 4, prateleira 5', 2),
(10, 'Caneta Vermelha', 14, 'Estante 4, prateleira 5', 2),
(12, 'Caneta Preta', 60, 'Estante 4, prateleira 5', 2),
(13, 'Sabonate Liquido', 18, 'Quarto do Nambuco, prateleira 2', 1),
(15, 'Motor a disel', 5, 'Deposito 1, quarto 2', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao`
--

CREATE TABLE `requisicao` (
  `idRequisicao` int(11) NOT NULL,
  `Data_retirada` varchar(45) DEFAULT NULL,
  `Requisitante_idRequisitante` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `requisicao`
--

INSERT INTO `requisicao` (`idRequisicao`, `Data_retirada`, `Requisitante_idRequisitante`) VALUES
(21, '2021-05-20', 2),
(20, '2021-05-19', 1),
(22, '2021-06-08', 1),
(23, '2021-06-09', 4),
(24, '2021-06-23', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisita`
--

CREATE TABLE `requisita` (
  `idRequisita` int(11) NOT NULL,
  `Produto_idProduto` int(11) NOT NULL,
  `Qtde_requisita` int(5) NOT NULL,
  `Requisicao_idRequisicao` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `requisita`
--

INSERT INTO `requisita` (`idRequisita`, `Produto_idProduto`, `Qtde_requisita`, `Requisicao_idRequisicao`) VALUES
(10, 7, 300, 21),
(9, 11, 37, 20),
(8, 7, 20, 20),
(11, 10, 200, 21),
(12, 17, 50, 21),
(13, 13, 5, 21),
(14, 6, 30, 22),
(15, 2, 13, 23),
(16, 11, 5, 23),
(17, 5, 30, 24),
(18, 8, 15, 24),
(19, 12, 3, 24);

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
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `fornece`
--
ALTER TABLE `fornece`
  ADD PRIMARY KEY (`idFornece`),
  ADD KEY `fk_Fornece_Produto1_idx` (`Produto_idProduto`),
  ADD KEY `fk_Fornece_Fornecedor1_idx` (`Fornecedor_idFornecedor`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idFornecedor`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProduto`),
  ADD KEY `fk_Produto_Categoria1_idx` (`Categoria_idCategoria`);

--
-- Indexes for table `requisicao`
--
ALTER TABLE `requisicao`
  ADD PRIMARY KEY (`idRequisicao`),
  ADD KEY `fk_Requisição_Requisitante1_idx` (`Requisitante_idRequisitante`);

--
-- Indexes for table `requisita`
--
ALTER TABLE `requisita`
  ADD PRIMARY KEY (`idRequisita`),
  ADD KEY `fk_Requisita_Produto1_idx` (`Produto_idProduto`),
  ADD KEY `fk_Requisita_Requisição1_idx` (`Requisicao_idRequisicao`);

--
-- Indexes for table `requisitante`
--
ALTER TABLE `requisitante`
  ADD PRIMARY KEY (`idRequisitante`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `fornece`
--
ALTER TABLE `fornece`
  MODIFY `idFornece` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `requisicao`
--
ALTER TABLE `requisicao`
  MODIFY `idRequisicao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `requisita`
--
ALTER TABLE `requisita`
  MODIFY `idRequisita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `requisitante`
--
ALTER TABLE `requisitante`
  MODIFY `idRequisitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
