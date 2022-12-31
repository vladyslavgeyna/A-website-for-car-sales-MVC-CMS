-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 31 2022 г., 13:10
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
-- Структура таблицы `admin_message`
--

CREATE TABLE `admin_message` (
  `id` int NOT NULL,
  `message_id` int NOT NULL COMMENT 'ID повідомлення',
  `user_admin_id` int NOT NULL COMMENT 'ID адміна, якому призначене повідомлення'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `type_of_currency_id` int NOT NULL COMMENT 'ID виду валюти',
  `wheel_drive_id` int NOT NULL COMMENT 'ID приводу автомобіля',
  `number_of_seats` int NOT NULL COMMENT 'Кількість місць для сидіння',
  `mileage` int NOT NULL COMMENT 'Пробіг (тисяч кілометрів)',
  `additional_options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Додаткові опції автомобіля'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Інформація про автомобіль';

--
-- Дамп данных таблицы `car`
--

INSERT INTO `car` (`id`, `car_brand_id`, `car_model_id`, `year_of_production`, `engine_capacity`, `fuel_id`, `transmission_id`, `color`, `region_id`, `district`, `city`, `price`, `type_of_currency_id`, `wheel_drive_id`, `number_of_seats`, `mileage`, `additional_options`) VALUES
(1, 2, 2, 2020, 3, 1, 1, 'Сірий', 2, 'Бердичівський', 'Бердичів', 16000, 1, 1, 5, 59, 'Бортовий комп\'ютер, клімат, підігрів керма'),
(4, 3, 4, 2020, 2.5, 1, 1, 'Сірий', 4, 'Рівненський', 'Рівне', 100000, 1, 1, 5, 120, 'Carplay, бортовий комп\'ютер, панорамний дах'),
(7, 2, 1, 2021, 2.5, 1, 1, 'Сірий', 2, 'Житомирський', 'Житомир', 21000, 1, 1, 5, 20, NULL),
(9, 2, 3, 2022, 2.5, 1, 1, 'Чорний', 1, 'Київський', 'Київ', 25000, 2, 1, 5, 12, 'Бортовий комп\'ютер, carplay, підігрів сидінь, підігрів керма, панорамний дах');

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

--
-- Дамп данных таблицы `car_ad`
--

INSERT INTO `car_ad` (`id`, `car_id`, `title`, `text`, `date_of_creating`, `is_active`, `user_id`) VALUES
(1, 1, 'Audi A5 2020 Sportback', 'Продам Audi A5 2020 року в модифікації SportBack', '2022-12-20 18:44:18', 1, 6),
(4, 4, 'Volkswagen Jetta 2021 SE', 'Всіх вітаю!<br />\r\nПродам Volkswagen Jetta 2021 року випуску в комплекції SEL.<br />\r\nВ ДТП авто не був.<br />\r\nДзвоніть, пишіть!<br />\r\nТоргу нема!!!!!!!', '2022-12-23 23:48:00', 1, 6),
(7, 7, 'Audi A4 2021 Avant', 'Продам Audi A4 2021 Avant', '2022-12-26 19:08:12', 1, 6),
(9, 9, 'Audi A6 2022 Avant Quatro С8', 'Продам Audi A6 2022 Avant Quatro С8.<br />\r\nСтан чудовий, купувався в Німеччина для себе.', '2022-12-27 16:01:19', 1, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `car_brand`
--

CREATE TABLE `car_brand` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва марки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Марки автомобілів';

--
-- Дамп данных таблицы `car_brand`
--

INSERT INTO `car_brand` (`id`, `name`) VALUES
(2, 'Audi'),
(3, 'Volkswagen');

-- --------------------------------------------------------

--
-- Структура таблицы `car_comparison`
--

CREATE TABLE `car_comparison` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'ID користувача, що додав автомобіль до порівняння',
  `car_ad_id` int NOT NULL COMMENT 'ID оголошення, доданого до порівняння'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Порівняння автомобілів';

-- --------------------------------------------------------

--
-- Структура таблицы `car_image`
--

CREATE TABLE `car_image` (
  `id` int NOT NULL,
  `image_id` int NOT NULL COMMENT 'ID зображення',
  `car_id` int NOT NULL COMMENT 'ID автомобіля',
  `is_main` int NOT NULL DEFAULT '0' COMMENT 'Чи є головною'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Зображення автомобілів';

--
-- Дамп данных таблицы `car_image`
--

INSERT INTO `car_image` (`id`, `image_id`, `car_id`, `is_main`) VALUES
(14, 15, 7, 1),
(17, 18, 9, 0),
(18, 19, 9, 1),
(19, 53, 4, 1),
(20, 54, 4, 0),
(21, 55, 1, 1),
(22, 56, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `car_model`
--

CREATE TABLE `car_model` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва моделі',
  `car_brand_id` int NOT NULL COMMENT 'ID марки до якої належить модель'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Моделі автомобілів за марками';

--
-- Дамп данных таблицы `car_model`
--

INSERT INTO `car_model` (`id`, `name`, `car_brand_id`) VALUES
(1, 'A4', 2),
(2, 'A5', 2),
(3, 'A6', 2),
(4, 'Jetta', 3);

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

--
-- Дамп данных таблицы `fuel`
--

INSERT INTO `fuel` (`id`, `name`) VALUES
(1, 'Бензин'),
(2, 'Газ'),
(3, 'Дизель'),
(4, 'Електро');

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва файлу'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Таблиця для збереження зображень';

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `name`) VALUES
(1, '639b9ab78b6ff.jpg'),
(15, '63a9c6ec9d2dd.jpg'),
(18, '63aaec9fb416b.jpeg'),
(19, '63aaec9fb9567.jpg'),
(53, '63af1dd07386e.jpg'),
(54, '63af1dd0b52f2.jpg'),
(55, '63af23315f44b.jpg'),
(56, '63af23316f480.jpg'),
(57, '63af31f23d5be.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Текст повідомлення',
  `user_id` int NOT NULL COMMENT 'ID користувача, що написав повідомлення',
  `date_of_creating` datetime NOT NULL COMMENT 'Дата та час написання повідомлення'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Таблиця з повідомленнями';

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE `region` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Область України';

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`id`, `name`) VALUES
(1, 'Київська'),
(2, 'Житомирська'),
(3, 'Вінницька'),
(4, 'Рівненська');

-- --------------------------------------------------------

--
-- Структура таблицы `transmission`
--

CREATE TABLE `transmission` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Вид коробки передач';

--
-- Дамп данных таблицы `transmission`
--

INSERT INTO `transmission` (`id`, `name`) VALUES
(1, 'Автомат'),
(2, 'Варіатор'),
(3, 'Робот');

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_currency`
--

CREATE TABLE `type_of_currency` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва валюти',
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Абревіатура валюти',
  `sign` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Знак валюти'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Назва валюти';

--
-- Дамп данных таблицы `type_of_currency`
--

INSERT INTO `type_of_currency` (`id`, `name`, `abbreviation`, `sign`) VALUES
(1, 'Долар США', 'USD', '$'),
(2, 'Євро', 'EUR', '€'),
(3, 'Гривня', 'UAH', '₴');

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

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `lastname`, `login`, `password`, `phone`, `is_admin`, `image_id`) VALUES
(1, 'Владислав', 'Гейна', 'Сергійович', 'vladgeina@gmail.com', 'c97fccc51332acbcc3a323c216d2a96a', '0937660691', 1, 1),
(6, 'Руслан', 'Пархомчук', 'Вікторович', 'ruslan@gmail.com', '1bbd886460827015e5d605ed44252251', '0930930912', 0, 57),
(7, 'Денис', 'Богайчук', 'Володимирович', 'den123@gmail.com', '4297f44b13955235245b2497399d7a93', '0937000691', 0, NULL),
(22, 'HEINA2', 'VLADYSLAV2', 'Сергійович2', 'vladgeina444@gmail.com', 'c8837b23ff8aaa8a2dde915473ce0991', '0932321232', 0, NULL);

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
-- Дамп данных таблицы `wheel_drive`
--

INSERT INTO `wheel_drive` (`id`, `name`) VALUES
(1, 'Повний'),
(2, 'Передній'),
(3, 'Задній');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin_message`
--
ALTER TABLE `admin_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `user_admin_id` (`user_admin_id`);

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
  ADD KEY `fuel_id` (`fuel_id`),
  ADD KEY `type_of_currency_id` (`type_of_currency_id`);

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_comparison_ibfk_1` (`car_ad_id`);

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
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- Индексы таблицы `type_of_currency`
--
ALTER TABLE `type_of_currency`
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
-- AUTO_INCREMENT для таблицы `admin_message`
--
ALTER TABLE `admin_message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `car_ad`
--
ALTER TABLE `car_ad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `car_brand`
--
ALTER TABLE `car_brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `car_comparison`
--
ALTER TABLE `car_comparison`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `car_image`
--
ALTER TABLE `car_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `car_model`
--
ALTER TABLE `car_model`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `favorite_ad`
--
ALTER TABLE `favorite_ad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `fuel`
--
ALTER TABLE `fuel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `region`
--
ALTER TABLE `region`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `transmission`
--
ALTER TABLE `transmission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `type_of_currency`
--
ALTER TABLE `type_of_currency`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `user_review`
--
ALTER TABLE `user_review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `wheel_drive`
--
ALTER TABLE `wheel_drive`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `admin_message`
--
ALTER TABLE `admin_message`
  ADD CONSTRAINT `admin_message_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `admin_message_ibfk_2` FOREIGN KEY (`user_admin_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`car_brand_id`) REFERENCES `car_brand` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`car_model_id`) REFERENCES `car_model` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`wheel_drive_id`) REFERENCES `wheel_drive` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_4` FOREIGN KEY (`transmission_id`) REFERENCES `transmission` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_5` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_6` FOREIGN KEY (`fuel_id`) REFERENCES `fuel` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_ibfk_7` FOREIGN KEY (`type_of_currency_id`) REFERENCES `type_of_currency` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
  ADD CONSTRAINT `car_comparison_ibfk_1` FOREIGN KEY (`car_ad_id`) REFERENCES `car_ad` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
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
-- Ограничения внешнего ключа таблицы `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
