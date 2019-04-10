-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 10 2019 г., 10:39
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diplocation`
--

-- --------------------------------------------------------

--
-- Структура таблицы `access_tokens`
--

CREATE TABLE `access_tokens` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `access_tokens`
--

INSERT INTO `access_tokens` (`id`, `admin_id`, `token`) VALUES
(40, 2, 'accessd715ccada26cdae40b301a43d8e385bd');

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `super_user` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`, `name`, `email`, `super_user`) VALUES
(1, 'admin', 'b1469224af591e16c1e7a0234f13167b', 'SuperAdmin', 'al.pes@bk.ru', 1),
(2, 'asuadmin', 'b1469224af591e16c1e7a0234f13167b', 'AsuAdmin', 'asu@edu.ru', 0),
(4, 'apes', '4f16aeeec0e9c4ef2477bfd120576407', 'Алихан Пешхоев', 'al.pes@bk.ru', 0),
(5, 'kirill', '4f16aeeec0e9c4ef2477bfd120576407', 'Кирилл', 'kill.real@mail.ru', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `admins_buildings`
--

CREATE TABLE `admins_buildings` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admins_buildings`
--

INSERT INTO `admins_buildings` (`id`, `admin_id`, `building_id`) VALUES
(12, 4, 7),
(13, 5, 3),
(14, 5, 8),
(15, 2, 4),
(16, 2, 7),
(17, 2, 8),
(18, 2, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buildings`
--

INSERT INTO `buildings` (`id`, `title`, `city_id`, `address`) VALUES
(3, 'АГУ (тест)', 2, NULL),
(4, 'МГУ (тест)', 1, 'Пушкина 12'),
(7, 'АГУ офишл', 2, 'Татищева 12'),
(8, 'БГУ', 5, ''),
(9, 'ТГУ', 8, '');

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `title`, `country_id`) VALUES
(1, 'Москва', 1),
(2, 'Астрахань', 1),
(5, 'Берлин', 2),
(6, 'Мюнхен', 2),
(8, 'Токио', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `title`) VALUES
(1, 'Россия'),
(2, 'Германия'),
(3, 'Япония');

-- --------------------------------------------------------

--
-- Структура таблицы `points`
--

CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `building_id` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `points`
--

INSERT INTO `points` (`id`, `device_id`, `title`, `building_id`, `edited_by`, `last_update`) VALUES
(1, '1', 'Точка A', 4, 0, '2019-03-03 12:32:07'),
(2, '2', 'Точка B', 4, 0, '2019-03-03 12:32:07'),
(5, '3', 'Точка C', 4, 0, '2019-03-03 12:32:07'),
(6, '4', 'Точка D', 4, 0, '2019-03-03 12:32:07');

-- --------------------------------------------------------

--
-- Структура таблицы `points_aliases`
--

CREATE TABLE `points_aliases` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `point_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vectors`
--

CREATE TABLE `vectors` (
  `id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `start_point` int(11) NOT NULL,
  `end_point` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  `direction` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vectors`
--

INSERT INTO `vectors` (`id`, `building_id`, `start_point`, `end_point`, `distance`, `direction`, `edited_by`, `last_update`) VALUES
(1, 4, 1, 2, 3, 0, 0, '2019-04-10 08:37:40'),
(2, 4, 2, 5, 3, 90, 0, '2019-04-10 08:37:43'),
(3, 4, 5, 6, 3, 180, 0, '2019-04-10 08:37:47'),
(4, 4, 6, 1, 3, 270, 0, '2019-04-10 08:37:50');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `access_tokens`
--
ALTER TABLE `access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `admins_buildings`
--
ALTER TABLE `admins_buildings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_buildings_fk0` (`admin_id`),
  ADD KEY `admins_buildings_fk1` (`building_id`);

--
-- Индексы таблицы `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buildings_fk0` (`city_id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_fk0` (`country_id`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device_id` (`device_id`),
  ADD KEY `points_fk0` (`building_id`);

--
-- Индексы таблицы `points_aliases`
--
ALTER TABLE `points_aliases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `points_aliases_fk0` (`point_id`);

--
-- Индексы таблицы `vectors`
--
ALTER TABLE `vectors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vectors_fk0` (`start_point`),
  ADD KEY `vectors_fk1` (`end_point`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `access_tokens`
--
ALTER TABLE `access_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `admins_buildings`
--
ALTER TABLE `admins_buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `points_aliases`
--
ALTER TABLE `points_aliases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `vectors`
--
ALTER TABLE `vectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `admins_buildings`
--
ALTER TABLE `admins_buildings`
  ADD CONSTRAINT `admins_buildings_fk0` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `admins_buildings_fk1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`);

--
-- Ограничения внешнего ключа таблицы `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_fk0` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Ограничения внешнего ключа таблицы `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_fk0` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Ограничения внешнего ключа таблицы `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_fk0` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`);

--
-- Ограничения внешнего ключа таблицы `points_aliases`
--
ALTER TABLE `points_aliases`
  ADD CONSTRAINT `points_aliases_fk0` FOREIGN KEY (`point_id`) REFERENCES `points` (`id`);

--
-- Ограничения внешнего ключа таблицы `vectors`
--
ALTER TABLE `vectors`
  ADD CONSTRAINT `vectors_fk0` FOREIGN KEY (`start_point`) REFERENCES `points` (`id`),
  ADD CONSTRAINT `vectors_fk1` FOREIGN KEY (`end_point`) REFERENCES `points` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
