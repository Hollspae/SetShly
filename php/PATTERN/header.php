<?php
session_start();


// $product_list = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Товар`'));

// $product_price_list = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Прайс-лист_товаров`'));

// $product_color_list = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Список_цветов_товара`'));

// $query_user_list = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Пользователь`'));



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libs/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/png">
    <script src="https://unpkg.com/popper.js@1" defer></script>
    <script src="https://unpkg.com/tippy.js@5" defer></script>
    <script src="libs/swiper/swiper-bundle.min.js" defer></script>
    <script src="js/app.js" defer></script>
    <title>SetShly - Заказывай на свой вкус!</title>
</head>

<body id="body">
    <div class="preloader" id="preloader">
        <div class="spinner">
            <div class="blob top"></div>
            <div class="blob bottom"></div>
            <div class="blob left"></div>
            <div class="blob move-blob"></div>
        </div>
    </div>
    <div class="background-navigation display-none"></div>
    <header id="header">
        <form class="search" method="get"> <img src="img/search.png" alt="" draggable="false">
            <input type="search" name="search" placeholder="Поиск">
        </form>
        <h1><a href="../Index/index.php" style="color: #282b34;">SetShly</a></h1> <img class="logo" src="img/logo.png"
            alt="" draggable="false">
        <nav id="navigation-header" class="navigation-header">
            <ul id="menu">
                <li>
                    <div class="profile"><img src="img/profile.png" alt="Войти" draggable="false"></div>
                </li>
                <li>
                    <a href="../Liked/liked.html" class="liked"><img src="img/liked.png" alt="Избранное"
                            draggable="false"></a>
                </li>
                <li>
                    <a href="../Basket/basket.html" class="basket"><img src="img/basket.png" alt="Корзина"
                            draggable="false"></a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="authorization authorization-closed">
        <div class="closing-authorization"> <img src="img/closing.png" alt="Закрыть" draggable="false"> </div>
        <form method="post" action="formAuthorization.php">
            <h3>Вход</h3>
            <div class="inputs">
                <div class="login">
                    <label for="login">Логин </label>

                    <input type="text" name="login" id="login">
                </div>


                <div class="password">
                    <label for="password">Пароль</label>
                    <input type="password" name="password1" id="password1">
                </div>
            </div>

            <button type="submit" name="formSubmit1" value="Продолжить">Продолжить</button>
            <div class="registration-unlock">Регистрация</div>

        </form>
    </div>
    <div class="registration registration-closed">
        <div class="closing-registration"> <img src="img/closing.png" alt="Закрыть" draggable="false"> </div>
        <form method="post" action="formRegistration.php">
            <h3>Регистрация</h3>
            <div class="inputs">
                <div class="surname">
                    <label for="surname">Фамилия</label>
                    <input type="text" name="surname" id="surname">
                </div>
                <div class="name">
                    <label for="name">Имя</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="telephone">
                    <label for="telephone">Телефон</label>
                    <input type="text" name="telephone" id="telephone">
                </div>
                <div class="password">
                    <label for="password">Пароль</label>
                    <input type="password" name="password2" id="password">
                </div>
            </div>
            <input type="checkbox" name="agreement" class="agreement">
            <p>Я принимаю пользовательское соглашение и даю согласие на обработку персональных данных</p>
            <button name="formSubmit2">Продолжить</button>
        </form>
    </div>