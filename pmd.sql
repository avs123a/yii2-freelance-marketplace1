-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 01 2017 г., 15:01
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pmd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bid`
--

CREATE TABLE `bid` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `price` decimal(19,4) NOT NULL,
  `term` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Активная'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bid`
--

INSERT INTO `bid` (`id`, `order_id`, `user_id`, `currency`, `price`, `term`, `comment`, `status`) VALUES
(7, 1, 1, 'UAH', '1000.0000', 10, 'Complete', 'Одобрена');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `text`) VALUES
(1, 1, 1, 'ИМ', 'Уточните детали'),
(2, 2, 1, 'Заказ на ИМ', 'Спасибо');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1509883199),
('m130524_201442_init', 1509883201);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `skills` varchar(50) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `price` decimal(19,4) DEFAULT NULL,
  `dateA` varchar(11) NOT NULL,
  `dateB` varchar(11) NOT NULL,
  `worker_login` varchar(20) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Активный'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `user_id`, `type`, `title`, `category`, `description`, `skills`, `currency`, `price`, `dateA`, `dateB`, `worker_login`, `status`) VALUES
(1, 1, '1 Проект', 'Интернет-магазин', 'Web-программирование', 'yii2 online shop with dependence attributes', 'php,mysql,yii2,html,css,js,jquery,bootstrap', 'UAH', '3000.0000', '08/11/17', '10/11/2017', 'admin', 'Указан исполнитель');

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `title` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `title`) VALUES
(13, 1, 'vs'),
(14, 1, 'mc'),
(15, 1, 'crs'),
(16, 1, 'mstr'),
(17, 1, 'p24'),
(18, 1, 'advc'),
(19, 1, 'wm'),
(20, 1, 'pp'),
(21, 1, 'pb'),
(22, 1, 'ik'),
(23, 1, 'ydm'),
(24, 1, 'prmn'),
(25, 1, 'pz'),
(26, 1, 'pnr'),
(27, 1, 'qw'),
(28, 1, 'btc'),
(29, 1, 'ik'),
(30, 1, 'rbks'),
(31, 1, 'rbks'),
(32, 1, 'ltc'),
(33, 1, 'doge'),
(34, 1, 'dash'),
(35, 1, 'eth');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '15',
  `surname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(22) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vk` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `role`, `surname`, `name`, `country`, `city`, `phone`, `skype`, `vk`, `fb`) VALUES
(1, 'admin', 'h7phzlDGSllNEpc67Jj3AxpDeIk8TJzQ', '$2y$13$Ru3K1LI10vr3RJfHmHw./OCOUGtBsHXyYc5Jtvhay38Hj.5xRE1xe', NULL, 'an128z56@gmail.com', 10, 1509883887, 1511007767, 20, 'Санжаровский', 'Антон', 'Украина', 'Люботин', '', '', '', ''),
(2, 'user2', 'XnSjsdOP5H7NZuwPRv8t95CPprwK37Il', '$2y$13$47hedvQxwN3T152ZC6DgeeOvSJebAXLrFs/CYKPxgKz3D8QLRsGVa', NULL, 'user2@mail.ru', 10, 1511606495, 1512023934, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bid`
--
ALTER TABLE `bid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Ограничения внешнего ключа таблицы `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
