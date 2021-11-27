-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 02:35 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digi_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `api_id` int(11) NOT NULL,
  `api_nama` text NOT NULL,
  `api_link` text NOT NULL,
  `api_date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`api_id`, `api_nama`, `api_link`, `api_date_created`) VALUES
(1, 'Teknisi All', 'api/teknisi-all', '2021-04-11 13:54:48'),
(2, 'User All', 'api/user-all/{token}', '2021-04-11 13:54:48'),
(3, 'Teknisi By (reference/value)', 'api/teknisi-by/{reference}/{value}', '2021-04-11 15:08:50'),
(4, 'Teknisi Insert', 'api/teknisi-insert', '2021-04-11 15:19:33'),
(5, 'Teknisi Update (id)', 'api/teknisi-update/{id}', '2021-04-11 15:19:59'),
(6, 'Teknisi Delete (id)', 'api/teknisi-delete/{id}', '2021-04-11 15:25:48'),
(8, 'Pelanggan', 'api/pelanggan-all', '2021-04-12 13:46:47'),
(9, 'Pelanggan By (reference/value)', 'api/pelanggan-by/{reference}/{value}', '2021-04-12 13:47:30'),
(10, 'Pelanggan Delete (id)', 'api/pelanggan-delete/{id}', '2021-04-12 13:48:03'),
(11, 'Pelanggan Insert', 'api/pelanggan-insert', '2021-04-12 13:48:33'),
(12, 'Pelanggan Update (id)', 'api/pelanggan-update/{id}', '2021-04-12 13:49:08'),
(13, 'Teknisi One (reference/value)', 'api/teknisi-one/{reference}/{value}', '2021-04-12 13:58:45'),
(14, 'User One (token/reference/value)', 'api/user-one/{token}/{reference}/{value}', '2021-04-12 14:00:09'),
(15, 'Users By (token/reference/value)', 'api/users-by/{token}/{reference}/{value}', '2021-04-12 14:01:02'),
(16, 'Jenis HP All', 'api/jenis-hp-all', '2021-07-22 10:12:59'),
(17, 'Jenis Hp Insert', 'api/jenis-hp-insert', '2021-07-22 10:13:25'),
(18, 'Jenis Hp Update (id)', 'api/jenis-hp-update/{id}', '2021-07-22 10:14:05'),
(19, 'Jenis Hp Delete (id)', 'api/jenis-hp-delete/{id}', '2021-07-22 10:14:29'),
(20, 'Jenis Hp By (reference/value)', 'api/jenis-hp-by/{reference}/{value}', '2021-07-22 10:15:01'),
(21, 'Jenis Hp One (reference/value)', 'api/jenis-hp-one/{reference}/{value}', '2021-07-22 10:15:32'),
(22, 'Jual All', 'api/jual-all', '2021-07-22 10:15:45'),
(23, 'Jual Insert', 'api/jual-insert', '2021-07-22 10:16:36'),
(24, 'Jual Update (id)', 'api/jual-update/{id}', '2021-07-22 10:17:03'),
(25, 'Jual Delete (id)', 'api/jual-delete/{id}', '2021-07-22 10:17:26'),
(26, 'Jual By (reference/value)', 'api/jual-by/{reference}/{value}', '2021-07-22 10:17:54'),
(27, 'Jual One (reference/value)', 'api/jual-one/{reference}/{value}', '2021-07-22 10:18:16'),
(28, 'Keahlian All', 'api/keahlian-all', '2021-07-22 10:18:33'),
(29, 'Keahlian By User (id)', 'api/keahlian-by-user/{id}', '2021-07-22 10:18:53'),
(30, 'Keahlian Insert', 'api/keahlian-insert', '2021-07-22 10:21:15'),
(31, 'Keahlian Update (id)', 'api/keahlian-update/{id}', '2021-07-22 10:21:41'),
(32, 'Keahlian Delete (id)', 'api/keahlian-delete/{id}', '2021-07-22 10:22:02'),
(33, 'Pesan (teknisi/pelanggan)', 'api/pesan/{teknisi}/{pelanggan}', '2021-08-07 14:08:12'),
(34, 'Pesan Insert', 'api/pesan-insert', '2021-08-07 14:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `beli_id` int(11) NOT NULL,
  `beli_jual_id` int(11) NOT NULL,
  `belii_status` enum('selesai','dibatalkan','booking') NOT NULL DEFAULT 'booking',
  `beli_tgl_beli` datetime NOT NULL,
  `beli_jasa_kurir` enum('Ya','Tidak') NOT NULL,
  `beli_pembeli` int(11) NOT NULL,
  `beli_tgl_booking` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detail_teknisi_jenis_hp`
--

CREATE TABLE `detail_teknisi_jenis_hp` (
  `id` int(11) NOT NULL,
  `teknisi_jenis_hp_id` int(11) NOT NULL,
  `jenis_hp_id` int(11) NOT NULL,
  `teknisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_teknisi_jenis_hp`
--

INSERT INTO `detail_teknisi_jenis_hp` (`id`, `teknisi_jenis_hp_id`, `jenis_hp_id`, `teknisi_id`) VALUES
(45, 19, 3, 1),
(46, 19, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_teknisi_jenis_kerusakan_hp`
--

CREATE TABLE `detail_teknisi_jenis_kerusakan_hp` (
  `id` int(11) NOT NULL,
  `teknisi_kerusakan_jenis_hp_id` int(11) NOT NULL,
  `teknisi_id` int(11) NOT NULL,
  `jenis_kerusakan_hp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_teknisi_jenis_kerusakan_hp`
--

INSERT INTO `detail_teknisi_jenis_kerusakan_hp` (`id`, `teknisi_kerusakan_jenis_hp_id`, `teknisi_id`, `jenis_kerusakan_hp_id`) VALUES
(40, 15, 1, 1),
(41, 15, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto_jual_produk`
--

CREATE TABLE `foto_jual_produk` (
  `id` int(11) NOT NULL,
  `jual_id` int(11) NOT NULL,
  `path_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_hp`
--

CREATE TABLE `jenis_hp` (
  `jenis_id` int(11) NOT NULL,
  `jenis_nama` varchar(255) NOT NULL,
  `jenis_thumbnail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis_hp`
--

INSERT INTO `jenis_hp` (`jenis_id`, `jenis_nama`, `jenis_thumbnail`) VALUES
(1, 'xiamoi', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Xiaomi_logo.svg/480px-Xiaomi_logo.svg.png'),
(2, 'Samsung', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Xiaomi_logo.svg/480px-Xiaomi_logo.svg.png'),
(3, 'Lenovo', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Xiaomi_logo.svg/480px-Xiaomi_logo.svg.png');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kerusakan_hp`
--

CREATE TABLE `jenis_kerusakan_hp` (
  `id_jenis_kerusakan` int(11) NOT NULL,
  `nama_kerusakan` varchar(255) NOT NULL,
  `deskripsi_kerusakan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis_kerusakan_hp`
--

INSERT INTO `jenis_kerusakan_hp` (`id_jenis_kerusakan`, `nama_kerusakan`, `deskripsi_kerusakan`) VALUES
(1, 'HP Suka Hang', 'Ditandai dengan sistem yang lemot waktu dipakai, kemudian suka macet (hang) tiba-tiba selama beberapa menit.'),
(2, 'HP Suka Update Sendiri', 'Ini jenis kerusakan ringan. HP yang sedang tersambung ke internet tiba-tiba mengupdate aplikasi sendiri.');

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `jual_id` int(11) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `jual_tgl_penjualan` datetime NOT NULL DEFAULT current_timestamp(),
  `jual_status` enum('belum','sudah','booked') NOT NULL DEFAULT 'belum',
  `jual_harga` bigint(20) NOT NULL,
  `jual_deskripsi` text NOT NULL,
  `jual_user_id` int(11) NOT NULL,
  `jual_tujuan` enum('pelanggan','teknisi') NOT NULL,
  `jual_judul` varchar(255) NOT NULL,
  `jual_jenis_hp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`jual_id`, `foto_produk`, `jual_tgl_penjualan`, `jual_status`, `jual_harga`, `jual_deskripsi`, `jual_user_id`, `jual_tujuan`, `jual_judul`, `jual_jenis_hp`) VALUES
(1, 'https://www.jakmall.com/blog/content/images/2020/09/sssss.JPG', '2021-08-12 19:58:22', 'belum', 50000, 'Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak', 1, 'pelanggan', 'Hp Xiomi Redmo Note 9', 1),
(2, 'https://www.jakmall.com/blog/content/images/2020/09/sssss.JPG', '2021-08-12 19:58:22', 'belum', 50000, 'Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak', 1, 'pelanggan', 'Hp Xiomi Redmo Note 9', 1);

-- --------------------------------------------------------

--
-- Table structure for table `keahlian`
--

CREATE TABLE `keahlian` (
  `keahlian_id` int(11) NOT NULL,
  `keahlian_jenis_hp` int(11) NOT NULL,
  `keahlian_teknisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pelanggan_nama` varchar(255) NOT NULL,
  `pelanggan_hp` varchar(14) NOT NULL,
  `pelanggan_alamat` varchar(255) NOT NULL,
  `pelanggan_foto` text DEFAULT NULL,
  `pelanggan_date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelanggan_date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pelanggan_lat` text NOT NULL,
  `pelanggan_lng` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `email`, `pelanggan_nama`, `pelanggan_hp`, `pelanggan_alamat`, `pelanggan_foto`, `pelanggan_date_created`, `pelanggan_date_updated`, `pelanggan_lat`, `pelanggan_lng`) VALUES
(4, 'abdul123@gmail.com', 'Abdul Hafiz Ramadan', 'Vivo', 'Bukit Datuk', 'https://img.lovepik.com/photo/50118/9025.jpg_wh860.jpg', '2021-11-25 01:56:17', '2021-11-25 13:41:34', '-', '-'),
(6, 'pelanggan@gmail.com', 'Pelanggan', 'Vivo', 'Bumi', 'https://image.freepik.com/free-photo/smiling-asian-man-standing-with-hands-folded-concept-engineering-jobs_264197-8835.jpg', '2021-11-25 13:49:21', '2021-11-25 13:49:21', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `pesan_id` int(11) NOT NULL,
  `pesan_pelanggan` int(11) NOT NULL,
  `pesan_teknisi` int(11) NOT NULL,
  `pesan_isi` text NOT NULL,
  `pesan_status` enum('menunggu','dibaca','','') NOT NULL,
  `pesan_pengirim` enum('pelanggan','teknisi') NOT NULL,
  `pesan_date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `pesan_foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jenis_hp_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `harga` float NOT NULL DEFAULT current_timestamp(),
  `is_sold_out` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `responden`
--

CREATE TABLE `responden` (
  `responden_id` int(11) NOT NULL,
  `responden_pelanggan` int(11) NOT NULL,
  `responden_teknisi` int(11) NOT NULL,
  `responden_skor` int(11) NOT NULL,
  `responden_date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `responden_gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `beli_id` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_handphone`
--

CREATE TABLE `service_handphone` (
  `service_handphone_id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `teknisi_id` int(11) NOT NULL,
  `jenis_hp` varchar(255) NOT NULL,
  `jenis_kerusakan` varchar(255) NOT NULL,
  `by_kurir` tinyint(1) NOT NULL,
  `status_service` enum('selesai','dibatalkan','proses','diterima','ditolak') NOT NULL DEFAULT 'proses',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_handphone`
--

INSERT INTO `service_handphone` (`service_handphone_id`, `pelanggan_id`, `teknisi_id`, `jenis_hp`, `jenis_kerusakan`, `by_kurir`, `status_service`, `created_at`, `updated_at`) VALUES
(5, 4, 2, 'Vivo', 'lcd', 0, 'ditolak', '2021-11-22 09:05:14', '2021-11-22 09:05:14'),
(6, 4, 2, 'Vivo', 'Lemot', 1, 'diterima', '2021-11-22 09:05:48', '2021-11-22 09:05:48'),
(7, 4, 6, 'Vivo', 'battery', 0, 'diterima', '2021-11-22 09:07:54', '2021-11-22 09:07:54'),
(8, 4, 4, 'Vivo', 'loop', 0, 'diterima', '2021-11-22 09:11:00', '2021-11-22 09:11:00'),
(9, 4, 5, 'Lenovo', 'lcd', 0, 'proses', '2021-11-22 09:13:03', '2021-11-22 09:13:03'),
(10, 25, 1, 'Lemovo', '1234', 0, 'proses', '2021-11-25 14:41:44', '2021-11-25 14:41:44'),
(11, 25, 1, 'Lemo', 'admin', 0, 'proses', '2021-11-25 14:43:40', '2021-11-25 14:43:40'),
(12, 25, 2, 'andro', 'afew', 0, 'proses', '2021-11-25 14:44:48', '2021-11-25 14:44:48'),
(13, 25, 2, 'ffwefw', 'fwfw', 0, 'proses', '2021-11-25 14:56:16', '2021-11-25 14:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE `teknisi` (
  `teknisi_id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `teknisi_nama` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `teknisi_nama_toko` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `teknisi_alamat` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `teknisi_lat` text CHARACTER SET utf8mb4 NOT NULL,
  `teknisi_lng` text CHARACTER SET utf8mb4 NOT NULL,
  `teknisi_hp` varchar(14) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `teknisi_total_score` int(11) DEFAULT NULL,
  `teknisi_total_responden` int(11) DEFAULT NULL,
  `teknisi_deskripsi` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `teknisi_foto` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `teknisi_sertifikat` text CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`teknisi_id`, `email`, `teknisi_nama`, `teknisi_nama_toko`, `teknisi_alamat`, `teknisi_lat`, `teknisi_lng`, `teknisi_hp`, `created_at`, `updated_at`, `teknisi_total_score`, `teknisi_total_responden`, `teknisi_deskripsi`, `teknisi_foto`, `teknisi_sertifikat`) VALUES
(1, 'ryan@gmail.com', 'Ryans', 'Jaya Ponsel', 'Pekanbaru', '1', '1', '08330101010', '2021-11-16 13:13:18', '2021-11-14 17:24:50', 60, 14, 'Yaya', 'https://assets-global.website-files.com/5b6df8bb681f89c158b48f6b/5d7b6a6e00f64f8f69b8bf36_it-services-technician.jpg', 'Adul Dwijaya_dummy2.jpg'),
(2, 'ryan@gmail.com', 'Ryan Andropal', 'Jaya Hp', 'Jalan Gapura', '1', '1', '081275753271', '2021-11-12 00:18:53', '2021-07-07 19:27:28', 50, 14, 'Yo servis disini gratis pisang', 'https://assets-global.website-files.com/5b6df8bb681f89c158b48f6b/5d7b6a6e00f64f8f69b8bf36_it-services-technician.jpg', 'Ryan Andropal_dummy2.jpg'),
(4, 'test@gmail.com', 'test', 'Toko I', 'PKU', '0.00', '0.00', '081275753271', '2021-11-06 22:35:17', '2021-11-02 18:46:23', 50, 14, 'Deskripsi toko I', 'https://assets-global.website-files.com/5b6df8bb681f89c158b48f6b/5d7b6a6e00f64f8f69b8bf36_it-services-technician.jpg', 'Ryan Andropal_dummy2.jpg'),
(5, 'test2@gmail.com', 'test2', 'test2', 'test2', '0.0', '0.0', '081275753271', '2021-11-06 22:35:18', '2021-11-02 19:01:46', 50, 14, 'test2', 'https://assets-global.website-files.com/5b6df8bb681f89c158b48f6b/5d7b6a6e00f64f8f69b8bf36_it-services-technician.jpg', 'Ryan Andropal_dummy2.jpg'),
(6, 'yaya@gmail.com', 'yaya', 'yaya', 'yaya', '0.0', '0.0', '081275753271', '2021-11-06 22:35:20', '2021-11-03 09:21:44', 50, 14, 'yaya', 'https://assets-global.website-files.com/5b6df8bb681f89c158b48f6b/5d7b6a6e00f64f8f69b8bf36_it-services-technician.jpg', 'Ryan Andropal_dummy2.jpg'),
(7, 'haha@gmail.com', 'haha', 'haha', 'haha', '0.0', '0.0', '081275753271', '2021-11-06 22:35:21', '2021-11-03 09:22:52', 50, 14, 'Deskripsi toko I', 'https://assets-global.website-files.com/5b6df8bb681f89c158b48f6b/5d7b6a6e00f64f8f69b8bf36_it-services-technician.jpg', 'Ryan Andropal_dummy2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `teknisi_jenis_hp`
--

CREATE TABLE `teknisi_jenis_hp` (
  `id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `teknisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teknisi_jenis_hp`
--

INSERT INTO `teknisi_jenis_hp` (`id`, `deskripsi`, `teknisi_id`) VALUES
(19, 'Testing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teknisi_kerusakan_jenis_hp`
--

CREATE TABLE `teknisi_kerusakan_jenis_hp` (
  `id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `teknisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teknisi_kerusakan_jenis_hp`
--

INSERT INTO `teknisi_kerusakan_jenis_hp` (`id`, `deskripsi`, `teknisi_id`) VALUES
(15, 'deskripsi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `akses_id` int(11) DEFAULT NULL,
  `level` enum('teknisi','pelanggan','admin') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `akses_id`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Ryans', 'ryan@gmail.com', NULL, '$2y$13$8nvKA6rSfrk6GadP0O1Y1.qpPCfLFylDQVl/4aq9QJyQEvd5z37DW', 0, 'teknisi', NULL, '2021-04-09 05:11:01', '2021-11-13 09:00:55'),
(3, 'Adul Dwijaya', 'aduldwijaya@gmail.com', NULL, '$2y$13$8nvKA6rSfrk6GadP0O1Y1.qpPCfLFylDQVl/4aq9QJyQEvd5z37DW', 1, 'teknisi', NULL, NULL, NULL),
(4, 'Ryan Andropal', 'adulryan@gmail.com', NULL, '$2y$10$SSUCBHyRyVNmYpio0ncWyOlJqq7CpxUo2O7./zVcZac...', 2, 'teknisi', NULL, NULL, NULL),
(6, 'a', 'a@gmail.com', NULL, 'bd905b54b717094932c93e23cd117b52de2e36b2', 1, 'pelanggan', NULL, NULL, NULL),
(8, 'test', 'test@gmail.com', NULL, '$2y$10$OcqeZH6oZJuOH7gRNKkZ9OpYdFwoT0HPxq.gdNq55iYReccF3xzia', NULL, 'teknisi', NULL, '2021-11-02 18:46:23', '2021-11-02 18:46:23'),
(9, 'test2', 'test2@gmail.com', NULL, '$2y$10$/thIvm5fZ8lXTaYPGTafHOcNQRUaY9OJHS04jyG4.c1L9Hpd3GleO', NULL, 'teknisi', NULL, '2021-11-02 19:01:46', '2021-11-02 19:01:46'),
(10, 'yaya', 'yaya@gmail.com', NULL, '$2y$10$LOuexfu1BjnO2O0eKdUh2eoNXMo/7g54qUIdY8tRfSnRhz3GJ9GK6', NULL, 'teknisi', NULL, '2021-11-03 09:21:44', '2021-11-03 09:21:44'),
(11, 'haha', 'haha@gmail.com', NULL, '$2y$10$rl4hf2lcErZgEt/MKlnMM.KGur0zG.t7bheHzpIZh4PXPx1b96Mpy', NULL, 'teknisi', NULL, '2021-11-03 09:22:52', '2021-11-03 09:22:52'),
(12, 'Abdul', 'abdul@gmail.com', NULL, '$2y$10$s9XNc4NR7AAmqZvYIMjQieNvBbHvpy7o2hHPtcaAxQtfe5ttpGlwC', NULL, 'teknisi', NULL, '2021-11-19 07:48:01', '2021-11-19 07:48:01'),
(13, 'Abdul fwefw', 'abduvvwefwl@gmail.com', NULL, '$2y$10$Fxh5RPvrVIc331eeEpqpzOzGorv6SL99T6ZO0d4LJkLEVkJbTHAju', NULL, 'teknisi', NULL, '2021-11-19 07:50:26', '2021-11-19 07:50:26'),
(14, 'Abdul fwefw', 'newuser@gmail.com', NULL, '$2y$10$34ITzvVbPw8B0bedRmBmt.Ot4LGT25lO9IcrlOm5O1H0DiJk3mcdq', NULL, 'teknisi', NULL, '2021-11-19 07:51:35', '2021-11-19 07:51:35'),
(15, 'Abdul fwefw', 'newuser1@gmail.com', NULL, '$2y$10$asNpeYqSAoNdbXW8/wXjr.LB6yYrPusGESPzkzIs/iKeuieQlpWgi', NULL, 'teknisi', NULL, '2021-11-19 07:53:40', '2021-11-19 07:53:40'),
(16, 'Abdul fwefw', 'newuser2@gmail.com', NULL, '$2y$10$1eR7JdOUa2ZuWgay/QavoO5dWwi8/YT/0ARl.ez7RWq2kGIfU7PKu', NULL, 'teknisi', NULL, '2021-11-19 07:54:05', '2021-11-19 07:54:05'),
(17, 'Abdul fwefw', 'newuser3@gmail.com', NULL, '$2y$10$6POQg7UlwXTdQGsl2tiUU.xKe86eyf14b/JfY43ZnlSwHDZgy7IZG', NULL, 'teknisi', NULL, '2021-11-19 08:00:04', '2021-11-19 08:00:04'),
(18, 'Abdul fwefw', 'newuser4@gmail.com', NULL, '$2y$10$elwm6Cp7mm5/2kEAfnWc..SqmwRiK.nh7847aCPM2G4QQtXgEtm2y', NULL, 'teknisi', NULL, '2021-11-19 08:01:03', '2021-11-19 08:01:03'),
(19, 'Abdul fwefw', 'newuser5@gmail.com', NULL, '$2y$10$8FxdckTfpmReW8Q5bSEgBexIQzKjJYHIcMazXjGO9T2LC5.8ogbpi', NULL, 'teknisi', NULL, '2021-11-19 08:10:10', '2021-11-19 08:10:10'),
(20, 'Abdul fwefw', 'newuser6@gmail.com', NULL, '$2y$10$7eYAvZ1SBdxeweAQIqqyB.E2I570EDr3aY045V9goJ2wdPPWiHESO', NULL, 'teknisi', NULL, '2021-11-19 19:10:28', '2021-11-19 19:10:28'),
(21, 'Abdul fwefw', 'newuser7@gmail.com', NULL, '$2y$10$v6QTRtI99U4yNmbrlVSkJO/BJuT3EoW55mKr.nEztbgBv0l.cknHW', NULL, 'teknisi', NULL, '2021-11-19 19:14:31', '2021-11-19 19:14:31'),
(22, 'Abdul fwefw', 'newuser8@gmail.com', NULL, '$2y$10$VUFwdXj5BpHDFrZpWk03e.TYTQBtI/kjQ.U5DwafZO2H/UaZ.LZcy', NULL, 'teknisi', NULL, '2021-11-19 19:43:40', '2021-11-19 19:43:40'),
(24, 'Abdul Hafiz Ramadan', 'abdul123@gmail.com', NULL, '$2y$13$8nvKA6rSfrk6GadP0O1Y1.qpPCfLFylDQVl/4aq9QJyQEvd5z37DW', 0, 'pelanggan', NULL, '2021-11-25 01:58:26', '2021-11-25 01:58:26'),
(25, 'pelanggan', 'pelanggan@gmail.com', NULL, '$2y$13$8nvKA6rSfrk6GadP0O1Y1.qpPCfLFylDQVl/4aq9QJyQEvd5z37DW', 0, 'pelanggan', NULL, '2021-04-09 05:11:01', '2021-11-13 09:00:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`beli_id`);

--
-- Indexes for table `detail_teknisi_jenis_hp`
--
ALTER TABLE `detail_teknisi_jenis_hp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_teknisi_jenis_kerusakan_hp`
--
ALTER TABLE `detail_teknisi_jenis_kerusakan_hp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto_jual_produk`
--
ALTER TABLE `foto_jual_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_hp`
--
ALTER TABLE `jenis_hp`
  ADD PRIMARY KEY (`jenis_id`);

--
-- Indexes for table `jenis_kerusakan_hp`
--
ALTER TABLE `jenis_kerusakan_hp`
  ADD PRIMARY KEY (`id_jenis_kerusakan`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`jual_id`);

--
-- Indexes for table `keahlian`
--
ALTER TABLE `keahlian`
  ADD PRIMARY KEY (`keahlian_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`pesan_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`responden_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_handphone`
--
ALTER TABLE `service_handphone`
  ADD PRIMARY KEY (`service_handphone_id`);

--
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`teknisi_id`);

--
-- Indexes for table `teknisi_jenis_hp`
--
ALTER TABLE `teknisi_jenis_hp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teknisi_kerusakan_jenis_hp`
--
ALTER TABLE `teknisi_kerusakan_jenis_hp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `api_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `beli`
--
ALTER TABLE `beli`
  MODIFY `beli_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_teknisi_jenis_hp`
--
ALTER TABLE `detail_teknisi_jenis_hp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `detail_teknisi_jenis_kerusakan_hp`
--
ALTER TABLE `detail_teknisi_jenis_kerusakan_hp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_jual_produk`
--
ALTER TABLE `foto_jual_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_hp`
--
ALTER TABLE `jenis_hp`
  MODIFY `jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_kerusakan_hp`
--
ALTER TABLE `jenis_kerusakan_hp`
  MODIFY `id_jenis_kerusakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jual`
--
ALTER TABLE `jual`
  MODIFY `jual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keahlian`
--
ALTER TABLE `keahlian`
  MODIFY `keahlian_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `pesan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responden`
--
ALTER TABLE `responden`
  MODIFY `responden_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_handphone`
--
ALTER TABLE `service_handphone`
  MODIFY `service_handphone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `teknisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teknisi_jenis_hp`
--
ALTER TABLE `teknisi_jenis_hp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `teknisi_kerusakan_jenis_hp`
--
ALTER TABLE `teknisi_kerusakan_jenis_hp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
