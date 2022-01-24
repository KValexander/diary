-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 24 2022 г., 20:14
-- Версия сервера: 10.3.29-MariaDB
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diary`
--
CREATE DATABASE IF NOT EXISTS `diary` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `diary`;

-- --------------------------------------------------------

--
-- Структура таблицы `cells`
--

DROP TABLE IF EXISTS `cells`;
CREATE TABLE `cells` (
  `cell_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `hour_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `label_id` int(11) NOT NULL,
  `background` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `dates`
--

DROP TABLE IF EXISTS `dates`;
CREATE TABLE `dates` (
  `date_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `hours`
--

DROP TABLE IF EXISTS `hours`;
CREATE TABLE `hours` (
  `hour_id` int(11) NOT NULL,
  `hour` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `hours`
--

INSERT INTO `hours` (`hour_id`, `hour`, `note`, `created_at`, `updated_at`) VALUES
(1, '05:00', NULL, '2022-01-24 17:13:46', '2022-01-24 17:13:46'),
(2, '06:00', NULL, '2022-01-24 17:13:49', '2022-01-24 17:13:49'),
(3, '07:00', NULL, '2022-01-24 17:13:51', '2022-01-24 17:13:51'),
(4, '08:00', NULL, '2022-01-24 17:13:52', '2022-01-24 17:13:52'),
(5, '09:00', NULL, '2022-01-24 17:13:53', '2022-01-24 17:13:53'),
(6, '10:00', NULL, '2022-01-24 17:13:55', '2022-01-24 17:13:55'),
(7, '11:00', NULL, '2022-01-24 17:13:59', '2022-01-24 17:13:59'),
(8, '12:00', NULL, '2022-01-24 17:14:01', '2022-01-24 17:14:01'),
(9, '13:00', NULL, '2022-01-24 17:14:02', '2022-01-24 17:14:02'),
(10, '14:00', NULL, '2022-01-24 17:14:04', '2022-01-24 17:14:04'),
(11, '15:00', NULL, '2022-01-24 17:14:06', '2022-01-24 17:14:06'),
(12, '16:00', NULL, '2022-01-24 17:14:08', '2022-01-24 17:14:08'),
(13, '17:00', NULL, '2022-01-24 17:14:10', '2022-01-24 17:14:10'),
(14, '18:00', NULL, '2022-01-24 17:14:16', '2022-01-24 17:14:16'),
(15, '19:00', NULL, '2022-01-24 17:14:17', '2022-01-24 17:14:17'),
(16, '20:00', NULL, '2022-01-24 17:14:19', '2022-01-24 17:14:19'),
(17, '21:00', NULL, '2022-01-24 17:14:21', '2022-01-24 17:14:21'),
(18, '22:00', NULL, '2022-01-24 17:14:25', '2022-01-24 17:14:25');

-- --------------------------------------------------------

--
-- Структура таблицы `labels`
--

DROP TABLE IF EXISTS `labels`;
CREATE TABLE `labels` (
  `label_id` int(11) NOT NULL,
  `label` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `profile_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cells`
--
ALTER TABLE `cells`
  ADD PRIMARY KEY (`cell_id`),
  ADD KEY `profile_id` (`profile_id`),
  ADD KEY `hour_id` (`hour_id`),
  ADD KEY `date_id` (`date_id`),
  ADD KEY `label_id` (`label_id`);

--
-- Индексы таблицы `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`date_id`);

--
-- Индексы таблицы `hours`
--
ALTER TABLE `hours`
  ADD PRIMARY KEY (`hour_id`);

--
-- Индексы таблицы `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`label_id`);

--
-- Индексы таблицы `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cells`
--
ALTER TABLE `cells`
  MODIFY `cell_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dates`
--
ALTER TABLE `dates`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hours`
--
ALTER TABLE `hours`
  MODIFY `hour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `labels`
--
ALTER TABLE `labels`
  MODIFY `label_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
