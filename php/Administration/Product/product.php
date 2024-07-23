<?php
session_start();
require_once '../../config/connect.php';
require_once 'productForm.php';


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
    <script src="js/app.js" defer></script>
    <title>SetShly - Заказывай на свой вкус!</title>
</head>

<body>
    <main>

        <nav id="navigation">
            <ul id="navigation-link">
                <li>
                    <a href="" onclick="history.back();return false;" class="history-back">
                        <img class="navigation_arrow" src="img/arrow.png" alt="">
                    </a>
                </li>
                <li>
                    <div class="navigation-link__a">
                        <a class="asd" href="../../Index/index.php">Главная страница</a>
                    </div>
                </li>
                <li>
                    <form class="search" method="get">
                        <input type="search" name="search" placeholder="Поиск">
                    </form>
                </li>

            </ul>

            <ul id="navigation-link" class="nav_two">
                <li>
                    <div class="navigation-link__Nav">
                        <a href="../../addingProduct/addingProduct.php">ТОВАР</a>
                    </div>
                <li>
                    <div class="navigation-link__Nav">
                        <a href="../Category/category.php">КАТЕГОРИИ</a>
                    </div>
                </li>
                <li>
                    <div class="navigation-link__Nav">
                        <a href="../Embroidery/embroidery.php">ВЫШИВКИ</a>
                    </div>
                </li>
            </ul>
        </nav>


        <?php getProduct($product_list, $category_list, $product_price_list, $embroidery, $material_list, $production_list, $color_list); ?>


    </main>
</body>

</html>