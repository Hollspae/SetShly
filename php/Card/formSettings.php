<?php
session_start();
require_once '../config/connect.php';
$url = urldecode(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$cut_search = substr($url, 38, 1);
$cut_searchColor = substr($url, 46);



$cut_explodeColor = explode('&', $cut_searchColor);
array_pop($cut_explodeColor);

$urlCount_color = mb_strlen($cut_explodeColor[0]);
// echo $urlCount_color;
if ($urlCount_color == 7) {
    $urlCount_color = $urlCount_color + 2;
}
if ($urlCount_color == 6) {
    $urlCount_color = $urlCount_color + 1;
}


$urlCount = 57 + $urlCount_color;

$cut_searchSize = substr($url, $urlCount);


$product_price = 0;
$product_image = 0;
$product_id = $cut_search;
$product_name = 0;

$arrColor = [];
$ColorCode = [];
$arrSize = [];
$arrSizeName = [];
$ArrMaterialList = [];
$product_list_copy = $product_list;



//Цвет
for ($i = 0; $i <= count($production_list); $i++) {

    if ($product_id == $production_list[$i][2]) {

        for ($j = 0; $j <= count($material_list); $j++) {
            if ($production_list[$i][1] == $material_list[$j][0]) {
                $arrColor[] = $material_list[$j][2];

                $arrColorUnique = array_unique($arrColor);
                sort($arrColorUnique); //список цветов у товара

                if (!empty($arrColorUnique)) {
                    $id_material = $material_list[$j][1];
                    $id_embroidery = $production_list[$i][3];

                }
            }

        }
    }
}
if (!empty($arrColorUnique)) {
    foreach ($arrColorUnique as $value) {
        for ($i = 0; $i <= count($color_list); $i++) {
            if ($value == $color_list[$i][0]) {
                $arrColors[] = $color_list[$i][1]; //Название цвета
                $AboutProduct__color = implode(", ", $arrColors);
            }

        }
        for ($j = 0; $j <= count($material_list); $j++) {
            if ($value == $material_list[$j][2]) {
                $arrSize[] = $material_list[$j][3];
                $arrSizeunique = array_unique($arrSize);
                sort($arrSizeunique);


            }
        }

    }

}


if (!empty($arrColors)) {
    foreach ($arrColors as $NameColors) {
        foreach ($cut_explodeColor as $cutColor) {
            if ($NameColors == $cutColor) {

                for ($k = 0; $k <= count($color_list); $k++) {
                    if ($cutColor == $color_list[$k][1]) {
                        $IDColorCut = $color_list[$k][0]; //Определение цвета по url


                    }
                }

            }
        }
    }
}



for ($i = 0; $i < count($material); $i++) {
    if ($id_material == $material[$i][0]) {
        $AboutProduct__structure = $material[$i][2]; //Состав товара
    }
}

for ($i = 0; $i < count($embroidery); $i++) {
    if ($id_embroidery == $embroidery[$i][0]) {
        $AboutProduct__embroidery = $embroidery[$i][1]; //Вышивка товара
    }
}

for ($i = 0; $i <= count($product_list); $i++) {
    if ($product_id == $product_list[$i][0]) {
        $AboutProduct__discription = $product_list[$i][3];
        $id_category = $product_list[$i][1];


    }
}

for ($i = 0; $i <= count($category_list); $i++) {
    if ($id_category == $category_list[$i][0]) {
        $AboutProduct__category = $category_list[$i][1]; //Название категории
    }
}


//Количество
for ($i = 0; $i <= count($size_list); $i++) {
    if ($cut_searchSize == $size_list[$i][1]) {
        $IDSizes = $size_list[$i][0];
    }
}
for ($a = 0; $a <= count($production_list); $a++) {

    if ($product_id == $production_list[$a][2]) {
        $ArrMaterialList[] = $production_list[$a][1];

        for ($i = 0; $i <= count($material_list); $i++) {

            foreach ($ArrMaterialList as $value) {
                if ($material_list[$i][0] == $value && $IDColorCut == $material_list[$i][2] && $IDSizes == $material_list[$i][3]) {
                    $MaterialListCount = $material_list[$i][0];

                    if ($MaterialListCount == $production_list[$a][1]) {
                        $CountProduct = $production_list[$a][4];

                    }
                }
            }



        }
    }

}


function CardOutput($IDColorCut, $material_list, $size_list, $product_list, $product_id, $product_price_list, $arrColors, $cut_explodeColor, $AboutProduct__category, $AboutProduct__embroidery, $cut_searchSize, $CountProduct)
{
    if (!empty($IDColorCut)) {
        for ($i = 0; $i <= count($material_list); $i++) {
            if ($IDColorCut == $material_list[$i][2]) {
                $IDSizeColor[] = $material_list[$i][3]; //Определение id размера в зависимости от цвета
            }
        }
    }
    if (!empty($IDSizeColor)) {
        foreach ($IDSizeColor as $IDSize) {
            for ($j = 0; $j <= count($size_list); $j++) {

                if ($IDSize == $size_list[$j][0]) {
                    $arrNameSize[] = $size_list[$j][1];

                    $arrNameSize = array_reverse(array_unique($arrNameSize));  //Определение имени размера в зависимости от цвета
                    arsort($arrNameSize);
                }
            }
        }
    }

    for ($i = 0; $i <= count($product_list); $i++) {
        if ($product_id == $product_list[$i][0]) {
            $product_name = $product_list[$i][2]; // Имя товара

            for ($k = 0; $k <= count($product_price_list); $k++) {
                if ($product_price_list[$k][1] == $product_id) {
                    $product_price = $product_price_list[$k][2]; //Прайс товара

                }
            }
        }
    }

    foreach ($arrColors as $value) {
        foreach ($cut_explodeColor as $color) {
            if ($color == $value) {
                echo '
                    <div class="product-image">
                        <img src="../../ProductImg/' . $AboutProduct__category . '/' . $AboutProduct__embroidery . '/' . $value . '.png" alt="Изображение товара" draggable="false">
                    </div>';
            }
        }
    }
    echo '
            <div class="product-info">
                <div class="product-name">
                    <h2>' . $product_name . '</h2></div>
                <div class="product-price">
                    <h3> ' . $product_price . '₽</h3></div>
                <div class="product-colors"> 
                    <span>Цвет:</span>
                    <div class="colors">';

    foreach ($arrColors as $value) {
        foreach ($cut_explodeColor as $color) {
            echo '
                <a class="formColor" href="http://setshly/php/card/card.php?card=' . $product_id . '&color=' . $value . '&size= " ><button ';
            if ($color == $value) {
                echo 'class="colorOutputActive">';
            } else {
                echo 'class="colorOutput">';
            }

            echo ' ' . $value . ' </button> </a>';
        }
    }

    echo '                                                                   
            </div>
        </div>
        <div class="product-proportions"> 
            <span>Размер:</span>
            <div class="proportions">';

    if (empty($arrNameSize)) {
        echo '<p class="Error">Выберите цвет!</p>';
    } else {

        foreach ($arrNameSize as $values) {
            echo '
                <a class="formColor" href="http://setshly/php/card/card.php?card=' . $product_id . '&color=' . $color . '&size=' . $values . '" ><button ';
            if ($cut_searchSize == $values) {
                echo 'class="proportionActive">';
            } else {
                echo 'class="proportion">';
            }
            echo ' ' . $values . ' </button></a>';


        }
        if ($CountProduct !== null) {

        }
        echo '</div> </div>';
    }
}

function TransferProductToCart($product_id, $cut_explodeColor, $cut_searchSize, $CountProduct, $color_list, $size_list, $production_list, $material_list, $basket, $connect, $list_productToBasket)
{

    $ColorNameToBasket = $cut_explodeColor[0];

    $SizeNameToBasket = $cut_searchSize;

    if (empty($ColorNameToBasket) || empty($SizeNameToBasket)) {
        echo '<p class="Error">Выберите размер!</p>';
    } else {
        echo '
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="buttons">
                <button class="button button-add" value="SubmitBakset" name="SubmitBakset" id="SubmitBakset">В корзину</button>
            </div>
        </form>';

        // ../Basket/basket.php?card=' . $product_id . '&color=' . $ColorNameToBasket . '&size=' . $SizeNameToBasket . '
        if (isset($_POST['SubmitBakset'])) {

            for ($i = 0; $i <= count($color_list); $i++) {
                if ($ColorNameToBasket == $color_list[$i][1]) {
                    $ColorIDToBasket = $color_list[$i][0];

                }
            }
            for ($i = 0; $i <= count($size_list); $i++) {
                if ($SizeNameToBasket == $size_list[$i][1]) {
                    $SizeIDToBasket = $size_list[$i][0];

                }
            }
            for ($i = 0; $i <= count($production_list); $i++) {
                if ($product_id == $production_list[$i][2]) {
                    $listMaterial[] = $production_list[$i][1];

                }
            }

            if (!empty($listMaterial)) {
                foreach ($listMaterial as $idMaterialList) {

                    for ($i = 0; $i <= count($material_list); $i++) {
                        if ($idMaterialList == $material_list[$i][0] && $ColorIDToBasket == $material_list[$i][2] && $SizeIDToBasket == $material_list[$i][3]) {
                            $NeedIDMaterialList = $material_list[$i][0];

                        }
                    }
                }
            }
        }

        if (!empty($NeedIDMaterialList)) {
            for ($i = 0; $i <= count($basket); $i++) {
                if ($_SESSION['id_user'] == $basket[$i][1]) {
                    $ID_basket = $basket[$i][0];

                }
            }
            for ($i = 0; $i <= count($production_list); $i++) {
                if ($NeedIDMaterialList == $production_list[$i][1]) {
                    $IDProduction = $production_list[$i][0]; // ID изготовления

                }
            }
        }

        if (!empty($ID_basket) && !empty($IDProduction)) {
            for ($a = 0; $a <= count($list_productToBasket); $a++) {

                if ($IDProduction == $list_productToBasket[$a][1]) {
                    if ($ID_basket == $list_productToBasket[$a][2]) {
                        $Error['exists'] = "Товар в корзине!";
                        echo '<p class="Error">' . $Error['exists'] . '</p>';
                        $accessible = 0;
                    }

                } else {
                    $accessible = 1;
                }
            }
        }
        if ($Error['exists'] !== "Товар в корзине!") {
            for ($i = 0; $i <= count($list_productToBasket) - 1; $i++) {
                $IDListProduct[] = $list_productToBasket[$i][0];
                $countListProduct = array_pop($IDListProduct) + 1;
                $countProduct = 1;
                $queryAddListProduct = mysqli_query($connect, "INSERT INTO `Список товаров` (`ID Списка товаров`, `ID Изготовления`, `ID Корзины`, `Количество`) VALUES ('{$countListProduct}', '{$IDProduction}', '{$ID_basket}', '{$countProduct}')");

            }
        }
    }



}

$IDORDER = 0;

for ($i = 0; $i <= count($feedback); $i++) {
    $listID[] = $feedback[$i][0];

}
if (!empty($listID)) {
    foreach ($listID as $v) {
        $IDORDER = $v;
    }
}

function FeedBack($product_id, $feedback, $query_user_list, $photoFeedback_list, $photoFeedback, $product_list)
{

    for ($i = 0; $i < count($feedback); $i++) {

        if ($product_id == $feedback[$i][2]) {

            $feedbacks = $feedback[$i][0];
            $iduser = $feedback[$i][1];
            $date = $feedback[$i][3];
            $discription = $feedback[$i][4];
            $rating = $feedback[$i][5];

            for ($j = 0; $j < count($query_user_list); $j++) {
                if ($iduser == $query_user_list[$j][0]) {
                    $names = $query_user_list[$j][3];
                    $sunames = $query_user_list[$j][2];
                }
            }

            $pictures = array();

            for ($d = 0; $d < count($photoFeedback_list); $d++) {
                if($photoFeedback_list[$i][1] == $feedbacks) {
                    $photo = $photoFeedback_list[$i][2];
                    for ($k = 0; $k < count($photoFeedback); $k++) {
                        if ($photo == $photoFeedback[$k][0]) {
                            $pictures[] = $photoFeedback[$k][1];
                        }
                    }
                }
            }

            $pictures_count = count($pictures);
            $pictures_echo = array();
            
            for ($a = 0; $a < count($product_list); $a++) {
                if($product_list[$a][0] == 6) {
                    $Nameproduct = $product_list[$a][2];
                }
            }

            for ($s = 0; $s < $pictures_count; $s++) {
                $pictures_echo[] = '<img class="imgFeedback" src="../../feedback/'.$Nameproduct.'/'.$pictures[$s].'" alt="">';
            }

            $picturesEchoFull = implode("<br>", $pictures_echo);

            if (!empty($rating)) {
                echo '<div class="cardFeedback">

        <div class="cardFeeback_top">
            <div class="feedback_name">
                <h3>Пользователь: </h3>
                <h2>' . $names . ' ' . $sunames . '</h2>
            </div>
            
        </div>
        <div class="cardFeeback_bottom">
            <div class="asd">
                <h3>Оценка:</h3> 
                <h2>' . $rating . '</h2>
            </div>
            <p>' . $discription . '</p>
        </div>
   
    </div>';

            }
        }

    }
}

//ОТЗЫВЫ


if (isset($_POST['btnfeedback'])) {
    if (isset($_POST)) {
        $Ratingproduct = $_POST['ratings'];

        if (!empty($_POST['Discription'])) {
            $Discriptionproduct = $_POST['Discription'];
        } else {
            $Discriptionproduct = "";
        }

        $date = date('Y-m-d');
        $id_user = $_SESSION['id_user'];
        $IDORDER = 0;
        for ($i = 0; $i <= count($feedback); $i++) {
            $listID[] = $feedback[$i][0];

        }
        if (!empty($listID)) {
            foreach ($listID as $v) {
                $IDORDER = $v;

            }
        }
        $IDORDER = $IDORDER + 1;
        if (!empty($_POST['ratings'])) {

            $queryFeedback = mysqli_query($connect, "INSERT INTO `Отзыв` (`ID Отзыва`, `ID Пользователя`, `ID Товара`, `Дата`, `Содержание`, `Оценка`) VALUES ('{$IDORDER} ', ' {$id_user}', '{$product_id}', '{$date}', '{$Discriptionproduct}', '{$Ratingproduct}')");

        }
    }

    if (!empty($queryFeedback)) {
        $feedbackDir = '../../feedback/';
        $nameIMG = $_FILES['images']['name'];
        $Nameproduct = 0;
        for ($i = 0; $i < count($product_list); $i++) {
            if($product_list[$i][0] == 6) {
                $Nameproduct = $product_list[$i][2];
            }
        }
        // Путь к папке "Футболка" внутри папки "feedback"
        $shirtDir = $feedbackDir . $Nameproduct;

        // Проверяем, существует ли папка "Футболка"
        if (!file_exists($shirtDir)) {
            // Если папка не существует, создаем ее
            mkdir($shirtDir, 0755, true);
        }

        $allowedTypes = array('image/webp', 'image/png', 'image/jpeg');

        // Проверяем, что массив $_FILES['images'] существует и содержит файлы
        if (isset($_FILES['images']) && !empty($_FILES['images'])) {
            $maxFiles = 3; // Максимальное количество файлов для загрузки
            $uploadedFilesCount = count($_FILES['images']['name']);
            if ($uploadedFilesCount <= $maxFiles) {

                // Проверяем, что загруженные файлы являются изображениями в формате PNG
                foreach ($_FILES['images']['name'] as $key => $file) {
                    $filePath = $shirtDir . '/' . basename($_FILES['images']['name'][$key]);


                    // Проверяем, что тип файла соответствует разрешенным типам
                    if (in_array($_FILES['images']['type'][$key], $allowedTypes)) {
                        // Перемещаем загруженный файл в папку "Футболка"
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $filePath)) {


                            for ($i = 0; $i < count($photoFeedback_list); $i++) {
                                $lastID_photofeedback_list[] = $photoFeedback_list[$i][0];
                                $ID_photoFeedback_list = array_pop($lastID_photofeedback_list) + 1;
                            }
                            if (!isset($lastID_photofeedback_list)) {
                                $ID_photoFeedback_list = 1;
                            }

                            for ($i = 0; $i < count($photoFeedback); $i++) {
                                $lastID_photofeedback[] = $photoFeedback[$i][0];
                                $ID_photoFeedback = array_pop($lastID_photofeedback) + 1;

                            }
                            if (!isset($lastID_photofeedback)) {
                                $ID_photoFeedback = 1;
                            }
                            $ID_photoFeedback_array = array($ID_photoFeedback);
                            foreach ($nameIMG as $nameimg) {
                                $arr[] = $ID_photoFeedback;
                                $arrIDPhotoFeedback = array_unique($arr);
                                $queryFeedbacks = mysqli_query($connect, "INSERT INTO `Фотографии отзыва` (`ID фотографии отзыва`, `Фото`) VALUES ('{$ID_photoFeedback}', '{$nameimg}')");
                                $ID_photoFeedback = $ID_photoFeedback + 1;
                                $ID_photoFeedback_array[] = $ID_photoFeedback;
                            }

                            foreach ($arrIDPhotoFeedback as $idphoto) {
                                $i = 0;
                                $queryFeedbacks = mysqli_query($connect, "INSERT INTO `Список фотографий отзывов` (`ID Списка фотографий отзывов`, `ID Отзыва`, `ID Фотографии отзыва`) VALUES ('{$ID_photoFeedback_list}', '{$IDORDER}', '{$ID_photoFeedback_array[$i]}')");
                                $ID_photoFeedback_list = $ID_photoFeedback_list + 1;
                                $i++;
                            }
                        }
                    }
                }
            }
        }
    }
}