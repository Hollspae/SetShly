<?php
session_start();
require_once '../config/connect.php';
include 'formHistoryBuy.php';


$completeInfo = 0;


if ($_SESSION['query'] == 1) {
    $completeInfo = 1;
    session_unset();
    session_destroy();
}
;
if (isset($_GET['search'])) {
    header('Location: http://setshly/php/Search/search.php?search=' . $_GET["search"] . '');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/png">
    <script src="js/app.js" defer></script>
    <title>SetShly - Заказывай на свой вкус!</title>
</head>

<body id="body">
    <!-- <div class="preloader" id="preloader">
        <div class="spinner">
            <div class="blob top"></div>
            <div class="blob bottom"></div>
            <div class="blob left"></div>
            <div class="blob move-blob"></div>
        </div>
    </div> -->

    <?php if (empty($_SESSION['name'])) {
        echo '
            <div class="background-navigation display-none"></div>';
    } ?>

    <div class="feedback-Closing" id="overlay"></div>

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
 
    <div class="feedback-Closing" id="feedback">

        <div class="feedback-window">

      
            <form method="post" action="formFeedback.php" enctype="multipart/form-data">

                <div class="feedback-block feedback__closing">
                    <input type="hidden" name="nameproductinpt" value="<?php echo $_SESSION['namesproduct'][0] ?>">
                    <h2>Отзыв к товару " <?php echo $_SESSION['namesproduct'][0] ?>" </h2>
                    <img src="../adding/product-images/2/2.png" class="img" alt="">

                    <img src="img/closing.png" alt="Закрыть" class="close" draggable="false" id="close">
                </div>
                <div class="feedback-block feedback__rating">
                    <h3>Оцените товар</h3>

                    <div class="rating">
                        <input class="ratings" name="rating" type="hidden">

                        <div class="rating__item" data-item-value="5">★</div>
                        <div class="rating__item" data-item-value="4">★</div>
                        <div class="rating__item" data-item-value="3">★</div>
                        <div class="rating__item" data-item-value="2">★</div>
                        <div class="rating__item" data-item-value="1">★</div>

                    </div>
                    <div class="rating_result" id="rating_result" hidden></div>
                </div>
                <!-- <div class="feedback-block feedback__size">
                    <ul>
                        <li>Цвет</li>
                        <li>Размер</li>
                    </ul>
                    <ul>

                        <<li>< echo $_SESSION['namesproduct']['key-2'][0] ?></li>
                        <li>< echo $_SESSION['namesproduct'][3] ?></li> -->

                <!-- </ul>
                </div>  -->
                <div class="feedback-block feedback__comments-header">
                    <h3>Расскажите о товаре</h3>
                    <h3 class="feedback-block-max">max 1000</h3>

                </div>
                <div class="feedback-block feedback__comments-text">
                    <textarea name="Discription" id="" cols="30" rows="10" class="comments" maxlength="1000"></textarea>
                </div>
                <div class="">
                    <input type="file" name="images[]" multiple>
                </div>
                <div class="feedback-block feedback__button">
                    <button class="btn-feedback" name="feedbackSubmit" type="sumbit">Продолжить</button>
                </div>
            </form>
        </div>


    </div>
    <main>

        <h2 class="HeaderDelivery">История заказов</h2>
        <nav class="container-navigation">
            <ul>
                <li><a href="http://setshly/php/profile/profile.php" class="history-back">
                        <img class="navigation_arrow" src="img/arrow.png" alt=""></a></li>
                <li><a href="http://setshly/php/Index/index.php">Главная страница</a></li>
                <li><a href="http://setshly/php/profile/profile.php">Личный кабинет</a></li>
                <li><a href="http://setshly/php/HistoryBuy/historyBuy.php">История покупок</a></li>
                <li><a href="http://setshly/php/AllProduct/allproduct.php">Все товары</a></li>
            </ul>
        </nav>

        <div class="container">

            <?php OutPutHistory($successfully, $feedback);
            if ($successfully == 0) {
                $historyBuy = "У вас нет заказов!";

                // echo '<p class="DeliveryNone">' . $historyBuy . '</p>';


            }
            ?>


        </div>

    </main>

    <footer id="footer">
        <div class="about-company"><a href="">О НАС</a></div>
        <div class="help"><a href="">ПОМОЩЬ</a></div>
        <div class="find"><a href="">НАЙДИ НАС</a></div>
    </footer>
    <!-- Подвал -->


</body>

</html>