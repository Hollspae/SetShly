<?php
session_start();
require_once '../config/connect.php';
include 'formSettings.php';
include 'formFeedback.php';

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
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/png">
    <script src="https://unpkg.com/popper.js@1" defer></script>
    <script src="https://unpkg.com/tippy.js@5" defer></script>
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

    <main id="main">
        <nav class="container-navigation">
            <ul>
                <li><a href="http://setshly/php/AllProduct/allproduct.php" class="history-back">
                        <img class="navigation_arrow" src="img/arrow.png" alt=""></a></li>
                <li><a href="http://setshly/php/Index/index.php">Главная страница</a></li>
                <li><a href="http://setshly/php/profile/profile.php">Личный кабинет</a></li>
                <li><a href="http://setshly/php/AllProduct/allproduct.php">Все товары</a></li>
            </ul>
        </nav>

        <section>
            <?php
            CardOutput($IDColorCut, $material_list, $size_list, $product_list, $product_id, $product_price_list, $arrColors, $cut_explodeColor, $AboutProduct__category, $AboutProduct__embroidery, $cut_searchSize, $CountProduct);

            TransferProductToCart($product_id, $cut_explodeColor, $cut_searchSize, $CountProduct, $color_list, $size_list, $production_list, $material_list, $basket, $connect, $list_productToBasket); ?>

        </section>

        <div class="section-description">
            <div class="HeaderDescription">
                <h2>О товаре</h2>
            </div>

            <div class="BlockAboutProduct">
                <div class="headingAboutProduct">
                    <ul>
                        <li>
                            <h3>Состав</h3>

                        </li>
                        <li>
                            <h3>Вышивка</h3>

                        </li>
                        <li>
                            <h3>Цвет</h3>

                        </li>
                        <li>
                            <h3>Категория</h3>

                        </li>
                    </ul>
                </div>
                <div class="aboutProduct">
                    <ul>
                        <?php echo '
                            <li>
                                <p> ' . $AboutProduct__structure . '</p>
                            </li>
                            <li>
                                <p> ' . $AboutProduct__embroidery . '</p>
                            </li>
                            <li>
                                <p> ' . $AboutProduct__color . '</p>
                            </li>
                            <li>
                                <p> ' . $AboutProduct__category . '</p>
                            </li>
                        '; ?>
                    </ul>
                </div>
            </div>
            <div class="HeaderDescription">
                <h2>Описание</h2>
            </div>
            <div class="BlockDiscription">
                <?php echo ' <p>' . $AboutProduct__discription . '</p> '; ?>
            </div>
        </div>

        <div class="section-feedback">
            <div class="HeaderDescription">
                <h2>Отзывы</h2>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="cardFeedback">
                    <div class="cardFeeback_top">
                        <div class="feedback_name">
                            <h3>Пользователь: </h3>
                            <h2>Ксения Вилькова</h2>
                            <div class="rating" value="" name="rating">
                                <div class="rating__item" id="star-open1" data-item-value="5">★</div>
                                <div class="rating__item" id="star-open2" data-item-value="4">★</div>
                                <div class="rating__item" id="star-open3" data-item-value="3">★</div>
                                <div class="rating__item" id="star-open4" data-item-value="2">★</div>
                                <div class="rating__item" id="star-open5" data-item-value="1">★</div>
                            </div>
                        </div>
                    </div>
                    <div class="cardFeeback_bottom">
                        <textarea type="text" name="Discription" id="" placeholder="Оцените товар!"></textarea>
                    </div>
                    <div class="cardFeeback_btn">
                        <button name="btnfeedback" type="submit">Отправить</button>
                        <input type="file" name="images[]" id="images" accept=".jpg, .png" multiple hidden>
                        <!-- <button type="button" id="uploadButton">Загрузить фото</button> -->
                    </div>
                </div>
                <input class="ratings" name="ratings" id="ratings" type="hidden">
            </form>

            <script>
                document.getElementById('uploadButton').addEventListener('click', function() {
                    document.getElementById('images').click();
                });

                document.getElementById('images').addEventListener('change', function() {
                    const files = this.files;
                    const maxFiles = 3;

                    if (files.length > maxFiles) {
                        console.error(`Можно загрузить не более ${maxFiles} фотографий.`);
                    } else {
                        let allFilesLoaded = true;
                        for (let i = 0; i < files.length; i++) {
                            if (!files[i]) {
                                allFilesLoaded = false;
                                break;
                            }
                        }

                        if (!allFilesLoaded) {
                            console.error("Не все фотографии загружены.");
                        } else {
                            console.log("Все фотографии успешно загружены.");
                        }
                    }
                });
            </script>


            <?php FeedBack($product_id, $feedback, $query_user_list, $photoFeedback_list, $photoFeedback, $product_list) ?>

        </div>


    
        </main>

</footer>
</body>

</html>