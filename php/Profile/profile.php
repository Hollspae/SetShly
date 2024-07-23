<?php
session_start();
require_once '../config/connect.php';
include 'formProfile.php';
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
                    <li><a href="http://setshly/php/Index/index.php" class="history-back">
                            <img class="navigation_arrow" src="img/arrow.png" alt=""></a></li>
                    <li><a href="http://setshly/php/Index/index.php">Главная страница</a></li>
                    <li><a href="http://setshly/php/profile/personalDate.php">Личные данные</a></li>

                    <li><a href="http://setshly/php/AllProduct/allproduct.php">Все товары</a></li>
                </ul>
            </nav>


            <!-- Первый ряд -->
            <div class="lk-block">

                <div class="lk-container">

                    <div class="lk-container_block lk-container_top ">
                        <h2>
                            <?php echo $_SESSION['name']; ?>
                            <?php echo $UserSurName; ?>

                        </h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">
                        <p>
                            <?php echo $UserNumber; ?>
                        </p>

                        <form action="../Index/formLogaut.php" method="POST">
                            <button type="submit" name="formSubmitExit" id="formSubmitExit"
                                value="formLogaut">Выход</button>
                        </form>
                    </div>
                </div>

                <?php if (!empty($_SESSION['name']) && $_SESSION['role'] == 2) {
                    echo '
                <div class="lk-container" onclick="location.href=`../Delivery/delivery.php`">

                    <div class="lk-container_block lk-container_top" >
                        <h2>Доставки</h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">

                    </div>
                </div>


                <div class="lk-container" onclick="location.href=`../Basket/basket.php`">

                    <div class="lk-container_block lk-container_top" >
                        <h2>Корзина</h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">

                    </div>
                </div>

            </div>

            <!-- Второй ряд -->
            <div class="lk-block">

                 <div class="lk-container">
                    <div class="lk-container_block lk-container_top" onclick="location.href=`../Profile/personalDate.php`">
                        <h2>
                            Личные данные
                        </h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">

                    </div>
                </div>

                <div class="lk-container">
                    <div class="lk-container_block lk-container_top" >
                        <h2>
                            --
                        </h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">

                    </div>
                </div>

                <div class="lk-container" onclick="location.href=`../HistoryBuy/historyBuy.php`">


                    <div class="lk-container_block lk-container_top">
                        <h2>История покупок</h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">

                    </div>

                </div>

            </div>
            ';
                }
                if (!empty($_SESSION['name']) && $_SESSION['role'] == 1) {
                    echo '
                <div class="lk-container" onclick="location.href=`../Administration/Product/product.php`">

                    <div class="lk-container_block lk-container_top">
                        <h2>Товары</h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">

                    </div>
                </div>


                <div class="lk-container" onclick="location.href=`../Administration/Moderation/moder.php`">

                    <div class="lk-container_block lk-container_top">
                        <h2>Администраторы</h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">

                    </div>
                </div>

            </div>

            <!-- Второй ряд -->
            <div class="lk-block">

                <div class="lk-container">

                    <div class="lk-container_block lk-container_top" onclick="location.href=`../Administration/Delivery/delivery.php`">
                        <h2>
                            Статусы доставок
                        </h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">
                        <p>

                        </p>


                    </div>
                </div>

                <div class="lk-container">
                    <div class="lk-container_block lk-container_top" >
                        <h2>
                            --
                        </h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">

                    </div>
                </div>

                <div class="lk-container" onclick="">


                    <div class="lk-container_block lk-container_top">
                        <h2>
                        --
                        </h2>
                    </div>
                    <div class="lk-container_block lk-container_bottom">

                    </div>

                </div>

            </div>
            ';
                }
                ?>
            </div>

    </main>
    <footer id="footer">
        <div class="about-company"><a href="">О НАС</a></div>
        <div class="help"><a href="">ПОМОЩЬ</a></div>
        <div class="find"><a href="">НАЙДИ НАС</a></div>
    </footer>
</body>

</html>