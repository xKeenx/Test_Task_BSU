-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 18 2021 г., 18:16
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bsu_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `surname` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `midname` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `surname`, `name`, `midname`, `email`, `country`, `city`, `login`, `password`) VALUES
(720, 'Горожанкин', 'Владислав', 'Сергеевич', 'vlad.gorozhankin@mail.ru', 'Россия', 'Белгород', '8btbizWcUP', 75009834),
(721, 'Кальчу', 'Дмитрий', 'Сергеевич', '1325021@bsu.edu.ru', 'Россия', 'Воронеж', 'LWjsKhppYz', 26381651),
(722, 'Петров', 'Денис', 'Васильевич', 'petrov@bsu.edu.ru', 'Петров', 'Белгород', 'jI7rXgNupN', 22100429),
(723, 'Денисов', 'Антон', 'Викторович', 'denisov@bsu.edu.ru', 'Денисов', 'Губкин', 'zv3FkY5yLr', 19831815);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=724;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
