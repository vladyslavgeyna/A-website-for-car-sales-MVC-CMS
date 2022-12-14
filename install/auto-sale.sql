-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 15 2022 г., 00:03
-- Версия сервера: 8.0.30
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `auto-sale`
--

-- --------------------------------------------------------

--
-- Структура таблицы `car`
--

CREATE TABLE `car` (
  `id` int NOT NULL,
  `car_brand_id` int NOT NULL COMMENT 'ID марки',
  `car_model_id` int NOT NULL COMMENT 'ID моделі',
  `year_of_production` int NOT NULL COMMENT 'Рік випуску',
  `engine_capacity` float NOT NULL COMMENT 'Об''єм двигуна в літрах',
  `fuel_id` int NOT NULL COMMENT 'ID виду пального',
  `transmission_id` int NOT NULL COMMENT 'ID коробки передач',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Колір',
  `region_id` int NOT NULL COMMENT 'Область, де знаходиться автомобіль',
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Район, де знаходиться автомобіль',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Місто, селище, село, де знаходиться автомобіль',
  `price` float NOT NULL COMMENT 'Ціна',
  `wheel_drive_id` int NOT NULL COMMENT 'ID приводу автомобіля',
  `number_of_seats` int NOT NULL COMMENT 'Кількість місць для сидіння',
  `mileage` int NOT NULL COMMENT 'Пробіг (тисяч кілометрів)',
  `additional_options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Додаткові опції автомобіля'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Інформація про автомобіль';

-- --------------------------------------------------------

--
-- Структура таблицы `car_ad`
--

CREATE TABLE `car_ad` (
  `id` int NOT NULL,
  `car_id` int NOT NULL COMMENT 'ID автомобіля',
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Заголовок оголошення',
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Текст оголошення',
  `date_of_creating` datetime NOT NULL COMMENT 'Дата створення оголошення',
  `is_active` int NOT NULL DEFAULT '1' COMMENT 'Чи активне оголошення (1 - так, 0 - ні)',
  `user_id` int NOT NULL COMMENT 'ID користувача, що створив оголошення'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Оголошення про продаж автомобіля';

-- --------------------------------------------------------

--
-- Структура таблицы `car_brand`
--

CREATE TABLE `car_brand` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва марки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Марки автомобілів';

-- --------------------------------------------------------

--
-- Структура таблицы `car_comparison`
--

CREATE TABLE `car_comparison` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'ID користувача, що додав автомобіль до порівняння',
  `car_id` int NOT NULL COMMENT 'ID автомобіля, доданого до порівняння'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Порівняння автомобілів';

-- --------------------------------------------------------

--
-- Структура таблицы `car_image`
--

CREATE TABLE `car_image` (
  `id` int NOT NULL,
  `image_id` int NOT NULL COMMENT 'ID зображення',
  `car_id` int NOT NULL COMMENT 'ID автомобіля'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Зображення автомобілів';

-- --------------------------------------------------------

--
-- Структура таблицы `car_model`
--

CREATE TABLE `car_model` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва моделі',
  `car_brand_id` int NOT NULL COMMENT 'ID марки до якої належить модель'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Моделі автомобілів за марками';

-- --------------------------------------------------------

--
-- Структура таблицы `favorite_ad`
--

CREATE TABLE `favorite_ad` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'ID користувача, який додав оголошення до обраного',
  `car_ad_id` int NOT NULL COMMENT 'ID оголошення, доданого до обраного'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Обрані оголошення';

-- --------------------------------------------------------

--
-- Структура таблицы `fuel`
--

CREATE TABLE `fuel` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Вид пального';

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва файлу'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Таблиця для збереження зображень';

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE `region` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Область України';

-- --------------------------------------------------------

--
-- Структура таблицы `transmission`
--

CREATE TABLE `transmission` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Вид коробки передач';

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ім''я',
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Прізвище',
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'По-батькові',
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Логін',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Пароль',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Номер телефону',
  `is_admin` int NOT NULL DEFAULT '0' COMMENT 'Чи адміністратор',
  `image_id` int DEFAULT NULL COMMENT 'ID зображення (аватар)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Користувачі';

-- --------------------------------------------------------

--
-- Структура таблицы `user_review`
--

CREATE TABLE `user_review` (
  `id` int NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Заголовок відгука',
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Текст відгука',
  `user_id` int NOT NULL COMMENT 'ID користувача, про якого написаний відгук',
  `user_id_from` int NOT NULL COMMENT 'ID користувача, що написав даний відгук'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Відгуки про користувача';

-- --------------------------------------------------------

--
-- Структура таблицы `wheel_drive`
--

CREATE TABLE `wheel_drive` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Вид приводу автомобіля';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_brand_id` (`car_brand_id`),
  ADD KEY `car_model_id` (`car_model_id`),
  ADD KEY `wheel_drive_id` (`wheel_drive_id`),
  ADD KEY `transmission_id` (`transmission_id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `fuel_id` (`fuel_id`);

--
-- Индексы таблицы `car_ad`
--
ALTER TABLE `car_ad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `car_brand`
--
ALTER TABLE `car_brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `car_comparison`
--
ALTER TABLE `car_comparison`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `car_image`
--
ALTER TABLE `car_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Индексы таблицы `car_model`
--
ALTER TABLE `car_model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_brand_id` (`car_brand_id`);

--
-- Индексы таблицы `favorite_ad`
--
ALTER TABLE `favorite_ad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_ad_id` (`car_ad_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `fuel`
--
ALTER TABLE `fuel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transmission`
--
ALTER TABLE `transmission`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_id` (`image_id`);

--
-- Индексы таблицы `user_review`
--
ALTER TABLE `user_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_from` (`user_id_from`);

--
-- Индексы таблицы `wheel_drive`
--
ALTER TABLE `wheel_drive`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `car_ad`
--
ALTER TABLE `car_ad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `car_brand`
--
ALTER TABLE `car_brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `car_comparison`
--
ALTER TABLE `car_comparison`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `car_image`
--
ALTER TABLE `car_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `car_model`
--
ALTER TABLE `car_model`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `favorite_ad`
--
ALTER TABLE `favorite_ad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fuel`
--
ALTER TABLE `fuel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `region`
--
ALTER TABLE `region`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transmission`
--
ALTER TABLE `transmission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_review`
--
ALTER TABLE `user_review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `wheel_drive`
--
ALTER TABLE `wheel_drive`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`car_brand_id`) REFERENCES `car_brand` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`car_model_id`) REFERENCES `car_model` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`wheel_drive_id`) REFERENCES `wheel_drive` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_4` FOREIGN KEY (`transmission_id`) REFERENCES `transmission` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_5` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_6` FOREIGN KEY (`fuel_id`) REFERENCES `fuel` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `car_ad`
--
ALTER TABLE `car_ad`
  ADD CONSTRAINT `car_ad_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ad_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `car_comparison`
--
ALTER TABLE `car_comparison`
  ADD CONSTRAINT `car_comparison_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_comparison_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `car_image`
--
ALTER TABLE `car_image`
  ADD CONSTRAINT `car_image_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_image_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `car_model`
--
ALTER TABLE `car_model`
  ADD CONSTRAINT `car_model_ibfk_1` FOREIGN KEY (`car_brand_id`) REFERENCES `car_brand` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `favorite_ad`
--
ALTER TABLE `favorite_ad`
  ADD CONSTRAINT `favorite_ad_ibfk_1` FOREIGN KEY (`car_ad_id`) REFERENCES `car_ad` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `favorite_ad_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `user_review`
--
ALTER TABLE `user_review`
  ADD CONSTRAINT `user_review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_review_ibfk_2` FOREIGN KEY (`user_id_from`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
