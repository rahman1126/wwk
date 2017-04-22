-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2017 at 07:02 PM
-- Server version: 5.7.17-0ubuntu0.16.10.1
-- PHP Version: 7.0.15-0ubuntu0.16.10.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wwk`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(10) UNSIGNED NOT NULL,
  `provinsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `provinsi`, `kota`, `created_at`, `updated_at`) VALUES
(1, 'Aceh', 'Banda Aceh', NULL, NULL),
(2, 'Aceh', 'Langsa', NULL, NULL),
(3, 'Aceh', 'Lhokseumawe', NULL, NULL),
(4, 'Aceh', 'Meulaboh', NULL, NULL),
(5, 'Aceh', 'Sabang', NULL, NULL),
(6, 'Aceh', 'Subulussalam', NULL, NULL),
(7, 'Bali', 'Denpasar', NULL, NULL),
(8, 'Bangka Belitung', 'Pangkalpinang', NULL, NULL),
(9, 'Banten', 'Cilegon', NULL, NULL),
(10, 'Banten', 'Serang', NULL, NULL),
(11, 'Banten', 'Tangerang Selatan', NULL, NULL),
(12, 'Banten', 'Tangerang', NULL, NULL),
(13, 'Bengkulu', 'Bengkulu', NULL, NULL),
(14, 'Gorontalo', 'Gorontalo', NULL, NULL),
(15, 'Jakarta', 'Jakarta Barat', NULL, NULL),
(16, 'Jakarta', 'Jakarta Pusat', NULL, NULL),
(17, 'Jakarta', 'Jakarta Selatan', NULL, NULL),
(18, 'Jakarta', 'Jakarta Timur', NULL, NULL),
(19, 'Jakarta', 'Jakarta Utara', NULL, NULL),
(20, 'Jambi', 'Sungai Penuh', NULL, NULL),
(21, 'Jambi', 'Jambi', NULL, NULL),
(22, 'Jawa Barat', 'Bandung', NULL, NULL),
(23, 'Jawa Barat', 'Bekasi', NULL, NULL),
(24, 'Jawa Barat', 'Bogor', NULL, NULL),
(25, 'Jawa Barat', 'Cimahi', NULL, NULL),
(26, 'Jawa Barat', 'Cirebon', NULL, NULL),
(27, 'Jawa Barat', 'Depok', NULL, NULL),
(28, 'Jawa Barat', 'Sukabumi', NULL, NULL),
(29, 'Jawa Barat', 'Tasikmalaya', NULL, NULL),
(30, 'Jawa Barat', 'Banjar', NULL, NULL),
(31, 'Jawa Tengah', 'Magelang', NULL, NULL),
(32, 'Jawa Tengah', 'Pekalongan', NULL, NULL),
(33, 'Jawa Tengah', 'Purwokerto', NULL, NULL),
(34, 'Jawa Tengah', 'Salatiga', NULL, NULL),
(35, 'Jawa Tengah', 'Semarang', NULL, NULL),
(36, 'Jawa Tengah', 'Surakarta', NULL, NULL),
(37, 'Jawa Tengah', 'Tegal', NULL, NULL),
(38, 'Jawa Timur', 'Batu', NULL, NULL),
(39, 'Jawa Timur', 'Blitar', NULL, NULL),
(40, 'Jawa Timur', 'Kediri', NULL, NULL),
(41, 'Jawa Timur', 'Madiun', NULL, NULL),
(42, 'Jawa Timur', 'Malang', NULL, NULL),
(43, 'Jawa Timur', 'Mojokerto', NULL, NULL),
(44, 'Jawa Timur', 'Pasuruan', NULL, NULL),
(45, 'Jawa Timur', 'Probolinggo', NULL, NULL),
(46, 'Jawa Timur', 'Surabaya', NULL, NULL),
(47, 'Kalimantan Barat', 'Pontianak', NULL, NULL),
(48, 'Kalimantan Barat', 'Singkawang', NULL, NULL),
(49, 'Kalimantan Selatan', 'Banjarbaru', NULL, NULL),
(50, 'Kalimantan Selatan', 'Banjarmasin', NULL, NULL),
(51, 'Kalimantan Tengah', 'Palangkaraya', NULL, NULL),
(52, 'Kalimantan Timur', 'Balikpapan', NULL, NULL),
(53, 'Kalimantan Timur', 'Bontang', NULL, NULL),
(54, 'Kalimantan Timur', 'Samarinda', NULL, NULL),
(55, 'Kalimantan Utara', 'Tarakan', NULL, NULL),
(56, 'Kepulauan Riau', 'Batam', NULL, NULL),
(57, 'Kepulauan Riau', 'Tanjungpinang', NULL, NULL),
(58, 'Lampung', 'Bandar Lampung', NULL, NULL),
(59, 'Lampung', 'Kotabumi', NULL, NULL),
(60, 'Lampung', 'Liwa', NULL, NULL),
(61, 'Lampung', 'Metro', NULL, NULL),
(62, 'Maluku Utara', 'Ternate', NULL, NULL),
(63, 'Maluku Utara', 'Tidore Kepulauan', NULL, NULL),
(64, 'Maluku', 'Ambon', NULL, NULL),
(65, 'Maluku', 'Tual', NULL, NULL),
(66, 'Nusa Tenggara Barat', 'Bima', NULL, NULL),
(67, 'Nusa Tenggara Barat', 'Mataram', NULL, NULL),
(68, 'Nusa Tenggara Timur', 'Kupang', NULL, NULL),
(69, 'Papua Barat', 'Sorong', NULL, NULL),
(70, 'Papua', 'Jayapura', NULL, NULL),
(71, 'Riau', 'Dumai', NULL, NULL),
(72, 'Riau', 'Pekanbaru', NULL, NULL),
(73, 'Sulawesi Selatan', 'Makassar', NULL, NULL),
(74, 'Sulawesi Selatan', 'Palopo', NULL, NULL),
(75, 'Sulawesi Selatan', 'Parepare', NULL, NULL),
(76, 'Sulawesi Tengah', 'Palu', NULL, NULL),
(77, 'Sulawesi Tenggara', 'Bau-Bau', NULL, NULL),
(78, 'Sulawesi Tenggara', 'Kendari', NULL, NULL),
(79, 'Sulawesi Utara', 'Bitung', NULL, NULL),
(80, 'Sulawesi Utara', 'Kotamobagu', NULL, NULL),
(81, 'Sulawesi Utara', 'Manado', NULL, NULL),
(82, 'Sulawesi Utara', 'Tomohon', NULL, NULL),
(83, 'Sumatera Barat', 'Bukittinggi', NULL, NULL),
(84, 'Sumatera Barat', 'Padang', NULL, NULL),
(85, 'Sumatera Barat', 'Padangpanjang', NULL, NULL),
(86, 'Sumatera Barat', 'Pariaman', NULL, NULL),
(87, 'Sumatera Barat', 'Payakumbuh', NULL, NULL),
(88, 'Sumatera Barat', 'Sawahlunto', NULL, NULL),
(89, 'Sumatera Barat', 'Solok', NULL, NULL),
(90, 'Sumatera Selatan', 'LubukLinggau', NULL, NULL),
(91, 'Sumatera Selatan', 'Pagaralam', NULL, NULL),
(92, 'Sumatera Selatan', 'Palembang', NULL, NULL),
(93, 'Sumatera Selatan', 'Prabumulih', NULL, NULL),
(94, 'Sumatera Utara', 'Binjai', NULL, NULL),
(95, 'Sumatera Utara', 'Medan', NULL, NULL),
(96, 'Sumatera Utara', 'Padang Sidempuan', NULL, NULL),
(97, 'Sumatera Utara', 'Pematangsiantar', NULL, NULL),
(98, 'Sumatera Utara', 'Sibolga', NULL, NULL),
(99, 'Sumatera Utara', 'Tanjungbalai', NULL, NULL),
(100, 'Sumatera Utara', 'Tebingtinggi', NULL, NULL),
(101, 'Yogyakarta', 'Yogyakarta', NULL, NULL),
(102, 'Bangka Belitung', 'Ukui', '2017-03-30 07:01:17', '2017-03-30 07:01:17'),
(103, 'Jakarta', 'Petogogan', '2017-03-30 07:02:09', '2017-03-30 07:02:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
