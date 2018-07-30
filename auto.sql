-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июл 30 2018 г., 13:39
-- Версия сервера: 5.6.35
-- Версия PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `auto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `data_auto`
--

CREATE TABLE `data_auto` (
  `id` int(2) UNSIGNED NOT NULL,
  `id mark` int(1) DEFAULT NULL,
  `date` int(4) DEFAULT NULL,
  `engine` int(4) DEFAULT NULL,
  `color` varchar(13) DEFAULT NULL,
  `speed` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `data_auto`
--

INSERT INTO `data_auto` (`id`, `id mark`, `date`, `engine`, `color`, `speed`) VALUES
(1, 1, 1993, 4950, 'black', 160),
(2, 1, 1997, 4950, 'black', 160),
(3, 2, 2012, 998, 'green', 187),
(4, 2, 2007, 1560, 'gray', 179),
(5, 2, 2004, 1789, 'white', 193),
(6, 3, 2004, 1332, 'white', 180),
(7, 3, 2005, 1493, 'gray', 160),
(8, 4, 2007, 998, 'green', 145),
(9, 5, 2004, 698, 'dark blue', 180),
(10, 5, 2003, 1396, 'gray', 220),
(11, 6, 2012, 1589, 'blue', 195),
(12, 7, 2013, 1997, 'red', 209),
(13, 7, 2007, 2979, 'green', 225),
(14, 8, 2008, 2996, 'blue', 245),
(15, 8, 2006, 4799, 'gray metallic', 250);

-- --------------------------------------------------------

--
-- Структура таблицы `model_auto`
--

CREATE TABLE `model_auto` (
  `id` int(1) UNSIGNED NOT NULL,
  `mark` varchar(5) DEFAULT NULL,
  `model` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `model_auto`
--

INSERT INTO `model_auto` (`id`, `mark`, `model`) VALUES
(1, 'Ford', 'Bronco'),
(2, 'Ford', 'C-Max'),
(3, 'Smart', 'Forfour'),
(4, 'Smart', 'Fortwo'),
(5, 'Smart', 'Roadster'),
(6, 'BMW', '1 Series'),
(7, 'BMW', '3 Series'),
(8, 'BMW', '7 Series');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data_auto`
--
ALTER TABLE `data_auto`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_auto`
--
ALTER TABLE `model_auto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `data_auto`
--
ALTER TABLE `data_auto`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `model_auto`
--
ALTER TABLE `model_auto`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;