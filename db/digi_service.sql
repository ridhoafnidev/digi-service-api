-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2021 at 04:02 PM
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
  `teknisi_kerusakan_jenis_hp_id` int(11) NOT NULL,
  `jenis_hp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_teknisi_jenis_hp`
--

INSERT INTO `detail_teknisi_jenis_hp` (`id`, `teknisi_kerusakan_jenis_hp_id`, `jenis_hp_id`) VALUES
(1, 14, 1),
(2, 14, 2),
(3, 15, 1),
(4, 15, 2),
(5, 16, 1),
(6, 16, 2),
(7, 17, 1),
(8, 17, 2),
(9, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_teknisi_jenis_kerusakan_hp`
--

CREATE TABLE `detail_teknisi_jenis_kerusakan_hp` (
  `id` int(11) NOT NULL,
  `teknisi_kerusakan_jenis_hp_id` int(11) NOT NULL,
  `jenis_kerusakan_hp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_teknisi_jenis_kerusakan_hp`
--

INSERT INTO `detail_teknisi_jenis_kerusakan_hp` (`id`, `teknisi_kerusakan_jenis_hp_id`, `jenis_kerusakan_hp_id`) VALUES
(1, 15, 1),
(2, 15, 2),
(3, 16, 1),
(4, 16, 2),
(5, 17, 1),
(6, 18, 1);

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

INSERT INTO `jual` (`jual_id`, `jual_tgl_penjualan`, `jual_status`, `jual_harga`, `jual_deskripsi`, `jual_user_id`, `jual_tujuan`, `jual_judul`, `jual_jenis_hp`) VALUES
(1, '2021-08-12 19:58:22', 'belum', 50000, 'mantap', 1, 'pelanggan', 'mantap', 1);

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
(4, 'uas@gmal.com', 'ujanga', '1231231', 'JLaninaja', 'Jhon_dummy3.jpg', '2021-06-08 06:55:09', '2021-10-24 03:11:27', '2323131', '23232');

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
(1, 'aduldwijaya@gmail.com', 'Adul Dwijaya', '', 'Jalan Gapura', '1', '1', '081275753271', '2021-10-24 03:06:30', '2021-06-08 21:49:43', 60, 14, 'Yo servis disini gratis pisang', 'https://assets-global.website-files.com/5b6df8bb681f89c158b48f6b/5d7b6a6e00f64f8f69b8bf36_it-services-technician.jpg', 'Adul Dwijaya_dummy2.jpg'),
(2, 'ryan@gmail.com', 'Ryan Andropal', '', 'Jalan Gapura', '1', '1', '081275753271', '2021-10-24 03:06:13', '2021-07-07 19:27:28', 50, 14, 'Yo servis disini gratis pisang', 'Ryan Andropal_dummy1.jpg', 'Ryan Andropal_dummy2.jpg'),
(4, 'test@gmail.com', 'test', 'Toko I', 'PKU', '0.00', '0.00', NULL, '2021-11-02 18:46:23', '2021-11-02 18:46:23', NULL, NULL, 'Deskripsi toko I', NULL, NULL),
(5, 'test2@gmail.com', 'test2', 'test2', 'test2', '0.0', '0.0', NULL, '2021-11-02 19:01:46', '2021-11-02 19:01:46', NULL, NULL, 'test2', NULL, NULL),
(6, 'yaya@gmail.com', 'yaya', 'yaya', 'yaya', '0.0', '0.0', NULL, '2021-11-03 09:21:44', '2021-11-03 09:21:44', NULL, NULL, 'yaya', NULL, NULL),
(7, 'haha@gmail.com', 'haha', 'haha', 'haha', '0.0', '0.0', NULL, '2021-11-03 09:22:52', '2021-11-03 09:22:52', NULL, NULL, NULL, NULL, NULL);

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
(1, 'deskripsi', 1),
(11, 'deskripsi', 1),
(12, 'deskripsi', 1),
(13, 'deskripsi', 1),
(14, 'deskripsi', 1),
(15, 'deskripsi', 1),
(16, 'deskripsi', 1),
(17, '[gsfgsfg]', 1),
(18, 'Testing', 1);

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
(1, 'ryan', 'ryan@gmail.com', NULL, '$2y$10$VAdQGEvVfX//P3xLr2dmVezNCdHjeDFoNmecuFth2ML5/s.rJdSbW', 0, 'teknisi', NULL, '2021-04-09 05:11:01', '2021-04-09 05:11:01'),
(2, 'ujanga', 'uas@gmal.com', NULL, '$2y$10$vXTV64Vz9eo6NhdbkzUOW..3BCkySY0XH4kO3LjQtPumb5cHm5faq', 4, 'pelanggan', NULL, NULL, NULL),
(3, 'Adul Dwijaya', 'aduldwijaya@gmail.com', NULL, '$2y$10$UxWFeU7AVFG/CICeLIs6ceNkSs4ntuOHraR0mQgX6Utr3TVWsKWbe', 1, 'teknisi', NULL, NULL, NULL),
(4, 'Ryan Andropal', 'adulryan@gmail.com', NULL, '$2y$10$SSUCBHyRyVNmYpio0ncWyOlJqq7CpxUo2O7./zVcZac...', 2, 'teknisi', NULL, NULL, NULL),
(6, 'a', 'a@gmail.com', NULL, 'bd905b54b717094932c93e23cd117b52de2e36b2', 1, 'pelanggan', NULL, NULL, NULL),
(8, 'test', 'test@gmail.com', NULL, '$2y$10$OcqeZH6oZJuOH7gRNKkZ9OpYdFwoT0HPxq.gdNq55iYReccF3xzia', NULL, 'teknisi', NULL, '2021-11-02 18:46:23', '2021-11-02 18:46:23'),
(9, 'test2', 'test2@gmail.com', NULL, '$2y$10$/thIvm5fZ8lXTaYPGTafHOcNQRUaY9OJHS04jyG4.c1L9Hpd3GleO', NULL, 'teknisi', NULL, '2021-11-02 19:01:46', '2021-11-02 19:01:46'),
(10, 'yaya', 'yaya@gmail.com', NULL, '$2y$10$LOuexfu1BjnO2O0eKdUh2eoNXMo/7g54qUIdY8tRfSnRhz3GJ9GK6', NULL, 'teknisi', NULL, '2021-11-03 09:21:44', '2021-11-03 09:21:44'),
(11, 'haha', 'haha@gmail.com', NULL, '$2y$10$rl4hf2lcErZgEt/MKlnMM.KGur0zG.t7bheHzpIZh4PXPx1b96Mpy', NULL, 'teknisi', NULL, '2021-11-03 09:22:52', '2021-11-03 09:22:52');

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
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`teknisi_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_teknisi_jenis_kerusakan_hp`
--
ALTER TABLE `detail_teknisi_jenis_kerusakan_hp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `jual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `teknisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teknisi_kerusakan_jenis_hp`
--
ALTER TABLE `teknisi_kerusakan_jenis_hp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
