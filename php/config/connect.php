<?php
$connect = mysqli_connect('localhost', 'root', '', 'Shopers');
if (!$connect)
    [
        die('Ошибка подключения к бд')
    ];


$query_user_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Пользователь`'));

$product_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Товар`'));

$product_price_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Прайс-лист_товаров`'));

$material_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Список Материалов`'));

$production_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Изготовление`'));

$color_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Цветовой_код`'));

$size_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Размер`'));

$material = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Материал`'));

$embroidery = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Вышивка`'));

$category_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Категория`'));

$linesParish = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Строки приход`'));

$basket = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Корзина`'));

$list_productToBasket = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Список товаров`'));

$list_productToOrder = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Список товаров заказа`'));

$delivery = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Доставка`'));

$Card = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Карта пользователя`'));

$StatusOrder = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Статус заказа`'));

$Order = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Заказ`'));

$Sale = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Скидочный промокод`'));

$Role = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Роль`'));

$feedback = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Отзыв`'));

$photoFeedback_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Список фотографий отзывов`'));

$photoFeedback = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Фотографии отзыва`'));

?>