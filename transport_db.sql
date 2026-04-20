-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 20 2026 г., 17:46
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `transport_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'принят',
  `location` varchar(200) DEFAULT 'на складе',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cargo`
--

INSERT INTO `cargo` (`id`, `tracking_number`, `user_id`, `description`, `status`, `location`, `updated_at`) VALUES
(1, 'TK-1234-2025', NULL, 'Стиральная машина', 'в пути', 'Москва', '2026-03-17 07:40:48'),
(2, 'TK-5678-2025', NULL, 'Мебель', 'доставлен', 'Санкт-Петербург', '2026-03-17 07:40:48'),
(3, 'TK-1111-2026', 1, 'Холодильник', 'в пути', 'Москва', '2026-04-06 12:52:21'),
(4, 'TK-2222-2026', 1, 'Мебель', 'доставлен', 'Санкт-Петербург', '2026-04-06 12:52:21'),
(5, 'TK-3333-2026', 4, 'Телевизор', 'принят', 'на складе', '2026-04-06 12:58:07'),
(6, 'TK-4444-2026', 4, 'Автомобильные шины', 'в пути', 'Казань', '2026-04-06 13:00:23'),
(7, 'TK-5555-2026', 4, 'Строительные материалы', 'доставлен', 'Санкт-Петербург', '2026-04-06 13:00:23'),
(8, 'TK-6666-2026', 4, 'Бытовая техника', 'принят', 'на складе в Ярославле', '2026-04-06 13:00:23'),
(9, 'TK-7777-2026', 4, 'Мебель офисная', 'в пути', 'Москва', '2026-04-06 13:00:23');

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `from_city` varchar(100) NOT NULL,
  `to_city` varchar(100) NOT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `volume` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'новая',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `from_city`, `to_city`, `weight`, `volume`, `status`, `created_at`) VALUES
(1, 0, 'Яросавль', 'Москва', 123.00, 7.00, 'новая', '2026-03-17 13:08:08'),
(2, 4, 'Ярославль', 'Москва', 360.00, 69.00, 'новая', '2026-03-17 13:13:34'),
(3, 4, 'Ярославль', 'Казань', 500.00, 10.00, 'новая', '2026-04-06 13:00:11'),
(4, 4, 'Москва', 'Санкт-Петербург', 1200.00, 25.00, 'в работе', '2026-04-06 13:00:11'),
(5, 4, 'Ярославль', 'Новосибирск', 3000.00, 60.00, 'выполнена', '2026-03-01 09:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`) VALUES
(1, 'Тестовый пользователь', 'test@mail.ru', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '123456789'),
(2, 'Холодилова Юлия Алексеевна', 'holodilovaulia22@gmail.com', '$2y$10$uRje/6tcJFWSniMSE3Xezex4q9DCeLNM/dW7pAKvYFudMF96vaDsm', 'tobik619'),
(4, 'Юлия Холодилова', 'yulia@gmail.com', '$2y$10$1QeLp9TYkc3cIjO0rEnteuzQdv9mY/YRLyCTiJG5bneVhIyylSP9W', '89080285560');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_number` (`tracking_number`);

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
