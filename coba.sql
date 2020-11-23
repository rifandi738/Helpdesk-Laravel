-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Sep 2020 pada 20.36
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coba`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aplikasi`
--

CREATE TABLE `tbl_aplikasi` (
  `id` int(11) NOT NULL,
  `nama_aplikasi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_aplikasi`
--

INSERT INTO `tbl_aplikasi` (`id`, `nama_aplikasi`) VALUES
(1, 'Aplikasi Fidi Profile'),
(3, 'Aplikasi Smart Hospital'),
(5, 'Aplikasi Travel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_divisi`
--

CREATE TABLE `tbl_divisi` (
  `id` int(11) NOT NULL,
  `kode_divisi` char(10) NOT NULL,
  `nama_divisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_divisi`
--

INSERT INTO `tbl_divisi` (`id`, `kode_divisi`, `nama_divisi`) VALUES
(1, 'A2', 'Divisi Production'),
(2, 'A0101', 'Product Owner');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id` int(11) NOT NULL,
  `kode_jabatan` char(10) NOT NULL,
  `nama_jabatan` varchar(20) DEFAULT NULL,
  `divisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`id`, `kode_jabatan`, `nama_jabatan`, `divisi_id`) VALUES
(1, 'A123', 'Manager', 1),
(2, 'AA', 'Staff', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_klien`
--

CREATE TABLE `tbl_klien` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(45) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_klien`
--

INSERT INTO `tbl_klien` (`id`, `nama_perusahaan`, `email`, `no_telpon`, `alamat`, `created_at`, `updated_at`, `user_id`) VALUES
(4, 'PT Sukses', 'sukses@gmail.co.id', '0219823443', 'Jl Bintaro Boulevard', '2020-08-18 02:37:17', '2020-08-18', 7),
(17, 'PT Maju Terus', 'majuterus@gmail.com', '0219823443', 'Greenlake City', '2020-09-30 18:31:32', '2020-09-30', 26),
(18, 'PT Fidi IT Kreatif', 'fidi@gmail.com', '089695667809', 'Peninggilan', '2020-09-30 18:32:19', '2020-09-30', 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_level`
--

CREATE TABLE `tbl_level` (
  `id` int(11) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_level`
--

INSERT INTO `tbl_level` (`id`, `level`) VALUES
(1, 'Super Admin'),
(2, 'Admin Helpdesk'),
(3, 'Production'),
(4, 'Klien');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_modul_aplikasi`
--

CREATE TABLE `tbl_modul_aplikasi` (
  `id` int(11) NOT NULL,
  `nama_modul` varchar(45) NOT NULL,
  `aplikasi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_modul_aplikasi`
--

INSERT INTO `tbl_modul_aplikasi` (`id`, `nama_modul`, `aplikasi_id`) VALUES
(2, 'Fitur Chat', 1),
(3, 'Fitur Upload Gambar', 1),
(5, 'Fitur Antrian', 3),
(8, 'Fitur Pemesanan', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_operator`
--

CREATE TABLE `tbl_operator` (
  `id` int(11) NOT NULL,
  `nama_operator` varchar(45) NOT NULL,
  `klien_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_operator`
--

INSERT INTO `tbl_operator` (`id`, `nama_operator`, `klien_id`) VALUES
(4, 'Frangky', 4),
(17, 'Tukinim', 17),
(18, 'Steven', 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id` int(11) NOT NULL,
  `nama_pegawai` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `no_handphone` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `divisi_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id`, `nama_pegawai`, `email`, `no_handphone`, `created_at`, `updated_at`, `divisi_id`, `jabatan_id`, `user_id`) VALUES
(1, 'Ahmad Rifandi', 'rifandi738@gmail.com', '089696558453', '2020-07-08 00:00:00', NULL, 1, 1, 2),
(2, 'Rifandi', 'rifandi@gmail.com', '089675646657', '2020-08-16 21:37:46', '2020-08-27 12:59:17', 1, 1, 5),
(3, 'Ndipati', 'adminlarashop@gmail.com', '089675646656', '2020-08-16 21:38:14', '2020-08-16 21:38:14', 1, 2, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengaduan`
--

CREATE TABLE `tbl_pengaduan` (
  `id` int(11) NOT NULL,
  `tanggal_pengaduan` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `keterangan` longtext NOT NULL,
  `klien_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `aplikasi_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modul_aplikasi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_pengaduan`
--

INSERT INTO `tbl_pengaduan` (`id`, `tanggal_pengaduan`, `image`, `keterangan`, `klien_id`, `status_id`, `aplikasi_id`, `created_at`, `updated_at`, `modul_aplikasi_id`) VALUES
(145, '2020-10-02', '20200921084442.png', '<p>Test</p>', 4, 2, 3, '2020-09-23 12:33:12', '2020-09-30 10:51:21', 5),
(155, '2020-09-25', '20200925041543.png', '<p>Testing</p>', 4, 1, 3, '2020-09-24 21:15:43', '2020-09-30 10:51:35', 5),
(156, '2020-09-27', '20200927012829.png', '<p>Test</p>', 4, 4, 5, '2020-09-26 18:28:29', '2020-09-30 11:08:09', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id` int(11) NOT NULL,
  `nama_status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `nama_status`) VALUES
(1, 'Open Ticket'),
(2, 'Wait'),
(3, 'Proses'),
(4, 'Close');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(191) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `level_id`) VALUES
(2, 'rifandi738@gmail.com', '$2y$10$/L9Xt5WKcYK.p0Nr8/HvwuM7Rm0wWBkCSSh0EyBNVXQ/L2pyU4Jti', 1),
(5, 'rifandi@gmail.com', '$2y$10$LC4YFEyrYtO0Hl2HAqBfCe45FJU4WSagZ88yYQ4KVF1JLV6yRfAIO', 2),
(6, 'adminlarashop@gmail.com', '$2y$10$COVE4QqNpyvoIEUR7gllgeB3IVHwV8w3Hpu9nDMSJrRpJHT2eF.TW', 3),
(7, 'sukses@gmail.co.id', '$2y$10$4GkQ.UDlLhzEV8Lx0kxaFedNvXlgIOKQlJXQxSF5YudJc5VM7xb0S', 4),
(26, 'majuterus@gmail.com', '$2y$10$i7gV.PNtv0YHcc8xC4CZCO2scismtIabGBGGgvMj9n3joS/lPs./2', 4),
(27, 'fidi@gmail.com', '$2y$10$tRY7ms6G2vsYuN7ws0LbVO0HNlIokgD2ZH7tPMPHQbLnoVXqT.jxu', 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_aplikasi`
--
ALTER TABLE `tbl_aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_divisi_UNIQUE` (`kode_divisi`);

--
-- Indeks untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_jabatan_UNIQUE` (`kode_jabatan`),
  ADD KEY `fk_tbl_jabatan_tbl_divisi1_idx` (`divisi_id`);

--
-- Indeks untuk tabel `tbl_klien`
--
ALTER TABLE `tbl_klien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_tbl_klien_tbl_user1_idx` (`user_id`);

--
-- Indeks untuk tabel `tbl_level`
--
ALTER TABLE `tbl_level`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_modul_aplikasi`
--
ALTER TABLE `tbl_modul_aplikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_modul_aplikasi_tbl_aplikasi1_idx` (`aplikasi_id`);

--
-- Indeks untuk tabel `tbl_operator`
--
ALTER TABLE `tbl_operator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_operator_tbl_klien1_idx` (`klien_id`);

--
-- Indeks untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_tbl_pegawai_tbl_divisi1_idx` (`divisi_id`),
  ADD KEY `fk_tbl_pegawai_tbl_jabatan1_idx` (`jabatan_id`),
  ADD KEY `fk_tbl_pegawai_tbl_user1_idx` (`user_id`);

--
-- Indeks untuk tabel `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_pengaduan_tbl_klien1_idx` (`klien_id`),
  ADD KEY `fk_tbl_pengaduan_tbl_status1_idx` (`status_id`),
  ADD KEY `fk_tbl_pengaduan_tbl_kategori1_idx` (`aplikasi_id`),
  ADD KEY `fk_tbl_pengaduan_tbl_modul_aplikasi1_idx` (`modul_aplikasi_id`);

--
-- Indeks untuk tabel `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `fk_tbl_user_tbl_level1_idx` (`level_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_aplikasi`
--
ALTER TABLE `tbl_aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_klien`
--
ALTER TABLE `tbl_klien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_level`
--
ALTER TABLE `tbl_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_modul_aplikasi`
--
ALTER TABLE `tbl_modul_aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_operator`
--
ALTER TABLE `tbl_operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD CONSTRAINT `fk_tbl_jabatan_tbl_divisi1` FOREIGN KEY (`divisi_id`) REFERENCES `tbl_divisi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_klien`
--
ALTER TABLE `tbl_klien`
  ADD CONSTRAINT `fk_tbl_klien_tbl_user1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_modul_aplikasi`
--
ALTER TABLE `tbl_modul_aplikasi`
  ADD CONSTRAINT `fk_tbl_modul_aplikasi_tbl_aplikasi1` FOREIGN KEY (`aplikasi_id`) REFERENCES `tbl_aplikasi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_operator`
--
ALTER TABLE `tbl_operator`
  ADD CONSTRAINT `fk_tbl_operator_tbl_klien1` FOREIGN KEY (`klien_id`) REFERENCES `tbl_klien` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD CONSTRAINT `fk_tbl_pegawai_tbl_divisi1` FOREIGN KEY (`divisi_id`) REFERENCES `tbl_divisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tbl_pegawai_tbl_jabatan1` FOREIGN KEY (`jabatan_id`) REFERENCES `tbl_jabatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tbl_pegawai_tbl_user1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  ADD CONSTRAINT `fk_tbl_pengaduan_tbl_kategori1` FOREIGN KEY (`aplikasi_id`) REFERENCES `tbl_aplikasi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tbl_pengaduan_tbl_klien1` FOREIGN KEY (`klien_id`) REFERENCES `tbl_klien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tbl_pengaduan_tbl_modul_aplikasi1` FOREIGN KEY (`modul_aplikasi_id`) REFERENCES `tbl_modul_aplikasi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tbl_pengaduan_tbl_status1` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `fk_tbl_user_tbl_level1` FOREIGN KEY (`level_id`) REFERENCES `tbl_level` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
