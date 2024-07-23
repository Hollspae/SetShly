<?php
session_start();

require_once '../config/connect.php';
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



$selectColor = $_POST['select-colors'];
echo $selectColor;
if (isset ($_POST['formSubmit123'])) {


    $arrSizes = array_flip($sizes);
    unset($arrSizes['Нет']);
    $arrSizess = array_flip($arrSizes);


    $ResultEdit = 0;

    $CheckNameforCategory = preg_replace("/[^a-zA-Zа-яА-Я\s]/ui", "", $_POST['inputName']);
    $product_priseEdit = preg_replace("/[^0-9]/ui", "", $_POST['inputPrice']);

    if (!empty ($CheckNameforCategory) && preg_replace("/^([А-Я]{1}[а-я]{5,})|([A-Z]{1}[a-z]{5,})/u", "", $CheckNameforCategory)) {

        $ExplodeNameforCategory = explode(" ", $CheckNameforCategory);

        for ($i = 0; $i < count($product_category); $i++) {
            $arrCategory[] = $product_category[$i][1];
            $result = array_intersect($ExplodeNameforCategory, $arrCategory);
        }

        if ($result == true) {
            $queryProductEdit_name = mysqli_query($connect, "UPDATE `Товар` SET `Название` = '{$CheckNameforCategory}' WHERE `Товар`.`ID_Товара` = '{$_SESSION['idProduct']}' ");

            for ($i = 0; $i < 4; $i++) {
                $ResultEdit++;
            }
        }

    }

    if (!empty ($product_priseEdit) && is_numeric($product_priseEdit)) {
        $queryProductEdit_price = mysqli_query($connect, "UPDATE `Прайс-лист_товаров` SET `Цена` = '{$product_priseEdit}' WHERE `Прайс-лист_товаров`.`ID Товара` = '{$_SESSION['idProduct']}' ");

        for ($i = 0; $i < 4; $i++) {
            $ResultEdit++;
        }
    }

    if ($ResultEdit > 0) {

        header('Location: http://setshly/php/card/card.php?card=' . $_SESSION['idProduct'] . '');
        unset($_SESSION['idProduct']);
    } else {
        header('Location: http://setshly/php/card/card.php?card=' . $_SESSION['idProduct'] . '');
        unset($_SESSION['idProduct']);
    }
}














// if (in_array($arrCategory, $queryProductEdit_name)) {

// } else {
//     echo "Не нашел";
// }



// $queryProduct = mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), "UPDATE `Товар` SET (`ID_Товара`, `ID_Категории`, `ID_Вышивки`, `Количество`, `Название`, `Фотография`) VALUES ('. $product_id . ', ' .  $product_id_category . ', 1, 1, ' . $product_nameEdit . ', 'product-images/1.png)'");

// //Цвета
// for ($c = 0; $c <= count($product_color); $c++) {
//     if ($product_id == $product_color[$c][1]) {
//         $arrColor[] = $product_color[$c][2];

//         $coutColor = count($arrColor);

//         $code_color1 = $arrColor[0];
//         $code_color2 = $arrColor[1];
//         $code_color3 = $arrColor[2];
//         $code_color4 = $arrColor[3];
//         $code_color5 = $arrColor[4];
//         $code_color6 = $arrColor[5];
//     }

// }


// if ($coutColor == 1) {
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color1 == $product_color_name[$a][0]) {
//             $color1 = $product_color_name[$a][1];
//         }
//     }

//     $color2 = false;
//     $color3 = false;
//     $color4 = false;
//     $color5 = false;
//     $color6 = false;
// }

// ;
// if ($coutColor == 2) {
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color1 == $product_color_name[$a][0]) {
//             $color1 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color2 == $product_color_name[$a][0]) {
//             $color2 = $product_color_name[$a][1];
//         }
//     }
//     ;

//     $color3 = false;
//     $color4 = false;
//     $color5 = false;
//     $color6 = false;
// }
// ;
// if ($coutColor == 3) {
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color1 == $product_color_name[$a][0]) {
//             $color1 = $product_color_name[$a][1];
//         }
//     }
//     ;

//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color2 == $product_color_name[$a][0]) {
//             $color2 = $product_color_name[$a][1];
//         }
//     }
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color3 == $product_color_name[$a][0]) {
//             $color3 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     $color4 = false;
//     $color5 = false;
//     $color6 = false;
// }
// ;
// if ($coutColor == 4) {
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color1 == $product_color_name[$a][0]) {
//             $color1 = $product_color_name[$a][1];
//         }
//     }
//     ;

//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color2 == $product_color_name[$a][0]) {
//             $color2 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color3 == $product_color_name[$a][0]) {
//             $color3 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color4 == $product_color_name[$a][0]) {
//             $color4 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     $color5 = false;
//     $color6 = false;
// }
// ;
// if ($coutColor == 5) {
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color1 == $product_color_name[$a][0]) {
//             $color1 = $product_color_name[$a][1];
//         }
//     }
//     ;

//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color2 == $product_color_name[$a][0]) {
//             $color2 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color3 == $product_color_name[$a][0]) {
//             $color3 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color4 == $product_color_name[$a][0]) {
//             $color4 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color5 == $product_color_name[$a][0]) {
//             $color5 = $product_color_name[$a][1];
//         }
//     }
//     ;

//     $color6 = false;
// }
// ;
// if ($coutColor == 6) {
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color1 == $product_color_name[$a][0]) {
//             $color1 = $product_color_name[$a][1];
//         }
//     }
//     ;

//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color2 == $product_color_name[$a][0]) {
//             $color2 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color3 == $product_color_name[$a][0]) {
//             $color3 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color4 == $product_color_name[$a][0]) {
//             $color4 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color5 == $product_color_name[$a][0]) {
//             $color5 = $product_color_name[$a][1];
//         }
//     }
//     ;
//     for ($a = 0; $a <= count($product_color_name); $a++) {
//         if ($code_color6 == $product_color_name[$a][0]) {
//             $color6 = $product_color_name[$a][1];
//         }
//     }
//     ;

// }
// ;






// function product_color($product_color_list, $product_id)
// {
//     for ($c = 0; $c <= count($product_color_list); $c++) {
//         if ($product_color_list[$c][1] == $product_id) {
//             $a = $product_color_list[$c][2];
//         }

//     }
// }
// ;


// $_SESSION['connect'] = mysqli_connect('127.0.0.1', 'root', '', 'Shop');

// $_SESSION['colorForm'] = [];
// $_SESSION['nameForm'] = [];
// $_SESSION['priceForm'] = [];
// $_SESSION['sizeForm'] = [];

// $_SESSION['informationContainer'] = [];
?>