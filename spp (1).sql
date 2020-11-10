-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Okt 2020 pada 07.23
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_tagihan`
--

CREATE TABLE `detail_tagihan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_tagihan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagihan_id` int(10) UNSIGNED DEFAULT NULL,
  `siswa_id` int(10) UNSIGNED DEFAULT NULL,
  `kelas_id` int(10) UNSIGNED DEFAULT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_tagihan`
--

INSERT INTO `detail_tagihan` (`id`, `kode_tagihan`, `tagihan_id`, `siswa_id`, `kelas_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TG08-2840-1', 1, 1, NULL, 'sudah dibayar', '2020-07-28 01:28:40', '2020-07-28 01:31:30'),
(2, 'TG06-0540-1', 2, 1, NULL, 'sudah dibayar', '2020-07-28 23:05:40', '2020-07-28 23:08:03'),
(3, 'TG06-0544-2', 2, 2, NULL, 'sudah dibayar', '2020-07-28 23:05:44', '2020-07-29 05:41:27'),
(4, 'TG12-3945-1', 3, 1, NULL, 'belum dibayar', '2020-07-29 05:39:45', '2020-07-29 05:39:45'),
(5, 'TG12-3952-2', 3, 2, NULL, 'belum dibayar', '2020-07-29 05:39:52', '2020-07-29 05:39:52'),
(6, 'TG12-3957-3', 3, 3, NULL, 'belum dibayar', '2020-07-29 05:39:57', '2020-07-29 05:39:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `periode_id` int(11) DEFAULT NULL,
  `nama` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `periode_id`, `nama`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'XI IPS 2', '1', '2020-07-28 01:26:49', '2020-07-29 02:06:54'),
(2, 1, 'XI IPS 2', '0', '2020-07-28 02:52:28', '2020-07-28 02:53:59'),
(3, 1, 'X IPA 1', '1', '2020-07-29 05:13:10', '2020-07-29 05:13:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_19_084734_create_siswa_table', 1),
(5, '2020_03_19_085348_create_periode_table', 1),
(6, '2020_03_19_085513_create_kelas_table', 1),
(7, '2020_03_30_143820_create_tagihan_table', 1),
(8, '2020_03_30_145904_create_transaksi_table', 1),
(9, '2020_06_11_132606_create_detail_tagihan', 1),
(10, '2020_06_11_145643_add_kode_to_detail_tagihan', 1),
(11, '2020_06_13_181018_add_tahun_to_periode', 1),
(12, '2020_07_04_203340_add_total_to_transaksi', 1),
(13, '2020_07_09_123800_add_kode_transaksi_to_transaksi', 1),
(14, '2020_07_13_141321_add_siswa_id_to_tagihan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tahun` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `deleted_at` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id`, `nama`, `tgl_mulai`, `tgl_selesai`, `tahun`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Periode Pertama', '2001-01-01', '2004-01-01', '2002', 1, '1', '2020-07-28 01:26:07', '2020-07-29 02:06:37'),
(2, 'Periode Kedua', '2010-01-06', '2011-01-01', '2010a', 1, '1', '2020-07-29 05:11:46', '2020-07-29 05:12:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_siswa` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tempat_lahir` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `nama_wali` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `user_id`, `nama_siswa`, `kelas_id`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `nama_wali`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'Arsela Libana', 1, 'Jakarta', '1999-01-01', 'P', 'Kedungsugih', 'Maslikha', '1', '2020-07-28 01:28:04', '2020-07-28 01:28:04'),
(2, 6, 'Wiranto', 1, 'Tegal', '2001-01-03', 'P', 'Kedungsugih', 'Jaka', '0', '2020-07-28 23:03:43', '2020-08-12 20:02:04'),
(3, 8, 'Raya', 1, 'Tegal', '2011-03-09', 'L', 'Tegal', 'Subekhi', '1', '2020-07-29 05:18:27', '2020-07-29 05:18:27'),
(4, 12, 'Atik', 1, 'Tegal', '1970-01-01', 'P', 'Dukuhmaja', 'Sukirno', '0', '2020-08-12 19:38:02', '2020-09-14 17:49:16'),
(5, 16, 'Atik', 1, 'Tegal', '1970-01-01', 'P', 'Dukuhmaja', 'Sukirno', '0', '2020-09-14 17:56:27', '2020-09-14 17:56:41'),
(6, 9, 'Atik', 1, 'Tegal', '1970-01-01', 'P', 'Dukuhmaja', 'Sukirno', '1', '2020-09-14 23:48:09', '2020-09-14 23:48:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` double NOT NULL,
  `peserta` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id`, `nama`, `jumlah`, `peserta`, `keterangan`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Syahriah Pertama', 50000, 'semua siswa', 'LUNAS', '1', '2020-07-28 01:28:40', '2020-07-29 02:08:28'),
(2, 'Syahriah Kedua', 50000, 'semua siswa', 'LUNAS', '1', '2020-07-28 23:05:40', '2020-07-29 00:33:19'),
(3, 'Syahriah Maret', 50000, 'semua siswa', 'B', '1', '2020-07-29 05:39:45', '2020-07-29 05:39:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tagihan_id` int(11) NOT NULL,
  `kode_transaksi` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_pembayaran` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lunas` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `siswa_id`, `tagihan_id`, `kode_transaksi`, `tgl_transaksi`, `total_pembayaran`, `keterangan`, `lunas`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'TG08-2840-1', '2020-07-28', '50000', 'LUNAS', 'ya', '1', '2020-07-28 01:31:30', '2020-07-28 01:31:30'),
(2, 1, 2, 'TG06-0540-1', '2020-07-08', '50000', 'LUNAS', 'ya', '1', '2020-07-28 23:08:03', '2020-07-28 23:08:03'),
(3, 2, 2, 'TG06-0544-2', '2020-07-15', '50000', 'LUNAS', 'ya', '1', '2020-07-29 05:32:51', '2020-07-29 05:32:51'),
(4, 1, 3, 'TG12-3945-1', '2020-07-22', '20000', 'j', 'ya', '1', '2020-07-29 05:41:27', '2020-07-29 05:41:27'),
(5, 1, 3, 'TG12-3945-1', '2020-07-22', '50000', 'l', 'ya', '1', '2020-07-29 05:42:57', '2020-07-29 05:42:57'),
(6, 1, 3, 'TG12-3945-1', '2020-07-09', '50000', 'LUNAS', 'ya', '1', '2020-07-29 05:44:05', '2020-07-29 05:44:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kepala sekolah', 'ritamasfufah123@gmail.com', NULL, '$2y$10$2kp9/KOYEv74PBj40CAUre8RygMkXakl8/ZWPEW/V3eSosnP.Noue', 'superadmin', NULL, '2020-07-28 01:05:59', '2020-07-28 01:05:59'),
(2, 'Admin', 'dydana98@gmail.com', NULL, '$2y$10$lM5n/9GxpXNKMEoTW9caG.TAJdak5476xmCOsPbmZsEds0CiqPB1S', 'admin', NULL, '2020-07-28 01:06:01', '2020-07-28 01:06:01'),
(4, 'Arsela Libana', 'arselalibana123@gmail.com', NULL, '$2y$10$GirsKlEyBhK2QnfG7968POQbhYm6QAUscrXekN2c4XK09g0v7nOJW', 'siswa', NULL, '2020-07-28 01:27:54', '2020-07-28 01:27:54'),
(8, 'Raya', 'anjar.dosen@gmail.com', NULL, '$2y$10$iYmS.NRhM2Sgmjy0SNWN5uhrjkPsv6xKSW.bd0J/U60hU/lSodOLK', 'siswa', NULL, '2020-07-29 05:18:20', '2020-07-29 05:18:20'),
(9, 'Atik', 'hartika3110@gmail.com', NULL, '$2y$10$eTHKD3bmNpXOoUYGWaf.o.5Xiqj3C/mWyhj18hc3nDKhSng1srTkS', 'siswa', NULL, '2020-09-14 23:47:53', '2020-09-14 23:47:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_tagihan`
--
ALTER TABLE `detail_tagihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_tagihan`
--
ALTER TABLE `detail_tagihan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
