-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Feb 2026 pada 03.52
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruangin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ruangan_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `keperluan` text DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `dibuat` datetime DEFAULT current_timestamp(),
  `diubah` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `ruangan_id`, `tanggal`, `jam_mulai`, `jam_selesai`, `keperluan`, `dokumen`, `status`, `dibuat`, `diubah`) VALUES
(1, 4, 1, '2025-12-05', '08:00:00', '10:00:00', 'Latihan presentasi tugas akhir', 'ta_aldi.pdf', 'pending', '2025-12-01 13:12:46', '2025-12-01 13:12:46'),
(2, 5, 2, '2025-12-05', '10:00:00', '12:00:00', 'Diskusi kelompok praktikum', 'proposal_sari.pdf', 'disetujui', '2025-12-01 13:12:46', '2025-12-01 13:12:46'),
(3, 6, 3, '2025-12-06', '13:00:00', '15:00:00', 'Rapat internal organisasi', 'surat_permohonan_dito.pdf', 'ditolak', '2025-12-01 13:12:46', '2025-12-01 13:12:46'),
(4, 2, 5, '2025-12-07', '09:00:00', '11:00:00', 'Rapat dosen bulanan', NULL, 'disetujui', '2025-12-01 13:12:46', '2025-12-01 13:12:46'),
(5, 3, 1, '2025-12-08', '14:00:00', '16:00:00', 'Konsultasi tugas akhir mahasiswa', NULL, 'pending', '2025-12-01 13:12:46', '2025-12-01 13:12:46'),
(6, 7, 2, '2025-12-04', '13:00:00', '15:00:00', 'Kelas Penambangan data', 'dokumen/n52DLGjqrf54PKX9usFKrFiiJwUGC0VZ5xhlqeRl.pdf', 'ditolak', '2025-12-03 07:16:27', '2025-12-08 05:56:39'),
(7, 14, 1, '2025-12-10', '00:00:00', '05:00:00', 'Jurit malam', 'dokumen/sJ41GKwHyKX3jK5HGnHJ6LV1VsSSBfXoyk4XDfab.pdf', 'ditolak', '2025-12-07 16:28:33', '2025-12-08 02:43:11'),
(8, 14, 1, '2025-12-10', '00:00:00', '05:00:00', 'Jurit malam', 'dokumen/NLJ735wobJ33GcaBDUIX3amSLPbW8rVxoo3BVS65.pdf', 'pending', '2025-12-07 16:28:36', '2025-12-07 16:28:36'),
(10, 8, 1, '2026-01-02', '04:14:00', '05:16:00', 'tes', 'dokumen/ljjCsxdulxLX9cc9QGCNBdHNGZ76EO0C1iSBgEx7.pdf', 'disetujui', '2025-12-07 17:10:57', '2025-12-08 02:42:57'),
(11, 9, 1, '2025-12-07', '07:00:00', '08:00:00', 'tes', 'dokumen/6mkJFlyoOZWCCGBtPRDgY9o8CPI9w8xHa0jC2J7G.pdf', 'pending', '2025-12-07 17:11:05', '2025-12-07 17:11:05'),
(12, 7, 3, '2025-12-09', '13:00:00', '15:00:00', 'tes', 'dokumen/tqiCJxSNqACpo1JTrLr9seTsHZ3KMrLPSafomwVg.pdf', 'pending', '2025-12-07 17:31:26', '2025-12-07 17:31:26'),
(14, 15, 6, '2025-12-11', '11:00:00', '15:00:00', 'Kumpul Divisi', 'dokumen/lLfbu2YD9XpFFqXG0RGFox2kkJdBCrBGQgD9Osyp.pdf', 'pending', '2025-12-08 03:22:14', '2025-12-08 03:22:14'),
(15, 16, 3, '2025-12-12', '08:40:00', '11:00:00', 'Penyampaian materi dasar UKM YES', 'dokumen/9ITFT9u7FDeM97WoRzxumKwaF4gjq0qF3wAkryo5.pdf', 'ditolak', '2025-12-08 03:41:18', '2025-12-08 03:55:08'),
(16, 18, 1, '2025-12-09', '12:25:00', '14:26:00', 'Kelas PTI', 'dokumen/RVSUDoj694jq6oZUznkmBopyPUds0ZbT5VgfCAJy.pdf', 'disetujui', '2025-12-08 05:26:04', '2025-12-08 05:26:57'),
(17, 19, 2, '2025-12-13', '08:30:00', '11:30:00', 'Penyampaian pemahaman akan bahaya malware', 'dokumen/Nf9OlLrn68MRKQDcIvd9taiRFTeKVv6vi4zahwk9.pdf', 'pending', '2025-12-08 06:01:10', '2025-12-08 06:01:10'),
(18, 20, 1, '2025-12-09', '13:07:00', '16:07:00', 'rapat', 'dokumen/b0k42NbE3OJkZuBwfpNCMDgWRQcKYdHp2TGVhUXj.pdf', 'pending', '2025-12-08 06:10:16', '2025-12-08 06:10:16'),
(19, 21, 5, '2025-12-09', '12:00:00', '15:00:00', 'untuk rapat', 'dokumen/U4xg5TSD6L91vlGtO1mrCBwjWNcK6PrV5PwUZ0q2.pdf', 'disetujui', '2025-12-08 07:32:26', '2025-12-08 07:34:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_03_000000_add_remember_token_to_users_table', 1),
(5, '2025_12_04_133830_add_avatar_to_users_table', 1),
(6, '2025_12_05_000000_add_is_verified_to_users_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL,
  `nama_ruangan` varchar(150) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `dibuat` datetime DEFAULT current_timestamp(),
  `diubah` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama_ruangan`, `kode`, `kapasitas`, `tipe`, `status`, `dibuat`, `diubah`) VALUES
(1, 'Lab Komputer 1', 'LAB01', 35, 'laboratorium', 'aktif', '2025-12-01 13:12:40', '2025-12-08 03:52:58'),
(2, 'Lab Komputer 2', 'LAB02', 30, 'laboratorium', 'aktif', '2025-12-01 13:12:40', '2025-12-08 03:54:21'),
(3, 'Ruang Kelas A1', 'KLSA1', 25, 'kelas kecil', 'aktif', '2025-12-01 13:12:40', '2025-12-01 13:12:40'),
(4, 'Ruang Kelas B2', 'KLSB2', 20, 'kelas kecil', 'aktif', '2025-12-01 13:12:40', '2025-12-01 13:12:40'),
(5, 'Ruang Rapat Utama', 'RPT01', 15, 'meeting', 'aktif', '2025-12-01 13:12:40', '2025-12-08 03:53:54'),
(6, 'Ruang Rapat Mini', 'RPT02', 10, 'meeting', 'nonaktif', '2025-12-01 13:12:40', '2025-12-08 03:54:06'),
(7, 'Aula 1', 'A001', 300, 'seminar', 'aktif', '2025-12-08 02:32:53', '2025-12-08 02:32:53'),
(8, 'Lab 6', 'LAB06', 15, 'laboratorium', 'aktif', '2025-12-08 07:35:48', '2025-12-08 07:35:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 1,
  `dibuat` datetime DEFAULT current_timestamp(),
  `diubah` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `is_verified`, `dibuat`, `diubah`, `remember_token`, `avatar`) VALUES
(1, 'Admin Ruangan', 'admin@ruangin.com', '$2y$12$9JplOPn2nrs2G1t0gk58SOoJo0XEu6/i.4L6EPvzesyrwPbV5m1Nq', 'admin', 1, '2025-12-01 13:12:33', '2025-12-07 15:37:32', NULL, NULL),
(2, 'Dosen Rina', 'rina@unikom.ac.id', '$2y$12$FkGtjg8yv5eaesKK4nrKxO6eCLOyxGoeyZgPImPLMQFCVSFKFarZm', 'dosen', 1, '2025-12-01 13:12:33', '2025-12-08 03:39:39', NULL, NULL),
(3, 'Dosen Bima', 'bima@unikom.ac.id', '$2y$12$FkGtjg8yv5eaesKK4nrKxO6eCLOyxGoeyZgPImPLMQFCVSFKFarZm', 'dosen', 1, '2025-12-01 13:12:33', '2025-12-04 07:25:56', NULL, NULL),
(4, 'Mahasiswa Aldi', 'aldi@student.ac.id', '$2y$12$FkGtjg8yv5eaesKK4nrKxO6eCLOyxGoeyZgPImPLMQFCVSFKFarZm', 'mahasiswa', 1, '2025-12-01 13:12:33', '2025-12-04 07:25:56', NULL, NULL),
(5, 'Mahasiswa Sari', 'sari@student.ac.id', '$2y$12$FkGtjg8yv5eaesKK4nrKxO6eCLOyxGoeyZgPImPLMQFCVSFKFarZm', 'mahasiswa', 1, '2025-12-01 13:12:33', '2025-12-04 07:25:56', NULL, NULL),
(6, 'Mahasiswa Dito', 'dito@student.ac.id', '$2y$12$FkGtjg8yv5eaesKK4nrKxO6eCLOyxGoeyZgPImPLMQFCVSFKFarZm', 'mahasiswa', 1, '2025-12-01 13:12:33', '2025-12-04 07:25:56', NULL, NULL),
(7, 'frans', 'franz@gmail.ac.id', '$2y$12$TgmZvxUNcq5Ub8LEEUMpTeKjvKF8oGpzbviuWwFzSsMhmXnIrA3pC', 'dosen', 1, '2025-12-03 13:39:57', '2025-12-08 09:52:43', NULL, 'avatars/kNcUvlWkjNNb7Hxpe2XQOjMWlAujRYf6Im8JjWuc.png'),
(8, 'Barka Tirta', 'barka@mahasiswa.com', '$2y$12$hYjQHb6DnUk/O9.Y7693KO8OlPf/dE5IY3Q5HQgTiIVFIf3gQLoca', 'mahasiswa', 1, '2025-12-07 15:39:39', '2025-12-08 16:50:49', NULL, ''),
(9, 'Revan', 'revana.10123355@mahasiswa.unikom.ac.id', '$2y$12$cqixUjbt5PghI66.J3nW5uhI.35kN8p06Od6V6f6ebsbTTsw6CrJC', 'mahasiswa', 1, '2025-12-07 15:40:16', '2025-12-08 16:50:49', NULL, ''),
(10, 'Budi Santoso', 'budi@dosen.com', '$2y$12$jvL4JIZQ.HJUvu.hGsqTxeWa5zOzecqG7DW.LI3k5ghs2Dr3hLd5m', 'dosen', 1, '2025-12-07 15:41:07', '2025-12-08 03:39:57', NULL, NULL),
(11, 'Asep Udin', 'asep@dosen.com', '$2y$12$D1XOJrpKMCuiRAhzpCQi7Ox2hTK2T1HggY6gPdPG8teLd1yM33zTy', 'dosen', 1, '2025-12-07 15:43:16', '2025-12-08 03:32:30', NULL, NULL),
(12, 'cusep karawang', 'cusep@dosen.com', '$2y$12$oJCShd3lcoakfAi.TNyzGeJoYhL7lizyeqDdlJ3rEoucFobAX5Idu', 'dosen', 1, '2025-12-07 15:56:17', '2025-12-08 03:37:37', NULL, NULL),
(13, 'iqbal ganteng', 'miamor@mahasiswa', '$2y$12$6o6v/am6kw.k/1rseeMwj.iXram1cXgsJCliVFREl192j6MQ3mkda', 'mahasiswa', 1, '2025-12-07 15:57:13', '2025-12-08 16:50:49', NULL, ''),
(14, 'Aurel azzahra', 'aurel@sangatimut.com', '$2y$12$1TvTmIbaZuphSxgZPfre0OziFUvHx/eUQN7jhAOEahtTPJ/p6qvk6', 'mahasiswa', 1, '2025-12-07 16:26:29', '2025-12-07 16:26:29', NULL, NULL),
(15, 'Bhadriko Theo Pramudya', 'bhadriko7@gmail.com', '$2y$12$k/iIYvMXuqXobgwFrC7ABuB8iHXpAu6OhA/zspDvagyuho4YiQf7a', 'mahasiswa', 1, '2025-12-08 01:59:20', '2025-12-08 16:51:17', NULL, ''),
(16, 'Alfansyah Rizky Wijaya', 'alfansyah.10123364@unikom.ac.id', '$2y$12$IJWuptFUBORO5Re4VxLbWOFZYfG4uwiFfYpU1OhIXqiQbqsb1nUkG', 'mahasiswa', 1, '2025-12-08 03:30:09', '2025-12-08 16:50:49', NULL, ''),
(17, 'Cristiano Ronaldo', 'ronaldo@dosen.com', '$2y$12$LkQH8It6xaZNTVKmL/B9qOVAZyMHKJAtZCEpTiytHlkkKRd7ouLJW', 'dosen', 0, '2025-12-08 05:17:07', '2025-12-08 05:17:07', NULL, NULL),
(18, 'Fauzan', 'fauzan@unikom.ac.id', '$2y$12$O.925xIKiXIJCtjwUc6fV.Y/JaV07GWQHUw80l3uwgQf/zIaTbmXq', 'mahasiswa', 1, '2025-12-08 05:17:24', '2025-12-08 05:17:24', NULL, NULL),
(19, 'Alfansyah RW', 'alfansyah@dosen.unikom', '$2y$12$YZcKE7/dCKAqXM3O.U1cHudCptAst5r90RLhws4phsB36NkACwldK', 'dosen', 1, '2025-12-08 05:27:47', '2025-12-08 05:29:02', NULL, NULL),
(20, 'bunros', 'ucup@mahasiswa.com', '$2y$12$hB22au6VOiYo8STplk0QI.E4bkvR7zh8g1Hxcc8K46kKgC124nVw.', 'mahasiswa', 1, '2025-12-08 06:05:19', '2025-12-08 06:05:19', NULL, NULL),
(21, 'namanya bebas', 'namabebas@email.com', '$2y$12$hQfsrikitKhR.YcjB4umge0irqK7msVfD8H7xlHB/ndFd2F9.FLaa', 'mahasiswa', 1, '2025-12-08 07:31:02', '2025-12-08 07:31:02', NULL, NULL),
(22, 'Coba daftar', 'cobadaftar@dosen.com', '$2y$12$JbdgEEc6cvDaEWelhIB47OK0oEIWsScom3jowrcmEeToGohjrQzHu', 'dosen', 1, '2025-12-08 07:37:01', '2025-12-08 07:37:30', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ruangan_id` (`ruangan_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
