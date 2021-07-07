-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2021 pada 23.35
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swiftshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `games`
--

CREATE TABLE `games` (
  `ID_GAME` int(11) NOT NULL,
  `NAMA_GAME` text DEFAULT NULL,
  `POPULARITAS_GAME` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `games`
--

INSERT INTO `games` (`ID_GAME`, `NAMA_GAME`, `POPULARITAS_GAME`) VALUES
(1, 'Mobile Legends', 100),
(2, 'Free Fire', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `ID_ITEM` int(11) NOT NULL,
  `ID_METODE` int(11) NOT NULL,
  `ID_GAME` int(11) NOT NULL,
  `NAMA_ITEM` text DEFAULT NULL,
  `VALUE_ITEM` int(11) DEFAULT NULL,
  `HARGA_ITEM` float(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `item`
--

INSERT INTO `item` (`ID_ITEM`, `ID_METODE`, `ID_GAME`, `NAMA_ITEM`, `VALUE_ITEM`, `HARGA_ITEM`) VALUES
(2, 1, 1, '12 Diamond', 12, 2000.00),
(3, 1, 1, '50 Diamond', 50, 8000.00),
(4, 1, 1, '70 Diamond', 70, 10000.00),
(5, 1, 1, '140 Diamond', 140, 20000.00),
(6, 1, 1, '355 Diamond', 355, 50000.00),
(7, 1, 1, '720 Diamond', 720, 100000.00),
(8, 1, 1, '1450 Diamond', 1450, 200000.00),
(9, 1, 1, '2180 Diamond', 2180, 300000.00),
(10, 1, 1, '3640 Diamond', 3640, 500000.00),
(11, 1, 1, '7290 Diamond', 7290, 1000000.00),
(12, 1, 1, '36500 Diamond', 36500, 5000000.00),
(13, 1, 1, '73100 Diamond', 73100, 10000000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `ID_METODE` int(11) NOT NULL,
  `NAMA_METODE` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`ID_METODE`, `NAMA_METODE`) VALUES
(1, 'OVO'),
(2, 'Gopay');

-- --------------------------------------------------------

--
-- Struktur dari tabel `voucher`
--

CREATE TABLE `voucher` (
  `ID_VOUCHER` int(11) NOT NULL,
  `ID_ITEM` int(11) DEFAULT NULL,
  `NAMA_VOUCHER` text DEFAULT NULL,
  `DESKRIPSI_VOUCHER` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`ID_GAME`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ID_ITEM`),
  ADD KEY `FK_ITEM_MEMPUNYAI_GAMES` (`ID_GAME`),
  ADD KEY `FK_ITEM_MENGGUNAK_METODE_P` (`ID_METODE`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`ID_METODE`);

--
-- Indeks untuk tabel `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`ID_VOUCHER`),
  ADD KEY `FK_VOUCHER_MEMILIKI_ITEM` (`ID_ITEM`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_ITEM_MEMPUNYAI_GAMES` FOREIGN KEY (`ID_GAME`) REFERENCES `games` (`ID_GAME`),
  ADD CONSTRAINT `FK_ITEM_MENGGUNAK_METODE_P` FOREIGN KEY (`ID_METODE`) REFERENCES `metode_pembayaran` (`ID_METODE`);

--
-- Ketidakleluasaan untuk tabel `voucher`
--
ALTER TABLE `voucher`
  ADD CONSTRAINT `FK_VOUCHER_MEMILIKI_ITEM` FOREIGN KEY (`ID_ITEM`) REFERENCES `item` (`ID_ITEM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
