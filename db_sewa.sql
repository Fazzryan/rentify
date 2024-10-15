-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Sep 2024 pada 05.33
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
-- Database: `db_sewa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Samsung', 'samsung', 'brandimg-433405864.png', '2024-08-17 16:41:04', '2024-08-17 16:41:04'),
(2, 'Asus', 'asus', 'brandimg-1845645309.png', '2024-08-17 16:41:13', '2024-08-30 16:02:52'),
(3, 'Huawei', 'huawei', 'brandimg-1819829972.png', '2024-08-17 16:50:12', '2024-08-30 16:14:09'),
(4, 'Xiaomi', 'xiaomi', 'brandimg-228568311.png', '2024-08-17 17:55:35', '2024-08-17 17:55:35'),
(5, 'Canon', 'canon', 'brandimg-273096251.png', '2024-08-30 16:03:14', '2024-08-30 16:03:14'),
(6, 'Sony', 'sony', 'brandimg-668788085.png', '2024-08-30 16:03:27', '2024-08-30 16:03:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `brandscategories`
--

CREATE TABLE `brandscategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `brandscategories`
--

INSERT INTO `brandscategories` (`id`, `category_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-08-17 16:41:28', '2024-08-17 16:41:28'),
(2, 2, 2, '2024-08-17 16:41:35', '2024-08-17 16:41:35'),
(3, 1, 3, '2024-08-17 16:50:24', '2024-08-17 16:50:24'),
(6, 2, 3, '2024-08-30 16:05:42', '2024-08-30 16:05:42'),
(7, 4, 1, '2024-08-30 16:05:54', '2024-08-30 16:05:54'),
(8, 4, 5, '2024-08-30 16:06:04', '2024-08-30 16:06:04'),
(9, 1, 4, '2024-08-30 16:06:36', '2024-08-30 16:06:36'),
(10, 4, 6, '2024-08-30 16:08:31', '2024-08-30 16:08:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Phone', 'phone', 'categoryimg-512900851.png', '2024-08-17 16:40:15', '2024-09-02 07:41:09'),
(2, 'Laptop', 'laptop', 'categoryimg-1430543267.png', '2024-08-17 16:40:20', '2024-09-02 07:41:18'),
(3, 'Headset', 'headset', 'categoryimg-469392443.png', '2024-08-20 07:40:16', '2024-09-02 07:41:28'),
(4, 'Camera', 'camera', 'categoryimg-381259876.png', '2024-08-30 16:04:16', '2024-09-02 07:41:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `category_id`, `brand_id`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(2, 'Samsung Galaxy S24', 'samsung-galaxy-s24', '<p><i>Refresh rate</i> yang lebih adaptif ini nantinya akan berpengaruh pada ketahanan dayanya. Sebab, makin rendah <i>refresh rate</i> maka makin sedikit juga daya baterai yang digunakan. Bahkan, saat dalam mode <i>Always-on</i>, <i>refresh rate</i>-nya berada di angka 24 Hz sebagai angka <i>refresh </i>paling rendah untuk Android.</p>', 1, 1, 130000, 5, '2024-08-18 02:46:52', '2024-09-03 15:02:19'),
(5, 'Samsung Galaxy S23', 'samsung-galaxy-s23', '<p><i>Refresh rate</i> yang lebih adaptif ini nantinya akan berpengaruh pada ketahanan dayanya. Sebab, makin rendah <i>refresh rate</i> maka makin sedikit juga daya baterai yang digunakan. Bahkan, saat dalam mode <i>Always-on</i>, <i>refresh rate</i>-nya berada di angka 24 Hz sebagai angka <i>refresh </i>paling rendah untuk Android.</p>', 1, 1, 150000, 4, '2024-08-18 08:08:54', '2024-08-26 15:59:43'),
(6, 'Huawei P50', 'huawei-p50', '<p>Huawei P50 Pro merupakan smartphone terbaru dari Huawei yang memiliki varian RAM 8 GB dan 12 GB hadir dalam tiga pilihan penyimpanan berkapasitas besar yaitu 128 GB, 256 GB dan 512 GB. Desain smartphone yang menarik dengan empat pilihan warna yaitu Golden Black, Cocoa Gold, Pearl White dan Charm Pink membuat smartphone ini akan semakin digemari oleh banyak orang. Untuk layar smartphone Huawei P50 Pro menggunakan layar OLED dengan di dukung refresh rate 120Hz dan display sebesar 6.6 inci dengan resolusi 1228 x 2700 pixels.</p>', 1, 3, 6000000, 1, '2024-08-26 07:46:39', '2024-08-30 15:57:28'),
(7, 'Asus Tuf Gaming F15', 'asus-tuf-gaming-f15', '<ul><li>12th Gen Intel® Core™ i5-12500H Processor</li><li>NVIDIA®&nbsp;GeForce&nbsp;RTX™&nbsp;3050&nbsp;Laptop&nbsp;GPU</li><li>8GB D4</li><li>512GB G3</li><li>Windows 11 Home</li></ul>', 2, 2, 300000, 3, '2024-08-30 16:51:35', '2024-08-30 16:51:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `productsimages`
--

CREATE TABLE `productsimages` (
  `id` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `productsimages`
--

INSERT INTO `productsimages` (`id`, `image_name`, `product_id`, `created_at`, `updated_at`) VALUES
(20, 'productimg-69617173.jpg', 6, '2024-08-26 07:46:39', '2024-08-26 07:46:39'),
(21, 'productimg-641996037.jpg', 2, '2024-08-27 06:07:36', '2024-08-27 06:07:36'),
(22, 'productimg-1573870824.jpg', 2, '2024-08-27 06:07:36', '2024-08-27 06:07:36'),
(23, 'productimg-202759032.jpg', 2, '2024-08-27 06:07:36', '2024-08-27 06:07:36'),
(24, 'productimg-1269001675.jpg', 5, '2024-08-27 06:17:47', '2024-08-27 06:17:47'),
(25, 'productimg-1740349192.jpg', 5, '2024-08-27 06:17:47', '2024-08-27 06:17:47'),
(26, 'productimg-168155072.jpg', 5, '2024-08-27 06:17:47', '2024-08-27 06:17:47'),
(27, 'productimg-671535414.jpg', 7, '2024-08-30 16:51:35', '2024-08-30 16:51:35'),
(28, 'productimg-143904900.jpg', 7, '2024-08-30 16:51:35', '2024-08-30 16:51:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stores`
--

INSERT INTO `stores` (`id`, `name`, `slug`, `address`, `is_open`, `created_at`, `updated_at`) VALUES
(1, 'Ps Store Batam', 'ps-store-batam', 'Batam', 1, '2024-08-15 14:46:38', '2024-08-15 14:46:38'),
(2, 'Ps Store Makasar', 'ps-store-makasar', 'Makasar', 1, '2024-08-15 14:47:16', '2024-09-05 16:16:38'),
(3, 'Jaya Cell', 'jaya-cell', 'Ciamis', 0, '2024-08-15 14:47:16', '2024-08-15 15:53:26'),
(5, 'Jaya Cell Tasikmalaya', 'jaya-cell-tasikmalaya', 'Tasikmalaya', 1, '2024-08-16 10:01:55', '2024-08-16 10:01:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trx_id` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT '''-''',
  `total_amount` int(11) NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `proof` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `delivery_type` varchar(255) NOT NULL DEFAULT 'pickup store',
  `transaction_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `name`, `user_id`, `trx_id`, `phone_number`, `address`, `total_amount`, `is_paid`, `proof`, `product_id`, `store_id`, `duration`, `start_at`, `end_at`, `delivery_type`, `transaction_date`, `created_at`, `updated_at`) VALUES
(11, 'Mayasari', 3, 'RNT-20240829844', '123', 'maleber', 150000, 1, 'proofimg-2086448055.png', 5, 1, 1, '2024-08-29', '2024-08-29', 'pickupstore', '2024-08-29', '2024-08-29 07:25:46', '2024-09-05 16:54:12'),
(12, 'Dinda Fazryan', 1, 'RNT-20240829121', '087731137537', 'Perumahan Indah No. 10', 130000, 1, 'proofimg-189234825.png', 2, 5, 1, '2024-08-29', '2024-08-30', 'pickupstore', '2024-08-29', '2024-08-29 13:18:21', '2024-09-05 16:54:38'),
(13, 'Dinda Fazryan', 1, 'RNT-20240905416', '087731137537', 'ciamis', 150000, 1, 'proofimg-884211829.png', 5, 5, 1, '2024-09-05', '2024-09-06', 'pickupstore', '2024-09-05', '2024-09-05 16:58:19', '2024-09-10 07:49:17'),
(14, 'Zidan', 5, 'RNT-20240910998', '087731137537', 'Tasikmalaya', 600000, 1, 'proofimg-261506138.png', 7, 5, 2, '2024-09-10', '2024-09-11', 'address', '2024-09-10', '2024-09-10 08:31:14', '2024-09-10 14:24:08'),
(15, 'Zidan', 5, 'RNT-20240910409', '085223424817', 'Batam', 900000, 1, 'proofimg-1930200649.jpeg', 7, 1, 3, '2024-09-10', '2024-09-13', 'address', '2024-09-10', '2024-09-10 08:36:42', '2024-09-10 14:24:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` enum('user','admin','owner') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `pass`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Dinda Fazryan', 'dinda@gmail.com', '594280c6ddc94399a392934cac9d80d5', 'dinda', 'owner', '2024-08-15 13:54:57', '2024-09-05 16:20:17'),
(3, 'Mayasari', 'maya@gmail.com', '871f8d97dac6f1c4612c6cb94128468a', 'mayasari', 'admin', '2024-08-18 16:20:48', '2024-09-05 05:37:57'),
(4, 'Dewi', 'dewi@gmail.com', 'fde0b737496c53bb85d07b31a02985a3', 'dewi123', 'user', '2024-09-04 15:37:56', '2024-09-05 14:28:30'),
(5, 'Zidan', 'zidan@gmail.com', '5f90220cd83974db4165c20540a2ea4a', 'zidan123', 'user', '2024-09-04 15:38:33', '2024-09-05 14:28:35'),
(6, 'Sukma Eka', 'sukma@gmail.com', 'fcfce9432eb70d62ea41d979f1576b00', 'sukma', 'admin', '2024-09-06 06:42:23', '2024-09-06 06:42:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `brandscategories`
--
ALTER TABLE `brandscategories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `productsimages`
--
ALTER TABLE `productsimages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `brandscategories`
--
ALTER TABLE `brandscategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `productsimages`
--
ALTER TABLE `productsimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
