-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31 Mei 2016 pada 07.17
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_det_pembelian` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_det_pembelian`, `id_pembelian`, `id_obat`, `harga`) VALUES
(1, 145161132, 134162325, 1200),
(2, 145161132, 137161906, 1000),
(3, 145161132, 137161930, 1000),
(4, 145161123, 137161930, 1000),
(5, 145161139, 137161930, 1000),
(6, 145161113, 137161930, 5000),
(7, 145161113, 137161906, 6000),
(8, 145161259, 134162325, 3000),
(9, 145161249, 137161930, 1000),
(10, 145161249, 137161930, 1000),
(11, 145161226, 134162325, 1000),
(12, 145161226, 134162325, 1000),
(13, 145161202, 137161930, 1200),
(14, 145161233, 137161930, 1000),
(15, 145161233, 137161906, 2000),
(16, 146161729, 137161930, 1000),
(17, 149161143, 137161930, 1000),
(18, 149161322, 137161930, 1100),
(19, 149161324, 137161930, 1100),
(20, 150161525, 150161553, 1200),
(21, 150161712, 150161553, 1000),
(22, 150161700, 150161553, 0),
(23, 151161224, 150161553, 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_det_pemesanan` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `sub_jumlah_pemesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id_det_pemesanan`, `id_pemesanan`, `id_obat`, `sub_jumlah_pemesanan`) VALUES
(1, 145161132, 137161906, 10),
(2, 145161132, 137161930, 10),
(3, 145161132, 134162325, 10),
(4, 145161123, 137161930, 2),
(5, 145161139, 137161930, 2),
(6, 145161113, 137161930, 21),
(7, 145161113, 137161906, 21),
(8, 145161259, 134162325, 60),
(9, 145161249, 137161930, 20),
(10, 145161226, 134162325, 10),
(11, 145161202, 137161930, 10),
(12, 145161233, 137161930, 10),
(13, 145161233, 137161906, 10),
(14, 146161729, 137161930, 10),
(15, 149161143, 137161930, 20),
(16, 149161322, 137161930, 10),
(17, 149161324, 137161930, 10),
(18, 150161525, 150161553, 30),
(19, 150161712, 150161553, 11),
(20, 150161700, 150161553, 1),
(21, 151161224, 150161553, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_det_penjualan` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `sub_jumlah_penjualan` int(11) NOT NULL,
  `sub_harga_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_det_penjualan`, `id_penjualan`, `id_obat`, `sub_jumlah_penjualan`, `sub_harga_penjualan`) VALUES
(1, 145161149, 137161930, 21, 0),
(2, 145161203, 137161930, 11, 0),
(3, 145161230, 134162325, 80, 0),
(4, 145161210, 134162325, 20, 0),
(5, 146161722, 137161930, 10, 0),
(6, 146161731, 137161930, 10, 0),
(7, 149161312, 137161930, 10, 15000),
(8, 149161357, 137161930, 10, 15000),
(9, 150161515, 150161553, 20, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `id_stok` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `id_satuan`, `id_stok`, `harga_beli`, `harga_jual`) VALUES
(134162325, 'PARASETAMOL', 134161407, 134162325, 0, 0),
(137161906, 'PARAMEX', 134161407, 137161906, 0, 1000),
(137161930, 'DEXTRAL', 134161407, 137161930, 1100, 1500),
(150161553, 'ENERVONC+', 134161407, 150161553, 1000, 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tanggal_diterima`, `jumlah`, `id_pengguna`, `id_supplier`) VALUES
(145161113, '2016-04-25', 0, 123456, 134160832),
(145161123, '2016-05-25', 0, 123456, 134160822),
(145161132, '2016-05-25', 0, 123456, 134160832),
(145161139, '2016-05-25', 0, 123456, 134160822),
(145161202, '2016-05-25', 0, 123456, 134160822),
(145161226, '2016-05-25', 0, 123456, 134160822),
(145161233, '2016-05-25', 0, 123456, 134160822),
(145161249, '2016-05-25', 0, 123456, 134160822),
(145161259, '2016-05-25', 0, 123456, 134160822),
(146161729, '2016-05-26', 0, 123456, 134160822),
(149161143, '2016-05-29', 0, 123456, 134160822),
(149161322, '2016-05-29', 0, 123456, 134160822),
(149161324, '2016-05-29', 0, 123456, 134160822),
(150161525, '2016-05-30', 0, 123456, 134160822),
(150161700, '0000-00-00', 0, 0, 134160822),
(150161712, '2016-05-30', 0, 123456, 150161516),
(151161224, '2016-05-31', 1000, 123456, 150161516);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `status_pemesanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tanggal`, `jumlah`, `id_pengguna`, `id_supplier`, `status_pemesanan`) VALUES
(145161113, '2016-04-25', 42, 123456, 134160832, 'DITERIMA'),
(145161123, '2016-05-25', 2, 123456, 134160822, 'DITERIMA'),
(145161132, '2016-05-25', 30, 123456, 134160832, 'DITERIMA'),
(145161139, '2016-05-25', 2, 123456, 134160822, 'DITERIMA'),
(145161202, '2016-05-25', 10, 123456, 134160822, 'DITERIMA'),
(145161226, '2016-05-25', 10, 123456, 134160822, 'DITERIMA'),
(145161233, '2016-05-25', 20, 123456, 134160822, 'DITERIMA'),
(145161249, '2016-05-25', 20, 123456, 134160822, 'DITERIMA'),
(145161259, '2016-05-25', 60, 123456, 134160822, 'DITERIMA'),
(146161729, '2016-05-23', 10, 123456, 134160822, 'DITERIMA'),
(149161143, '2016-05-29', 20, 123456, 134160822, 'DITERIMA'),
(149161322, '2016-05-29', 10, 123456, 134160822, 'DITERIMA'),
(149161324, '2016-05-27', 10, 123456, 134160822, 'DITERIMA'),
(150161525, '2016-05-30', 30, 123456, 134160822, 'DITERIMA'),
(150161700, '2016-05-30', 1, 123456, 134160822, 'PENDING'),
(150161712, '2016-05-30', 11, 123456, 150161516, 'DITERIMA'),
(151161224, '2016-05-31', 10, 123456, 150161516, 'DITERIMA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status_pengguna` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `status_pengguna`) VALUES
(54321, 'Khusnan', 'user', 'YWRtaW4=', 'ADMIN'),
(123456, 'Jhonny', 'user', 'dXNlcg==', 'ASSAPOTEKER');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `total_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal_penjualan`, `jumlah`, `id_pengguna`, `total_penjualan`) VALUES
(145161149, '2016-04-25', 21, 123456, 0),
(145161203, '2016-05-25', 11, 123456, 0),
(145161210, '2016-05-25', 20, 123456, 0),
(145161230, '2016-05-25', 80, 123456, 0),
(146161722, '2016-05-26', 10, 123456, 0),
(146161731, '2016-05-26', 10, 123456, 0),
(149161312, '2016-05-29', 10, 123456, 15000),
(149161357, '2016-05-29', 10, 123456, 15000),
(150161515, '2016-05-30', 20, 123456, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(134161407, 'BOTOL'),
(138161152, 'STRIP'),
(150161520, 'TABLET');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `rop` int(11) NOT NULL,
  `eoq` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `used` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`id_stok`, `jumlah_stok`, `rop`, `eoq`, `lead_time`, `used`) VALUES
(134162325, 100, 2, 0, 0, 80),
(137161906, 210, 2, 0, 0, 0),
(137161930, 330, 146, 0, 2, 72),
(150161553, 82, 2, 0, 0, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
(134160822, 'PUSAKA INDAH', 'coba alamat', '14045 - kantor'),
(134160832, 'KIMIAFARMA', 'Rungkut industri no. 45\r\nsurabaya, jawa timur', '088 7777 1234'),
(134160846, 'SUPPLIER OBAT', 'coba\r\ntulis\r\nalamat', '123 (xl)\r\n321 (simpati)'),
(150161516, 'GALIHOS', 'Jl. Galihos', '089788987890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_det_pembelian`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id_det_pemesanan`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_det_penjualan`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
