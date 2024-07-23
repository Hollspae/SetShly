<?php require_once '../config/connect.php';
require_once 'form-basket.php';

session_start();
$completeInfo = 0;
if
($_SESSION['query'] == 1) {
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
    <div class="background display-none" id="background"></div>

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
                        echo '<p>' . $_SESSION["name"] . '</p>';
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


    <main>

        <div class="container">
            <div class="order">

                <h2 class="HeaderDelivery">Корзина</h2>
                <nav class="container-navigation">
                    <ul>
                        <li><a href="http://setshly/php/profile/profile.php" class="history-back">
                                <img class="navigation_arrow" src="img/arrow.png" alt=""></a></li>
                        <li><a href="http://setshly/php/Index/index.php">Главная страница</a></li>

                        <li><a href="http://setshly/php/AllProduct/allproduct.php">Все товары</a></li>

                        <li>
                            <h2>Итого:
                                <?php PriceOutput($connect, $basket, $list_productToBasket, $production_list, $product_price_list, $procent) ?>р
                            </h2>
                        </li>


                    </ul>

                </nav>

                <section class="section-product">

                    <?php
                    dataOutput($basket, $list_productToBasket, $production_list, $product_price_list, $product_list, $category_list, $embroidery, $material_list, $color_list, $size_list, $connect);
                    if (!empty($Error['emptyBasket'])) {
                        echo '<p class="Error"> ' . $Error['emptyBasket'] . '</p>';
                    }

                    ?>

                </section>
            </div>

        </div>

        <aside class="decoration">
            <form method="post" action="form-basket.php">
                <div class="decoration_block decoration-delivery">

                    <h2>Доставка в пункт выдачи</h2>

                    <select name="DeliveryText" id="DeliveryText">
                        <?php DeliveryUser($delivery) ?>
                    </select>

                </div>
                <div class="decoration_block ">

                    <h2>Способ оплаты</h2>

                    <?php

InputCardUser($countCardUser, $ARRnumberCardUser, $Card, $connect);

                    ?>
                </div>

                <div class="decoration_block decoration-sum">
                    <h2>Сумма оплаты:
                        <?php PriceOutput($connect, $basket, $list_productToBasket, $production_list, $product_price_list, $procent) ?>р
                    </h2>
                </div>

                <button type="submit" class="btnForOrder" name="submitOrder" id="submitOrder">Заказать</button>
            </form>
            <button id="CardOpen" name="CardOpen" class="CardNumberEdit">Изменить карту</button>

            

        </aside>

        <!-- Добавление карты -->
        <aside class="BlockCard display-none" id="BlockCard">

            <div class="closing-card" id="closing-card">
                <img src="img/closing.png" alt="Закрыть" draggable="false">
            </div>
            <form method="post" action="">

                <div class="SectionNumber">
                    <p>Номер карты</p>
                    <input type="text" name="CardNumber" id="CardNumber" placeholder="0000 0000 0000 0000"
                        maxlength="16" minlength="16" required>

                </div>
                <div class="SectionDuration">
                    <p>Срок действия</p>
                    <input type="text" name="Duration" id="Duration" placeholder="00/00" maxlength="4" minlength="4"
                        required>
                </div>
                <div class="SectionCVV">
                    <p>CVV</p>
                    <input type="text" name="CVV" id="CVV" placeholder="000" maxlength="3" minlength="3" required>
                </div>
                <div class="buttonCard">
                    <button id="SubmitDetaliedCard" name="SubmitDetaliedCard">Сохранить</button>
                </div>
            </form>
        </aside>


        <!-- Подтвержение заказа -->
        <!-- <aside class="BlockOrder display-none" id="BlockOrder">
            <div class="closing-card" id="closing-order">
                <img src="img/closing.png" alt="Закрыть" draggable="false">
            </div>
            <form action="" method="post">
                <h2>Подтверждение заказа</h2>
                <div class="sectionOrder">
                    <ul class="OrderULone">
                        <li>
                            <h2>Номер заказа:</h2>
                        </li>

                        <li>
                            <h2>Адрес получения:</h2>
                        </li>
                        <li>
                            <h2>Дата заказа:</h2>
                        </li>
                        <li>
                            <h2>Дата получения:</h2>
                        </li>
                        <li>
                            <h2>Сумма заказа:</h2>
                        </li>
                        <li>
                            <h2>Оплата</h2>
                        </li>
                        <li>
                            <h2>Промокод:</h2>
                        </li>

                    </ul>
                    <ul class="OrderULtwo">
                        <li>
                            <h2><?php echo $EndOrder ?></h2>
                        </li>
                        <li>
                            <h2><?php echo $Index . ", " . $Region . ", г. " . $City . ", ул. " . $Adrress . ", д. " . $HouseNumber ?>
                            </h2>
                        </li>
                        <li>
                            <h2><?php echo $date ?></h2>
                        </li>
                        <li>
                            <h2><?php echo $dateReceipt ?></h2>
                        </li>
                        <li>
                            <h2><?php echo $arrProduct_price ?> р</h2>
                        </li>
                        <li>
                            <h2><?php echo $NumberCard ?> </h2>
                        </li>
                        <li>
                            <input class="Order_sale" type="text" name="sale" id="sale"
                                placeholder="">
                            <p class="ErrorCard"></p>
                        </li>
                    </ul>
                </div>


                <div class="buttonOrder">
                    <button id="SubmitDetaliedOrder" name="SubmitDetaliedOrder">Оформить заказ</button>
                </div>
            </form>
        </aside> -->


    </main>
    <!-- <footer id="footer">
        <div class="about-company"><a href="">О НАС</a></div>
        <div class="help"><a href="">ПОМОЩЬ</a></div>
        <div class="find"><a href="">НАЙДИ НАС</a></div>
    </footer> -->

    <?php
        include '../PATTERN/footer.php';
        ?>
</body>

</html>