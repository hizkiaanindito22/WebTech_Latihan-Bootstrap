-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2026 at 09:27 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amanin_20236025_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `konten` longtext NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_publikasi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul_berita`, `konten`, `gambar`, `tanggal_publikasi`) VALUES
(2, 'AMANIN WEBSITE SIAP RILIS !', 'SURAKARTA – Industri jasa keamanan di Indonesia memasuki babak baru dengan diluncurkannya platform digital \"AMANIN\" pada hari ini, Selasa (5/5). Website ini hadir sebagai penyedia jasa keamanan terintegrasi yang mempertemukan kebutuhan pengamanan fisik dengan keunggulan teknologi terkini dalam satu pintu.\r\n\r\nPeluncuran AMANIN menjawab tantangan masyarakat dan pelaku usaha yang selama ini sering mengalami kesulitan dalam mengakses layanan keamanan yang kredibel dan transparan. Melalui platform ini, pengguna kini dapat memesan layanan personel pengamanan bersertifikat hingga instalasi sistem proteksi tingkat tinggi hanya melalui perangkat digital.\r\n\r\n\"AMANIN bukan sekadar penyedia jasa, melainkan mitra keamanan yang mengedepankan kemudahan akses dan akuntabilitas. Kami mengintegrasikan sistem pengawasan cerdas dengan kesiapsiagaan personel di lapangan,\" ujar manajemen AMANIN dalam keterangan resminya hari ini.\r\n\r\nBeberapa fitur unggulan yang ditawarkan melalui website AMANIN meliputi:\r\n\r\nPemesanan Personel Progresif: Kemudahan dalam mendatangkan satuan pengamanan (Satpam) atau pengawalan VIP yang telah melewati proses verifikasi ketat.\r\n\r\nIntegrasi Sistem Keamanan (IoT): Layanan instalasi perangkat keras seperti CCTV pintar, sensor gerak, hingga sistem alarm yang terkoneksi langsung ke dasbor pengguna.\r\n\r\nMonitoring Real-Time: Pengguna dapat memantau laporan aktivitas keamanan dan status aset secara langsung melalui website.\r\n\r\nRespon Darurat 24 Jam: Dukungan layanan bantuan yang siaga setiap saat untuk menangani situasi kritis.\r\n\r\nKehadiran platform ini diharapkan mampu meningkatkan standar industri keamanan di Indonesia, khususnya dalam hal efisiensi operasional. Dengan transparansi data dan kemudahan teknologi, AMANIN optimis dapat memberikan rasa aman yang lebih maksimal bagi masyarakat luas.\r\n\r\nBagi masyarakat yang ingin mengetahui lebih lanjut mengenai layanan ini, seluruh informasi dan paket pengamanan sudah dapat diakses mulai hari ini melalui laman resmi AMANIN.\r\n\r\nPenulis: Hizkia Anindito', 'berita1.jpg', '2026-05-05 07:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `kepuasan_client`
--

CREATE TABLE `kepuasan_client` (
  `id` int(11) NOT NULL,
  `skor_kepuasan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kepuasan_client`
--

INSERT INTO `kepuasan_client` (`id`, `skor_kepuasan`) VALUES
(1, 95);

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `waktu_kirim` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `email_address`, `pesan`, `waktu_kirim`) VALUES
(1, 'abc', 'abc@yahoo.com', 'abc123 atas098', '2026-05-05 03:15:31'),
(2, 'qwerty', 'qwerty@gmail.com', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\r\nBerikut adalah beberapa contoh perhitungan umum dalam berbagai bidang, mulai dari pajak hingga bisnis, berdasarkan data terkini:Perhitungan PPN 12% (Aturan 2025): Jika membeli laptop seharga Rp15.000.000, perhitungannya adalah 12% \\(\\times \\) (11/12 \\(\\times \\) Rp15.000.000), menghasilkan PPN sebesar Rp1.650.000.Perhitungan Biaya Listrik: Rumus dasarnya adalah (Daya Alat \\(\\times \\) Jam Pemakaian) / 1000 \\(\\times \\) Tarif PLN per kWh.Perhitungan Persentase Keuntungan: Menggunakan rumus \\(\\frac{\\text{Keuntungan}}{\\text{Harga Beli}} \\times 100\\%\\). Contoh: Beli Rp100.000, jual Rp120.000, untung 20%.Perhitungan Volume Cetakan: Volume = Luas Alas \\(\\times \\) Tinggi. Contoh: Luas alas \\(33,75 \\text{ cm}^2\\) \\(\\times \\) tinggi \\(2,5 \\text{ cm}\\) = \\(67,5 \\text{ cm}^3\\).Perhitungan PPh 21 (Pajak Karyawan): Menggunakan sistem Tarif Efektif Rata-rata (TER) pada penghasilan bruto bulanan, dengan penyesuaian di bulan Desember.', '2026-05-05 03:17:06'),
(3, 'abc', 'abc@yahoo.com', '09 Berikut adalah beberapa contoh perhitungan umum dalam berbagai bidang, mulai dari pajak hingga bisnis, berdasarkan data terkini:Perhitungan PPN 12% (Aturan 2025): Jika membeli laptop seharga Rp15.000.000, perhitungannya adalah 12% \\(\\times \\) (11/12 \\(\\times \\) Rp15.000.000), menghasilkan PPN sebesar Rp1.650.000.Perhitungan Biaya Listrik: Rumus dasarnya adalah (Daya Alat \\(\\times \\) Jam Pemakaian) / 1000 \\(\\times \\) Tarif PLN per kWh.Perhitungan Persentase Keuntungan: Menggunakan rumus \\(\\frac{\\text{Keuntungan}}{\\text{Harga Beli}} \\times 100\\%\\). Contoh: Beli Rp100.000, jual Rp120.000, untung 20%.Perhitungan Volume Cetakan: Volume = Luas Alas \\(\\times \\) Tinggi. Contoh: Luas alas \\(33,75 \\text{ cm}^2\\) \\(\\times \\) tinggi \\(2,5 \\text{ cm}\\) = \\(67,5 \\text{ cm}^3\\).Perhitungan PPh 21 (Pajak Karyawan): Menggunakan sistem Tarif Efektif Rata-rata (TER) pada penghasilan bruto bulanan, dengan penyesuaian di bulan Desember.', '2026-05-05 03:19:00'),
(4, 'abc', 'abc@yahoo.com', 'pasang\r\n', '2026-05-05 03:19:50'),
(5, 'abc', 'abc@yahoo.com', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', '2026-05-05 03:22:49'),
(6, 'abc', 'abc@yahoo.com', 'Berikut adalah beberapa contoh perhitungan umum dalam berbagai bidang, mulai dari pajak hingga bisnis, berdasarkan data terkini:Perhitungan PPN 12% (Aturan 2025): Jika membeli laptop seharga Rp15.000.000, perhitungannya adalah 12% \\(\\times \\) (11/12 \\(\\times \\) Rp15.000.000), menghasilkan PPN sebesar Rp1.650.000.Perhitungan Biaya Listrik: Rumus dasarnya adalah (Daya Alat \\(\\times \\) Jam Pemakaian) / 1000 \\(\\times \\) Tarif PLN per kWh.Perhitungan Persentase Keuntungan: Menggunakan rumus \\(\\frac{\\text{Keuntungan}}{\\text{Harga Beli}} \\times 100\\%\\). Contoh: Beli Rp100.000, jual Rp120.000, untung 20%.Perhitungan Volume Cetakan: Volume = Luas Alas \\(\\times \\) Tinggi. Contoh: Luas alas \\(33,75 \\text{ cm}^2\\) \\(\\times \\) tinggi \\(2,5 \\text{ cm}\\) = \\(67,5 \\text{ cm}^3\\).Perhitungan PPh 21 (Pajak Karyawan): Menggunakan sistem Tarif Efektif Rata-rata (TER) pada penghasilan bruto bulanan, dengan penyesuaian di bulan Desember.', '2026-05-05 03:23:07'),
(7, 'abc567', 'innabc@yahoo.com', 'Berikut adalah beberapa contoh perhitungan umum dalam berbagai bidang, mulai dari pajak hingga bisnis, berdasarkan data terkini:Perhitungan PPN 12% (Aturan 2025): Jika membeli laptop seharga Rp15.000.000, perhitungannya adalah 12% \\(\\times \\) (11/12 \\(\\times \\) Rp15.000.000), menghasilkan PPN sebesar Rp1.650.000.Perhitungan Biaya Listrik: Rumus dasarnya adalah (Daya Alat \\(\\times \\) Jam Pemakaian) / 1000 \\(\\times \\) Tarif PLN per kWh.Perhitungan Persentase Keuntungan: Menggunakan rumus \\(\\frac{\\text{Keuntungan}}{\\text{Harga Beli}} \\times 100\\%\\). Contoh: Beli Rp100.000, jual Rp120.000, untung 20%.Perhitungan Volume Cetakan: Volume = Luas Alas \\(\\times \\) Tinggi. Contoh: Luas alas \\(33,75 \\text{ cm}^2\\) \\(\\times \\) tinggi \\(2,5 \\text{ cm}\\) = \\(67,5 \\text{ cm}^3\\).Perhitungan PPh 21 (Pajak Karyawan): Menggunakan sistem Tarif Efektif Rata-rata (TER) pada penghasilan bruto bulanan, dengan penyesuaian di bulan Desember.', '2026-05-05 03:59:51'),
(8, 'abc567', 'innabc@yahoo.com', 'Berikut adalah beberapa contoh perhitungan umum dalam berbagai bidang, mulai dari pajak hingga bisnis, berdasarkan data terkini:Perhitungan PPN 12% (Aturan 2025): Jika membeli laptop seharga Rp15.000.000, perhitungannya adalah 12% \\(\\times \\) (11/12 \\(\\times \\) Rp15.000.000), menghasilkan PPN sebesar Rp1.650.000.Perhitungan Biaya Listrik: Rumus dasarnya adalah (Daya Alat \\(\\times \\) Jam Pemakaian) / 1000 \\(\\times \\) Tarif PLN per kWh.Perhitungan Persentase Keuntungan: Menggunakan rumus \\(\\frac{\\text{Keuntungan}}{\\text{Harga Beli}} \\times 100\\%\\). Contoh: Beli Rp100.000, jual Rp120.000, untung 20%.Perhitungan Volume Cetakan: Volume = Luas Alas \\(\\times \\) Tinggi. Contoh: Luas alas \\(33,75 \\text{ cm}^2\\) \\(\\times \\) tinggi \\(2,5 \\text{ cm}\\) = \\(67,5 \\text{ cm}^3\\).Perhitungan PPh 21 (Pajak Karyawan): Menggunakan sistem Tarif Efektif Rata-rata (TER) pada penghasilan bruto bulanan, dengan penyesuaian di bulan Desember.', '2026-05-05 04:21:38'),
(9, 'abc567', 'innabc@yahoo.com', 'cekn 2', '2026-05-05 07:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `nama_layanan`, `keterangan`) VALUES
(1, 'Pengawasan Keamanan', 'Pemantauan 24/7 dan tindakan pencegahan proaktif untuk perlindungan aset dan personel.'),
(2, 'Layanan Pengawalan', 'Pengawalan profesional untuk individu penting, aset berharga, atau transportasi logistik.'),
(3, 'Pusat Komando (CC)', 'Pusat operasi terpadu untuk koordinasi, manajemen insiden, dan respons darurat cepat');

-- --------------------------------------------------------

--
-- Table structure for table `waktu_respon`
--

CREATE TABLE `waktu_respon` (
  `id` int(11) NOT NULL,
  `skor_respon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `waktu_respon`
--

INSERT INTO `waktu_respon` (`id`, `skor_respon`) VALUES
(1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kepuasan_client`
--
ALTER TABLE `kepuasan_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waktu_respon`
--
ALTER TABLE `waktu_respon`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kepuasan_client`
--
ALTER TABLE `kepuasan_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `waktu_respon`
--
ALTER TABLE `waktu_respon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
