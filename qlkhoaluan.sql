-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 14, 2020 lúc 11:10 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlkhoaluan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `branches`
--

INSERT INTO `branches` (`id`, `name`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Hệ thống thông tin', 1, '2020-05-12 07:16:26', '2020-05-12 07:16:26'),
(2, 'Truyền thông và mạng máy tính', 1, '2020-05-12 07:21:27', '2020-05-12 07:21:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classes`
--

CREATE TABLE `classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classes`
--

INSERT INTO `classes` (`id`, `name`, `department_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, '67DCHT22', 1, 1, '2020-05-12 08:11:31', '2020-05-12 08:11:31'),
(2, '67DCHT23', 1, 1, '2020-05-12 08:16:26', '2020-05-12 08:16:26'),
(4, '67DCHTA1', 1, 1, '2020-05-12 08:19:30', '2020-05-12 08:44:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `department`
--

CREATE TABLE `department` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `department`
--

INSERT INTO `department` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Khoa CNTT', '2020-05-12 03:55:10', '2020-05-12 03:55:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `fields`
--

CREATE TABLE `fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `fields`
--

INSERT INTO `fields` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Phân tích thiết kế hệ thống thông tin, xây dựng phần mềm quản lý (Winform)', '2020-05-12 09:00:41', '2020-05-13 06:38:20'),
(2, 'Xây dựng Website', '2020-05-12 09:00:52', '2020-05-13 06:38:29'),
(3, 'Lập trình Di Động', '2020-05-12 09:22:58', '2020-05-12 09:22:58'),
(4, 'Xây dựng ứng dụng', '2020-05-13 06:38:42', '2020-05-13 06:38:54'),
(5, 'Mạng', '2020-05-13 06:39:02', '2020-05-13 06:39:02'),
(6, 'Khác', '2020-05-13 06:39:09', '2020-05-13 06:39:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_lecturer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_lecturer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address_lecturer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `id_department` int(11) NOT NULL,
  `id_field` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lecturers`
--

INSERT INTO `lecturers` (`id`, `name_lecturer`, `address_lecturer`, `email_address_lecturer`, `phone_number`, `password`, `status`, `id_department`, `id_field`, `created_at`, `updated_at`) VALUES
(1, 'Ha Manh Tuan', 'Ha Noi', 'tuanhanb98@gmail.com', '0979587821', '$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-12 14:30:28', '2020-05-12 15:40:42'),
(4, 'Nguyễn Công Tuyến', 'Số 112, đường Lê Hoàn,', 'user2@gmail.com', '0979587821', '$2y$10$65G7EZnarzMmwucTydFxQOoSpXF5GoXKEsg6mbinNAJxS6ym4i33G', 1, 1, 1, '2020-05-14 05:02:11', '2020-05-14 05:02:20'),
(5, 'Dương Huy Toàn', 'Số 112, đường Lê Hoàn,', 'user3@gmail.com', '0979587821', '$2y$10$BY5Uv6NJdsiVgH.IQ50UpuaJXlziewGZts2KPLsqotHunnVy/cFCC', 1, 1, 4, '2020-05-14 05:10:16', '2020-05-14 05:10:24'),
(64, 'Nguyễn Văn A', 'Hà Nội', '1@gmail.com', '19009876', '$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-14 07:35:16', '2020-05-14 07:35:16'),
(65, 'Nguyễn Văn B', 'Hà Nội', '2@gmail.com', '19009876', '123456789$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-14 07:35:16', '2020-05-14 07:35:16'),
(66, 'Nguyễn Văn C', 'Hà Nội', '3@gmail.com', '19009876', '$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-14 07:35:16', '2020-05-14 07:35:16'),
(67, 'Nguyễn Văn D', 'Hà Nội', '4@gmail.com', '19009876', '$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-14 07:35:16', '2020-05-14 07:35:16'),
(68, 'Nguyễn Văn E', 'Hà Nội', '5@gmail.com', '19009876', '$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-14 07:35:16', '2020-05-14 07:35:16'),
(69, 'Nguyễn Văn F', 'Hà Nội', '6@gmail.com', '19009876', '$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-14 07:35:16', '2020-05-14 07:35:16'),
(70, 'Nguyễn Văn G', 'Hà Nội', '7@gmail.com', '19009876', '$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-14 07:35:16', '2020-05-14 07:35:16'),
(71, 'Nguyễn Văn H', 'Hà Nội', '8@gmail.com', '19009876', '$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-14 07:35:16', '2020-05-14 07:35:16'),
(72, 'Nguyễn Văn I', 'Hà Nội', '9@gmail.com', '19009876', '$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-14 07:35:16', '2020-05-14 07:35:16'),
(73, 'Nguyễn Văn K', 'Hà Nội', '10@gmail.com', '19009876', '$2y$10$GAWliK0kc.2roHFdZ.Pj/Oc223bMovyQ/.YRc5rB75eNsomqyOAwS', 1, 1, 2, '2020-05-14 07:35:16', '2020-05-14 07:35:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_12_022925_create_department_table', 1),
(5, '2020_05_12_023059_create_branches_table', 1),
(6, '2020_05_12_023253_create_classes_table', 1),
(7, '2020_05_12_154952_create_fields_table', 2),
(8, '2020_05_12_204125_create_lecturers_table', 3),
(9, '2020_05_12_230512_create_permission_tables', 4),
(10, '2020_05_13_100048_create_topics_table', 5),
(11, '2020_05_13_141429_create_students_table', 6),
(12, '2020_05_13_152048_create_protections_table', 7),
(13, '2020_05_13_215220_create_topic_protection_table', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App/User', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'add_department', 'web', '2020-05-12 16:23:15', '2020-05-12 16:23:15'),
(2, 'edit_department', 'web', '2020-05-12 16:25:50', '2020-05-12 16:25:50'),
(3, 'deletel_department', 'web', '2020-05-12 16:26:14', '2020-05-12 16:26:14'),
(4, 'add_branches', 'web', '2020-05-12 16:26:28', '2020-05-12 16:26:28'),
(5, 'edit_branches', 'web', '2020-05-12 16:26:41', '2020-05-12 16:26:41'),
(6, 'delete_branches', 'web', '2020-05-12 16:26:54', '2020-05-12 16:26:54'),
(7, 'add_fields', 'web', '2020-05-12 16:27:02', '2020-05-12 16:27:02'),
(8, 'edit_fields', 'web', '2020-05-12 16:27:15', '2020-05-12 16:27:15'),
(9, 'delete_fields', 'web', '2020-05-12 16:27:26', '2020-05-12 16:27:26'),
(10, 'change_status_lecturers', 'web', '2020-05-12 16:28:09', '2020-05-12 16:28:09'),
(11, 'add_user', 'web', '2020-05-12 17:08:46', '2020-05-12 17:08:46'),
(12, 'edit_user', 'web', '2020-05-12 17:08:53', '2020-05-12 17:08:53'),
(13, 'delete_user', 'web', '2020-05-12 17:09:01', '2020-05-12 17:09:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `protections`
--

CREATE TABLE `protections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept` int(11) NOT NULL DEFAULT 0,
  `time_start` date NOT NULL,
  `time_end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `protections`
--

INSERT INTO `protections` (`id`, `name`, `accept`, `time_start`, `time_end`, `created_at`, `updated_at`) VALUES
(1, 'Đợt bảo vệ K67-CNTT-HTTT', 1, '2020-05-13', '2020-05-31', '2020-05-13 08:41:14', '2020-05-14 03:41:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2020-05-12 16:48:29', '2020-05-12 16:48:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `msv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT 0,
  `id_department` int(10) UNSIGNED NOT NULL,
  `id_classes` int(10) UNSIGNED NOT NULL,
  `id_branch` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`id`, `msv`, `name`, `password`, `phone`, `email`, `status`, `id_department`, `id_classes`, `id_branch`, `created_at`, `updated_at`) VALUES
(1, '67DCHT20156', 'Hà Mạnh Tuấn', '$2y$10$.Iq3xisCKWm/iCWWr/Hz3.oSdHpeAp55dOtg4Tk3LNPrJHcCb65rS', '1900009876', 'tuanhanb98@gmail.com', 1, 1, 1, 1, NULL, '2020-05-14 03:02:23'),
(2, '67DCHT20157', 'Khuất Tiến Tuệ', '$2y$10$.Iq3xisCKWm/iCWWr/Hz3.oSdHpeAp55dOtg4Tk3LNPrJHcCb65rS', '1234567891', 'tueoccho@gmail.com', 1, 1, 1, 1, NULL, NULL),
(3, '67DCHT20158', 'Nguyễn Văn A', '$2y$10$.Iq3xisCKWm/iCWWr/Hz3.oSdHpeAp55dOtg4Tk3LNPrJHcCb65rS', '1234567898', '1@gmail.com', 1, 1, 1, 1, NULL, NULL),
(4, '67DCHT20000', 'Nguyễn Văn A', '$2y$10$Z1St8mb.6RYXmQltWBNXAu6vK4WhIV.FZnWwipTFMi3ooODD3MVEO', '1234567898', '123456@gmail.com', 1, 1, 1, 1, '2020-05-14 07:01:59', '2020-05-14 07:01:59'),
(5, '67DCHT20001', 'Nguyễn Văn B', '$2y$10$sE3gyCSRErndkb67L5d2PeNwUyuyAaXQWfyhua8bE6pPaiEV3j046', '1234567898', '123456@gmail.com', 1, 1, 2, 2, '2020-05-14 07:01:59', '2020-05-14 07:01:59'),
(6, '67DCHT20002', 'Nguyễn Văn C', '$2y$10$ZPQEw2z2KoEhkwY/pyARxem0i9Uy3eTfkH9IuU6WrWpP5CMofncJ2', '1234567898', '123456@gmail.com', 1, 1, 4, 1, '2020-05-14 07:01:59', '2020-05-14 07:01:59'),
(7, '67DCHT20003', 'Nguyễn Văn D', '$2y$10$abgUDv.jqH9dEciSaLmlFObLj.LhqnqtctrOpjxiB69a2/A0RyXs.', '1234567898', '123456@gmail.com', 1, 1, 1, 2, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(8, '67DCHT20004', 'Nguyễn Văn E', '$2y$10$AcadrwTMs0AVOJ1DtvdxpOZ2w6uyzceHo7RrawaJH2Rsj3IaLw5IS', '1234567898', '123456@gmail.com', 1, 1, 4, 1, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(9, '67DCHT20005', 'Nguyễn Văn F', '$2y$10$7sah85NG.B6uCMSsVkrZSe1z8./fjOtkkXfMqgvjr6LJoIwdH6lP6', '1234567898', '123456@gmail.com', 1, 1, 2, 2, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(10, '67DCHT20006', 'Nguyễn Văn G', '$2y$10$NHCXsaxYCRBClZKQW.zzO.Vt54J6seXMdLNuvgtqUDQVtwjHREK.q', '1234567898', '123456@gmail.com', 1, 1, 1, 1, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(11, '67DCHT20007', 'Nguyễn Văn H', '$2y$10$FBUFTsq2YbDWemE0oLv7u.xl./kstTqVXGdvitxRlikb7I.W3rB2m', '1234567898', '123456@gmail.com', 1, 1, 1, 2, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(12, '67DCHT20008', 'Nguyễn Văn I', '$2y$10$7oXR/qhriwZ4q6U.6WiXs.i/yn03DxtMIU14IumPggOoj4bfMGOyS', '1234567898', '123456@gmail.com', 1, 1, 2, 1, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(13, '67DCHT20009', 'Nguyễn Văn K', '$2y$10$bagMeSY1z7JsWm68iyE2QOqUrnbmGDnggDbwhU0m0fu1oale5JJre', '1234567898', '123456@gmail.com', 1, 1, 2, 2, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(14, '67DCHT20010', 'Nguyễn Văn L', '$2y$10$RfSsvFCmnk0ZL10pH2jWEeZlwDF1gT3YJZOq3Kh41U4pP1/kCeCNC', '1234567898', '123456@gmail.com', 1, 1, 2, 1, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(15, '67DCHT20011', 'Nguyễn Văn M', '$2y$10$V5H/PqdOQbrN6U6rUgwdleZBEduk7t5eXXXnRCSsP2ycmm20oEHgW', '1234567898', '123456@gmail.com', 1, 1, 4, 2, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(16, '67DCHT20012', 'Nguyễn Văn N', '$2y$10$6zzLicPUpxdKIcBxXaL67O0CrHTILJpXijLvN06TSxZ9nzPQ7mFzW', '1234567898', '123456@gmail.com', 1, 1, 4, 1, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(17, '67DCHT20013', 'Nguyễn Văn O', '$2y$10$Qq9j40KkklksTRnTIQQzCO7EUKInzmxe2XbBemsfSVtl7sf6FOzeO', '1234567898', '123456@gmail.com', 1, 1, 1, 2, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(18, '67DCHT20014', 'Nguyễn Văn Q', '$2y$10$TRC5rDYsUvk7XEl3Vnw5aeNVlwvBABgSljHhgNbOmpt4m5k9V5Ydm', '1234567898', '123456@gmail.com', 1, 1, 4, 1, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(19, '67DCHT20015', 'Nguyễn Văn W', '$2y$10$pNmSnpcjOn/rXcX4k01voeLuhvTDeMuDjZVlZI/LQclLTS9eohplC', '1234567898', '123456@gmail.com', 1, 1, 2, 2, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(20, '67DCHT20016', 'Nguyễn Văn X', '$2y$10$GV/OKMQ03aST76kjGlZ5z.NF13gTx1zMJl.j025yHG5lGQt7Uh6Fu', '1234567898', '123456@gmail.com', 1, 1, 4, 1, '2020-05-14 07:02:00', '2020-05-14 07:02:00'),
(21, '67DCHT20017', 'Nguyễn Văn Z', '$2y$10$deSLZ8lIYZor5ViM01gPZuKS215vur8YNuWVSFwBjoLzxeeA6Qu1y', '1234567898', '123456@gmail.com', 1, 1, 1, 2, '2020-05-14 07:02:01', '2020-05-14 07:02:01'),
(22, '67DCHT20018', 'Nguyễn Văn V', '$2y$10$0dqSfRI4YWObBN8/idAQoeAE.mz7/8nQG49u2RdDZy3tMbYE.lZci', '1234567898', '123456@gmail.com', 1, 1, 2, 1, '2020-05-14 07:02:01', '2020-05-14 07:02:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `topics`
--

CREATE TABLE `topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `lecturers_id` int(10) UNSIGNED NOT NULL,
  `fields_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept` int(11) NOT NULL DEFAULT 0,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `topics`
--

INSERT INTO `topics` (`id`, `lecturers_id`, `fields_id`, `name`, `accept`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Phân tích thiết kế và xây dựng Website bán hàng online quần áo trẻ em tại siêu thị', 1, 'Đề tài nên viết bằng ngôn ngữ PHP', '2020-05-13 03:19:03', '2020-05-14 04:18:44'),
(2, 1, 2, 'Xây dựng phần mềm quản lý khóa luận khoa Công Nghệ Thông Tin cho Đại học Công Nghệ Giao Thông Vận Tải', 1, 'Xây dựng phần mềm quản lý khóa luận khoa Công Nghệ Thông Tin cho Đại học Công Nghệ Giao Thông Vận Tải', '2020-05-13 04:00:33', '2020-05-14 04:18:44'),
(3, 1, 2, 'Xây dựng Website bán rau sạch', 1, 'Xây dựng Website bán rau sạch', '2020-05-13 04:01:34', '2020-05-14 04:18:44'),
(11, 4, 1, 'Phân tích thiết kế và xây dựng hệ thống thông tin quản lý mạng lưới xe buýt của một thành phố trên nền GIS.', 1, '* Yêu cầu nội dung\r\n- Tìm hiểu, khảo sát thực tế quy trình quản lý mạng lưới xe buýt của một thành phố tại Sở Giao thông Vận tải (sẽ thống nhất với sinh viên về thành phố cụ thể). \r\n- Phân tích thiết kế hệ thống thông tin (chức năng, CSDL) quản lý mạng lưới xe buýt đã khảo sát trên nền GIS.\r\nLựa chọn công cụ (Hệ quản trị CSDL, ngôn ngữ lập trình) và triển khai xây dựng hệ thống thông tin quản lý mạng lưới xe buýt đã khảo sát trên nền GIS.\r\n* Sản phẩm\r\n- Báo cáo khảo sát và thu thập dữ liệu.\r\n- Báo cáo đồ án theo quy định của Trường, tóm tắt thông tin đồ án, slide báo cáo đồ án.\r\nSản phẩm phần mềm và CSDL.', '2020-05-14 05:03:14', '2020-05-14 05:04:01'),
(12, 4, 1, 'Phân tích thiết kế và xây dựng hệ thống thông tin quản lý hàng hóa và công nợ của doanh nghiệp', 1, '* Yêu cầu nội dung\r\n- Tìm hiểu, khảo sát thực tế quy trình, nghiệp vụ quản lý của doanh nghiệp (sẽ thống nhất với sinh viên về doanh nghiệp cụ thể). \r\n- Phân tích thiết kế hệ thống (chức năng, CSDL).\r\nLựa chọn công cụ (Hệ quản trị CSDL, ngôn ngữ lập trình) và triển khai xây dựng hệ thống.\r\n* Sản phẩm\r\n- Báo cáo khảo sát và thu thập dữ liệu.\r\n- Báo cáo đồ án theo quy định của Trường, tóm tắt thông tin đồ án, slide báo cáo đồ án.\r\nSản phẩm phần mềm và CSDL.', '2020-05-14 05:03:43', '2020-05-14 05:04:01'),
(13, 5, 4, 'Tìm hiểu ngôn ngữ lập trình di động Android và xây dựng ứng dụng từ điển tiếng anh chuyên ngành cntt', 1, '- Khảo sát hệ thống;\r\n- Phát biểu bài toán;\r\n- Phân tích thiết kế hệ thống;\r\n- Thiết kế cơ sở dữ liệu;\r\n- Thiết kế giao diện;\r\n- Thiết kế chương trình;\r\n- Đánh giá chương trình.', '2020-05-14 05:12:34', '2020-05-14 05:13:32'),
(14, 5, 4, 'Xây dựng ứng dụng học từ vựng tiếng anh trên thiết bị di động sử dụng hệ điều hành Android', 1, '- Tìm hiểu, sử dụng công nghệ xây dựng ứng dụng trên nền tảng android\r\n- Đánh giá công nghệ, lựa chọn công nghệ \r\n- Áp dụng công nghệ triển khai ứng dụng minh họa', '2020-05-14 05:13:09', '2020-05-14 05:13:32'),
(35, 64, 1, 'Phân tích thiết kế và xây dựng hệ thống thông tin quản lý vật liệu xây dựng của công ty xây dựng công trình giao thông.', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(36, 65, 2, 'Thiết kế và xây dựng website  giới thiệu và bán nông sản.', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(37, 66, 3, 'Xây dựng phần mềm đọc tin tức bóng đá trên Android áp dụng Firebase', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(38, 67, 4, 'Xây dựng chương trình quản lý bán hàng máy tính tại một công ty', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(39, 68, 5, 'Nghiên cứu chương trình mô phỏng OMNET++ và ứng dụng vào mô phỏng cơ chế truy cập WLAN', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(40, 69, 6, 'Tìm hiểu cơ sở dữ liệu Cassandra và ứng dụng', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(41, 70, 2, 'Xây dựng hệ thống website đăng ký thực tập doanh nghiệp cho khoa CNTT UTT', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(42, 71, 2, 'Xây dựng website hỗ trợ tuyển dụng và tìm việc làm cho UTT', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(43, 72, 6, 'Tìm hiểu cơ sở dữ liệu Redis và ứng dụng', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(44, 73, 5, 'Thiết kế và Quản trị hệ thống Windown server 2012 cho Văn phòng đài tiếng nói Việt Nam', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(45, 64, 4, 'Xây dựng chương trình quản lý thư viện trường ĐH CNGT VT', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(46, 65, 3, 'Xây dựng ứng dụng luyện thi TOEIC trên nền tảng Android', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(47, 66, 2, 'Thiết kế và xây dựng website giới thiệu và bán sách trực tuyến', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(48, 67, 1, 'Phân tích thiết kế và xây dựng hệ thống thông tin quản lý xe taxi của một công ty taxi.', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(49, 68, 1, 'Phân tích thiết kế và xây dựng hệ thống thông tin quản lý hàng hóa và công nợ của doanh nghiệp', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(50, 69, 2, 'Thiết kế và xây dựng website  giới thiệu và bán dụng cụ thể thao.', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(51, 70, 3, 'Xây dựng hệ thống quản lý đồ án tốt nghiệp đa nền (Web + Android)', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(52, 71, 4, 'Xây dựng phần mềm  hỗ trợ hệ thống đào tạo và cấp phát giấy phép lái xe', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(53, 72, 5, 'Xây dựng hệ thống giám sát hoạt động hệ thống mạng cho Sở Ngoại vụ Tỉnh Vĩnh phúc', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35'),
(54, 73, 6, 'Tìm hiểu cơ sở dữ liệu MongoDB và ứng dụng', 1, 'php', '2020-05-14 08:20:35', '2020-05-14 08:20:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `topic_protection`
--

CREATE TABLE `topic_protection` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `id_protection` int(11) DEFAULT NULL,
  `acceptance` int(11) NOT NULL DEFAULT 0,
  `pass` int(11) DEFAULT NULL,
  `scores` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `topic_protection`
--

INSERT INTO `topic_protection` (`id`, `id_student`, `id_topic`, `id_protection`, `acceptance`, `pass`, `scores`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, NULL, '2020-05-13 15:10:06', '2020-05-14 08:34:33'),
(2, 2, 2, 1, 0, NULL, NULL, '2020-05-14 03:24:21', '2020-05-14 08:34:33'),
(3, 3, 3, 1, 1, NULL, NULL, '2020-05-14 05:22:02', '2020-05-14 08:34:33'),
(4, 4, 11, 1, 1, NULL, NULL, '2020-05-14 07:43:52', '2020-05-14 08:34:33'),
(5, 5, 12, 1, 1, NULL, NULL, '2020-05-14 07:44:37', '2020-05-14 08:34:33'),
(6, 7, 13, 1, 1, NULL, NULL, '2020-05-14 07:44:57', '2020-05-14 08:34:33'),
(7, 8, 14, NULL, 1, NULL, NULL, '2020-05-14 07:45:32', '2020-05-14 08:34:33'),
(8, 9, 35, 1, 1, NULL, NULL, '2020-05-14 08:22:04', '2020-05-14 08:34:33'),
(9, 10, 48, 1, 1, NULL, NULL, '2020-05-14 08:22:24', '2020-05-14 08:34:33'),
(10, 11, 36, 1, 1, NULL, NULL, '2020-05-14 08:22:41', '2020-05-14 08:34:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `born` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `address`, `born`, `phone`, `admin`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$RKqKhaXoSwv9I/fZuZWwCeM7xnSnAyPk8xFOa6Xxy/YDGOFqz6tpS', NULL, NULL, NULL, NULL, 1, 1, '2020-05-11 19:44:46', '2020-05-11 19:44:46');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_department_id_index` (`department_id`);

--
-- Chỉ mục cho bảng `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_branch_id_index` (`branch_id`);

--
-- Chỉ mục cho bảng `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_address_lecturer` (`email_address_lecturer`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `protections`
--
ALTER TABLE `protections`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_msv_unique` (`msv`),
  ADD KEY `students_id_department_index` (`id_department`),
  ADD KEY `students_id_classes_index` (`id_classes`),
  ADD KEY `students_id_branch_index` (`id_branch`);

--
-- Chỉ mục cho bảng `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topics_lecturers_id_index` (`lecturers_id`);

--
-- Chỉ mục cho bảng `topic_protection`
--
ALTER TABLE `topic_protection`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `protections`
--
ALTER TABLE `protections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `topic_protection`
--
ALTER TABLE `topic_protection`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_id_branch_foreign` FOREIGN KEY (`id_branch`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_id_classes_foreign` FOREIGN KEY (`id_classes`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_id_department_foreign` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_lecturers_id_foreign` FOREIGN KEY (`lecturers_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
