<?php
session_start();
require_once '../config/connect.php';
$connect = mysqli_connect('127.0.0.1', 'root', '', 'Shop');

function hiddenValueResult($postTypeHidden)
{
    $hiddenValueResult = '';

    if (empty($_SESSION['post']['information-container-sample' . $postTypeHidden . ''])) {
        $hiddenValueResult = "closed";
    } else if ($_SESSION['post']['information-container-sample' . $postTypeHidden . ''] == 'closed') {
        $hiddenValueResult = $_SESSION['post']['information-container-sample' . $postTypeHidden . ''];
    } else if ($_SESSION['post']['information-container-sample' . $postTypeHidden . ''] == 'open') {
        $hiddenValueResult = $_SESSION['post']['information-container-sample' . $postTypeHidden . ''];
    }

    return $hiddenValueResult;
}
;

function imageErrorResult($filesTypeImage)
{
    if (empty($_SESSION['files']['image' . $filesTypeImage . '']['size'])) {
        $imageErrorResult = '<span class="error">Вы не выбрали изображение!</span>';
        echo "<script>console.log('no good' );</script>";
    } elseif (empty($_SESSION['files']['image' . $filesTypeImage . '']['size']) && $_SESSION['files']['image' . $filesTypeImage . '']['size'] > (10 * 1024 * 1024)) {
        $imageErrorResult = '<span class="error">Размер изображения не должен превышать 10 МБ!</span>';
    } elseif (empty($_SESSION['files']['image' . $filesTypeImage . '']['size']) && !in_array(getimagesize($_SESSION['files']['image' . $filesTypeImage . '']['tmp_name'])['mime'], array('image/jpeg', 'image/png, image/webp'))) {
        $imageErrorResult = '<span class="error">Запрещённый формат изображения!</span>';
    }
    ;

    return $imageErrorResult;
}
;

function nameErrorResult($postTypeName)
{
    if (empty(preg_replace("/[^a-zA-Zа-яА-Я0-9\s]/ui", "", $_SESSION['post']['name' . $postTypeName . '']))) {
        $nameErrorResult = '<span class="error">Введите название!</span>';
        echo "<script>console.log('no good' );</script>";
    }
    ;

    $category_array = ["Футболка", "Джинсы", "Носки", "Худи"];

    $nameform_strpos = preg_replace("/[^a-zA-Zа-яА-Я0-9\s]/ui", "", $_SESSION['post']['name' . $postTypeName . '']);

    if (strpos($nameform_strpos, $category_array[0]) === false && strpos($nameform_strpos, $category_array[1]) === false && strpos($nameform_strpos, $category_array[2]) === false && strpos($nameform_strpos, $category_array[3]) === false) {
        if (!empty($nameform_strpos)) {
            $nameErrorResult = '<span class="error">Введите категорию!</span>';
            echo "<script>console.log('no good' );</script>";
        }
        ;
    }
    ;

    $category_more_test = 0;

    for ($i = 0; $i <= 3; $i++) {
        if (strpos($nameform_strpos, $category_array[$i]) !== false) {
            $category_more_test++;
            echo "<script>console.log('good' );</script>";
        }
        ;
    }
    ;


    if ($category_more_test >= 2) {
        $nameErrorResult = '<span class="error">Нельзя вводить несколько категорий!</span>';
        echo "<script>console.log('no good' );</script>";
    }
    ;

    return $nameErrorResult;
}
;

function priceErrorResult($postTypePrice)
{
    $priceErrorResult = '';

    if (!is_numeric(preg_replace("/[^0-9]/ui", "", $_SESSION['post']['price' . $postTypePrice . '']))) {
        $priceErrorResult = '<span class="error">Введите цену!</span>';
        echo "<script>console.log('no good' );</script>";
    }
    ;

    return $priceErrorResult;
}
;


function colorErrorResult($postTypePrice)
{
    if ($_SESSION['post']['select-color' . $postTypePrice . ''] == 7) {
        $priceErrorResult = '<span class="error"> Выберите цвет!</span>';
        echo "<script>console.log('no good' );</script>";
    }
    ;

    $form_array = 0;

    $colorform_array = 0;

    if ($postTypePrice == 1) {
        $form_array = [$_SESSION['post']['information-container-sample2'], $_SESSION['post']['information-container-sample3'], $_SESSION['post']['information-container-sample4']];
        echo "<script>console.log('good0' );</script>";
    }
    ;

    if ($postTypePrice == 2) {
        $form_array = [$_SESSION['post']['information-container-sample1'], $_SESSION['post']['information-container-sample3'], $_SESSION['post']['information-container-sample4']];
        echo "<script>console.log('good1' );</script>";
    }
    ;

    if ($postTypePrice == 3) {
        $form_array = [$_SESSION['post']['information-container-sample2'], $_SESSION['post']['information-container-sample1'], $_SESSION['post']['information-container-sample4']];
        echo "<script>console.log('good2' );</script>";
    }
    ;

    if ($postTypePrice == 4) {
        $form_array = [$_SESSION['post']['information-container-sample2'], $_SESSION['post']['information-container-sample3'], $_SESSION['post']['information-container-sample1']];
        echo "<script>console.log('good3' );</script>";
    }
    ;

    $form_array = [$_SESSION['post']['information-container-sample2'], $_SESSION['post']['information-container-sample3'], $_SESSION['post']['information-container-sample4']];

    if ($postTypePrice == 1) {
        [$_SESSION['post']['select-color2'], $_SESSION['post']['select-color4'], $_SESSION['post']['select-color3']];
        echo "<script>console.log('good11' );</script>";
    }
    ;

    if ($postTypePrice == 1) {
        [$_SESSION['post']['select-color1'], $_SESSION['post']['select-color4'], $_SESSION['post']['select-color3']];
        echo "<script>console.log('good12' );</script>";
    }
    ;

    if ($postTypePrice == 1) {
        [$_SESSION['post']['select-color2'], $_SESSION['post']['select-color4'], $_SESSION['post']['select-color1']];
        echo "<script>console.log('good13' );</script>";
    }
    ;

    if ($postTypePrice == 1) {
        [$_SESSION['post']['select-color2'], $_SESSION['post']['select-color1'], $_SESSION['post']['select-color3']];
        echo "<script>console.log('good14' );</script>";
    }
    ;

    $key_color = 0;

    for ($i = 0; $i <= 3; $i++) {
        if ($form_array[$i] == "open") {
            if ($colorform_array[$i] == $_SESSION['post']['select-color' . $postTypePrice . '']) {
                $key_color++;
                echo "<script>console.log('good001' );</script>";
            }
            ;
        }
        ;
    }
    ;

    if ($key_color >= 1) {
        if ($_SESSION['post']['select-color' . $postTypePrice . ''] != 7) {
            $priceErrorResult = '<span class="error"> Такой цвет товара уже есть!</span>';
            echo "<script>console.log('no good002' );</script>";
        }
        ;
    }
    ;

    return $priceErrorResult;
}
;

function colorValueResult($f_postTypeColor, $f_postTypeColorValue)
{
    $colorSelectionResult = '';

    if ($_SESSION['post']['select-color' . $f_postTypeColor . ''] == $f_postTypeColorValue) {
        $colorSelectionResult = 'selected';
        echo "<script>console.log('good003' );</script>";
    }
    ;

    return $colorSelectionResult;
}
;

function colorHTML($postTypeColor)
{

    $colorValue7Result = '';

    if (empty($_SESSION['post']['select-color' . $postTypeColor . '']) || colorValueResult($postTypeColor, 7) == 'selected') {
        $colorValue7Result = 'selected';
        echo "<script>console.log('good004' );</script>";
    }
    ;

    $colorHTMLResult = '
    <select class="information-container__select-color select-color' . $postTypeColor . '" name="select-color' . $postTypeColor . '">
        <option value="1" ' . colorValueResult($postTypeColor, 1) . '>Красный</option>
        <option value="2" ' . colorValueResult($postTypeColor, 2) . '>Синий</option>
        <option value="3" ' . colorValueResult($postTypeColor, 3) . '>Белый</option>
        <option value="4" ' . colorValueResult($postTypeColor, 4) . '>Черный</option>
        <option value="5" ' . colorValueResult($postTypeColor, 5) . '>Желтый</option>
        <option value="6" ' . colorValueResult($postTypeColor, 6) . '>Зеленый</option>
        <option value="7" ' . $colorValue7Result . '>Нет</option>
    </select>';

    return $colorHTMLResult;
}
;

function sizeErrorResult($postTypeSize)
{
    $sizeErrorResult = '';

    $key_size = 0;
    if ($postTypeSize == 1) {
        for ($i = 1; $i <= 5; $i++) {
            if ($_SESSION['post']['select-size' . $i . ''] == 6) {
                $key_size++;
                echo "<script>console.log('1' );</script>";
            }
            ;
        }
        ;
    }
    ;

    if ($postTypeSize == 6) {
        for ($i = 6; $i <= 10; $i++) {
            if ($_SESSION['post']['select-size' . $i . ''] == 6) {
                $key_size++;
                echo "<script>console.log('6' );</script>";
            }
            ;
        }
        ;
    }
    ;

    if ($postTypeSize == 11) {
        for ($i = 11; $i <= 15; $i++) {
            if ($_SESSION['post']['11' . $i . ''] == 6) {
                $key_size++;
            }
            ;
        }
        ;
    }
    ;

    if ($postTypeSize == 16) {
        for ($i = 20; $i <= 5; $i++) {
            if ($_SESSION['post']['16' . $i . ''] == 6) {
                $key_size++;
            }
            ;
        }
        ;
    }
    ;

    if ($key_size == 5) {
        $sizeErrorResult = '<span class="error"> Выберите размер!</span>';
        echo "<script>console.log('No size' );</script>";
    }
    ;

    return $sizeErrorResult;
}
;

function sizeValueResult($f_postTypeSize, $f_postTypeSizeValue)
{
    $sizeSelectionResult = '';

    if ($_SESSION['post']['select-size' . $f_postTypeSize . ''] == $f_postTypeSizeValue) {
        $sizeSelectionResult = 'selected';
        echo "<script>console.log('selected' );</script>";
    }
    ;

    return $sizeSelectionResult;
}
;

function sizeHTML($postTypeSize)
{

    $sizeValue6Result = '';

    if ($_SESSION['post']['select-size' . $postTypeSize . ''] == 6 || sizeValueResult($postTypeSize, 6) == 'selected' || empty($_SESSION['post']['select-size' . $postTypeSize . ''])) {
        $sizeValue6Result = 'selected';
        echo "<script>console.log('select-size' );</script>";
    }
    ;

    $sizeHTMLResult = '
    <select class="information-container__select-size select-size' . $postTypeSize . '" name="select-size' . $postTypeSize . '">
        <option value="1" ' . sizeValueResult($postTypeSize, 1) . '>S</option>
        <option value="2" ' . sizeValueResult($postTypeSize, 2) . '>M</option>
        <option value="3" ' . sizeValueResult($postTypeSize, 3) . '>L</option>
        <option value="4" ' . sizeValueResult($postTypeSize, 4) . '>XL</option>
        <option value="5" ' . sizeValueResult($postTypeSize, 5) . '>2XL</option>
        <option value="6" ' . $sizeValue6Result . '>Нет</option>
    </select>';

    return $sizeHTMLResult;
}
;

function queryErrorResult($connect, $productNum)
{
    $queryErrorResult = '';

    $query_product_examination = mysqli_query($connect, 'SELECT * FROM `Товар`');

    $query_product_examination_list = mysqli_fetch_all($query_product_examination);

    $query_color_examination = mysqli_query($connect, 'SELECT * FROM `Список_цветов_товара`');

    $query_color_examination_list = mysqli_fetch_all($query_color_examination);

    $query_size_examination = mysqli_query($connect, 'SELECT * FROM `Список_размеров_товара`');

    $query_size_examination_list = mysqli_fetch_all($query_size_examination);

    $key_continue = 0;

    $count_id = count($query_product_examination_list);

    for ($i = 0; $i <= $count_id; $i++) {
        if ($query_product_examination_list[$i][4] == preg_replace("/[^a-zA-Zа-яА-Я0-9\s]/ui", "", $_SESSION['post']['name' . $productNum . '']) && $query_color_examination_list[$i][2] == $_SESSION['post']['select-color' . $productNum . '']) {
            $key_continue++;
            $i = $count_id;
            echo "<script>console.log('queryErrorResult' );</script>";
        }
        ;
    }
    ;

    if ($key_continue >= 1) {
        $queryErrorResult = '<span class="error"> Такой товар уже существует!</span>';
        echo "<script>console.log('tovar est' );</script>";
    }
    ;

    return $queryErrorResult;
}
;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="shortcut icon" href="images/logo.png" type="images/png">
    <script src="https://unpkg.com/popper.js@1" defer></script>
    <script src="https://unpkg.com/tippy.js@5" defer></script>
    <script src="scripts/app.js" defer></script>
    <title>SetShly - Заказывай на свой вкус!</title>
</head>

<body id="body">
    <header id="header">
        <form class="search" method="get"> <img src="images/search.png" alt="" draggable="false">
            <input type="search" name="search" placeholder="Поиск">
        </form>
        <h1><a href="../Index/index.php" style="color: #282b34;">SetShly</a></h1> <img class="logo"
            src="images/logo.png" alt="" draggable="false">
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
                        echo '<a href="http://setshly/php/profile/profile.php" class="profile" id="profile_lk"><img src="images/profile.png" alt="Личный кабинет" draggable="false"></a>';
                    } else {
                        echo '<div class="profile" id="profile" ><img src="images/profile.png" alt="Вход" draggable="false"></div>
                        ';
                    }
                    ?>

                </li>
                <li>
                    <a href="../Liked/liked.html" class="liked"><img src="images/liked.png" alt="Избранное"
                            draggable="false"></a>
                </li>
                <li>
                    <a href="../Basket/basket.html" class="basket"><img src="images/basket.png" alt="Корзина"
                            draggable="false"></a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <form class="form" method="post" action="form-adding.php" enctype="multipart/form-data">
            <div class="form__indentation">Первый товар</div>
            <!--ПЕРВАЯ ФОРМА-->
            <div class="information-container information-container-sample1">
                <input class="information-container__input-hidden input-hidden1" type="hidden"
                    name="information-container-sample1" value="open">
                <div class="information-container__product-image product-image1"><label
                        class="information-container__label-file" for="file1"><img src=""><input
                            class="information-container__image-download" type="file" id="file1" name="image1"><span
                            class="information-container__image-title">Выберите изображение
                            <?php if (!empty($_SESSION['post']['formSubmit'])) {
                                echo imageErrorResult(1);
                                echo "<script>console.log('ara1' );</script>";
                            }
                            ; ?>
                        </span></label></div>
                <div class="information-container__product-info product-info1">
                    <div class="information-container__product-name product-name1">
                        <label class="information-container__label-name" for="input-name">Название:
                            <?php if (!empty($_SESSION['post']['formSubmit'])) {
                                echo nameErrorResult(1);
                                echo "<script>console.log('ara2' );</script>";
                            }
                            ; ?>
                        </label>
                        <input type="text" name="name1" class=" information-container__input-name input-name1"
                            autocomplete="off" value="<?= $_SESSION['post']['name1'] ?>">
                    </div>
                    <div class="information-container__product-price">
                        <label class="information-container__label-price" for="input-price">Цена: </label>
                        <?php if (!empty($_SESSION['post']['formSubmit'])) {
                            echo priceErrorResult(1);
                            echo "<script>console.log('ara3' );</script>";
                        }



                        ; ?>
                        <input type="text" name="price1" class="information-container__input-price input-price1"
                            autocomplete="off" value="<?= $_SESSION['post']['price1'] ?>">
                    </div>
                    <div class="information-container__product-color"> <span
                            class="information-container__color-title">Цвет:
                            <?php if (!empty($_SESSION['post']['formSubmit'])) {
                                echo colorErrorResult(1);
                                echo "<script>console.log('ara4' );</script>";
                            }
                            ; ?>
                        </span>
                        <div class="information-container__colors">
                            <?php echo colorHTML(1); ?>
                        </div>
                    </div>
                    <div class="information-container__product-size"> <span
                            class="information-container__size-title">Размер:
                            <?php if (!empty($_SESSION['post']['formSubmit'])) {
                                echo sizeErrorResult(1);
                                echo "<script>console.log('ara5' );</script>";
                            }
                            ; ?>
                        </span>
                        <div class="information-container__sizes">
                            <?php echo sizeHTML(1); ?>
                            <?php echo sizeHTML(2); ?>
                            <?php echo sizeHTML(3); ?>
                            <?php echo sizeHTML(4); ?>
                            <?php echo sizeHTML(5); ?>
                        </div>
                    </div>
                    <div class="information-container__buttons">
                        <button type="submit" name="formSubmit" class="information-container__add-button"
                            value="Добавить">Добавить</button>
                    </div>
                    <?php if (!empty($_SESSION['post']['formSubmit'])) {
                        echo queryErrorResult($connect, 1);
                        echo "<script>console.log('ara6' );</script>";
                    }
                    ; ?>
                </div>
            </div>
            <div class="form__indentation">Второй товар</div>
            <!--ВТОРАЯ ФОРМА-->
            <div class="information-container information-container-sample2">
                <input class="information-container__input-hidden input-hidden2" type="hidden"
                    name="information-container-sample2" value="<?php echo hiddenValueResult(2) ?>">

                <div
                    class="information-container__closing-background closing-background2 closing-background_closed closing-background_transition-closed">
                    <div class="information-container__closing-button closing-button2">Открыть<img
                            class="closing-background_image-lock" src="images/lock.png" alt=""></div>
                </div>

                <div
                    class="information-container__product-image product-image2 form_closing closing-background_transition-closed">
                    <label class="information-container__label-file" for="file2"><img src=""><input
                            class="information-container__image-download" type="file" id="file2" name="image2"><span
                            class="information-container__image-title">Выберите изображение
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample2'] == 'open') {
                                echo imageErrorResult(2);
                            }
                            ; ?>
                        </span></label>
                </div>

                <div
                    class="information-container__product-info product-info2 form_closing closing-background_transition-closed">
                    <div class="information-container__product-name product-name2">
                        <label class="information-container__label-name" for="input-name">Название:
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample2'] == 'open') {
                                echo nameErrorResult(2);
                            }
                            ; ?>
                        </label>
                        <input type="text" name="name2" class=" information-container__input-name input-name2"
                            autocomplete="off" value="<?= $_SESSION['post']['name2'] ?>">
                    </div>
                    <div class="information-container__product-price">
                        <label class="information-container__label-price" for="input-price">Цена: </label>
                        <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample2'] == 'open') {
                            echo priceErrorResult(2);
                        }
                        ; ?>
                        <input type="text" name="price2" class="information-container__input-price input-price2"
                            autocomplete="off" value="<?= $_SESSION['post']['price2'] ?>">
                    </div>
                    <div class="information-container__product-color"> <span
                            class="information-container__color-title">Цвет:
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample2'] == 'open') {
                                echo colorErrorResult(2);
                            }
                            ; ?>
                        </span>
                        <div class="information-container__colors">
                            <?php echo colorHTML(2); ?>
                        </div>
                    </div>
                    <div class="information-container__product-size"> <span
                            class="information-container__size-title">Размер:
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample2'] == 'open') {
                                echo sizeErrorResult(6);
                            }
                            ; ?>
                        </span>
                        <div class="information-container__sizes">
                            <?php echo sizeHTML(6); ?>
                            <?php echo sizeHTML(7); ?>
                            <?php echo sizeHTML(8); ?>
                            <?php echo sizeHTML(9); ?>
                            <?php echo sizeHTML(10); ?>
                        </div>
                    </div>
                    <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample2'] == 'open') {
                        echo queryErrorResult($connect, 2);
                    }
                    ; ?>
                </div>
                <div class="information-container__button-close button-close2"><img src="images/lock-button.png"
                        alt="Закрыть"></div>
            </div>
            <div class="form__indentation">Третий товар</div>
            <!--ТРЕТЬЯ ФОРМА-->
            <div class="information-container information-container-sample3">
                <input class="information-container__input-hidden input-hidden3" type="hidden"
                    name="information-container-sample3" value="<?php echo hiddenValueResult(3) ?>">
                <div
                    class="information-container__closing-background closing-background3 closing-background_closed closing-background_transition-closed">
                    <div class="information-container__closing-button closing-button3">Открыть<img
                            class="closing-background_image-lock" src="images/lock.png" alt=""></div>
                </div>
                <div
                    class="information-container__product-image product-image3 form_closing closing-background_transition-closed">
                    <label class="information-container__label-file" for="file3"><img src=""><input
                            class="information-container__image-download" type="file" id="file3" name="image3"><span
                            class="information-container__image-title">Выберите изображение
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample3'] == 'open') {
                                echo imageErrorResult(3);
                            }
                            ; ?>
                        </span></label>
                </div>
                <div
                    class="information-container__product-info product-info3 form_closing closing-background_transition-closed">
                    <div class="information-container__product-Аname product-name3">
                        <label class="information-container__label-name" for="input-name">Название:
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample3'] == 'open') {
                                echo nameErrorResult(3);
                            }
                            ; ?>
                        </label>
                        <input type="text" name="name3" class=" information-container__input-name input-name3"
                            autocomplete="off" value="<?= $_SESSION['post']['name3'] ?>">
                    </div>
                    <div class="information-container__product-price">
                        <label class="information-container__label-price" for="input-price">Цена: </label>
                        <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample3'] == 'open') {
                            echo priceErrorResult(3);
                        }
                        ; ?>
                        <input type="text" name="price3" class="information-container__input-price input-price3"
                            autocomplete="off" value="<?= $_SESSION['post']['price3'] ?>">
                    </div>
                    <div class="information-container__product-color"> <span
                            class="information-container__color-title">Цвет:
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample3'] == 'open') {
                                echo colorErrorResult(3);
                            }
                            ; ?>
                        </span>
                        <div class="information-container__colors">
                            <?php echo colorHTML(3); ?>
                        </div>
                    </div>
                    <div class="information-container__product-size"> <span
                            class="information-container__size-title">Размер:
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample3'] == 'open') {
                                echo sizeErrorResult(11);
                            }
                            ; ?>
                        </span>
                        <div class="information-container__sizes">
                            <?php echo sizeHTML(11); ?>
                            <?php echo sizeHTML(12); ?>
                            <?php echo sizeHTML(13); ?>
                            <?php echo sizeHTML(14); ?>
                            <?php echo sizeHTML(15); ?>
                        </div>
                    </div>
                    <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample3'] == 'open') {
                        echo queryErrorResult($connect, 3);
                    }
                    ; ?>
                </div>
                <div class="information-container__button-close button-close3"><img src="images/lock-button.png"
                        alt="Закрыть"></div>
            </div>
            <div class="form__indentation">Четвертый товар</div>
            <!--ЧЕТВЕРТАЯ ФОРМА-->
            <div class="information-container information-container-sample4">
                <input class="information-container__input-hidden input-hidden4" type="hidden"
                    name="information-container-sample4" value="<?php echo hiddenValueResult(4) ?>">
                <div
                    class="information-container__closing-background closing-background4 closing-background_closed closing-background_transition-closed">
                    <div class="information-container__closing-button closing-button4">Открыть<img
                            class="closing-background_image-lock" src="images/lock.png" alt=""></div>
                </div>
                <div
                    class="information-container__product-image product-image4 form_closing closing-background_transition-closed">
                    <label class="information-container__label-file" for="file4"><img src=""><input
                            class="information-container__image-download" type="file" id="file4" name="image4"><span
                            class="information-container__image-title">Выберите изображение
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample4'] == 'open') {
                                echo imageErrorResult(4);
                            }
                            ; ?>
                        </span></label>
                </div>
                <div
                    class="information-container__product-info product-info4 form_closing closing-background_transition-closed">
                    <div class="information-container__product-name product-name4">
                        <label class="information-container__label-name" for="input-name">Название:
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample4'] == 'open') {
                                echo nameErrorResult(4);
                            }
                            ; ?>
                        </label>
                        <input type="text" name="name4" class=" information-container__input-name input-name4"
                            autocomplete="off" value="<?= $_SESSION['post']['name4'] ?>">
                    </div>
                    <div class="information-container__product-price">
                        <label class="information-container__label-price" for="input-price">Цена: </label>
                        <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample4'] == 'open') {
                            echo priceErrorResult(4);
                        }
                        ; ?>
                        <input type="text" name="price4" class="information-container__input-price input-price4"
                            autocomplete="off" value="<?= $_SESSION['post']['price4'] ?>">
                    </div>
                    <div class="information-container__product-color"> <span
                            class="information-container__color-title">Цвет:
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample4'] == 'open') {
                                echo colorErrorResult(4);
                            }
                            ; ?>
                        </span>
                        <div class="information-container__colors">
                            <?php echo colorHTML(4); ?>
                        </div>
                    </div>
                    <div class="information-container__product-size"> <span
                            class="information-container__size-title">Размер:
                            <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample4'] == 'open') {
                                echo sizeErrorResult(16);
                            }
                            ; ?>
                        </span>
                        <div class="information-container__sizes">
                            <?php echo sizeHTML(16); ?>
                            <?php echo sizeHTML(17); ?>
                            <?php echo sizeHTML(18); ?>
                            <?php echo sizeHTML(19); ?>
                            <?php echo sizeHTML(20); ?>
                        </div>
                    </div>
                    <?php if (!empty($_SESSION['post']['formSubmit']) && $_SESSION['post']['information-container-sample4'] == 'open') {
                        echo queryErrorResult($connect, 4);
                    }
                    ; ?>
                </div>
                <div class="information-container__button-close button-close4"><img src="images/lock-button.png"
                        alt="Закрыть"></div>
            </div>
        </form>
    </main>

    <footer id="footer">
        <div class="about-company"><a href="">О НАС</a></div>
        <div class="help"><a href="">ПОМОЩЬ</a></div>
        <div class="find"><a href="">НАЙДИ НАС</a></div>
    </footer>

</body>

</html>