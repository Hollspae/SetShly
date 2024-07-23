<?php
session_start();
require_once '../config/connect.php';
include 'formProfile.php';
include 'formProfileDelete.php';
if (empty($_SESSION['name'])) {
    header('Location: http://setshly/php/Index/index.php');
    exit;
}


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
                        echo '<p class="name">' . $_SESSION["name"] . '</p>';
                    }
                    ?>
                </li>
                <li>

                    <?php
                    if (!empty($_SESSION['name'])) {
                        echo '<a href="http://setshly/php/profile/profile.php" class="profile" id="profile_lk"><img src="img/profile.png" alt="Личный кабинет" draggable="false"></a>';
                    } else {
                        echo '<div class="profile" id="profile" ><img src="img/profile.png" alt="Вход" draggable="false"></div>';
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

    <main id="main">

        <div class="lk-content">



            <nav class="container-navigation">
                <ul>
                    <li><a href="http://setshly/php/profile/profile.php" class="history-back">
                            <img class="navigation_arrow" src="img/arrow.png" alt=""></a></li>
                    <li><a href="http://setshly/php/Index/index.php">Главная страница</a></li>
                    <li><a href="http://setshly/php/profile/profile.php">Личный кабинет</a></li>

                    <li><a href="http://setshly/php/AllProduct/allproduct.php">Все товары</a></li>
                </ul>
            </nav>

            <div class="content_personalDate">

                <div class="block_personalDate">
                    <form action="formProfile.php" method="post">

                        <input type="text" name="NameProfile" id="NameProfile" placeholder="Имя">
                        <?php
                        if (!empty($_SESSION['NAME'])) {
                            echo '
                                <p class="Error">' . $_SESSION['NAME'] . '</p>';
                        } ?>
                        <input type="text" name="SurnameProfile" id="SurnameProfile" placeholder="Фамилия">
                        <?php
                        if (!empty($_SESSION['SURNAME'])) {
                            echo '
                                <p class="Error">' . $_SESSION['SURNAME'] . '</p>';
                        } ?>
                        <input type="text" name="NumberProfile" id="NumberProfile" placeholder="Номер">
                        <?php
                        if (!empty($_SESSION['NUMBER'])) {
                            echo '
                                <p class="Error">' . $_SESSION['NUMBER'] . '</p>';
                        } ?>
                        <input type="text" name="PasswordProfile" id="PasswordProfile" placeholder="Пароль">
                        <?php
                        if (!empty($_SESSION['PASSWORD'])) {
                            echo '
                                <p class="Error">' . $_SESSION['PASSWORD'] . '</p>';
                        } ?>

                        <button class="button__EditProfile" type="submit" name="formSubmitEdit" id="formSubmitEdit"
                            value="formEditProfile">
                            Сохранить изменения</button>
                    </form>
                    <form action="formProfileDelete.php" method="post">
                        <a href="formProfileDelete.php?del=' . $idForm . '">
                            <button class="button__DeleteProfile" type="submit" name="formSubmitDelete"
                                id="formSubmitDelete" value="formDeleteProfile">
                                Удалить аккаунт</button>
                        </a>
                    </form>
                </div>


            </div>
        </div>

    </main>
    <footer id="footer">
        <div class="about-company"><a href="">О НАС</a></div>
        <div class="help"><a href="">ПОМОЩЬ</a></div>
        <div class="find"><a href="">НАЙДИ НАС</a></div>
    </footer>
</body>

</html>