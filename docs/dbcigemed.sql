-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Out-2019 às 21:00
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbcigemed`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbci`
--

CREATE TABLE `tbci` (
  `numero` int(10) UNSIGNED NOT NULL,
  `objeto` varchar(255) NOT NULL,
  `idFuncionario` int(10) UNSIGNED DEFAULT NULL,
  `data_cad` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbci`
--

INSERT INTO `tbci` (`numero`, `objeto`, `idFuncionario`, `data_cad`) VALUES
(1, 'Teste 3', 2, '2019-09-26'),
(2, 'Objeto de teste', 1, '2019-09-26'),
(3, 'Teste 2 ', 2, '2019-09-26'),
(1439, 'asd', 1, '2019-10-08'),
(1440, 'asd', 1, '2019-10-08'),
(1441, 'asd', 1, '2019-10-08'),
(1442, 'asd', 1, '2019-10-08'),
(1443, 'asd', 1, '2019-10-08'),
(1444, 'asd', 2, '2019-10-08'),
(1445, 'asd', 2, '2019-10-08'),
(1446, 'asd', 2, '2019-10-08'),
(1447, 'asd', 2, '2019-10-08'),
(1448, 'sasasa', 2, '2019-10-08'),
(1449, 'sasasas', 2, '2019-10-08'),
(1450, 'AÔBA', 2, '2019-10-08'),
(1451, 'AÔBA', 2, '2019-10-08'),
(1452, 'sasasa', 2, '2019-10-08'),
(1456, 'asasa', 2, '2019-10-08'),
(1457, 'asasa', 2, '2019-10-08'),
(1458, 'asasa', 2, '2019-10-08'),
(1459, 'asasa', 2, '2019-10-08'),
(1460, 'sa', 2, '2019-10-08'),
(1461, 'sa', 2, '2019-10-08'),
(1462, 'sa', 2, '2019-10-08'),
(1463, 'sa', 2, '2019-10-08'),
(1464, 'sa', 2, '2019-10-08'),
(1465, 'sa', 2, '2019-10-08'),
(1466, 'sa', 2, '2019-10-08'),
(1467, 'sa', 2, '2019-10-08'),
(1468, 'sa', 2, '2019-10-08'),
(1469, 'sa', 2, '2019-10-08'),
(1470, 'sa', 2, '2019-10-08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfuncionario`
--

CREATE TABLE `tbfuncionario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbfuncionario`
--

INSERT INTO `tbfuncionario` (`id`, `nome`) VALUES
(2, 'Carlos'),
(1, 'Gabriel Barth');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbgemedadm`
--

CREATE TABLE `tbgemedadm` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbgemedadm`
--

INSERT INTO `tbgemedadm` (`id`, `usuario`, `senha`) VALUES
(1, 'Alisson Couto', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbci`
--
ALTER TABLE `tbci`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `fk_ci_funcionario` (`idFuncionario`);

--
-- Índices para tabela `tbfuncionario`
--
ALTER TABLE `tbfuncionario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `tbgemedadm`
--
ALTER TABLE `tbgemedadm`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbci`
--
ALTER TABLE `tbci`
  MODIFY `numero` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1471;

--
-- AUTO_INCREMENT de tabela `tbfuncionario`
--
ALTER TABLE `tbfuncionario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbgemedadm`
--
ALTER TABLE `tbgemedadm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbci`
--
ALTER TABLE `tbci`
  ADD CONSTRAINT `fk_ci_funcionario` FOREIGN KEY (`idFuncionario`) REFERENCES `tbfuncionario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
