-- Database: crud_mahasiswa
-- Buat database terlebih dahulu dengan perintah:
-- CREATE DATABASE crud_mahasiswa;

USE crud_mahasiswa;

-- Struktur tabel untuk tabel `mahasiswa`
CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nim` (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data contoh untuk tabel `mahasiswa`
INSERT INTO `mahasiswa` (`nama`, `nim`, `tanggal_lahir`, `alamat`) VALUES
('Ahmad Rizki Pratama', '2021001001', '2002-05-15', 'Jl. Merdeka No. 123, Jakarta Pusat'),
('Siti Nurhaliza', '2021001002', '2001-08-22', 'Jl. Sudirman No. 456, Bandung'),
('Muhammad Fadli', '2021001003', '2002-12-10', 'Jl. Diponegoro No. 789, Surabaya');