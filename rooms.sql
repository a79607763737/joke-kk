-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 12 2023 г., 08:18
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `arzhaany`
--

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `text` mediumtext DEFAULT NULL,
  `img` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `text`, `img`, `phone`) VALUES
(1, 'Алдын-Булак', 'Этнокультурный комплекс «Алдын-Булак»\r\nОчень красиво, но надо быть готовым к толпам туристов, свадебных кортежей.\r\nВ местечке Харар Балык\r\n', 'Этнокультурный комплекс «Алдын-Булак»\r\nОчень красиво, но надо быть готовым к толпам туристов, свадебных кортежей.\r\nВ местечке Харар Балык', 'img/room/goldbulak.jpg', '89527519018'),
(2, 'Зов марала', 'Мараловодческая ферма «Зов марала»\r\nМожно погладить маралов, закупить пантовую продукцию, принять оздоровительные ванные.', 'Мараловодческая ферма «Зов марала»\r\nМожно погладить маралов, закупить пантовую продукцию, принять оздоровительные ванные.\r\nВ местечке Елькин ключ, в 18 км. от Турана.\r\nДом 25 тыс. руб. в сутки\r\nС человека 2-3 тыс.', 'img/room/maralhoz.jpg', '89955505257, 89235411590, 8(39422)2-56-78'),
(3, 'Дружба', 'Турбаза «Дружба» на озере Дус-Хол\r\nВесь июнь у них бесплатные завтраки, есть услуги массажа.\r\n', 'Турбаза «Дружба» на озере Дус-Хол\r\nВесь июнь у них бесплатные завтраки, есть услуги массажа\r\nПроживание по акции в июне с завтраком в сутки 1400 руб, без — 1700', 'img/room/friendship.jpg', '89632626657'),
(4, 'Теректиг', 'Гостевая юрта «Теректиг»\r\nИнтерьер юрты огонь, есть чабанская совсем рядом, интересно для детей.', 'Гостевая юрта «Теректиг»\r\nИнтерьер юрты огонь, есть чабанская совсем рядом, интересно для детей\r\nВ 34 км. от Кызыла недалеко от села Суг-Бажы.\r\nАренда юрты в будни 12 тыс. руб., в выходные - 15 тыс. руб.', 'img/room/terektig.jpg', '89333140433');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`,`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
