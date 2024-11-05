-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 04 Apr 2023 pada 15.24
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujian_online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(20) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`nip`, `nama_guru`, `no_telp`, `alamat`, `foto`) VALUES
('12321', 'Adi Wibisono', '9786876', '-', 'user.png'),
('12345', 'Yati Kurniati', '0', '-', 'user.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_essay`
--

CREATE TABLE `jawaban_essay` (
  `id` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `jawaban` text NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `kode_mapel` varchar(20) NOT NULL,
  `jenis_ujian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `join_kelas`
--

CREATE TABLE `join_kelas` (
  `kode_kelas` varchar(20) NOT NULL,
  `nis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `join_kelas`
--

INSERT INTO `join_kelas` (`kode_kelas`, `nis`) VALUES
('XTKJB', '280199');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(20) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`, `nip`) VALUES
('XTKJB', 'TEKNIK KOMPUTER & JARINGAN', '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `kode_mapel` varchar(20) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`kode_mapel`, `nama_mapel`) VALUES
('BENG', 'B.Inggris'),
('BINDO', 'B.Indonesia'),
('PENJAS', 'Penjaskes'),
('PC02', 'Merakit PC'),
('PENDAIS', 'Pend. Agama Islam'),
('seni', 'senibudaya'),
('TKJ01', 'Jaringan Komputer'),
('TKJ02', 'Sistem Nirkabel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `nama_materi` varchar(50) NOT NULL,
  `file` text NOT NULL,
  `kode_mapel` varchar(20) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `medsos`
--

CREATE TABLE `medsos` (
  `id` int(11) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `ig` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `yt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `medsos`
--

INSERT INTO `medsos` (`id`, `fb`, `ig`, `twitter`, `yt`) VALUES
(1, 'https://facebook.com', 'https://instagram.com', 'https://twitter.com', 'https://youtube.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mengajar`
--

CREATE TABLE `mengajar` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `kode_mapel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mengajar`
--

INSERT INTO `mengajar` (`id`, `nip`, `kode_kelas`, `kode_mapel`) VALUES
(39, '12321', 'XTKJB', 'BENG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mengerjakan`
--

CREATE TABLE `mengerjakan` (
  `id` int(11) NOT NULL,
  `kode_mapel` varchar(20) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `jam` int(11) NOT NULL,
  `menit` int(11) NOT NULL,
  `jenis_ujian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mengerjakan`
--

INSERT INTO `mengerjakan` (`id`, `kode_mapel`, `kode_kelas`, `tgl`, `jam`, `menit`, `jenis_ujian`) VALUES
(55, 'BENG', 'XTKJB', '2023-04-04', 1, 0, 'TKDCORE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `kode_mapel` varchar(20) NOT NULL,
  `jml_soal` int(11) NOT NULL,
  `jwb_benar` varchar(10) NOT NULL,
  `jwb_salah` varchar(10) NOT NULL,
  `jwb_kosong` varchar(10) NOT NULL,
  `skor` varchar(10) NOT NULL,
  `jenis_ujian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `nis`, `kode_kelas`, `kode_mapel`, `jml_soal`, `jwb_benar`, `jwb_salah`, `jwb_kosong`, `skor`, `jenis_ujian`) VALUES
(54, '280199', 'XTKJB', 'BENG', 2, '0', '2', '0', '0.0', 'TKDCORE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_essay`
--

CREATE TABLE `nilai_essay` (
  `id` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `kode_mapel` varchar(20) NOT NULL,
  `jenis_ujian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_essay`
--

INSERT INTO `nilai_essay` (`id`, `nis`, `kode_kelas`, `kode_mapel`, `jenis_ujian`) VALUES
(14, '123432', 'XTKJB', 'PC02', 'Kuis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `foto` text NOT NULL,
  `zona_waktu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_siswa`, `jk`, `no_telp`, `alamat`, `foto`, `zona_waktu`) VALUES
('1234567', 'Rinto', 'L', '085281618966', 'sgdyusds', 'user.png', ''),
('12345672323', 'Rintowewe', 'L', '275362753263', 'dssdsdsd', 'user.png', ''),
('280199', 'alex', 'L', '123456788901', 'sdsd', 'businessman.png', 'Asia/Makassar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `soal` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL,
  `knc_jawaban` varchar(10) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `kode_mapel` varchar(20) NOT NULL,
  `jenis_ujian` varchar(30) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id_soal`, `soal`, `a`, `b`, `c`, `d`, `e`, `knc_jawaban`, `kode_kelas`, `kode_mapel`, `jenis_ujian`, `foto`) VALUES
(151, '<p>sdsdsds</p>\r\n', '<p>sdsdsd</p>\r\n', '<p>sdsds</p>\r\n', '<p>sdsds</p>\r\n', '<p>sdsd</p>\r\n', '<p>sdsd</p>\r\n', 'b', 'XTKJB', 'BENG', 'TKDCORE', ''),
(152, '<p>fdfeddfe</p>\r\n', '<p>dfdfdfdf</p>\r\n', '<p>dfdfdfd</p>\r\n', '<p>dfdfdfdfd</p>\r\n', '<p>dfdfd</p>\r\n', '<p>dfdfdf</p>\r\n', 'e', 'XTKJB', 'BENG', 'TKDCORE', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_essay`
--

CREATE TABLE `soal_essay` (
  `id_soal` int(11) NOT NULL,
  `soal` text NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `kode_mapel` varchar(20) NOT NULL,
  `jenis_ujian` varchar(30) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `soal_essay`
--

INSERT INTO `soal_essay` (`id_soal`, `soal`, `kode_kelas`, `kode_mapel`, `jenis_ujian`, `foto`) VALUES
(17, '<p>dsdsdsdsdsds</p>\r\n', 'XTKJB', 'PC02', 'Kuis', ''),
(19, '<p>apakah yang disebut dengan bentuk al-jabar</p>\r\n', '7a1', 'mtk07', 'essay', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', 'yptkapin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `jawaban_essay`
--
ALTER TABLE `jawaban_essay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kelas` (`kode_kelas`),
  ADD KEY `kode_mapel` (`kode_mapel`);

--
-- Indeks untuk tabel `join_kelas`
--
ALTER TABLE `join_kelas`
  ADD KEY `kode_kelas` (`kode_kelas`),
  ADD KEY `nis` (`nis`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD KEY `nip` (`nip`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kode_mapel`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `kode_mapel` (`kode_mapel`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indeks untuk tabel `medsos`
--
ALTER TABLE `medsos`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mengajar_ibfk_1` (`nip`),
  ADD KEY `mengajar_ibfk_3` (`kode_mapel`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indeks untuk tabel `mengerjakan`
--
ALTER TABLE `mengerjakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kelas` (`kode_kelas`),
  ADD KEY `kode_mapel` (`kode_mapel`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nis`),
  ADD KEY `kode_kelas` (`kode_kelas`),
  ADD KEY `kode_mapel` (`kode_mapel`);

--
-- Indeks untuk tabel `nilai_essay`
--
ALTER TABLE `nilai_essay`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `kode_mapel` (`kode_mapel`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indeks untuk tabel `soal_essay`
--
ALTER TABLE `soal_essay`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jawaban_essay`
--
ALTER TABLE `jawaban_essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `medsos`
--
ALTER TABLE `medsos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mengajar`
--
ALTER TABLE `mengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `mengerjakan`
--
ALTER TABLE `mengerjakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `nilai_essay`
--
ALTER TABLE `nilai_essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT untuk tabel `soal_essay`
--
ALTER TABLE `soal_essay`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jawaban_essay`
--
ALTER TABLE `jawaban_essay`
  ADD CONSTRAINT `jawaban_essay_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `join_kelas`
--
ALTER TABLE `join_kelas`
  ADD CONSTRAINT `join_kelas_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `join_kelas_ibfk_3` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_ibfk_3` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mengajar`
--
ALTER TABLE `mengajar`
  ADD CONSTRAINT `mengajar_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mengajar_ibfk_3` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mengajar_ibfk_4` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mengerjakan`
--
ALTER TABLE `mengerjakan`
  ADD CONSTRAINT `mengerjakan_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mengerjakan_ibfk_2` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_4` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `soal_ibfk_2` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
