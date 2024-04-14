-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 17 2022 г., 08:34
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diplom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dons`
--

CREATE TABLE `dons` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `login` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `dons`
--

INSERT INTO `dons` (`id`, `name`, `login`, `pass`) VALUES
(1, 'Сократ', 'admin', 'iamclever');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int UNSIGNED NOT NULL,
  `year_n_days` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'курс и дни проведения занятий',
  `don` int UNSIGNED NOT NULL COMMENT 'преподаватель'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `year_n_days`, `don`) VALUES
(1, 'Интеллектуалы', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id_student` int NOT NULL,
  `id_group` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `pass` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id_student`, `id_group`, `name`, `pass`) VALUES
(1, 1, 'Данте', 'ilovepizza'),
(2, 1, 'Вергилий', 'ineedmorepower'),
(3, 1, 'Никола Тесла', 'engineer'),
(4, 1, 'Клерк Максвелл', 'mechanic'),
(5, 1, 'Альберт Эйнштейн', 'полететьнеполучилось');

-- --------------------------------------------------------

--
-- Структура таблицы `s_t`
--

CREATE TABLE `s_t` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `id_task` int NOT NULL,
  `done_or_no` tinyint(1) NOT NULL COMMENT 'сделано ли'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `s_t`
--

INSERT INTO `s_t` (`id`, `id_student`, `id_task`, `done_or_no`) VALUES
(1, 5, 1, 1),
(2, 2, 1, 1),
(3, 1, 1, 0),
(4, 4, 1, 1),
(5, 3, 1, 1),
(6, 5, 2, 1),
(7, 2, 2, 1),
(8, 1, 2, 0),
(9, 4, 2, 1),
(10, 3, 2, 1),
(11, 5, 3, 0),
(12, 2, 3, 1),
(13, 1, 3, 0),
(14, 4, 3, 1),
(15, 3, 3, 0),
(16, 5, 4, 0),
(17, 2, 4, 1),
(18, 1, 4, 0),
(19, 4, 4, 1),
(20, 3, 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id_task` int NOT NULL,
  `number` float NOT NULL,
  `id_group` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id_task`, `number`, `id_group`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dons`
--
ALTER TABLE `dons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `don` (`don`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_student`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `id_group` (`id_group`);

--
-- Индексы таблицы `s_t`
--
ALTER TABLE `s_t`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_task` (`id_task`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `id_group` (`id_group`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dons`
--
ALTER TABLE `dons`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id_student` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `s_t`
--
ALTER TABLE `s_t`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_task` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`don`) REFERENCES `dons` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `s_t`
--
ALTER TABLE `s_t`
  ADD CONSTRAINT `s_t_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `s_t_ibfk_2` FOREIGN KEY (`id_task`) REFERENCES `tasks` (`id_task`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
