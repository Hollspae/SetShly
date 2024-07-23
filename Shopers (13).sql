-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3309
-- Время создания: Июл 23 2024 г., 10:41
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Shopers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Карта пользователя`
--

CREATE TABLE `Карта пользователя` (
  `ID Оплаты пользователя` int NOT NULL,
  `ID Пользователя` int NOT NULL,
  `Номер карты` bigint NOT NULL,
  `Срок действия` int NOT NULL,
  `CVV` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Карта пользователя`
--

INSERT INTO `Карта пользователя` (`ID Оплаты пользователя`, `ID Пользователя`, `Номер карты`, `Срок действия`, `CVV`) VALUES
(1, 1, 2222222222222222, 1, 1),
(2, 1, 1231123112311231, 2233, 123),
(3, 1, 1111111111111111, 1111, 111),
(4, 3, 1111222233334444, 1231, 123),
(5, 3, 1231231231231231, 3123, 123),
(7, 2, 2222222222333323, 2222, 333),
(8, 3, 4444444444444444, 4444, 444),
(9, 1, 2202330344058693, 1929, 333),
(10, 4, 2202330455684233, 2328, 332),
(11, 4, 2464324442433423, 1528, 235),
(14, 5, 2202330455684234, 1122, 321);

-- --------------------------------------------------------

--
-- Структура таблицы `Категория`
--

CREATE TABLE `Категория` (
  `ID_Категории` int NOT NULL,
  `Наименование` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Категория`
--

INSERT INTO `Категория` (`ID_Категории`, `Наименование`) VALUES
(1, 'Футболка'),
(2, 'Джинсы'),
(3, 'Носки'),
(4, 'Худи'),
(5, 'Майка');

-- --------------------------------------------------------

--
-- Структура таблицы `Корзина`
--

CREATE TABLE `Корзина` (
  `ID Корзины` int NOT NULL,
  `ID Пользователя` int NOT NULL,
  `Сумма` int NOT NULL,
  `Дата формирования` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Корзина`
--

INSERT INTO `Корзина` (`ID Корзины`, `ID Пользователя`, `Сумма`, `Дата формирования`) VALUES
(1, 1, 2480, '2024-06-03'),
(2, 2, 1, '2024-05-23'),
(3, 3, 1, '2024-05-31'),
(4, 4, 2100, '2024-06-12'),
(6, 5, 1, '2024-06-20');

-- --------------------------------------------------------

--
-- Структура таблицы `Материал`
--

CREATE TABLE `Материал` (
  `ID Материала` int NOT NULL,
  `Название` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Состав` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Материал`
--

INSERT INTO `Материал` (`ID Материала`, `Название`, `Состав`) VALUES
(1, 'Футболка (хлопок, лайкра)', 'Хлопок, лайкра'),
(2, 'Джинсы (хлопок, спандекс)', '90% хлопок; 10% спандекс; хлопок; спандекс'),
(3, 'Носки (хлопок, лайкра)', 'Хлопок 95%; Лайкра 5%');

-- --------------------------------------------------------

--
-- Структура таблицы `Отзыв`
--

CREATE TABLE `Отзыв` (
  `ID Отзыва` int NOT NULL,
  `ID Пользователя` int NOT NULL,
  `ID Товара` int NOT NULL,
  `Дата` date NOT NULL,
  `Содержание` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Оценка` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Отзыв`
--

INSERT INTO `Отзыв` (`ID Отзыва`, `ID Пользователя`, `ID Товара`, `Дата`, `Содержание`, `Оценка`) VALUES
(1, 3, 6, '2024-06-19', 'Просто прекрасные джинсы. Подошли и мне, и сыну.\r\n\r\nСынуля прям Джеймс Бонд!!', '5'),
(2, 3, 2, '2024-06-19', 'Взяла на размер больше, чем нужно было, не подошли(\r\nМатериал хороший и вышивка сделана качественно!', '4'),
(3, 3, 3, '2024-06-19', 'Взяла сразу несколько, приду за второй партией', '5'),
(4, 3, 4, '2024-06-19', 'Брала дочери, очень понравилось!', '5'),
(5, 3, 5, '2024-06-21', 'Хуйня!', '3'),
(6, 3, 5, '2024-06-21', 'Хуйня!', '3'),
(7, 3, 5, '2024-06-21', 'Хуйня!', '3');

-- --------------------------------------------------------

--
-- Структура таблицы `Пользователь`
--

CREATE TABLE `Пользователь` (
  `ID Пользователя` int NOT NULL,
  `ID_Роли` int NOT NULL,
  `Фамилия` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Имя` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Номер телефона` bigint NOT NULL,
  `Пароль` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Пользователь`
--

INSERT INTO `Пользователь` (`ID Пользователя`, `ID_Роли`, `Фамилия`, `Имя`, `Номер телефона`, `Пароль`) VALUES
(1, 2, 'Михеев', 'Андрей', 79097265767, 'Qwe123'),
(2, 2, 'Арарат', 'Василий', 79876543210, 'Qwe123'),
(3, 2, 'Вилькова', 'Ксения', 79655686041, 'Qwe123'),
(4, 1, 'Мирап', 'Асен', 79097265723, 'Qwe123'),
(5, 1, 'Миронов', 'Марией', 79655686042, 'Qwe123');

-- --------------------------------------------------------

--
-- Структура таблицы `Поставка`
--

CREATE TABLE `Поставка` (
  `ID Поставки` int NOT NULL,
  `ID Статуса Поставки` int NOT NULL,
  `ID Поставщика` int NOT NULL,
  `Дата` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Поставка`
--

INSERT INTO `Поставка` (`ID Поставки`, `ID Статуса Поставки`, `ID Поставщика`, `Дата`) VALUES
(1, 2, 1, '2024-04-24');

-- --------------------------------------------------------

--
-- Структура таблицы `Поставщик`
--

CREATE TABLE `Поставщик` (
  `ID Поставщика` int NOT NULL,
  `Название` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Телефон` bigint NOT NULL,
  `Юридический адрес` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ИНН` int NOT NULL,
  `ОГРН` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Поставщик`
--

INSERT INTO `Поставщик` (`ID Поставщика`, `Название`, `Телефон`, `Юридический адрес`, `ИНН`, `ОГРН`) VALUES
(1, 'Мой поставщик', 89655686041, 'Юр адрес', 123, 123);

-- --------------------------------------------------------

--
-- Структура таблицы `Прайс-лист_товаров`
--

CREATE TABLE `Прайс-лист_товаров` (
  `ID_Прайс-листа_товаров` int NOT NULL,
  `ID Товара` int NOT NULL COMMENT 'Индекс',
  `Цена` int NOT NULL COMMENT 'Индекс',
  `Дата` date NOT NULL COMMENT 'Индекс'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Прайс-лист_товаров`
--

INSERT INTO `Прайс-лист_товаров` (`ID_Прайс-листа_товаров`, `ID Товара`, `Цена`, `Дата`) VALUES
(1, 2, 3340, '2024-03-06'),
(2, 3, 720, '2024-03-04'),
(3, 4, 2100, '2024-04-24'),
(4, 5, 1890, '2024-06-19'),
(5, 6, 2350, '2024-06-19'),
(6, 3, 820, '2024-06-19'),
(7, 3, 330, '2024-06-19'),
(8, 2, 2890, '2024-06-19'),
(9, 6, 2450, '2024-06-20'),
(10, 6, 2350, '2024-06-20'),
(11, 2, 1890, '2024-06-20'),
(12, 7, 999, '2024-06-20');

-- --------------------------------------------------------

--
-- Структура таблицы `Прайс-лист материала`
--

CREATE TABLE `Прайс-лист материала` (
  `ID Материала` int NOT NULL,
  `ID Прайс-листа материала` int NOT NULL,
  `Цена` int NOT NULL,
  `Дата` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Прайс-лист сервиса`
--

CREATE TABLE `Прайс-лист сервиса` (
  `ID Прайс листа сервиса` int NOT NULL,
  `ID Сервиса доставки` int NOT NULL,
  `Цена (руб)` int NOT NULL,
  `Минимальный вес` int NOT NULL,
  `Максимальный вес` int NOT NULL,
  `Дата` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Прайс-лист сервиса`
--

INSERT INTO `Прайс-лист сервиса` (`ID Прайс листа сервиса`, `ID Сервиса доставки`, `Цена (руб)`, `Минимальный вес`, `Максимальный вес`, `Дата`) VALUES
(1, 1, 186, 500, 0, '2023-12-06'),
(2, 1, 211, 1000, 0, '2023-12-06'),
(3, 1, 236, 2000, 0, '2023-12-06'),
(4, 1, 311, 2500, 0, '2023-12-06');

-- --------------------------------------------------------

--
-- Структура таблицы `Вид оплаты`
--

CREATE TABLE `Вид оплаты` (
  `ID Оплаты` int NOT NULL,
  `Тип` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Вид оплаты`
--

INSERT INTO `Вид оплаты` (`ID Оплаты`, `Тип`) VALUES
(1, '100%'),
(2, '50% при оформлении заказа, 50% при получении'),
(3, 'После поулчения');

-- --------------------------------------------------------

--
-- Структура таблицы `Вышивка`
--

CREATE TABLE `Вышивка` (
  `ID_Вышивки` int NOT NULL,
  `Название` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Описание` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Фото` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Вышивка`
--

INSERT INTO `Вышивка` (`ID_Вышивки`, `Название`, `Описание`, `Фото`) VALUES
(1, 'Волна', 'Вышивка nike - волна', ''),
(4, 'Руки', 'Вышивка двух рук', ''),
(5, 'Смайлик', 'Вышивка со смайликом', ''),
(7, 'Акула', 'Вышивка акулы', ''),
(8, 'Сердечки', 'Вышивка с nike-сердечками', 'ФЫ'),
(9, 'Рука и лапа', 'Вышивка руки и лапки', 'фыв'),
(10, 'Цветочки', 'Вышивка с цветочками', 'Цветочки.png'),
(12, 'Рыбка', 'Вышивка с рыбкой для футболки', 'Рыбка.png'),
(13, 'Цветы', 'Описание вышивки', 'Цветы.png');

-- --------------------------------------------------------

--
-- Структура таблицы `Доставка`
--

CREATE TABLE `Доставка` (
  `ID Доставки` int NOT NULL,
  `ID Сервиса` int NOT NULL COMMENT 'Индекс',
  `Индекс города` int NOT NULL,
  `Край` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Город` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Улица` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Номер дома` int NOT NULL,
  `Дата отправки` datetime NOT NULL,
  `Дата получения` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Доставка`
--

INSERT INTO `Доставка` (`ID Доставки`, `ID Сервиса`, `Индекс города`, `Край`, `Город`, `Улица`, `Номер дома`, `Дата отправки`, `Дата получения`) VALUES
(1, 2, 618417, 'Пермский край', 'Березники', 'Советская площадь', 3, '2024-05-29 09:43:29', '2024-05-29 09:43:29'),
(2, 2, 618416, 'Пермский край', 'Березники', 'Ломоносова', 108, '2024-05-29 09:44:47', '2024-05-29 09:44:47');

-- --------------------------------------------------------

--
-- Структура таблицы `Заказ`
--

CREATE TABLE `Заказ` (
  `ID заказа` int NOT NULL,
  `ID Списка товаров заказа` int NOT NULL,
  `ID статуса заказа` int NOT NULL,
  `ID доставки` int NOT NULL,
  `ID оплаты пользователя` int NOT NULL,
  `Дата заказа` date NOT NULL,
  `Дата получения` date NOT NULL,
  `Сумма` int NOT NULL,
  `Определитель` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Заказ`
--

INSERT INTO `Заказ` (`ID заказа`, `ID Списка товаров заказа`, `ID статуса заказа`, `ID доставки`, `ID оплаты пользователя`, `Дата заказа`, `Дата получения`, `Сумма`, `Определитель`) VALUES
(1, 2, 5, 1, 8, '2024-06-21', '2024-06-28', 3780, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Изготовление`
--

CREATE TABLE `Изготовление` (
  `ID Изготовления` int NOT NULL,
  `ID Списка Материалов` int NOT NULL COMMENT 'Индекс',
  `ID Товара` int NOT NULL COMMENT 'Индекс',
  `ID Вышивки` int NOT NULL COMMENT 'Индекс',
  `Количество` int NOT NULL,
  `Дата` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Изготовление`
--

INSERT INTO `Изготовление` (`ID Изготовления`, `ID Списка Материалов`, `ID Товара`, `ID Вышивки`, `Количество`, `Дата`) VALUES
(10, 7, 2, 7, 3, '2023-12-06'),
(11, 8, 2, 7, 6, '2023-12-06'),
(27, 12, 3, 8, 3, '2024-04-05'),
(28, 13, 3, 8, 3, '2023-12-06'),
(29, 14, 3, 8, 3, '2023-12-06'),
(30, 15, 3, 8, 3, '2023-12-06'),
(31, 16, 3, 8, 3, '2023-12-06'),
(32, 17, 3, 8, 3, '2023-12-06'),
(36, 18, 4, 9, 5, '2024-04-24'),
(37, 19, 4, 9, 5, '2024-04-24'),
(38, 20, 4, 9, 5, '2024-04-24'),
(39, 21, 4, 9, 5, '2024-04-24'),
(40, 22, 5, 12, 6, '2024-06-19'),
(41, 23, 5, 12, 6, '2024-06-19'),
(42, 24, 5, 12, 6, '2024-06-19'),
(43, 31, 6, 10, 8, '2024-06-19'),
(44, 32, 6, 10, 8, '2024-06-19'),
(45, 33, 6, 10, 8, '2024-06-19'),
(46, 34, 6, 10, 8, '2024-06-19'),
(59, 71, 5, 12, 1, '2024-04-24'),
(60, 72, 5, 12, 1, '2024-04-24');

-- --------------------------------------------------------

--
-- Структура таблицы `Скидочный промокод`
--

CREATE TABLE `Скидочный промокод` (
  `ID скидочного промокода` int NOT NULL,
  `Наименование` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Скидка` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Скидочный промокод`
--

INSERT INTO `Скидочный промокод` (`ID скидочного промокода`, `Наименование`, `Скидка`) VALUES
(1, 'NODISCONT', 0),
(2, 'ALLDISC', 15);

-- --------------------------------------------------------

--
-- Структура таблицы `Список Материалов`
--

CREATE TABLE `Список Материалов` (
  `ID Списка Материалов` int NOT NULL,
  `ID Материала` int NOT NULL COMMENT 'Индекс',
  `ID Цвета` int NOT NULL COMMENT 'Индекс',
  `ID Размера` int NOT NULL COMMENT 'Индекс',
  `Количество` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Список Материалов`
--

INSERT INTO `Список Материалов` (`ID Списка Материалов`, `ID Материала`, `ID Цвета`, `ID Размера`, `Количество`) VALUES
(1, 1, 7, 2, 2),
(2, 1, 7, 5, 1),
(3, 1, 7, 1, 1),
(4, 1, 3, 2, 1),
(5, 1, 5, 2, 1),
(6, 1, 3, 1, 1),
(7, 2, 2, 2, 4),
(8, 2, 2, 3, 6),
(12, 3, 3, 2, 1),
(13, 3, 3, 1, 1),
(14, 3, 7, 2, 2),
(15, 3, 7, 3, 2),
(16, 3, 7, 1, 1),
(17, 3, 8, 2, 10),
(18, 1, 3, 1, 1),
(19, 1, 3, 2, 1),
(20, 1, 7, 2, 2),
(21, 1, 7, 3, 2),
(22, 1, 4, 1, 1),
(23, 1, 4, 2, 2),
(24, 1, 4, 3, 1),
(25, 1, 4, 1, 1),
(26, 1, 4, 2, 2),
(27, 1, 4, 3, 1),
(28, 1, 3, 1, 3),
(29, 1, 3, 2, 2),
(30, 1, 3, 3, 1),
(31, 2, 2, 1, 1),
(32, 2, 2, 2, 4),
(33, 2, 2, 3, 2),
(34, 2, 2, 4, 2),
(35, 2, 4, 1, 1),
(36, 2, 4, 2, 2),
(37, 2, 4, 3, 2),
(38, 2, 4, 4, 2),
(39, 2, 4, 1, 1),
(40, 2, 4, 2, 2),
(41, 2, 4, 3, 2),
(42, 2, 4, 4, 2),
(43, 1, 3, 1, 2),
(44, 1, 3, 2, 1),
(45, 1, 3, 3, 2),
(46, 1, 3, 5, 3),
(47, 1, 3, 1, 2),
(48, 1, 3, 2, 1),
(49, 1, 3, 3, 2),
(50, 1, 3, 5, 3),
(51, 1, 4, 1, 1),
(52, 1, 4, 2, 1),
(53, 1, 4, 3, 2),
(54, 1, 4, 5, 3),
(55, 1, 3, 1, 2),
(56, 1, 3, 2, 1),
(57, 1, 3, 3, 2),
(58, 1, 3, 5, 3),
(59, 1, 1, 1, 2),
(60, 1, 1, 2, 1),
(61, 1, 1, 3, 2),
(62, 1, 1, 5, 3),
(63, 1, 1, 1, 2),
(64, 1, 1, 2, 1),
(65, 1, 1, 3, 2),
(66, 1, 1, 5, 3),
(67, 1, 4, 1, 1),
(68, 1, 4, 2, 1),
(69, 1, 4, 3, 2),
(70, 1, 4, 5, 3),
(71, 1, 3, 1, 1),
(72, 1, 3, 2, 3),
(73, 1, 3, 1, 1),
(74, 1, 3, 2, 2),
(75, 1, 3, 3, 3),
(76, 1, 3, 1, 1),
(77, 1, 3, 2, 2),
(78, 1, 3, 3, 3),
(79, 1, 3, 1, 3),
(80, 1, 3, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Список товаров`
--

CREATE TABLE `Список товаров` (
  `ID Списка товаров` int NOT NULL,
  `ID Изготовления` int NOT NULL COMMENT 'Индекс',
  `ID Корзины` int NOT NULL COMMENT 'Индекс',
  `Количество` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Список товаров`
--

INSERT INTO `Список товаров` (`ID Списка товаров`, `ID Изготовления`, `ID Корзины`, `Количество`) VALUES
(7, 46, 2, 1),
(10, 38, 4, 2),
(12, 43, 1, 1),
(18, 60, 6, 1),
(19, 40, 3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Список товаров заказа`
--

CREATE TABLE `Список товаров заказа` (
  `ID Списка товаров заказа` int NOT NULL,
  `ID Пользователя` int NOT NULL COMMENT 'Индекс',
  `ID Изготовления` int NOT NULL COMMENT 'Индекс',
  `Количество` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Список товаров заказа`
--

INSERT INTO `Список товаров заказа` (`ID Списка товаров заказа`, `ID Пользователя`, `ID Изготовления`, `Количество`) VALUES
(1, 2, 30, 1),
(2, 3, 40, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Список фотографий изготовления`
--

CREATE TABLE `Список фотографий изготовления` (
  `ID Списка фото изготовления` int NOT NULL,
  `ID Изготовления` int NOT NULL,
  `ID Фотографии изготовления` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Список фотографий отзывов`
--

CREATE TABLE `Список фотографий отзывов` (
  `ID Списка фотографий отзывов` int NOT NULL,
  `ID Отзыва` int NOT NULL COMMENT 'Индекс',
  `ID Фотографии отзыва` int NOT NULL COMMENT 'Индекс'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Список фотографий отзывов`
--

INSERT INTO `Список фотографий отзывов` (`ID Списка фотографий отзывов`, `ID Отзыва`, `ID Фотографии отзыва`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Сервис доставки`
--

CREATE TABLE `Сервис доставки` (
  `ID сервиса` int NOT NULL,
  `Наименование` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Актуальность` tinyint(1) NOT NULL,
  `Дата` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Сервис доставки`
--

INSERT INTO `Сервис доставки` (`ID сервиса`, `Наименование`, `Актуальность`, `Дата`) VALUES
(1, 'Почта России', 1, '2023-12-06'),
(2, 'СДЭК', 1, '2023-12-06');

-- --------------------------------------------------------

--
-- Структура таблицы `Товар`
--

CREATE TABLE `Товар` (
  `ID_Товара` int NOT NULL,
  `ID_Категории` int NOT NULL COMMENT 'Индекс',
  `Название` text NOT NULL,
  `Описание` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Товар`
--

INSERT INTO `Товар` (`ID_Товара`, `ID_Категории`, `Название`, `Описание`) VALUES
(2, 2, 'Джинсы с акулой', 'Крутые джинсы для крутых ребят'),
(3, 3, 'Носки с сердечками', 'Описание носков'),
(4, 1, 'Футболка с рукой и лапой', 'Описание футболки'),
(5, 1, 'Футболка с рыбками', 'Отличная футболка на любое время года Если вы едете на море то обязательно берем данную футболку с вышивкой рыбок'),
(6, 2, 'Джинсы с цветочками', 'Широкие джинсы подойдут для любых прогулок Удобны в ношении'),
(7, 1, 'Тестовый товар', 'Описание товара');

-- --------------------------------------------------------

--
-- Структура таблицы `Статус Поставки`
--

CREATE TABLE `Статус Поставки` (
  `ID Статуса Поставки` int NOT NULL,
  `Название` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Статус Поставки`
--

INSERT INTO `Статус Поставки` (`ID Статуса Поставки`, `Название`) VALUES
(1, 'В пути'),
(2, 'Доставлено');

-- --------------------------------------------------------

--
-- Структура таблицы `Статус заказа`
--

CREATE TABLE `Статус заказа` (
  `ID статуса заказа` int NOT NULL,
  `Название` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Статус заказа`
--

INSERT INTO `Статус заказа` (`ID статуса заказа`, `Название`) VALUES
(1, 'В сборке'),
(2, 'Передано в доставку'),
(3, 'В пути'),
(4, 'Готов к получению'),
(5, 'Доставлено');

-- --------------------------------------------------------

--
-- Структура таблицы `Строки приход`
--

CREATE TABLE `Строки приход` (
  `ID Строк прихода` int NOT NULL,
  `ID Материала` int NOT NULL,
  `ID Поставки` int NOT NULL,
  `Количество` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Строки приход`
--

INSERT INTO `Строки приход` (`ID Строк прихода`, `ID Материала`, `ID Поставки`, `Количество`) VALUES
(1, 1, 1, 50),
(2, 2, 1, 10),
(3, 3, 1, 22);

-- --------------------------------------------------------

--
-- Структура таблицы `Фотографии изготовления`
--

CREATE TABLE `Фотографии изготовления` (
  `ID Фотографии изготовления` int NOT NULL,
  `Фото` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Фотографии отзыва`
--

CREATE TABLE `Фотографии отзыва` (
  `ID фотографии отзыва` int NOT NULL,
  `Фото` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Фотографии отзыва`
--

INSERT INTO `Фотографии отзыва` (`ID фотографии отзыва`, `Фото`) VALUES
(1, 'tn — копия (2).jpg'),
(2, 'tn.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `Цветовой_код`
--

CREATE TABLE `Цветовой_код` (
  `ID_Цветового_кода` int NOT NULL,
  `Название` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Цветовой_код`
--

INSERT INTO `Цветовой_код` (`ID_Цветового_кода`, `Название`) VALUES
(1, 'Красный'),
(2, 'Синий'),
(3, 'Белый'),
(4, 'Черный'),
(5, 'Зеленый'),
(6, 'Желтый'),
(7, 'Голубой'),
(8, 'Розовый');

-- --------------------------------------------------------

--
-- Структура таблицы `Размер`
--

CREATE TABLE `Размер` (
  `ID_Размера` int NOT NULL,
  `Наименование` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Описание` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Размер`
--

INSERT INTO `Размер` (`ID_Размера`, `Наименование`, `Описание`) VALUES
(1, 'S', '42-44'),
(2, 'M', '44-46'),
(3, 'L', '46-48'),
(4, 'XL', '48-50'),
(5, '2XL', '50-52');

-- --------------------------------------------------------

--
-- Структура таблицы `Роль`
--

CREATE TABLE `Роль` (
  `ID_Роли` int NOT NULL,
  `Наименование` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Роль`
--

INSERT INTO `Роль` (`ID_Роли`, `Наименование`) VALUES
(1, 'Администратор'),
(2, 'Пользователь');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Карта пользователя`
--
ALTER TABLE `Карта пользователя`
  ADD PRIMARY KEY (`ID Оплаты пользователя`),
  ADD KEY `ID Пользователя` (`ID Пользователя`);

--
-- Индексы таблицы `Категория`
--
ALTER TABLE `Категория`
  ADD PRIMARY KEY (`ID_Категории`);

--
-- Индексы таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD PRIMARY KEY (`ID Корзины`),
  ADD UNIQUE KEY `IDUser` (`ID Пользователя`),
  ADD UNIQUE KEY `ID Пользователя` (`ID Пользователя`),
  ADD UNIQUE KEY `ID Пользователя_2` (`ID Пользователя`);

--
-- Индексы таблицы `Материал`
--
ALTER TABLE `Материал`
  ADD PRIMARY KEY (`ID Материала`);

--
-- Индексы таблицы `Отзыв`
--
ALTER TABLE `Отзыв`
  ADD PRIMARY KEY (`ID Отзыва`),
  ADD KEY `ID Отзыва` (`ID Пользователя`),
  ADD KEY `ID Товара` (`ID Товара`);

--
-- Индексы таблицы `Пользователь`
--
ALTER TABLE `Пользователь`
  ADD PRIMARY KEY (`ID Пользователя`),
  ADD KEY `ID_Роли` (`ID_Роли`);

--
-- Индексы таблицы `Поставка`
--
ALTER TABLE `Поставка`
  ADD PRIMARY KEY (`ID Поставки`),
  ADD UNIQUE KEY `IDStatusShipment` (`ID Статуса Поставки`),
  ADD UNIQUE KEY `IDProvider` (`ID Поставщика`);

--
-- Индексы таблицы `Поставщик`
--
ALTER TABLE `Поставщик`
  ADD PRIMARY KEY (`ID Поставщика`);

--
-- Индексы таблицы `Прайс-лист_товаров`
--
ALTER TABLE `Прайс-лист_товаров`
  ADD PRIMARY KEY (`ID_Прайс-листа_товаров`),
  ADD KEY `ID Товара` (`ID Товара`),
  ADD KEY `ID Товара_2` (`ID Товара`),
  ADD KEY `Цена` (`Цена`,`Дата`);

--
-- Индексы таблицы `Прайс-лист материала`
--
ALTER TABLE `Прайс-лист материала`
  ADD PRIMARY KEY (`ID Прайс-листа материала`),
  ADD UNIQUE KEY `ID Материала` (`ID Материала`);

--
-- Индексы таблицы `Прайс-лист сервиса`
--
ALTER TABLE `Прайс-лист сервиса`
  ADD PRIMARY KEY (`ID Прайс листа сервиса`),
  ADD KEY `ID Сервиса доставки` (`ID Сервиса доставки`);

--
-- Индексы таблицы `Вид оплаты`
--
ALTER TABLE `Вид оплаты`
  ADD PRIMARY KEY (`ID Оплаты`);

--
-- Индексы таблицы `Вышивка`
--
ALTER TABLE `Вышивка`
  ADD PRIMARY KEY (`ID_Вышивки`);

--
-- Индексы таблицы `Доставка`
--
ALTER TABLE `Доставка`
  ADD PRIMARY KEY (`ID Доставки`),
  ADD KEY `ID сервиса` (`ID Сервиса`);

--
-- Индексы таблицы `Заказ`
--
ALTER TABLE `Заказ`
  ADD PRIMARY KEY (`ID заказа`),
  ADD KEY `ID доставки` (`ID доставки`),
  ADD KEY `ID статуса заказа` (`ID статуса заказа`),
  ADD KEY `ID корзины` (`ID Списка товаров заказа`,`ID статуса заказа`,`ID доставки`),
  ADD KEY `ID Списка товаров заказа` (`ID Списка товаров заказа`,`ID статуса заказа`,`ID доставки`),
  ADD KEY `ID Списка товаров_2` (`ID Списка товаров заказа`,`ID статуса заказа`,`ID доставки`,`ID оплаты пользователя`),
  ADD KEY `ID оплаты пользователя` (`ID оплаты пользователя`);

--
-- Индексы таблицы `Изготовление`
--
ALTER TABLE `Изготовление`
  ADD PRIMARY KEY (`ID Изготовления`),
  ADD KEY `ID Списка Материалов` (`ID Списка Материалов`,`ID Товара`,`ID Вышивки`),
  ADD KEY `ID Вышивки` (`ID Вышивки`),
  ADD KEY `ID Товара` (`ID Товара`);

--
-- Индексы таблицы `Скидочный промокод`
--
ALTER TABLE `Скидочный промокод`
  ADD PRIMARY KEY (`ID скидочного промокода`);

--
-- Индексы таблицы `Список Материалов`
--
ALTER TABLE `Список Материалов`
  ADD PRIMARY KEY (`ID Списка Материалов`),
  ADD KEY `ID Материала` (`ID Материала`,`ID Цвета`,`ID Размера`),
  ADD KEY `ID Цвета` (`ID Цвета`),
  ADD KEY `ID Размера` (`ID Размера`);

--
-- Индексы таблицы `Список товаров`
--
ALTER TABLE `Список товаров`
  ADD PRIMARY KEY (`ID Списка товаров`),
  ADD KEY `ID_Товара` (`ID Изготовления`),
  ADD KEY `ID_Корзины` (`ID Корзины`),
  ADD KEY `ID Изготовления` (`ID Изготовления`,`ID Корзины`);

--
-- Индексы таблицы `Список товаров заказа`
--
ALTER TABLE `Список товаров заказа`
  ADD PRIMARY KEY (`ID Списка товаров заказа`),
  ADD KEY `ID Пользователя` (`ID Пользователя`),
  ADD KEY `ID Изготовления` (`ID Изготовления`);

--
-- Индексы таблицы `Список фотографий изготовления`
--
ALTER TABLE `Список фотографий изготовления`
  ADD KEY `ID Изготовления` (`ID Изготовления`);

--
-- Индексы таблицы `Список фотографий отзывов`
--
ALTER TABLE `Список фотографий отзывов`
  ADD PRIMARY KEY (`ID Списка фотографий отзывов`),
  ADD KEY `ID Отзыва` (`ID Отзыва`,`ID Фотографии отзыва`),
  ADD KEY `ID Фотографии отзыва` (`ID Фотографии отзыва`);

--
-- Индексы таблицы `Сервис доставки`
--
ALTER TABLE `Сервис доставки`
  ADD PRIMARY KEY (`ID сервиса`);

--
-- Индексы таблицы `Товар`
--
ALTER TABLE `Товар`
  ADD PRIMARY KEY (`ID_Товара`),
  ADD KEY `ID_Категории` (`ID_Категории`);

--
-- Индексы таблицы `Статус Поставки`
--
ALTER TABLE `Статус Поставки`
  ADD PRIMARY KEY (`ID Статуса Поставки`);

--
-- Индексы таблицы `Статус заказа`
--
ALTER TABLE `Статус заказа`
  ADD PRIMARY KEY (`ID статуса заказа`);

--
-- Индексы таблицы `Строки приход`
--
ALTER TABLE `Строки приход`
  ADD PRIMARY KEY (`ID Строк прихода`),
  ADD KEY `ID Материала` (`ID Материала`),
  ADD KEY `ID Поставки` (`ID Поставки`);

--
-- Индексы таблицы `Фотографии отзыва`
--
ALTER TABLE `Фотографии отзыва`
  ADD PRIMARY KEY (`ID фотографии отзыва`);

--
-- Индексы таблицы `Цветовой_код`
--
ALTER TABLE `Цветовой_код`
  ADD PRIMARY KEY (`ID_Цветового_кода`);

--
-- Индексы таблицы `Размер`
--
ALTER TABLE `Размер`
  ADD PRIMARY KEY (`ID_Размера`);

--
-- Индексы таблицы `Роль`
--
ALTER TABLE `Роль`
  ADD PRIMARY KEY (`ID_Роли`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Карта пользователя`
--
ALTER TABLE `Карта пользователя`
  MODIFY `ID Оплаты пользователя` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `Корзина`
--
ALTER TABLE `Корзина`
  MODIFY `ID Корзины` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Отзыв`
--
ALTER TABLE `Отзыв`
  MODIFY `ID Отзыва` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Пользователь`
--
ALTER TABLE `Пользователь`
  MODIFY `ID Пользователя` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Поставка`
--
ALTER TABLE `Поставка`
  MODIFY `ID Поставки` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Поставщик`
--
ALTER TABLE `Поставщик`
  MODIFY `ID Поставщика` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Прайс-лист_товаров`
--
ALTER TABLE `Прайс-лист_товаров`
  MODIFY `ID_Прайс-листа_товаров` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `Вышивка`
--
ALTER TABLE `Вышивка`
  MODIFY `ID_Вышивки` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `Доставка`
--
ALTER TABLE `Доставка`
  MODIFY `ID Доставки` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Заказ`
--
ALTER TABLE `Заказ`
  MODIFY `ID заказа` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Изготовление`
--
ALTER TABLE `Изготовление`
  MODIFY `ID Изготовления` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT для таблицы `Скидочный промокод`
--
ALTER TABLE `Скидочный промокод`
  MODIFY `ID скидочного промокода` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Список Материалов`
--
ALTER TABLE `Список Материалов`
  MODIFY `ID Списка Материалов` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT для таблицы `Список товаров`
--
ALTER TABLE `Список товаров`
  MODIFY `ID Списка товаров` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `Список товаров заказа`
--
ALTER TABLE `Список товаров заказа`
  MODIFY `ID Списка товаров заказа` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `Список фотографий отзывов`
--
ALTER TABLE `Список фотографий отзывов`
  MODIFY `ID Списка фотографий отзывов` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Сервис доставки`
--
ALTER TABLE `Сервис доставки`
  MODIFY `ID сервиса` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Товар`
--
ALTER TABLE `Товар`
  MODIFY `ID_Товара` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `Статус Поставки`
--
ALTER TABLE `Статус Поставки`
  MODIFY `ID Статуса Поставки` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Статус заказа`
--
ALTER TABLE `Статус заказа`
  MODIFY `ID статуса заказа` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Строки приход`
--
ALTER TABLE `Строки приход`
  MODIFY `ID Строк прихода` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Фотографии отзыва`
--
ALTER TABLE `Фотографии отзыва`
  MODIFY `ID фотографии отзыва` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `Цветовой_код`
--
ALTER TABLE `Цветовой_код`
  MODIFY `ID_Цветового_кода` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `Роль`
--
ALTER TABLE `Роль`
  MODIFY `ID_Роли` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Карта пользователя`
--
ALTER TABLE `Карта пользователя`
  ADD CONSTRAINT `карта пользователя_ibfk_1` FOREIGN KEY (`ID Пользователя`) REFERENCES `Пользователь` (`ID Пользователя`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD CONSTRAINT `корзина_ibfk_1` FOREIGN KEY (`ID Пользователя`) REFERENCES `Пользователь` (`ID Пользователя`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Отзыв`
--
ALTER TABLE `Отзыв`
  ADD CONSTRAINT `отзыв_ibfk_1` FOREIGN KEY (`ID Товара`) REFERENCES `Товар` (`ID_Товара`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Пользователь`
--
ALTER TABLE `Пользователь`
  ADD CONSTRAINT `пользователь_ibfk_1` FOREIGN KEY (`ID_Роли`) REFERENCES `Роль` (`ID_Роли`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Поставка`
--
ALTER TABLE `Поставка`
  ADD CONSTRAINT `поставка_ibfk_1` FOREIGN KEY (`ID Поставщика`) REFERENCES `Поставщик` (`ID Поставщика`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `поставка_ibfk_2` FOREIGN KEY (`ID Статуса Поставки`) REFERENCES `Статус Поставки` (`ID Статуса Поставки`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Прайс-лист_товаров`
--
ALTER TABLE `Прайс-лист_товаров`
  ADD CONSTRAINT `прайс-лист_товаров_ibfk_1` FOREIGN KEY (`ID Товара`) REFERENCES `Товар` (`ID_Товара`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Доставка`
--
ALTER TABLE `Доставка`
  ADD CONSTRAINT `доставка_ibfk_1` FOREIGN KEY (`ID Сервиса`) REFERENCES `Сервис доставки` (`ID сервиса`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Заказ`
--
ALTER TABLE `Заказ`
  ADD CONSTRAINT `заказ_ibfk_1` FOREIGN KEY (`ID доставки`) REFERENCES `Доставка` (`ID Доставки`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `заказ_ibfk_3` FOREIGN KEY (`ID статуса заказа`) REFERENCES `Статус заказа` (`ID статуса заказа`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `заказ_ibfk_4` FOREIGN KEY (`ID Списка товаров заказа`) REFERENCES `Список товаров заказа` (`ID Списка товаров заказа`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `заказ_ibfk_5` FOREIGN KEY (`ID оплаты пользователя`) REFERENCES `Карта пользователя` (`ID Оплаты пользователя`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Изготовление`
--
ALTER TABLE `Изготовление`
  ADD CONSTRAINT `изготовление_ibfk_1` FOREIGN KEY (`ID Вышивки`) REFERENCES `Вышивка` (`ID_Вышивки`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `изготовление_ibfk_2` FOREIGN KEY (`ID Товара`) REFERENCES `Товар` (`ID_Товара`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `изготовление_ibfk_3` FOREIGN KEY (`ID Списка Материалов`) REFERENCES `Список Материалов` (`ID Списка Материалов`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Список Материалов`
--
ALTER TABLE `Список Материалов`
  ADD CONSTRAINT `список материалов_ibfk_1` FOREIGN KEY (`ID Материала`) REFERENCES `Материал` (`ID Материала`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `список материалов_ibfk_2` FOREIGN KEY (`ID Цвета`) REFERENCES `Цветовой_код` (`ID_Цветового_кода`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `список материалов_ibfk_3` FOREIGN KEY (`ID Размера`) REFERENCES `Размер` (`ID_Размера`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Список товаров`
--
ALTER TABLE `Список товаров`
  ADD CONSTRAINT `список товаров_ibfk_1` FOREIGN KEY (`ID Изготовления`) REFERENCES `Изготовление` (`ID Изготовления`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `список товаров_ibfk_2` FOREIGN KEY (`ID Корзины`) REFERENCES `Корзина` (`ID Корзины`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Список товаров заказа`
--
ALTER TABLE `Список товаров заказа`
  ADD CONSTRAINT `список товаров заказа_ibfk_2` FOREIGN KEY (`ID Изготовления`) REFERENCES `Изготовление` (`ID Изготовления`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `список товаров заказа_ibfk_3` FOREIGN KEY (`ID Пользователя`) REFERENCES `Пользователь` (`ID Пользователя`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Список фотографий изготовления`
--
ALTER TABLE `Список фотографий изготовления`
  ADD CONSTRAINT `список фотографий изготовления_ibfk_1` FOREIGN KEY (`ID Изготовления`) REFERENCES `Изготовление` (`ID Изготовления`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Список фотографий отзывов`
--
ALTER TABLE `Список фотографий отзывов`
  ADD CONSTRAINT `список фотографий отзывов_ibfk_1` FOREIGN KEY (`ID Отзыва`) REFERENCES `Отзыв` (`ID Отзыва`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `список фотографий отзывов_ibfk_2` FOREIGN KEY (`ID Фотографии отзыва`) REFERENCES `Фотографии отзыва` (`ID фотографии отзыва`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Товар`
--
ALTER TABLE `Товар`
  ADD CONSTRAINT `товар_ibfk_1` FOREIGN KEY (`ID_Категории`) REFERENCES `Категория` (`ID_Категории`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Строки приход`
--
ALTER TABLE `Строки приход`
  ADD CONSTRAINT `строки приход_ibfk_1` FOREIGN KEY (`ID Материала`) REFERENCES `Материал` (`ID Материала`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `строки приход_ibfk_2` FOREIGN KEY (`ID Поставки`) REFERENCES `Поставка` (`ID Поставки`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
