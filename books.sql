-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2019 at 01:13 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `idbuku` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `idkategori` int(11) DEFAULT NULL,
  `imgfile` varchar(100) DEFAULT NULL,
  `sinopsis` text,
  `thnterbit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`idbuku`, `judul`, `pengarang`, `penerbit`, `idkategori`, `imgfile`, `sinopsis`, `thnterbit`) VALUES
(1, 'lorem ipsum', 'ada lah pokoknya', 'samping rumah penulis', 3, NULL, 'lorem ipsum dolor sit amet concentes de juno yupiter minerva apollo mars ceres', 2019),
(2, 'coba pertama kali', 'dia yang ada di sana', 'tetangga pengarang', 6, 'lab1002.PNG', 'lorem ipsum dolor sit amet', 2000),
(4, 'coba kategori yang dihapus', 'sebenarnya tidak ada', 'tidak akan pernah terbit', 7, 'lab1003c.PNG', 'coba dulu bisa tidak, pakenya query gan', 1111),
(5, 'jytgij', 'fgkhhk', 'kfvyfgh', 5, '', 'yrfyfgubk', 2568),
(6, 'hnibgufgi', 'cnhibuvcytdyu', 'jhtdvfyjbgnk', 6, NULL, 'lbfvcxxrt', 4567),
(7, 'gvbknmnhbvcrgf', 'sedtfghjk', 'jkbvcfs', 4, NULL, 'buydcxhn', 765),
(8, 'vxzxc', ' bvtcsxtrt', 'hgbycxtrt', 4, NULL, 'vxrxtcyvbnm,', 1345),
(9, 'edcvgyhnmk', 'ijnhytrdxa', 'qwerszxcv', 6, NULL, 'rtyuilmnbvc', 988),
(10, 'axefvgbnhv', 'zsxcfvbbh', 'gbsybwdgr', 5, NULL, 'xercvfrgf', 400),
(11, 'sfcsrvqw', 'fhjj', 'aee', 3, 'sgfrx', 'srvbdhjfth', 345),
(12, 'rcvgbdch', 'rcgvbyn', 'fghhdvxf', 1, NULL, 'aesrvgbhnfjgmh', 45),
(13, 'fgdbdfnmfvnh', 'ghdbvs', 'opk,lmknjfbdvs', 7, NULL, 'fzdsbhdjfkmn', 1),
(14, 'fjgknmjk', 'xdcsvdfhd', 'opodax', 9, NULL, 'ecvbsrbjvf', 3563);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `kategori`) VALUES
(1, 'Buku Teks'),
(2, 'Majalah'),
(3, 'Skripsi'),
(4, 'Thesis'),
(5, 'Disertasi'),
(6, 'Novel'),
(7, 'Light Novel');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'operator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `fullname`, `role`) VALUES
('admin', '123456', 'Administrator', 1),
('wksdk', 'asd', 'reverend', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`idbuku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `idbuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
