-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 14 2023 г., 04:00
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `registration`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `id_image` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `id_image`, `comment`, `created_at`, `author`) VALUES
(53, 35, 'xxxxxxxxxxxxxx', '2023-06-14 03:48:39', 'v'),
(55, 31, 'vvvvvvvvvvvvvvvvvvvvvvvvv', '2023-06-14 03:49:14', 'v'),
(57, 30, 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', '2023-06-14 03:55:01', 'v'),
(59, 31, 'mmmmmmmmmmmm', '2023-06-14 03:56:23', 'z'),
(60, 26, 'mmmmmmmmmmmmmmmmmmmmmmmm', '2023-06-14 03:56:55', 'z'),
(61, 43, 'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', '2023-06-14 03:57:33', 'z');

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `id_name` int NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `id_name`, `image`) VALUES
(25, 28, 'images/hg.png'),
(26, 28, 'images/bn.png'),
(30, 28, 'images/j.png'),
(31, 28, 'images/si.png'),
(35, 33, 'images/ds.png'),
(43, 33, 'images/bn.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(28, 'v', 'dghn@sory.ru', '$argon2id$v=19$m=65536,t=4,p=1$bG1hcjFOYUcyazlReGdBbQ$WxN0BiacezM639IF6BocyLqq8ptJAdn/MXmfWM6uqyk', '2023-06-13 21:47:13'),
(29, 'x', 'nnnn@mail.ru', '$argon2id$v=19$m=65536,t=4,p=1$V1k0NU5ELkJsbUtFWHN3eQ$Aoy7n8nb9MAoDXBw05l95ixBvyC2952+wj3r48ECrcQ', '2023-06-13 22:29:52'),
(30, 'b', 'dn@sory.ru', '$argon2id$v=19$m=65536,t=4,p=1$eTl0d25EaFJtZDBNQmx4MA$kxWtYxa/ISroDoeoOXVjjifJLHiBbACoyS6ygKJMHZs', '2023-06-13 22:39:47'),
(31, 'ффф', 'dn@sy.ru', '$argon2id$v=19$m=65536,t=4,p=1$MWhHN1EyUXRLd24ycVhhbw$XExZO6otVR+hv91XDTxvnSwtjdesWJfsM1GsBko0s5o', '2023-06-14 01:34:04'),
(32, 'ыыы', 'd@sory.ru', '$argon2id$v=19$m=65536,t=4,p=1$QlMwUmR5c1NmQXZ2TmZxdw$todzzRdoy1VqXZSlaKASE2MsUzH71ygXXv9ItynNvrg', '2023-06-14 01:37:04'),
(33, 'z', 'dn@s.ru', '$argon2id$v=19$m=65536,t=4,p=1$Y1c4QUlCeTYvOTNIQ3FKaw$rY9IS5x28HnazW3q40LewsB0s/qttFcghPLj5p4Yh/k', '2023-06-14 01:52:51'),
(34, 'vbv', 'dhhhn@s.ru', '$argon2id$v=19$m=65536,t=4,p=1$emdVT2VhemhsNzFNTGMuQg$Isfd/PfuV/JkxEjlveygZeA1JoqE91HMjDLdK557eio', '2023-06-14 03:59:13');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_ibfk_1` (`id_image`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_ibfk_1` (`id_name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_name`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
