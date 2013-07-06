-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 06. Juli 2013 jam 08:54
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `surat_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `key`
--

CREATE TABLE IF NOT EXISTS `key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `key`
--

INSERT INTO `key` (`id`, `name`, `code`) VALUES
(9, '1', '2'),
(10, '22', '22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `letter`
--

CREATE TABLE IF NOT EXISTS `letter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letter_type_id` int(11) NOT NULL,
  `public_key` varchar(255) NOT NULL,
  `letter_no` varchar(255) NOT NULL,
  `letter_file` varchar(255) NOT NULL,
  `desc` longtext NOT NULL,
  `source` varchar(255) NOT NULL,
  `date_print` date NOT NULL,
  `date_confirm` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `letter`
--

INSERT INTO `letter` (`id`, `letter_type_id`, `public_key`, `letter_no`, `letter_file`, `desc`, `source`, `date_print`, `date_confirm`) VALUES
(2, 3, '22', '11', '', '5', '22', '2013-07-01', '2013-07-02'),
(3, 2, '22', '123456', '', 'bukakasss', '555', '2013-07-13', '2013-07-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `letter_type`
--

CREATE TABLE IF NOT EXISTS `letter_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `letter_type`
--

INSERT INTO `letter_type` (`id`, `name`) VALUES
(2, 'Surat Masuk'),
(3, 'Surat Keluar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `passwd` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `user_type_id`, `name`, `email`, `passwd`) VALUES
(1, 1, 'Herry', 'her0satr@yahoo.com', 'd0cccd72f00289035b8e25ff29100dee'),
(4, 1, 'Yani', 'yani@yahoo.com', '933902c6f005618c80b7760478a14cc1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'Ka BAU'),
(2, 'Staff TU'),
(3, 'Staff Rektorat'),
(4, 'Staff Unit');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
