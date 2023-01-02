-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 02 2023 г., 23:13
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

--
-- Дамп данных таблицы `admin_message`
--

INSERT INTO `admin_message` (`id`, `message_id`, `user_admin_id`) VALUES
(33, 15, 1);

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
  `additional_options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Додаткові опції автомобіля',
  `dollar_price` float NOT NULL COMMENT 'Ціна в доларах'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Інформація про автомобіль';

--
-- Дамп данных таблицы `car`
--

INSERT INTO `car` (`id`, `car_brand_id`, `car_model_id`, `year_of_production`, `engine_capacity`, `fuel_id`, `transmission_id`, `color`, `region_id`, `district`, `city`, `price`, `type_of_currency_id`, `wheel_drive_id`, `number_of_seats`, `mileage`, `additional_options`, `dollar_price`) VALUES
(1, 2, 2, 2020, 3, 1, 1, 'Сірий', 2, 'Бердичівський', 'Бердичів', 21000, 1, 1, 5, 59, 'Бортовий комп\'ютер, клімат, підігрів керма', 21000),
(4, 3, 4, 2020, 2.5, 1, 1, 'Сірий', 4, 'Рівненський', 'Рівне', 10000, 1, 1, 5, 120, 'Carplay, бортовий комп\'ютер, панорамний дах', 10000),
(7, 2, 1, 2021, 2.5, 1, 1, 'Сірий', 2, 'Житомирський', 'Житомир', 21000, 2, 1, 5, 20, NULL, 19672.1),
(9, 2, 3, 2022, 2.5, 1, 1, 'Чорний', 1, 'Київський', 'Київ', 25000, 1, 1, 5, 12, 'Бортовий комп\'ютер, carplay, підігрів сидінь, підігрів керма, панорамний дах', 25000),
(10, 5, 8, 2020, 3, 3, 1, 'Білий', 2, 'Бердичівський', 'Бердичів', 10000, 1, 2, 3, 100, NULL, 10000),
(11, 3, 9, 2019, 3, 3, 1, 'Чорний', 1, 'Київський', 'Київ', 45000, 1, 1, 5, 90, 'Дотяжки дверей, автопаркування, дістронік керування по полосам , повноцінні монітори, без дротова зарядка, два комплекта коліс, зима нова', 45000),
(12, 6, 10, 2018, 0, 4, 1, 'Сірий', 2, 'Житомирський', 'Житомир', 50000, 2, 1, 6, 41, NULL, 46838.4),
(13, 3, 11, 2018, 2, 3, 1, 'Сірий', 6, 'Львівський', 'Львів', 30750, 1, 1, 5, 148, NULL, 30750);

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
(9, 9, 'Audi A6 2022 Avant Quatro С8', 'Продам Audi A6 2022 Avant Quatro С8.<br />\r\nСтан чудовий, купувався в Німеччина для себе.', '2022-12-27 16:01:19', 1, 6),
(10, 10, 'Mercedes Sprinter 2020 Грузовий', 'Добрий день!<br />\r\nПродам машину!<br />\r\nДзвоніть', '2022-12-31 23:18:01', 1, 6),
(11, 11, 'Volkswagen Touareg 2019', 'Купляли в офіційного дилера, стан нової машини. Машина та салон ще в плівках вся ціла без підкрасів, вкладень не потребує взагалі, після щойно після т.о . <br />\r\nПитань по авто взагалі нема, розхід з дизелем однаковий, але їде краще! <br />\r\nОсновні агрегати ще на гарантії', '2023-01-02 14:17:39', 1, 7),
(12, 12, 'Tesla Model X 100d 2018', 'Авто в хорошому стані <br />\r\nIntel <br />\r\n100d<br />\r\nМаксимальна комплектація<br />\r\nЄвропейська навігація<br />\r\nМодем Зарядка в комплекті<br />\r\nДодаткові питання за телефоном', '2023-01-02 14:28:53', 1, 7),
(13, 13, 'Volkswagen Tiguan R LINE 2018', 'Продам Volkswagen Tiguan в модифікації R LINE 2018 року.<br />\r\nАвто купував в офіційного дилера.<br />\r\nПригнано зі Швеції.', '2023-01-02 14:41:02', 1, 23);

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
(3, 'Volkswagen'),
(5, 'Mercedes-Benz'),
(6, 'Tesla');

-- --------------------------------------------------------

--
-- Структура таблицы `car_comparison`
--

CREATE TABLE `car_comparison` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'ID користувача, що додав автомобіль до порівняння',
  `car_ad_id` int NOT NULL COMMENT 'ID оголошення, доданого до порівняння'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Порівняння автомобілів';

--
-- Дамп данных таблицы `car_comparison`
--

INSERT INTO `car_comparison` (`id`, `user_id`, `car_ad_id`) VALUES
(36, 7, 4);

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
(19, 53, 4, 0),
(20, 54, 4, 1),
(23, 58, 10, 0),
(24, 59, 10, 1),
(25, 60, 1, 0),
(26, 61, 1, 1),
(31, 66, 11, 1),
(32, 67, 11, 0),
(33, 68, 11, 0),
(34, 69, 11, 0),
(35, 70, 12, 1),
(36, 71, 12, 0),
(37, 72, 12, 0),
(38, 73, 12, 0),
(39, 74, 13, 0),
(40, 75, 13, 0),
(41, 76, 13, 0),
(42, 77, 13, 1),
(43, 78, 13, 0);

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
(4, 'Jetta', 3),
(8, 'Sprinter', 5),
(9, 'Touareg', 3),
(10, 'Model X', 6),
(11, 'Tiguan', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `favorite_ad`
--

CREATE TABLE `favorite_ad` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'ID користувача, який додав оголошення до обраного',
  `car_ad_id` int NOT NULL COMMENT 'ID оголошення, доданого до обраного'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Обрані оголошення';

--
-- Дамп данных таблицы `favorite_ad`
--

INSERT INTO `favorite_ad` (`id`, `user_id`, `car_ad_id`) VALUES
(41, 23, 1),
(42, 23, 4);

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
(57, '63af31f23d5be.jpg'),
(58, '63b098f912ebf.jpg'),
(59, '63b098fa76e8b.jpg'),
(60, '63b2ba7117b93.jpg'),
(61, '63b2ba7121332.jpg'),
(66, '63b2bdd05d479.jpg'),
(67, '63b2bdd06c4c7.jpg'),
(68, '63b2bdd0798d2.jpg'),
(69, '63b2bdd086ed4.jpg'),
(70, '63b2bff5b4ab9.jpg'),
(71, '63b2bff5c0155.jpg'),
(72, '63b2bff5ca879.jpg'),
(73, '63b2bff5d48ca.jpg'),
(74, '63b2c2ced9d05.jpg'),
(75, '63b2c2ceebe15.jpg'),
(76, '63b2c2cf05673.jpg'),
(77, '63b2c2cf13e48.jpg'),
(78, '63b2c2cf21991.jpg'),
(79, '63b3234541821.jpg');

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

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `text`, `user_id`, `date_of_creating`) VALUES
(15, 'Додайте таку то марку', 6, '2022-12-31 23:11:20');

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
(4, 'Рівненська'),
(6, 'Львівська');

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
(23, 'Петро', 'Петренко', 'Петрович', 'petro@gmail.com', '4297f44b13955235245b2497399d7a93', '0958726127', 0, NULL),
(24, 'Олександр', 'Волков', 'Максимович', 'alex@gmail.com', '4297f44b13955235245b2497399d7a93', '0937662312', 0, 79);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `car_ad`
--
ALTER TABLE `car_ad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `car_brand`
--
ALTER TABLE `car_brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `car_comparison`
--
ALTER TABLE `car_comparison`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `car_image`
--
ALTER TABLE `car_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `car_model`
--
ALTER TABLE `car_model`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `favorite_ad`
--
ALTER TABLE `favorite_ad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `fuel`
--
ALTER TABLE `fuel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `region`
--
ALTER TABLE `region`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `user_review`
--
ALTER TABLE `user_review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
