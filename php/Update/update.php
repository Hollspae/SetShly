<?php
session_start();

require_once '../config/connect.php';

include 'form-update.php';
// if (isset ($_GET['search'])) {
//     header('Location: http://setshly/php/Search/search.php?search=' . $_GET["search"] . '');
// }

$connect = mysqli_connect('127.0.0.1', 'root', '', 'Shop');
$url = urldecode(((!empty ($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$cut_search = substr($url, 44);


$product_list = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Товар`'));

$product_price_list = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Прайс-лист_товаров`'));

$product_color = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Список_цветов_товара`'));

$product_color_name = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Цветовой_код`'));

$product_size = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Список_размеров_товара`'));

$product_size_name = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Размер`'));

$product_category = mysqli_fetch_all(mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Категория`'));

$product_id = $cut_search;
$product_price = 0;
$product_image = 0;


$product_name = 0;
$product_id_category = 0;

$arrColor = [];
$arrSize = [];
$arrCategory = [];

$_SESSION['idProduct'] = $product_id;



function colorAll($product_color_name)
{
    for ($i = 0; $i <= count($product_color_name); $i++) {
        $arrColor[] = $product_color_name[$i][1];

        $ColorAllResult = '
            <select name="select-colors" class="information-container__select-color">
                <option value="Нет"> Нет </option>
                <option value="Красный"> ' . $arrColor[0] . '</option>
                <option value="Синий"> ' . $arrColor[1] . '</option>
                <option value="Белый"> ' . $arrColor[2] . '</option>
                <option value="Черный"> ' . $arrColor[3] . '</option>
                <option value="Зеленый"> ' . $arrColor[4] . '</option>
                <option value="Желтый"> ' . $arrColor[5] . '</option>
            </select>';
    }
    return $ColorAllResult;
}

function sizeAll($product_size_name)
{
    for ($i = 0; $i <= count($product_size_name); $i++) {
        $arrSize[] = $product_size_name[$i][1];

        $sizeAllResult = '
            <select class="information-container__select-size select-size" name="select-size[]">
                <option value="Нет"> Нет </option>
                <option value="S"> ' . $arrSize[0] . '</option>
                <option value="M"> ' . $arrSize[1] . '</option>
                <option value="L"> ' . $arrSize[2] . '</option>
                <option value="XL"> ' . $arrSize[3] . '</option>
                <option value="2XL"> ' . $arrSize[4] . '</option>
    
            </select>';
    }
    return $sizeAllResult;
}


//Цена
for ($i = 0; $i <= count($product_price_list); $i++) {
    if ($product_id == $product_price_list[$i][1]) {
        $product_price = $product_price_list[$i][2];
    }
}



//Имя
for ($i = 0; $i <= count($product_list); $i++) {
    if ($product_id == $product_list[$i][0]) {
        $product_name = $product_list[$i][4];

    }

}

//Категория
for ($i = 0; $i <= count($product_list); $i++) {
    for ($a = 0; $a <= count($product_category); $a++)
        if ($product_id[$i][1] == $product_category[$a][0]) {
            $product_id_category = $product_category[$a][0];
        }
}


?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
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

    <?php if (empty ($_SESSION['name'])) {
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
                    if (!empty ($_SESSION['name'])) {
                        echo '<p>' . $_SESSION["name"] . '</p>';
                    }
                    ?>
                </li>
                <li>

                    <?php
                    if (!empty ($_SESSION['name'])) {
                        echo '<a href="http://setshly/php/profile/profile.php" class="profile" id="profile_lk"><img src="img/profile.png" alt="Личный кабинет" draggable="false"></a>';
                    } else {
                        echo '<div class="profile" id="profile" ><img src="img/profile.png" alt="Вход" draggable="false"></div>
                                ';
                    }
                    ?>

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


    <main>

        <section>
            <div class="product-image"><img src="img/product1.webp" alt="Изображение товара" draggable="false"></div>
            <div class="information-container">
                <form method="post" action="form-update.php">
                    <div class="product product_name">
                        <label class="information-container__label information-container__label-name" for="input-name">
                            Название:</label>
                        <input class="information-container__input-name " type="text" name="inputName"
                            value=" <?php echo $product_name; ?>">
                    </div>

                    <div class="product product__price">
                        <label class="information-container__label information-container__label-price"
                            for="input-price">
                            Цена: </label>
                        <input class="information-container__input-name " type="text" name="inputPrice"
                            value="<?php echo $product_price; ?>">
                    </div>

                    <div class="product product__color">

                        <span class="information-container__label information-container__label-color"> Цвет:</span>


                        <?php echo colorAll($product_color_name); ?>

                    </div>

                    <div class="product product-proportions">
                        <span class="information-container__label information-container__size-title"> Размер:</span>
                        <div class="proportions">

                            <?php echo sizeAll($product_size_name); ?>
                            <?php echo sizeAll($product_size_name); ?>
                            <?php echo sizeAll($product_size_name); ?>
                            <?php echo sizeAll($product_size_name); ?>
                            <?php echo sizeAll($product_size_name); ?>

                        </div>
                    </div>


                    <button class="button-upp" type="submit" name="formSubmit123"
                        value="Подтвердить">Подтвердить</button>
                </form>

            </div>
            </div>
        </section>




    </main>
    <footer id="footer">
        <div class="about-company"><a href="">О НАС</a></div>
        <div class="help"><a href="">ПОМОЩЬ</a></div>
        <div class="find"><a href="">НАЙДИ НАС</a></div>
    </footer>
</body>

</html>