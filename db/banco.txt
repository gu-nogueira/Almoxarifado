CREATE DATABASE `proj_almox` DEFAULT CHARACTER SET utf8;
USE `proj_almox`;
CREATE TABLE `Categoria` (
 `idCategoria` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `Descricao` VARCHAR(40));
CREATE TABLE `Produto` (
 `idProduto` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `Descricao` VARCHAR(100),
 `Qtde_estoque` INT,
 `Local_armaz` TEXT(200),
 `Categoria_idCategoria` INT NOT NULL,
 INDEX `fk_Produto_Categoria1_idx` (`Categoria_idCategoria`),
 CONSTRAINT `fk_Produto_Categoria1`
 FOREIGN KEY (`Categoria_idCategoria`)
 REFERENCES `proj_almox`.`Categoria` (`idCategoria`));
CREATE TABLE `Requisitante` (
 `idRequisitante` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `Nome` VARCHAR(100),
 `Setor` VARCHAR(30));
CREATE TABLE `Requisição` (
 `idRequisição` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `Data_retirada` VARCHAR(45),
 `Requisitante_idRequisitante` INT NOT NULL,
 INDEX `fk_Requisição_Requisitante1_idx` (`Requisitante_idRequisitante`),
 CONSTRAINT `fk_Requisição_Requisitante1`
 FOREIGN KEY (`Requisitante_idRequisitante`)
 REFERENCES `proj_almox`.`Requisitante` (`idRequisitante`));
CREATE TABLE `Fornecedor` (
 `idFornecedor` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `Nome_fantasia` VARCHAR(200),
 `Endereco` VARCHAR(200),
 `Cidade` VARCHAR(45));
CREATE TABLE `Requisita` (
 `idRequisita` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `Produto_idProduto` INT NOT NULL,
 `Requisição_idRequisição` INT NOT NULL,
 INDEX `fk_Requisita_Produto1_idx` (`Produto_idProduto`),
 INDEX `fk_Requisita_Requisição1_idx` (`Requisição_idRequisição`),
 CONSTRAINT `fk_Requisita_Produto1`
 FOREIGN KEY (`Produto_idProduto`)
 REFERENCES `proj_almox`.`Produto` (`idProduto`),
 CONSTRAINT `fk_Requisita_Requisição1`
 FOREIGN KEY (`Requisição_idRequisição`)
 REFERENCES `proj_almox`.`Requisição` (`idRequisição`));
CREATE TABLE `Fornece` (
 `idFornece` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `Produto_idProduto` INT NOT NULL,
 `Fornecedor_idFornecedor` INT NOT NULL,
 INDEX `fk_Fornece_Produto1_idx` (`Produto_idProduto`),
 INDEX `fk_Fornece_Fornecedor1_idx` (`Fornecedor_idFornecedor`),
 CONSTRAINT `fk_Fornece_Produto1`
 FOREIGN KEY (`Produto_idProduto`)
 REFERENCES `proj_almox`.`Produto` (`idProduto`),
CONSTRAINT `fk_Fornece_Fornecedor1`
 FOREIGN KEY (`Fornecedor_idFornecedor`)
 REFERENCES `proj_almox`.`Fornecedor` (`idFornecedor`));