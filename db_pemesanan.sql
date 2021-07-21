-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jul 2021 pada 18.20
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pemesanan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name`, `company`, `phone_number`, `address`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Rizky Alkusaeri', 'Adipati Satya Raharja', '0808212112', 'Jl sekeloa utara no.222, Jl plta saguling no 384', 2, '2021-06-02 20:56:51', '2021-06-02 20:56:51'),
(2, 'aku', 'Adipati Satya Raharja', '12123232312', 'Jl sekeloa utara no.222, Jl plta saguling no 384', 6, '2021-06-06 02:59:13', '2021-06-06 02:59:13'),
(3, 'aku', 'Adipati Satya Raharja', '12123232312', 'Jl sekeloa utara no.222, Jl plta saguling no 384', 7, '2021-06-06 03:01:01', '2021-06-06 03:01:01'),
(4, 'aku', 'Adipati Satya Raharja', '121212', 'Jl sekeloa utara no.222, Jl plta saguling no 384', 8, '2021-06-06 03:04:16', '2021-06-06 03:04:16'),
(5, 'aku', 'Adipati Satya Raharja', '21121212', 'Jl sekeloa utara no.222, Jl plta saguling no 384', 9, '2021-06-06 03:11:55', '2021-06-06 03:11:55'),
(6, 'Joni', 'Haka Foto', '212132312', 'Jl sekeloa utara no.222, Jl plta saguling no 384', 10, '2021-06-07 19:08:15', '2021-06-07 19:08:15'),
(7, 'asas', 'asasasa', '12121212', 'asasasa', 12, '2021-07-20 08:07:08', '2021-07-20 08:07:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_jalan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `deliveries`
--

INSERT INTO `deliveries` (`id`, `faktur`, `surat_jalan`, `order_id`, `created_at`, `updated_at`) VALUES
(1, '1623027667faktur.pdf', '1623027667surat.pdf', 5, '2021-06-06 18:01:07', '2021-06-06 18:01:07'),
(2, '1623118689faktur.pdf', '1623118689surat.pdf', 6, '2021-06-07 19:18:09', '2021-06-07 19:18:09'),
(3, '1626224382faktur.pdf', '1626224382surat.pdf', 7, '2021-07-13 17:59:42', '2021-07-13 17:59:42'),
(4, '1626792261faktur.pdf', '1626792261surat.pdf', 10, '2021-07-20 07:44:21', '2021-07-20 07:44:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `evidence`
--

CREATE TABLE `evidence` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `evidence`
--

INSERT INTO `evidence` (`id`, `bukti`, `order_id`, `created_at`, `updated_at`) VALUES
(2, '16229846345bukti.jpg', 5, '2021-06-06 06:03:54', '2021-06-06 06:03:54'),
(3, '16231186106bukti.jpg', 6, '2021-06-07 19:16:50', '2021-06-07 19:16:50'),
(4, '16262242967bukti.png', 7, '2021-07-13 17:58:16', '2021-07-13 17:58:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `invoices`
--

INSERT INTO `invoices` (`id`, `file`, `order_id`, `created_at`, `updated_at`) VALUES
(2, '162298448016229844065.pdf.pdf', 5, '2021-06-06 06:01:20', '2021-06-06 06:01:20'),
(3, '162311851816231183516.pdf.pdf', 6, '2021-06-07 19:15:18', '2021-06-07 19:15:18'),
(4, '162622420116262230217.pdf.pdf', 7, '2021-07-13 17:56:41', '2021-07-13 17:56:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_03_022823_create_customers_table', 1),
(5, '2021_06_03_022848_create_orders_table', 1),
(6, '2021_06_03_023012_create_purchases_table', 1),
(7, '2021_06_03_023024_create_invoices_table', 1),
(8, '2021_06_03_023111_create_deliveries_table', 1),
(9, '2021_06_03_030223_add_role_to_user_table', 2),
(10, '2021_06_03_040925_add_status_to_orders_table', 3),
(11, '2021_06_04_014407_add_job_to_table_order', 4),
(12, '2021_06_04_122817_add_status_produksi_to_orders_table', 5),
(13, '2021_06_04_123742_add_bukti_to_invoices_table', 6),
(14, '2021_06_04_130336_add_surat_jalan_to_deliveries_table', 7),
(15, '2021_06_06_080831_create_evidence_table', 8),
(16, '2021_07_19_033449_create_products_table', 9),
(17, '2021_07_19_033839_create_materials_table', 9),
(18, '2021_07_19_042226_create_order_details_table', 9),
(19, '2021_07_19_042925_add_relationship_to_orders_table', 10),
(20, '2021_07_19_043033_add_relationship_to_orders_details_table', 10),
(21, '2021_07_19_080055_add_size_to_products_table', 11),
(22, '2021_07_19_114612_add_note_to_orders_table', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `selesai` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `invoice`, `total`, `status`, `selesai`, `bukti`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(10, 'INV-1', 184000, 5, '2021-07-26', '1626769782INV-1.png', 'asasas', 2, '2021-07-20 01:09:52', '2021-07-20 07:59:34'),
(11, 'INV-2', 36000, 3, '2021-07-28', '1626796655INV-2.png', 'asasasasasa', 2, '2021-07-20 08:48:27', '2021-07-20 09:03:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `purchases`
--

INSERT INTO `purchases` (`id`, `file`, `order_id`, `created_at`, `updated_at`) VALUES
(3, '162622415416262230217.pdf.pdf', 7, '2021-07-13 17:55:54', '2021-07-13 17:55:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '2021-06-06 09:54:51', '$2y$10$vUNMtJ7ccJPNqygrl5TMWOtRtGPHVwZVaTzZ6OnnYFtuSjUzlWwRK', NULL, NULL, NULL, 'admin'),
(2, 'Rizky Alkusaeri', 'rizkyalkus12@gmail.com', '2021-07-12 10:39:44', '$2y$10$/C9j2LZv6ph9PCDSdWy1/u66f1UlmUA5j3o7JEeO6B5rCogsgl9Qm', NULL, '2021-06-02 20:56:51', '2021-06-02 20:56:51', 'customer'),
(9, 'aku', 'alkusaery@gmail.com', '2021-06-06 05:38:45', '$2y$10$CYohsD1RIZUVH.w01OZ1aumXgA5Oh./wJ.bEHgIAsz6G0pl77xlT6', 'elZLHLzvkLuOahMLLD4b6KNU79EAW2CS7MmNbpyU4vwSPgkSYsA2N2Dtr8xH', '2021-06-06 03:11:54', '2021-06-06 18:30:01', 'customer'),
(10, 'Joni', 'joni@gmail.com', '2021-06-07 19:08:43', '$2y$10$2.ziTn87qFCgU6XgNSjQfujMH5C2blhxd2xRuBXH678/FREnN4Z7.', 'sIjbIurXQ8BFi55v1KteefEhN5ptTe9B2UiC96iU4hfwuuz1s8ZRTZhnH6ro', '2021-06-07 19:08:15', '2021-06-07 19:23:17', 'customer'),
(11, 'hai', 'hai@gmail.com', '2021-07-20 15:09:44', '$2y$10$oTKLFH7syJgtt3KgfIg4SO/ELozs6adYNsO/9ilYukrb89lgijP32', NULL, '2021-07-20 08:06:16', '2021-07-20 08:06:16', 'gudang'),
(12, 'asas', 'mia@gmail.com', '2021-07-20 08:08:00', '$2y$10$RDTPtYpO2Gp2boGot.8PvuhPFKZfzNPWFioYO5MKjgVvB.8xmCxeK', NULL, '2021-07-20 08:07:08', '2021-07-20 08:08:00', 'customer'),
(14, 'direktur', 'dir@gmail.com', '2021-07-20 08:24:02', '$2y$10$e7anYq.SRB88osgFQtN/8uMIX6DUyAxnUSmUNWruZLfcJZNnIeZcS', NULL, '2021-07-20 08:24:02', '2021-07-20 08:24:02', 'direktur'),
(15, 'ppic', 'ppic@gmail.com', '2021-07-20 08:47:31', '$2y$10$1hVBjNCddceLPoBFrxkwPua6y94cn9lXybv3yYV3GMwYz7qbGNeIG', NULL, '2021-07-20 08:47:31', '2021-07-20 08:47:31', 'ppic');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `evidence`
--
ALTER TABLE `evidence`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `evidence`
--
ALTER TABLE `evidence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
