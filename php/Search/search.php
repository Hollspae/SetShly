<?php
session_start();
require_once '../config/connect.php';

//ДОРАБОТАТЬ КАРТОЧКИ 

$url = urldecode(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$cut_search = substr($url, 44);

if ($cut_search !== false && !empty($cut_search)) {

    $search_fix = preg_replace("/[^a-zA-Zа-яА-Я0-9\s]/ui", "", $cut_search);
    $search_array = explode(' ', $cut_search);
    $product_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Товар`'));

    $similar_products = [];
    $similar_key = 0;


    for ($k = 0; $k <= count($product_list); $k++) {
        for ($s = 0; $s <= count($search_array); $s++) {
            if (strpos($product_list[$k][2], $search_array[$s]) !== false) {
                $similar_key++;
                $similar_products[$similar_key] = $product_list[$k][2];
            }
            ;
        }
        ;
    }
    ;

    if (!empty($similar_products)) {
        $similar_products = array_values(array_diff(array_unique($similar_products), array('')));
        $similar_products = array_combine(range(1, count($similar_products)), $similar_products);
        $product_query_list = count($similar_products);
        function insert_html($production_list, $product_id, $material_list, $arrIDembroidery, $embroidery, $product_list, $category_list, $product_name, $product_price, $number)
        {


            for ($i = 0; $i <= count($production_list); $i++) {

                if ($product_id == $production_list[$i][2]) {
                    $Arr_production[] = $production_list[$i][1];
                    $arrIDembroidery[] = $production_list[$i][3];
                    $IDembroidery = array_shift($arrIDembroidery);

                    for ($j = 0; $j <= count($material_list); $j++) {
                        foreach ($Arr_production as $valueProduction) {

                            if ($valueProduction == $material_list[$j][0]) {

                                $arrColors = $material_list[$j][2];
                                $arrSizes = $material_list[$j][3];
                            }
                        }
                    }

                    for ($a = 0; $a <= count($embroidery); $a++) {
                        if ($IDembroidery == $embroidery[$a][0]) {
                            $product_embroidery = $embroidery[$a][1]; //Вышивка товара
                        }

                    }
          
                    for ($p = 0; $p <= count($product_list); $p++) {
                        if ($product_id == $product_list[$p][0]) {
                            $IDcategory = $product_list[$p][1];
                            for ($z = 0; $z <= count($category_list); $z++) {
                                if ($IDcategory == $category_list[$z][0]) {
                                    $product_category = $category_list[$z][1]; //Название категории



                                }
                            }
                        }
                    }
                }


            }


            $dir = "../../ProductImg/$product_category/$product_embroidery/";
            $fileIMG = scandir($dir, 1);
            $IMGName = array_shift($fileIMG);

            echo '
                    <li class="product" id="' . $number . '">
                        <div class="card-product" id= ' . $product_id . '>
                        <img class="card-product__img" src="../../ProductImg/' . $product_category . '/' . $product_embroidery . '/' . $IMGName . '" alt="Изображение товара" draggable="false">
                        
                            <span class="product-name product_span">' . $product_name . '</span>
                            <span class="product-price product_span">' . $product_price . ' ₽</span>

                            <a href="../card/card.php?card=' . $product_id . '&color=' . $arrColors . '&size=' . $arrSizes . ' ">                       
                                <button class="product_btn">Посмотреть</button>
                            </a>
                        </div>
                    </li>
                ';
        }
        ;
    }

    ;

} else {

    $search_error = "error";
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

    <?php if (empty($_SESSION['name'])) {
        echo '
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
        ';
    }
    ?>


    <main id="main" style="
        <?php

        if ($product_query_list <= 3 && $search_error != "error") {
            echo 'height: calc(var(--index) * (88 - 47));';
        }
        ;

        if ($product_query_list >= 4 && $product_query_list <= 6 && $search_error != "error") {
            echo 'height: calc(var(--index) * (88 - 30));';
        }
        ;

        if ($product_query_list >= 7 && $product_query_list <= 9 && $search_error != "error") {
            echo 'height: calc(var(--index) * (88 - 13));';
        }
        ;

        if ($product_query_list == 0 || $search_error == "error") {
            echo 'height: calc(var(--index) * (88 - 13));';
        }
        ;

        ?>">

        <section style="
        <?php

        if ($product_query_list <= 3 && $search_error != "error") {
            echo 'height: calc(var(--index) * (84 - 47));';
        }
        ;

        if ($product_query_list >= 4 && $product_query_list <= 6 && $search_error != "error") {
            echo 'height: calc(var(--index) * (84 - 30));';
        }
        ;

        if ($product_query_list >= 7 && $product_query_list <= 9 && $search_error != "error") {
            echo 'height: calc(var(--index) * (84 - 13));';
        }
        ;

        if ($product_query_list == 0 || $search_error == "error") {
            echo 'height: calc(var(--index) * (84 - 13));';
        }
        ;

        ?>">
            <ul class="container__products row-1">
                <?php
                if ($product_query_list >= 1 && $search_error != "error") {

                    $product_name = $similar_products[1];
                    $product_price = 0;
                    $product_image = 0;
                    $product_id = 0;

                    $number = 1;



                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[1]) {

                            for ($k = 0; $k <= count($product_price_list); $k++) {

                                if ($product_list[$i][0] == $product_price_list[$k][1]) {
                                    $product_price = $product_price_list[$k][2];
                                    $product_id = $product_list[$i][0];
                                    $k = count($product_price_list);
                                    $i = count($product_list);

                                }
                                ;
                            }
                            ;
                        }
                        ;
                    }
                    ;

                    insert_html($production_list, $product_id, $material_list, $arrIDembroidery, $embroidery, $product_list, $category_list, $product_name, $product_price, $number);
                }
                ;
                ?>
                <?php
                if ($product_query_list >= 2 && $search_error != "error") {

                    $product_name = $similar_products[2];
                    $product_price = 0;
                    $product_image = 0;
                    $product_id = 0;

                    $number = 2;

                    for ($u = 0; $u <= count($product_list); $u++) {
                        if ($product_list[$u][2] == $product_name) {
                            $product_id = $product_list[$u][0];
                            for ($k = 0; $k <= count($product_price_list); $k++) {

                                if ($product_id == $product_price_list[$k][1]) {
                                    $product_price = $product_price_list[$k][2];

                                    $k = count($product_price_list);
                                    $i = count($product_list);


                                }
                                ;
                            }
                            ;
                        }
                        ;
                    }
                    ;

                    insert_html($production_list, $product_id, $material_list, $arrIDembroidery, $embroidery, $product_list, $category_list, $product_name, $product_price, $number);
                }
                ;

                if ($product_query_list >= 3 && $search_error != "error") {

                    $product_name = $similar_products[3];
                    $product_price = 0;
                    $product_image = 0;
                    $product_id = 0;

                    $number = 3;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[1]) {
                            for ($k = 0; $k <= count($product_price_list); $k++) {
                                if ($product_list[$i][0] == $product_price_list[$k][1]) {
                                    $product_price = $product_price_list[$k][2];
                                    $product_id = $product_list[$i][0];
                                    $k = count($product_price_list);
                                    $i = count($product_list);

                                }
                                ;
                            }
                            ;
                        }
                        ;
                    }
                    ;


                    insert_html($production_list, $product_id, $material_list, $arrIDembroidery, $embroidery, $product_list, $category_list, $product_name, $product_price, $number);
                }
                ;
                ?>
            </ul>
            <ul class="container__products row-2">
                <?php
                if ($product_query_list >= 4 && $search_error != "error") {

                    $product_name = $similar_products[4];
                    $product_price = 0;
                    $product_image = 0;
                    $product_id = 0;


                    $number = 4;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[4]) {
                            for ($k = 0; $k <= count($product_price_list); $k++) {
                                if ($product_list[$i][0] == $product_price_list[$k][1]) {
                                    $product_price = $product_price_list[$k][2];
                                    $product_id = $product_list[$i][0];
                                    $k = count($product_price_list);
                                    $i = count($product_list);
                                }
                                ;
                            }
                            ;
                        }
                        ;
                    }
                    ;


                    insert_html($production_list, $product_id, $material_list, $arrIDembroidery, $embroidery, $product_list, $category_list, $product_name, $product_price, $number);
                }
                ;
                ?>
                <?php
                if ($product_query_list >= 5 && $search_error != "error") {

                    $product_name = $similar_products[5];
                    $product_price = 0;
                    $product_image = 0;
                    $product_id = 0;


                    $number = 5;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[5]) {
                            for ($k = 0; $k <= count($product_price_list); $k++) {
                                if ($product_list[$i][0] == $product_price_list[$k][1]) {
                                    $product_price = $product_price_list[$k][2];
                                    $product_id = $product_list[$i][0];
                                    $k = count($product_price_list);
                                    $i = count($product_list);
                                }
                                ;
                            }
                            ;
                        }
                        ;
                    }
                    ;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[5]) {
                            $product_image = $product_list[$i][6];
                            $i = count($product_list);
                        }
                        ;
                    }
                    ;

                    insert_html($production_list, $product_id, $material_list, $arrIDembroidery, $embroidery, $product_list, $category_list, $product_name, $product_price, $number);
                }
                ;
                ?>
                <?php
                if ($product_query_list >= 6 && $search_error != "error") {

                    $product_name = $similar_products[6];
                    $product_price = 0;
                    $product_image = 0;
                    $product_id = 0;


                    $number = 6;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[6]) {
                            for ($k = 0; $k <= count($product_price_list); $k++) {
                                if ($product_list[$i][0] == $product_price_list[$k][1]) {
                                    $product_price = $product_price_list[$k][2];
                                    $product_id = $product_list[$i][0];
                                    $k = count($product_price_list);
                                    $i = count($product_list);
                                }
                                ;
                            }
                            ;
                        }
                        ;
                    }
                    ;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[6]) {
                            $product_image = $product_list[$i][6];
                            $i = count($product_list);
                        }
                        ;
                    }
                    ;

                    insert_html($production_list, $product_id, $material_list, $arrIDembroidery, $embroidery, $product_list, $category_list, $product_name, $product_price, $number);
                }
                ;
                ?>
            </ul>
            <ul class="container__products row-3">
                <?php
                if ($product_query_list >= 7 && $search_error != "error") {

                    $product_name = $similar_products[7];
                    $product_price = 0;
                    $product_image = 0;
                    $product_id = 0;


                    $number = 7;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[7]) {
                            for ($k = 0; $k <= count($product_price_list); $k++) {
                                if ($product_list[$i][0] == $product_price_list[$k][1]) {
                                    $product_price = $product_price_list[$k][2];
                                    $product_id = $product_list[$i][0];
                                    $k = count($product_price_list);
                                    $i = count($product_list);
                                }
                                ;
                            }
                            ;
                        }
                        ;
                    }
                    ;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[7]) {
                            $product_image = $product_list[$i][6];
                            $i = count($product_list);
                        }
                        ;
                    }
                    ;

                    insert_html($production_list, $product_id, $material_list, $arrIDembroidery, $embroidery, $product_list, $category_list, $product_name, $product_price, $number);
                }
                ;
                ?>
                <?php
                if ($product_query_list >= 8 && $search_error != "error") {

                    $product_name = $similar_products[8];
                    $product_price = 0;
                    $product_image = 0;
                    $product_id = 0;


                    $number = 8;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[8]) {
                            for ($k = 0; $k <= count($product_price_list); $k++) {
                                if ($product_list[$i][0] == $product_price_list[$k][1]) {
                                    $product_price = $product_price_list[$k][2];
                                    $product_id = $product_list[$i][0];
                                    $k = count($product_price_list);
                                    $i = count($product_list);
                                }
                                ;
                            }
                            ;
                        }
                        ;
                    }
                    ;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[8]) {
                            $product_image = $product_list[$i][6];
                            $i = count($product_list);
                        }
                        ;
                    }
                    ;

                    insert_html($production_list, $product_id, $material_list, $arrIDembroidery, $embroidery, $product_list, $category_list, $product_name, $product_price, $number);
                }
                ;
                ?>
                <?php
                if ($product_query_list >= 9 && $search_error != "error") {

                    $product_name = $similar_products[9];
                    $product_price = 0;
                    $product_image = 0;
                    $product_id = 0;


                    $number = 96;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[9]) {
                            for ($k = 0; $k <= count($product_price_list); $k++) {
                                if ($product_list[$i][0] == $product_price_list[$k][1]) {
                                    $product_price = $product_price_list[$k][2];
                                    $product_id = $product_list[$i][0];
                                    $k = count($product_price_list);
                                    $i = count($product_list);
                                }
                                ;
                            }
                            ;
                        }
                        ;
                    }
                    ;

                    for ($i = 0; $i <= count($product_list); $i++) {
                        if ($product_list[$i][2] == $similar_products[9]) {
                            $product_image = $product_list[$i][6];
                            $i = count($product_list);
                        }
                        ;
                    }
                    ;

                    insert_html($production_list, $product_id, $material_list, $arrIDembroidery, $embroidery, $product_list, $category_list, $product_name, $product_price, $number);
                }
                ;
                ?>
            </ul>
        </section>
    </main>
    <?php
    include '../PATTERN/footer.php';


    ?>