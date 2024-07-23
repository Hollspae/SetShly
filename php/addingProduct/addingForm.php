<?php
session_start();
require_once '../config/connect.php';

$NameProductBefor = 0;
$PriceProductBefore = 0;
$arrlistMaterial = [];
$arrlistSize = [];
$arrSizeID = [];

$_SESSION['nameProduct_Form'] = null;
$_SESSION['priceProduct_Form'] = null;
$_SESSION['countProduct_Form'] = null;
$_SESSION['categoryProduct_Form'] = [];
$_SESSION['embroideryProduct_Form'] = [];
$_SESSION['discriptionProduct_Form'] = "";
$_SESSION['ColorProduct_Form'] = [];
$_SESSION['SizeID_Form'] = [];
$_SESSION['countSize_Form'] = [];

$arrlistSize[] = "Нет";
for ($i = 0; $i <= count($size_list) - 1; $i++) {
    $arrlistSize[] = $size_list[$i][1];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successfully = 0;
    $Error = [];

    $_SESSION['nameProduct_Form'] = $_POST['nameProduct'];
    $_SESSION['priceProduct_Form'] = $_POST['priceProduct'];
    $_SESSION['countProduct_Form'] = $_POST['countProduct'];
    $_SESSION['discriptionProduct_Form'] = $_POST['discriptionProduct'];
    $_SESSION['categoryProduct_Form'] = $_POST['categoryProduct'];
    $_SESSION['embroideryProduct_Form'] = $_POST['embroideryProduct'];
    $_SESSION['ColorProduct_Form'] = $_POST['ColorProduct'];
    $_SESSION['materialProduct_Form'] = $_POST['materialProduct'];

    $patternDiscription = '/^[А-ЯА-Яа-яа-яёЁ\s.,]+$/u';
    $patternPrice = '/^[0-9]+$/';

    if (!empty($_SESSION['nameProduct_Form']) && preg_match('/^[А-ЯА-Яа-яа-яёЁ\s.,]+$/u', $_SESSION['nameProduct_Form'])) {
        $borderName = "border: calc(var(--index) * .1) solid rgb(4, 187, 13)";
        $sencefullNameMatch = 1;
    } else {
        $Error['name'] = "Введите корректное название товара!";
        $borderName = "border: calc(var(--index) * .1) solid rgb(199, 2, 2)";
    }

    if (!empty($_SESSION['priceProduct_Form']) && preg_match($patternPrice, $_SESSION['priceProduct_Form']) && $_SESSION['priceProduct_Form'] > 0) {
        $borderPrice = "border: calc(var(--index) * .1) solid rgb(4, 187, 13)";
        $sencefullPriceMatch = 1;

    } else {
        $Error['price'] = "Введите корректную цену товара!";
        $borderPrice = "border: calc(var(--index) * .1) solid rgb(199, 2, 2)";

    }


    if (!empty($_SESSION['discriptionProduct_Form']) && preg_match($patternDiscription, $_SESSION['discriptionProduct_Form'])) {
        $_SESSION['discriptionProduct_Form'] = preg_replace('/[\s]+/', ' ', $_SESSION['discriptionProduct_Form']);
        $borderDiscription = "border: calc(var(--index) * .1) solid rgb(4, 187, 13)";
        $sencefullDiscriptionMatch = 1;
    } else {
        $Error['discription'] = "Введите корректное описание товара!";
        $borderDiscription = "border: calc(var(--index) * .1) solid rgb(199, 2, 2)";
    }

    $_SESSION['SizeProduct1'] = $_POST['SizeProduct1'];
    $_SESSION['SizeProduct2'] = $_POST['SizeProduct2'];
    $_SESSION['SizeProduct3'] = $_POST['SizeProduct3'];
    $_SESSION['SizeProduct4'] = $_POST['SizeProduct4'];
    $_SESSION['SizeProduct5'] = $_POST['SizeProduct5'];

    $_SESSION['countSize1'] = preg_replace('/[^0-9]+/iu', '', $_POST['countSize1']);
    $_SESSION['countSize2'] = preg_replace('/[^0-9]+/iu', '', $_POST['countSize2']);
    $_SESSION['countSize3'] = preg_replace('/[^0-9]+/iu', '', $_POST['countSize3']);
    $_SESSION['countSize4'] = preg_replace('/[^0-9]+/iu', '', $_POST['countSize4']);
    $_SESSION['countSize5'] = preg_replace('/[^0-9]+/iu', '', $_POST['countSize5']);



    //Проверка количества товара
    if ($_SESSION['countSize1'] == "" || $_SESSION['countSize2'] == "" || $_SESSION['countSize3'] == "" || $_SESSION['countSize4'] == "" || $_SESSION['countSize5'] == "") {
        $Error['Count'] = "Количество не может быть пустым!";
    }
    if ($_SESSION['SizeProduct1'] !== "Нет" && $_SESSION['countSize1'] == 0 || $_SESSION['SizeProduct2'] !== "Нет" && $_SESSION['countSize2'] == 0 || $_SESSION['SizeProduct3'] !== "Нет" && $_SESSION['countSize3'] == 0 || $_SESSION['SizeProduct4'] !== "Нет" && $_SESSION['countSize4'] == 0 || $_SESSION['SizeProduct5'] !== "Нет" && $_SESSION['countSize5'] == 0) {
        $Error['Count'] = "Введите количество товара!";
    }
    if ($_SESSION['SizeProduct1'] == "Нет" && $_SESSION['countSize1'] > 0 || $_SESSION['SizeProduct2'] == "Нет" && $_SESSION['countSize2'] > 0 || $_SESSION['SizeProduct3'] == "Нет" && $_SESSION['countSize3'] > 0 || $_SESSION['SizeProduct4'] == "Нет" && $_SESSION['countSize4'] > 0 || $_SESSION['SizeProduct5'] == "Нет" && $_SESSION['countSize5'] > 0) {
        $Error['Size'] = "Введите размер!";
    }

    if (strlen($_SESSION['countSize1']) >= 2 && substr($_SESSION['countSize1'], 0, 1) == '0') {
        $Error['Count'] = "Количество не может начинаться с 0";
    } else if (strlen($_SESSION['countSize2']) >= 2 && substr($_SESSION['countSize2'], 0, 1) == '0') {
        $Error['Count'] = "Количество не может начинаться с 0";
    } else if (strlen($_SESSION['countSize3']) >= 2 && substr($_SESSION['countSize3'], 0, 1) == '0') {
        $Error['Count'] = "Количество не может начинаться с 0";
    } else if (strlen($_SESSION['countSize4']) >= 2 && substr($_SESSION['countSize4'], 0, 1) == '0') {
        $Error['Count'] = "Количество не может начинаться с 0";
    } else if (strlen($_SESSION['countSize5']) >= 2 && substr($_SESSION['countSize5'], 0, 1) == '0') {
        $Error['Count'] = "Количество не может начинаться с 0";
    }



    if (empty($Error['Count'])) {
        $_SESSION['countSize_Form'] = [$_SESSION['countSize1'], $_SESSION['countSize2'], $_SESSION['countSize3'], $_SESSION['countSize4'], $_SESSION['countSize5']];
        $arrSizeCountList = $_SESSION['countSize_Form'];

        $CountSum = array_sum($arrSizeCountList);

        if (count(array_unique($arrSizeCountList)) === 1 && $arrSizeCountList[0] === "0") {
            $Error['Count'] = "Выберите минимум одно значение!";

        } else {
            $arrSizeCountList = array_diff($arrSizeCountList, ["0"]);
            $sencefullCount = 1;
            ;
        }
    }


    //Проверка размеров товара
    $_SESSION['SizeProduct_Form'] = [$_SESSION['SizeProduct1'], $_SESSION['SizeProduct2'], $_SESSION['SizeProduct3'], $_SESSION['SizeProduct4'], $_SESSION['SizeProduct5']];

    $arrSizeList = $_SESSION['SizeProduct_Form'];

    $allEqualToNo = false;

    if (count(array_unique($arrSizeList)) === 1 && $arrSizeList[0] === "Нет") {
        $Error['Size'] = "Выберите минимум одно значение!";

    } else {
        $arrSizeList = array_diff($arrSizeList, ["Нет"]);
        if (count($arrSizeList) != count(array_unique($arrSizeList))) {
            $Error['Size'] = "Размеры повторяются!";
        }
    }

    foreach ($arrSizeList as $sizes) {
        for ($i = 0; $i <= count($size_list); $i++) {
            if ($sizes == $size_list[$i][1]) {
                $arrSizeListID[] = $size_list[$i][0];
            }
        }
    }
}

for ($a = 0; $a <= count($material); $a++) {
    if ($_SESSION['materialProduct_Form'] == $material[$a][1]) {
        $materialID = $material[$a][0];
    }
}

//Подсчет количества
if (empty($Error['Size']) && empty($Error['Count'])) {
    for ($i = 0; $i <= count($linesParish); $i++) {
        if ($materialID == $linesParish[$i][1]) {
            $CountMaterial_linesParish = $linesParish[$i][3];

        }
    }
}

if (!empty($CountMaterial_linesParish) && !empty($CountSum)) {
    if ($CountSum > $CountMaterial_linesParish) {
        $Error['Count'] = "Максимальное количество: " . $CountMaterial_linesParish;
    }
}
;



if ($arrSizeListID !== null && $arrSizeCountList !== null) {
    // key -> Размер, value -> Значение
    $arrSizeListIDFlip = array_flip($arrSizeListID);
    $Arr_Sizes_Count = array_combine(array_keys($arrSizeListIDFlip), array_values($arrSizeCountList));

    $sencefullSizes = 1;
    foreach ($Arr_Sizes_Count as $k => $v) {
        $sizesKey[] = $k;
        $countValue[] = $v;
    }
}

$size1 = $sizesKey[0];
$size2 = $sizesKey[1];
$size3 = $sizesKey[2];
$size4 = $sizesKey[3];
$size5 = $sizesKey[4];

$count1 = $countValue[0];
$count2 = $countValue[1];
$count3 = $countValue[2];
$count4 = $countValue[3];
$count5 = $countValue[4];

$notEmpty = function ($value) {
    return !empty($value);
};



if ($sencefullSizes == 1 && $sencefullDiscriptionMatch == 1 && $sencefullNameMatch == 1 && $sencefullPriceMatch == 1) {
    if (isset($_POST['formSubmitEdit'])) {
        $data = date("Y-m-d");

        for ($i = 0; $i <= count($category_list); $i++) {
            if ($_SESSION['categoryProduct_Form'] == $category_list[$i][1]) {
                $categoryID = $category_list[$i][0];
            }
        }

        if (!empty($materialID)) {
            for ($i = 0; $i <= count($linesParish); $i++) {
                if ($materialID == $linesParish[$i][1]) {
                    $countMaterial = $linesParish[$i][3];
                }
            }
        }
        for ($a = 0; $a <= count($color_list); $a++) {
            if ($_SESSION['ColorProduct_Form'] == $color_list[$a][1]) {
                $colorID = $color_list[$a][0];
            }
        }


        if (!empty($materialID)) {
            for ($i = 0; $i <= count($linesParish); $i++) {
                if ($materialID == $linesParish[$i][1]) {
                    $countMaterial = $linesParish[$i][3];
                }
            }

        }
        for ($a = 0; $a <= count($size_list); $a++) {
            if ($_SESSION['ColorProduct_Form'] == $color_list[$a][1]) {
                $colorID = $color_list[$a][0];
            }
        }
        for ($a = 0; $a <= count($embroidery); $a++) {
            if ($_SESSION['embroideryProduct_Form'] == $embroidery[$a][1]) {
                $embroideryID = $embroidery[$a][0];
            }
        }


        for ($i = 0; $i <= count($product_list); $i++) {
            $EndIDProduct[] = $product_list[$i][0];

        }
        $filteredArray = array_filter($EndIDProduct, $notEmpty);
        $EndProduct = array_pop($filteredArray) + 1;


        $queryProduct = mysqli_query($connect, 'INSERT INTO `Товар` (`ID_Товара`, `ID_Категории`, `Название`, `Описание`) VALUES (' . $EndProduct . ', ' . $categoryID . ', "' . $_SESSION['nameProduct_Form'] . '", "' . $_SESSION['discriptionProduct_Form'] . '")');

        if (isset($queryProduct)) {
            $successfullyProduct = 1;

            for ($o = 0; $o <= count($product_price_list); $o++) {
                $EndPriceProduct[] = $product_price_list[$o][0];
                $filteredArray = array_filter($EndPriceProduct, $notEmpty);
                $EndPrice = array_pop($filteredArray) + 1;
            }

            $queryPrice = mysqli_query($connect, 'INSERT INTO `Прайс-лист_товаров` (`ID_Прайс-листа_товаров`, `ID Товара`, `Цена`, `Дата`) VALUES (' . $EndPrice . ', ' . $EndProduct . ', ' . $_SESSION['priceProduct_Form'] . ', "' . $data . '")');

            if (isset($queryPrice)) {
                $successfullyPrices = 1;

                for ($u = 0; $u <= count($material_list); $u++) {
                    $EndMaterialListID[] = $material_list[$u][0];
                    $filteredArray = array_filter($EndMaterialListID, $notEmpty);
                    $EndMaterialList = array_pop($filteredArray) + 1;


                }

                if (!empty($size1) && !empty($count1)) {
                    $arrMaterialList[] = $EndMaterialList;
                    $queryMaterialList = mysqli_query($connect, 'INSERT INTO `Список Материалов` (`ID Списка Материалов`, `ID Материала`, `ID Цвета`, `ID Размера`, `Количество`) VALUES (' . $EndMaterialList . ', ' . $materialID . ', ' . $colorID . ', ' . $size1 . ', ' . $count1 . ')');
                    $successfullyMaterialList = 1;

                }
                if (!empty($size2) && !empty($count2)) {

                    $EndMaterialList = $EndMaterialList + 1;
                    $arrMaterialList[] = $EndMaterialList;
                    $queryMaterialList = mysqli_query($connect, 'INSERT INTO `Список Материалов` (`ID Списка Материалов`, `ID Материала`, `ID Цвета`, `ID Размера`, `Количество`) VALUES (' . $EndMaterialList . ', ' . $materialID . ', ' . $colorID . ', ' . $size2 . ', ' . $count2 . ')');
                    $successfullyMaterialList = 1;

                }
                if (!empty($size3) && !empty($count3)) {

                    $EndMaterialList = $EndMaterialList + 1;
                    $arrMaterialList[] = $EndMaterialList;
                    $queryMaterialList = mysqli_query($connect, 'INSERT INTO `Список Материалов` (`ID Списка Материалов`, `ID Материала`, `ID Цвета`, `ID Размера`, `Количество`) VALUES (' . $EndMaterialList . ', ' . $materialID . ', ' . $colorID . ', ' . $size3 . ', ' . $count3 . ')');
                    $successfullyMaterialList = 1;

                }
                if (!empty($size4) && !empty($count4)) {
                    $EndMaterialList = $EndMaterialList + 1;
                    $arrMaterialList[] = $EndMaterialList;
                    $queryMaterialList = mysqli_query($connect, 'INSERT INTO `Список Материалов` (`ID Списка Материалов`, `ID Материала`, `ID Цвета`, `ID Размера`, `Количество`) VALUES (' . $EndMaterialList . ', ' . $materialID . ', ' . $colorID . ', ' . $size4 . ', ' . $count4 . ')');
                    $successfullyMaterialList = 1;

                }
                if (!empty($size5) && !empty($count5)) {
                    $EndMaterialList = $EndMaterialList + 1;
                    $arrMaterialList[] = $EndMaterialList;
                    $queryMaterialList = mysqli_query($connect, 'INSERT INTO `Список Материалов` (`ID Списка Материалов`, `ID Материала`, `ID Цвета`, `ID Размера`, `Количество`) VALUES (' . $EndMaterialList . ', ' . $materialID . ', ' . $colorID . ', ' . $size5 . ', ' . $count5 . ')');
                    $successfullyMaterialList = 1;

                }

            }

            for ($s = 0; $s <= count($production_list); $s++) {
                $EndProdiuctionID[] = $production_list[$s][0];

            }
            $filteredArray = array_filter($EndProdiuctionID, $notEmpty);

            $EndProductionList = array_pop($filteredArray) + 1;
            $date = date('Y-m-d');

            foreach ($arrMaterialList as $value) {


                $queryMaterialList = mysqli_query($connect, 'INSERT INTO `Изготовление` (`ID Изготовления`, `ID Списка Материалов`, `ID Товара`, `ID Вышивки`, `Количество`, `Дата`) VALUES (' . $EndProductionList . ', ' . $value . ', ' . $EndProduct . ', ' . $embroideryID . ', ' . $CountSum . ', "' . $date . '")');
                $EndProductionList = $EndProductionList + 1;
                $sencefullProduction = 1;
            }


            if (isset($_FILES['custom-file-upload'])) {
                $targetFolder = '../../ProductImg/' . $_SESSION['categoryProduct_Form'] . '/' . $_SESSION['embroideryProduct_Form'] . '/';
                // Получаем информацию о загруженном файле
                $fileInfo = pathinfo($_FILES['custom-file-upload']['name']);

                // Проверяем, что файл имеет допустимый формат
                if ($fileInfo['extension'] === 'png') {
                    // Переименовываем файл
                    $newFileName = '' . $_SESSION['ColorProduct_Form'] . '.' . $fileInfo['extension'];

                    // Создаем путь к файлу в целевой папке
                    $targetPath = $targetFolder . $newFileName;
                    // Проверяем, существует ли целевая папка
                    if (!file_exists($targetFolder)) {
                        // Если папка не существует, создаем её
                        mkdir($targetFolder, 0755, true);
                    }
                    // Перемещаем файл в целевую папку
                    if (move_uploaded_file($_FILES['custom-file-upload']['tmp_name'], $targetPath)) {
                        $sencefullIMG == 1;
                        // echo "Файл был успешно загружен и переименован.";
                    }
                }
            }
        }
    }
}

if ($successfullyProduct == 1 && $successfullyPrices == 1 && $successfullyMaterialList == 1 && $sencefullIMG == 1 && $sencefullProduction == 1) {

    // unset($_SESSION['nameProduct_Form']);
    // unset($_SESSION['priceProduct_Form']);
    // unset($_SESSION['countProduct_Form']);
    // unset($_SESSION['categoryProduct_Form']);
    // unset($_SESSION['embroideryProduct_Form']);
    // unset($_SESSION['discriptionProduct_Form']);
    // unset($_SESSION['ColorProduct_Form']);
    // unset($_SESSION['SizeID_Form']);
    // unset($_SESSION['countSize_Form']);

    // unset($_SESSION['SizeProduct1']);
    // unset($_SESSION['SizeProduct2']);
    // unset($_SESSION['SizeProduct3']);
    // unset($_SESSION['SizeProduct4']);
    // unset($_SESSION['SizeProduct5']);


    // unset($_SESSION['countSize1']);
    // unset($_SESSION['countSize2']);
    // unset($_SESSION['countSize3']);
    // unset($_SESSION['countSize4']);
    // unset($_SESSION['countSize5']);

    // unset($_SESSION['countSize_Form']);
    // unset($_SESSION['SizeProduct_Form']);


    header('Location: http://setshly/php/Administration/Product/product.php');
    exit;
}





?>