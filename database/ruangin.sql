-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2025 at 07:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `booking`
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
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `ruangan_id`, `tanggal`, `jam_mulai`, `jam_selesai`, `keperluan`, `dokumen`, `status`, `dibuat`, `diubah`) VALUES
(1, 4, 1, '2025-12-05', '08:00:00', '10:00:00', 'Latihan presentasi tugas akhir', 'ta_aldi.pdf', 'pending', '2025-12-01 13:12:46', '2025-12-01 13:12:46'),
(2, 5, 2, '2025-12-05', '10:00:00', '12:00:00', 'Diskusi kelompok praktikum', 'proposal_sari.pdf', 'disetujui', '2025-12-01 13:12:46', '2025-12-01 13:12:46'),
(3, 6, 3, '2025-12-06', '13:00:00', '15:00:00', 'Rapat internal organisasi', 'surat_permohonan_dito.pdf', 'ditolak', '2025-12-01 13:12:46', '2025-12-01 13:12:46'),
(4, 2, 5, '2025-12-07', '09:00:00', '11:00:00', 'Rapat dosen bulanan', NULL, 'disetujui', '2025-12-01 13:12:46', '2025-12-01 13:12:46'),
(5, 3, 1, '2025-12-08', '14:00:00', '16:00:00', 'Konsultasi tugas akhir mahasiswa', NULL, 'pending', '2025-12-01 13:12:46', '2025-12-01 13:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
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
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama_ruangan`, `kode`, `kapasitas`, `tipe`, `status`, `dibuat`, `diubah`) VALUES
(1, 'Lab Komputer 1', 'LAB01', 35, 'lab', 'aktif', '2025-12-01 13:12:40', '2025-12-01 13:12:40'),
(2, 'Lab Komputer 2', 'LAB02', 30, 'lab', 'aktif', '2025-12-01 13:12:40', '2025-12-01 13:12:40'),
(3, 'Ruang Kelas A1', 'KLSA1', 25, 'kelas kecil', 'aktif', '2025-12-01 13:12:40', '2025-12-01 13:12:40'),
(4, 'Ruang Kelas B2', 'KLSB2', 20, 'kelas kecil', 'aktif', '2025-12-01 13:12:40', '2025-12-01 13:12:40'),
(5, 'Ruang Rapat Utama', 'RPT01', 15, 'rapat', 'aktif', '2025-12-01 13:12:40', '2025-12-01 13:12:40'),
(6, 'Ruang Rapat Mini', 'RPT02', 10, 'rapat', 'nonaktif', '2025-12-01 13:12:40', '2025-12-01 13:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `dibuat` datetime DEFAULT current_timestamp(),
  `diubah` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `dibuat`, `diubah`) VALUES
(1, 'Admin Ruangan', 'admin@ruangin.com', 'admin123', 'admin', '2025-12-01 13:12:33', '2025-12-01 13:12:33'),
(2, 'Dosen Rina', 'rina@unikom.ac.id', 'password', 'dosen', '2025-12-01 13:12:33', '2025-12-01 13:12:33'),
(3, 'Dosen Bima', 'bima@unikom.ac.id', 'password', 'dosen', '2025-12-01 13:12:33', '2025-12-01 13:12:33'),
(4, 'Mahasiswa Aldi', 'aldi@student.ac.id', 'password', 'mahasiswa', '2025-12-01 13:12:33', '2025-12-01 13:12:33'),
(5, 'Mahasiswa Sari', 'sari@student.ac.id', 'password', 'mahasiswa', '2025-12-01 13:12:33', '2025-12-01 13:12:33'),
(6, 'Mahasiswa Dito', 'dito@student.ac.id', 'password', 'mahasiswa', '2025-12-01 13:12:33', '2025-12-01 13:12:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ruangan_id` (`ruangan_id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
