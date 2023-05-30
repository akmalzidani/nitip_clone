-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2023 pada 11.34
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_tugas`
--

CREATE TABLE `detail_tugas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL DEFAULT '-',
  `nama_mhs` varchar(100) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `id_tugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_tugas`
--

INSERT INTO `detail_tugas` (`id`, `nama`, `ukuran`, `tipe`, `path`, `nilai`, `nama_mhs`, `deskripsi`, `id_tugas`) VALUES
(2, 'OjiSiji', '', '', 'cobaduludong', '-', '', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nrp` int(11) NOT NULL,
  `jenis_kelamin` set('Laki-laki','Perempuan') NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `asal_sma` varchar(30) NOT NULL,
  `matkul_fav` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nrp`, `jenis_kelamin`, `jurusan`, `email`, `alamat`, `no_hp`, `asal_sma`, `matkul_fav`) VALUES
(6, 'Akmal Zidani F', 123002, 'Perempuan', 'D3 Teknik Informatika', 'akmal@gmail.com', 'Jl. Kalibutuh 132-A Surabaya', '087703133145', 'SMA Negeri 2 Surabaya', 'Pemrograman Web1'),
(10, 'malz', 123003, 'Laki-laki', 'S23 Pro MAX', 'handarugans@gmail.com', 'Nggalek', '08123456789', 'SMA Negeri 2 Trenggalek', 'Matematika 1'),
(36, 'Omaga', 123004, 'Perempuan', 'D3 Teknik Informatika', 'akmal20031003@gmail.com', '123', '0123123123', 'SMA Negeri 2 Surabaya', 'Matematika 2'),
(38, 'Akmal', 0, 'Laki-laki', 'D3 Teknik Informatika', 'akmalzidani@it.student.pens.ac.id', 'Jl. Kalibutuh 132-A Surabaya', '0123123123', 'SMA Negeri 2 Surabaya', 'Pemrograman Web');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas_mhs`
--

CREATE TABLE `tugas_mhs` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama_matkul` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tugas_mhs`
--

INSERT INTO `tugas_mhs` (`id`, `nama`, `nama_matkul`, `desc`) VALUES
(7, 'Blablabla', 'Sistem Operasi', 'asdaskfasdj;jdasd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `nama`, `password`) VALUES
(6, 'Dosen', 'malz', 'Akmal Zidani Fikri', '$2y$10$V5yF46VrSFe36wJZeihOLu.UA9Z7Tfa/eIuXmVWvsgDcoIRSjY8NC'),
(7, 'Dosen', 'akmal', 'Akmal Zidani Fikri', '$2y$10$KIg.2W3ZyO4ex0rX.wTsheEY6N43/LDd2MsNDvQrrlUYpNk.Ytgte'),
(8, 'Mahasiswa', 'mhs', 'mahasiswa', '$2y$10$79OtW2LJQHhvQbfiVG7H3egvEbSKecETps3w9yB.7ZlXdsFGzACc2'),
(9, 'Dosen', 'fitrios', 'Fitri Setyorini', '$2y$10$Nz2rjbvJpskcydb78hJxGudoQb0uAql47ANbzvE5kQZCY2pQGuksS');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_tugas`
--
ALTER TABLE `detail_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tugas_mhs`
--
ALTER TABLE `tugas_mhs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_tugas`
--
ALTER TABLE `detail_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tugas_mhs`
--
ALTER TABLE `tugas_mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
