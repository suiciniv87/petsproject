-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Out-2019 às 14:01
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pets`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `tipo_pet` varchar(25) NOT NULL,
  `nome_pet` varchar(15) NOT NULL,
  `lat` float NOT NULL,
  `long` float NOT NULL,
  `lat_final` float NOT NULL,
  `long_final` float NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `hora_vista` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pets`
--

INSERT INTO `pets` (`id`, `tipo_pet`, `nome_pet`, `lat`, `long`, `lat_final`, `long_final`, `data_inicio`, `data_fim`, `hora_vista`) VALUES
(1, 'Cachorro', 'Bob', -27.5949, -48.5482, -27.6037, -48.5464, '2019-08-05', '2019-09-02', '05:15:00'),
(2, 'Cachorro', 'Mel', -32.035, -52.0986, -32.0323, -52.1052, '2019-10-06', '2019-10-21', '21:47:53'),
(3, 'Cachorro', 'Argos', -29.6958, -51.2358, -29.6999, -51.2271, '2019-07-08', '2019-10-05', '16:21:10'),
(4, 'Gato', 'Pitu', -22.6026, -43.1902, -22.6055, -43.1989, '2019-04-15', '2019-09-18', '12:02:19'),
(5, 'Gato', 'Catita', -27.5949, -48.5482, -27.5919, -48.5439, '2019-02-12', '2019-07-20', '02:18:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
