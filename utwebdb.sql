-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Nov 2024 pada 05.41
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `file_manager_ut`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$wOVl2xTLajJDo//oxNttwepgGxoYmQ1ujwqdTDVYAAWc6jt0OBrnS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `departments`
--

INSERT INTO `departments` (`id`, `name`, `faculty_id`, `created_at`, `updated_at`, `department_name`) VALUES
(69, 'KDTN', 32, '2024-11-17 06:20:13', '2024-11-20 15:44:48', 'sistem'),
(70, 'KDTN', 32, '2024-11-17 09:47:39', '2024-11-20 15:45:00', 'gizi'),
(74, 'PAI', 37, '2024-11-20 15:17:14', '2024-11-20 15:45:08', 'dakwah'),
(75, 'PAI', 37, '2024-11-20 15:18:02', '2024-11-20 15:45:14', 'ben'),
(76, 'PAI', 37, '2024-11-20 15:18:11', '2024-11-20 15:45:18', 'haha'),
(77, 'KDTN', 32, '2024-11-20 15:48:21', '2024-11-20 16:01:38', 'jdjncdfnkf'),
(78, 'PAI', 37, '2024-11-20 16:02:20', '2024-11-20 16:02:20', 'pondok'),
(84, 'FE', 41, '2024-11-25 02:47:00', '2024-11-25 02:47:00', 'managemen'),
(86, 'FE', 41, '2024-11-25 02:48:21', '2024-11-25 02:48:21', 'akutansi'),
(87, 'FHISIP', 42, '2024-11-25 02:51:40', '2024-11-25 02:51:40', 'ilmu hukum'),
(88, 'FHISIP', 42, '2024-11-25 02:52:36', '2024-11-25 02:52:36', 'ilmu politik'),
(89, 'FKIP', 43, '2024-11-25 02:54:30', '2024-11-25 02:54:30', 'pendidikan bahasa inggris'),
(90, 'FKIP', 43, '2024-11-25 02:54:47', '2024-11-25 02:54:47', 'pendidikan matematika'),
(91, 'FST', 44, '2024-11-25 02:59:27', '2024-11-25 02:59:27', 'ilmu komunikasi'),
(92, 'FST', 44, '2024-11-25 02:59:53', '2024-11-25 02:59:53', 'statistik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `faculties`
--

INSERT INTO `faculties` (`id`, `name`) VALUES
(32, 'KDTN'),
(37, 'PAI'),
(41, 'FE'),
(42, 'FHISIP'),
(43, 'FKIP'),
(44, 'FST');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama_fakultas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `file_type` varchar(255) DEFAULT NULL,
  `uploaded_at` datetime DEFAULT current_timestamp(),
  `department` varchar(255) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `files`
--

INSERT INTO `files` (`id`, `faculty`, `filename`, `file_path`, `created_at`, `file_type`, `uploaded_at`, `department`, `faculty_id`, `department_id`) VALUES
(159, 'KDTN', 'bg_buku (5) (1) (1) (1) (2) (2) (1) (1).jpg', 'uploads/bg_buku (5) (1) (1) (1) (2) (2) (1) (1).jpg', '2024-11-20 02:34:00', NULL, '2024-11-20 09:34:00', 'sistem', NULL, NULL),
(160, 'KDTN', 'Bukti Ujian 17210720 (772).pdf', 'uploads/Bukti Ujian 17210720 (772).pdf', '2024-11-20 14:38:02', NULL, '2024-11-20 21:38:02', 'gizi', NULL, NULL),
(162, 'KDTN', 'bg_buku (4) (1).jpg', 'uploads/bg_buku (4) (1).jpg', '2024-11-20 15:15:17', NULL, '2024-11-20 22:15:17', 'gizi', NULL, NULL),
(166, 'KDTN', 'Basic Web HTML CSS (5) (1) (1) (2).zip', 'uploads/Basic Web HTML CSS (5) (1) (1) (2).zip', '2024-11-25 02:43:56', NULL, '2024-11-25 09:43:56', 'gizi', NULL, NULL),
(167, 'FE', 'Basic Web HTML CSS (5) (1) (1) (1) (1).zip', 'uploads/Basic Web HTML CSS (5) (1) (1) (1) (1).zip', '2024-11-25 02:48:55', NULL, '2024-11-25 09:48:55', 'akutansi', NULL, NULL),
(168, 'FHISIP', 'Basic Web HTML CSS (5) (1) (1) (2).zip', 'uploads/Basic Web HTML CSS (5) (1) (1) (2).zip', '2024-11-25 02:52:59', NULL, '2024-11-25 09:52:59', 'ilmu politik', NULL, NULL),
(169, 'FKIP', 'Basic Web HTML CSS (5) (1) (1) (1) (1).zip', 'uploads/Basic Web HTML CSS (5) (1) (1) (1) (1).zip', '2024-11-25 02:55:25', NULL, '2024-11-25 09:55:25', 'pendidikan matematika', NULL, NULL),
(170, 'FKIP', 'Swit Routing (2).zip', 'uploads/Swit Routing (2).zip', '2024-11-25 02:55:53', NULL, '2024-11-25 09:55:53', 'pendidikan bahasa inggris', NULL, NULL),
(171, 'FST', 'Basic Web HTML CSS (5) (1) (1) (1) (1).zip', 'uploads/Basic Web HTML CSS (5) (1) (1) (1) (1).zip', '2024-11-25 03:00:18', NULL, '2024-11-25 10:00:18', 'statistik', NULL, NULL),
(172, 'FE', 'Basic Web HTML CSS (5) (1) (1) (2) (1).zip', 'uploads/Basic Web HTML CSS (5) (1) (1) (2) (1).zip', '2024-11-25 03:56:15', NULL, '2024-11-25 10:56:15', 'akutansi', NULL, NULL),
(173, 'PAI', 'bg_buku (5) (1) (1) (1) (2) (2) (1) (1) (1).jpg', 'uploads/bg_buku (5) (1) (1) (1) (2) (2) (1) (1) (1).jpg', '2024-11-25 04:35:31', NULL, '2024-11-25 11:35:31', 'dakwah', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `fakultas_id` int(11) DEFAULT NULL,
  `nama_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan_files`
--

CREATE TABLE `jurusan_files` (
  `id` int(11) NOT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` datetime NOT NULL,
  `faculty` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `uploaded_files`
--

INSERT INTO `uploaded_files` (`id`, `file_name`, `file_type`, `file_path`, `uploaded_at`, `faculty`) VALUES
(1, '0069.zip', 'FE', 'upload/FE/0069.zip', '2024-10-30 11:17:26', NULL),
(70, 'Swit Routing (3).zip', 'application/x-zip-compressed', 'uploads/Swit Routing (3).zip', '2024-11-05 13:55:07', 'FE'),
(73, 'Quiz Etika Komputer ali.pdf', 'application/pdf', 'uploads/Quiz Etika Komputer ali.pdf', '2024-11-05 14:16:38', 'FE'),
(74, '', 'application/pdf', 'uploads/Quiz Etika Komputer ali.pdf', '2024-11-05 14:22:33', 'FE'),
(75, '', 'application/pdf', 'uploads/ilovepdf_merged (1) (1).pdf', '2024-11-05 15:08:17', 'FKIP'),
(76, '', 'application/pdf', 'uploads/ilovepdf_merged (1) (1).pdf', '2024-11-05 16:00:23', 'FKIP');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indeks untuk tabel `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`fakultas_id`);

--
-- Indeks untuk tabel `jurusan_files`
--
ALTER TABLE `jurusan_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indeks untuk tabel `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jurusan_files`
--
ALTER TABLE `jurusan_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`);

--
-- Ketidakleluasaan untuk tabel `jurusan_files`
--
ALTER TABLE `jurusan_files`
  ADD CONSTRAINT `jurusan_files_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
