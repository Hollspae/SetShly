<?php
require_once '../config/connect.php';
include 'formAuthorization.php';
include 'formRegistration.php';
session_start();




$completeInfo = 0;
$completeLogin = 0;
$completeRegistration = 0;

if ($_SESSION['query'] == 1) {
    $completeInfo = 1;
    session_unset();
    session_destroy();
}
;


if (isset($_GET['search'])) {
    header('Location: http://setshly/php/Search/search.php?search=' . $_GET["search"] . '');
}


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

    <?php if (empty($_SESSION['name'])) {
        echo '
    <div class="background-navigation display-none"></div>';
    } ?>

    <header id="header">
        <form class="search" method="get"> <img src="img/search.png" alt="" draggable="false">
            <input type="search" name="search" placeholder="Поиск">
        </form>
        <h1><a href="../Index/index.php" style="color: #282b34;">SetShly</a></h1> <img class="logo" src="img/logo.png"
            alt="" draggable="false">
        <nav id="navigation-header" class="navigation-header">
            <ul id="menu">

                <li>
                    <?php
                    if (!empty($_SESSION['name'])) {
                        echo '
                            <p>' . $_SESSION["name"] . '</p>';
                    }
                    ?>
                </li>
                <li>
                    <?php
                    if (!empty($_SESSION['name'])) {
                        echo '<a href="http://setshly/php/profile/profile.php" class="profile" id="profile_lk"><img src="img/profile.png" alt="Личный кабинет" draggable="false"></a>';
                    } else {
                        echo '<div class="profile" id="profile" ><img src="img/profile.png" alt="Вход" draggable="false"></div>
                        ';
                    }
                    ?>
                </li>
                <li>
                    <a href="../Basket/basket.php" class="basket"><img src="img/basket.png" alt="Корзина"
                            draggable="false"></a>
                </li>
            </ul>
        </nav>
    </header>
    <?
    if ($_SESSION['completedLogin'] == "successfully") {


        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = document.getElementById('success-message');
            successMessage.style.display = 'block';
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 1500);
        });
    </script>";

        unset($_SESSION['completedLogin']);

    }
    ?>
    <div id="success-message" style="display: none;">
        Вы зарегистрировались!
    </div>
    <?php if (empty($_SESSION['name'])) {
        echo '
    <div class="authorization authorization-closed">
        <div class="closing-authorization"> <img src="img/closing.png" alt="Закрыть" draggable="false"> </div>
        <form method="post" action="">
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
        <form method="post" action="">
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
        ';
    }
    ?>


    <main id="main">
        <?php
        if ($completeInfo == 1) {
            echo '<div class="complete-info">Товар добавлен!</div>';
            $completeInfo = 0;
        }
        ;
        ?>

        <section class="section selection-clothink">

            <div class="female__clothink" > 
                <a href="http://setshly/php/Search/search.php?search=Футболка">
                    <h2>ФУТБОЛКИ</h2>
                </a>
                <a href="http://setshly/php/Search/search.php?search=Футболка"><img src="img/1.png" alt="" draggable="false"></a>
            </div>
            <div class="male__clothink"> 
                <a href="http://setshly/php/Search/search.php?search=Джинсы">
                    <h2>ДЖИНСЫ</h2>
                </a>
                <a href="http://setshly/php/Search/search.php?search=Джинсы"><img src="img/two.jpg" alt="" draggable="false"></a>
            </div>
        </section>

        <section class="section selection-clothinks">

            <div class="female__clothink"> 
                <a href="http://setshly/php/AllProduct/allproduct.php">
                    <h2>ВСЕ ТОВАРЫ</h2>
                </a>
                <a href="http://setshly/php/AllProduct/allproduct.php"><img src="img/tree.jpg" alt="" draggable="false"></a>
            </div>

        </section>

        <?php
        include '../PATTERN/footer.php';
        ?>