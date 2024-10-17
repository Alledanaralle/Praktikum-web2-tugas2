-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Okt 2024 pada 04.14
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan_izin`
--

CREATE TABLE `permohonan_izin` (
  `izin_id` int(11) NOT NULL,
  `nama_dsn` varchar(255) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `pangkat_jabatan` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `dosen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permohonan_izin`
--

INSERT INTO `permohonan_izin` (`izin_id`, `nama_dsn`, `nip`, `pangkat_jabatan`, `jabatan`, `unit_kerja`, `dosen_id`) VALUES
(1, 'Alledanaralle', '230202056', 'Tinggi', 'Kajur', 'Unit 1', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_tugas`
--

CREATE TABLE `surat_tugas` (
  `surat_tugas_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `nama_dsn` varchar(255) NOT NULL,
  `tgl_surat_tugas` date NOT NULL,
  `transportasi` varchar(50) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_tugas`
--

INSERT INTO `surat_tugas` (`surat_tugas_id`, `dosen_id`, `nomor`, `nama_dsn`, `tgl_surat_tugas`, `transportasi`, `keperluan`, `tujuan`) VALUES
(1, 1, '230202056', 'Alledanaralle', '2024-10-16', 'Helikopter', 'Makan Nasgor', 'Dinner'),
(2, 20, '230202056', 'Allegemink', '2024-10-16', 'Sepeda', 'Ke kampus', 'kuliah');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `permohonan_izin`
--
ALTER TABLE `permohonan_izin`
  ADD PRIMARY KEY (`izin_id`);

--
-- Indeks untuk tabel `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD PRIMARY KEY (`surat_tugas_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `permohonan_izin`
--
ALTER TABLE `permohonan_izin`
  MODIFY `izin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_tugas`
--
ALTER TABLE `surat_tugas`
  MODIFY `surat_tugas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
