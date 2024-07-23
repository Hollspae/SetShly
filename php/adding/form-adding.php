<?php
session_start();
require_once '../config/connect.php';

$_SESSION['connect'] = mysqli_connect('127.0.0.1', 'root', '', 'Shop');

$_SESSION['colorForm'] = [];
$_SESSION['nameForm'] = [];
$_SESSION['priceForm'] = [];
$_SESSION['sizeForm'] = [];

$_SESSION['informationContainer'] = [];

for ($i = 1; $i <= 4; $i++) {
    $_SESSION['colorForm'][$i] = $_POST['select-color' . $i . ''];
    $_SESSION['nameForm'][$i] = preg_replace("/[^a-zA-Zа-яА-Я0-9\s]/ui", "", $_POST['name' . $i . '']);
    $_SESSION['priceForm'][$i] = preg_replace("/\D/ui", "", $_POST['price' . $i . '']);
    $sizeSum1 = $i + 5;
    $sizeSum2 = $i + 10;
    $sizeSum3 = $i + 15;
    $_SESSION['sizeForm'][$i] = $_POST['select-size' . $i . ''];
    $_SESSION['sizeForm'][$sizeSum1] = $_POST['select-size' . $sizeSum1 . ''];
    $_SESSION['sizeForm'][$sizeSum2] = $_POST['select-size' . $sizeSum2 . ''];
    $_SESSION['sizeForm'][$sizeSum3] = $_POST['select-size' . $sizeSum3 . ''];
    $_SESSION['informationContainer'][$i] = $_POST['information-container-sample' . $i . ''];
    if ($i == 4) {
        $_SESSION['sizeForm'][5] = $_POST['select-size5'];
        $_SESSION['sizeForm'][10] = $_POST['select-size10'];
        $_SESSION['sizeForm'][15] = $_POST['select-size15'];
        $_SESSION['sizeForm'][20] = $_POST['select-size20'];

    }
    ;
}
;

ksort($_SESSION['sizeForm']);

$keyLogin = 0;

$keyCategory = 0;

$_SESSION['categoryList'] = ["Футболка", "Джинсы", "Носки", "Худи"];

for ($i = 1; $i <= 4; $i++) {
    if (empty ($_SESSION['nameForm'][$i] || $_SESSION['nameForm'][$i] != $_SESSION['nameForm'][1]) || !is_numeric($_SESSION['priceForm'][$i]) || $_SESSION['priceForm'][$i] != $_SESSION['priceForm'][1]) {
        $keyLogin++;

    }
    ;

    if ($i == 4) {
        for ($k = 0; $k <= 3; $k++) {
            if (strpos($_SESSION['nameForm'][$i], $_SESSION['categoryList'][$k]) != false) {
                $keyCategory++;

            }
            ;
        }
        ;
    }
    ;
}
;

if ($keyLogin == 0 && $keyCategory == 0) {

    $_SESSION['queryResult'];

    function formRequest($formNumber)
    {
        $imageSize = $_FILES['image' . $formNumber . '']['size'];

        $formArray = [];

        for ($i = 1; $i <= 4; $i++) {
            $formArray[$i] = [$_POST['information-container-sample' . $i . '']];
        }
        ;

        $keyColor = 0;

        for ($i = 1; $i <= 4; $i++) {
            if ($i != $formNumber && $formArray[$i] == "open" && $_SESSION['colorForm'][$i] == $_POST['select-color' . $formNumber . '']) {
                $keyColor++;

            }
            ;
        }
        ;

        if (
            $keyColor === 0 &&
            !empty ($imageSize) &&
            $imageSize <= (10 * 1024 * 1024) &&
            in_array(getimagesize($_FILES['image' . $formNumber . '']['tmp_name'])['mime'], array('image/jpeg', 'image/png'))
        ) {

            $keySizeOne = 0;

            $keySizeTwo = 0;


            for ($k = 1; $k <= 5; $k++) {
                if ($k != 5) {
                    $sizeNum = 5 * $formNumber - $k;
                    if ($_SESSION['sizeForm'][$sizeNum] == 6) {
                        $keySizeOne++;

                    }
                    ;
                } else if ($k == 5) {
                    $sizeNum = 5 * $formNumber;

                    if ($_SESSION['sizeForm'][$sizeNum] == 6) {
                        $keySizeTwo = 1;

                    }
                    ;
                }
                ;
            }
            ;

            $keySize = $keySizeOne + $keySizeTwo;

            if ($keySize < 5) {

                $queryProductExamination = mysqli_query($_SESSION['connect'], 'SELECT * FROM `Товар`');

                $queryProductExaminationList = mysqli_fetch_all($queryProductExamination);

                $queryColorExamination = mysqli_query($_SESSION['connect'], 'SELECT * FROM `Список_цветов_товара`');

                $queryColorExaminationList = mysqli_fetch_all($queryColorExamination);

                $keyContinue = 0;

                $countId = count($queryProductExaminationList);

                for ($i = 0; $i <= $countId; $i++) {
                    if ($queryProductExaminationList[$i][4] == $_SESSION['nameForm'][$formNumber] && $queryColorExaminationList[$i][2] == $_POST['select-color' . $formNumber . '']) {
                        $keyContinue++;
                        $i = $countId;

                    }
                    ;
                }
                ;

                if ($keyContinue === 0) {

                    $sizeIdentify = [];


                    for ($i = 1; $i <= 5; $i++) {
                        $sizeIdentify[$i] = 0;
                    }
                    ;

                    for ($k = 1; $k <= 5; $k++) {
                        if ($k != 5) {
                            $sizeNum = 5 * $formNumber - $k;
                            for ($q = 1; $q <= 5; $q++) {
                                if ($_SESSION['sizeForm'][$sizeNum] == $q) {
                                    $sizeIdentify[$k]++;
                                }
                                ;
                            }
                        } else if ($k == 5) {
                            $sizeNum = 5 * $formNumber;
                            for ($q = 1; $q <= 5; $q++) {
                                if ($_SESSION['sizeForm'][$sizeNum] == $q) {
                                    $sizeIdentify[$k]++;
                                }
                                ;
                            }
                            ;
                        }
                        ;
                    }
                    ;

                    foreach ($sizeIdentify as $key => $value) {
                        if ($key == 1) {
                            $sizeIdentify[4] = $value;
                        } else if ($key == 4) {
                            $sizeIdentify[1] = $value;
                        } else if ($key == 2) {
                            $sizeIdentify[3] = $value;
                        } else if ($key == 3) {
                            $sizeIdentify[2] = $value;
                        }
                        ;
                    }
                    ;

                    $keySizeIdentify = 0;

                    for ($i = 1; $i <= 5; $i++) {
                        if ($sizeIdentify[$i] >= 2) {
                            $keySizeIdentify++;
                        }
                        ;
                    }
                    ;

                    if ($keySizeIdentify == 0) {
                        $productCategory = 0;

                        for ($i = count($_SESSION['categoryList']) - 1; $i >= 0; $i--) {
                            $_SESSION['categoryList'][$i + 1] = $_SESSION['categoryList'][$i];
                        }
                        ;

                        for ($i = 1; $i <= 4; $i++) {
                            if (strpos($_SESSION['nameForm'][1], $_SESSION['categoryList'][$i]) !== false) {
                                $productCategory = $i;
                            }
                            ;
                        }
                        ;

                        $globalUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Товар`'))) + 1;

                        $globalColorUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Список_цветов_товара`'))) + 1;

                        $globalSizeUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Список_размеров_товара`'))) + 1;

                        $globalPriceUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Прайс-лист_товаров`'))) + 1;

                        $date = date('Y-m-d');

                        $upload_dir = 'product-images/';

                        $imageName = $upload_dir . $globalUpdateID . '.png';

                        $mov = move_uploaded_file($_FILES['image1']['tmp_name'], $imageName);

                        $queryProduct = mysqli_query($_SESSION['connect'], 'INSERT INTO `Товар` (`ID_Товара`, `ID_Категории`, `ID_Вышивки`, `Количество`, `Название`, `Фотография`) VALUES (' . $globalUpdateID . ', ' . $productCategory . ', 1, 1, "' . $_SESSION['nameForm'][$formNumber] . '", "' . $imageName . '")');

                        $queryPrice = mysqli_query($_SESSION['connect'], 'INSERT INTO `Прайс-лист_товаров` (`ID_Прайс-листа_товаров`, `ID Товара`, `Цена`, `Дата`) VALUES (' . $globalPriceUpdateID . ', ' . $globalUpdateID . ', ' . $_SESSION['priceForm'][$formNumber] . ', "' . $date . '")');

                        $queryColor = mysqli_query($_SESSION['connect'], 'INSERT INTO `Список_цветов_товара` (`ID_Списка_цветных_товаров`, `ID_Товара`, `ID_Цветового_кода`, Количество) VALUES (' . $globalColorUpdateID . ', ' . $globalUpdateID . ',
                            ' . $_SESSION['colorForm'][$formNumber] . ', 1)');

                        $sizeCountList = [];

                        for ($i = 1; $i <= 4; $i++) {
                            if ($formNumber == $i) {
                                for ($k = 1; $k <= 5; $k++) {
                                    if ($k != 5) {
                                        $sizeCountList[$k] = 5 * $i - $k;
                                    } else if ($k == 5) {
                                        $sizeCountList[$k] = 5 * $i - 4;
                                    }
                                    ;
                                }
                                ;
                            }
                            ;
                        }
                        ;

                        if ($_SESSION['sizeForm'][$formNumber * $sizeCountList[1]] != 6) {
                            $querySize1 = mysqli_query($_SESSION['connect'], 'INSERT INTO `Список_размеров_товара` (`ID_Списка_размеров`, `ID_Товара`, `ID_Размера`, Количество) VALUES (' . $globalSizeUpdateID . ', ' . $globalUpdateID . ', ' . $_SESSION['sizeForm'][$formNumber] . ', 1)');

                            $globalSizeUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Список_размеров_товара`'))) + 1;
                        }

                        if ($_SESSION['sizeForm'][$formNumber * $sizeCountList[2]] != 6) {

                            $querySize2 = mysqli_query($_SESSION['connect'], 'INSERT INTO `Список_размеров_товара` (`ID_Списка_размеров`, `ID_Товара`, `ID_Размера`, Количество) VALUES (' . $globalSizeUpdateID . ', ' . $globalUpdateID . ', ' . $_SESSION['sizeForm'][2] . ', 1)');

                            $globalSizeUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Список_размеров_товара`'))) + 1;
                        }

                        if ($_SESSION['sizeForm'][$formNumber * $sizeCountList[3]] != 6) {
                            $querySize3 = mysqli_query($_SESSION['connect'], 'INSERT INTO `Список_размеров_товара` (`ID_Списка_размеров`, `ID_Товара`, `ID_Размера`, Количество) VALUES (' . $globalSizeUpdateID . ', ' . $globalUpdateID . ', ' . $_SESSION['sizeForm'][3] . ', 1)');

                            $globalSizeUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Список_размеров_товара`'))) + 1;
                        }

                        if ($_SESSION['sizeForm'][$formNumber * $sizeCountList[4]] != 6) {
                            $querySize4 = mysqli_query($_SESSION['connect'], 'INSERT INTO `Список_размеров_товара` (`ID_Списка_размеров`, `ID_Товара`, `ID_Размера`, Количество) VALUES (' . $globalSizeUpdateID . ', ' . $globalUpdateID . ', ' . $_SESSION['sizeForm'][4] . ', 1)');

                            $globalSizeUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Список_размеров_товара`'))) + 1;
                        }

                        if ($_SESSION['sizeForm'][$formNumber * $sizeCountList[5]] != 6) {
                            $querySize5 = mysqli_query($_SESSION['connect'], 'INSERT INTO `Список_размеров_товара` (`ID_Списка_размеров`, `ID_Товара`, `ID_Размера`, Количество) VALUES (' . $globalSizeUpdateID . ', ' . $globalUpdateID . ', ' . $_SESSION['sizeForm'][5] . ', 1)');
                        }

                        if ($formNumber != 4) {
                            $globalUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Товар`'))) + 1;

                            $globalPriceUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Прайс-лист_товаров`'))) + 1;


                            $globalColorUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Список_цветов_товара`'))) + 1;

                            $globalSizeUpdateID = count(mysqli_fetch_all(mysqli_query($_SESSION['connect'], 'SELECT * FROM `Список_размеров_товара`'))) + 1;
                        }
                        ;

                        if ($queryProduct) {
                            $_SESSION['queryResult'][$formNumber]["queryProduct"] = "true";
                        } else {
                            $_SESSION['queryResult'][$formNumber]["queryProduct"] = "false";
                        }
                        ;

                        if ($queryPrice) {
                            $_SESSION['queryResult'][$formNumber]["queryPrice"] = "true";
                        } else {
                            $_SESSION['queryResult'][$formNumber]["queryPrice"] = "false";
                        }
                        ;

                        if ($queryColor) {
                            $_SESSION['queryResult'][$formNumber]["queryColor"] = "true";
                        } else {
                            $_SESSION['queryResult'][$formNumber]["queryColor"] = "false";
                        }

                        return $_SESSION['queryResult'];
                    }
                    ;
                }
                ;
            }
            ;
        }
        ;
    }
    ;

    formRequest(1);

    for ($i = 2; $i <= 4; $i++) {
        if ($_SESSION['informationContainer'][$i] == "open") {
            formRequest($i);

        }
        ;
    }
    ;

    $keyFuncResult = 0;

    for ($i = 1; $i <= 4; $i++) {
        if (isset ($queryResults[$i])) {
            $keyFuncResult++;
        }
        ;
    }
    ;

    if ($keyFuncResult == 0) {
        $keyFormAdding = [];

        $keyFormAddingResult = "true";

        for ($i = 1; $i <= 4; $i++) {
            if ($_SESSION['informationContainer'][$i] == "open") {
                $keyFormAdding[$i]["open"] = "true";

            } else {
                $keyFormAdding[$i]["open"] = "false";

            }
            ;

            if ($_SESSION['informationContainer'][$i] == "open") {
                if (
                    $_SESSION['queryResult'][$i]["queryProduct"] &&
                    $_SESSION['queryResult'][$i]["queryPrice"] &&
                    $_SESSION['queryResult'][$i]["queryColor"]


                ) {
                    $keyFormAdding[$i]["queries"] = "true";

                } else {
                    $keyFormAdding[$i]["queries"] = "false";

                }
                ;
            }
            ;
        }
        ;

        foreach ($keyFormAdding as $key) {
            if ($key["open"] == "true" && $key["queries"] == "false") {
                $keyFormAddingResult = "false";

            }
            ;
        }
        ;

        echo var_dump($_SESSION['test']);

        if ($keyFormAddingResult == "true") {

            unset($_SESSION['categoryList']);

            unset($_SESSION['informationContainer']);

            unset($_SESSION['sizeForm']);

            unset($_SESSION['priceForm']);

            unset($_SESSION['nameForm']);

            unset($_SESSION['colorForm']);

            unset($_SESSION['connect']);

            unset($_SESSION['queryResult']);

            session_start();

            $_SESSION['queryProduct'] = "true";

            header('Location: http://setshly/php/Index/index.php');

            var_dump($_SESSION['sizeForm']);

            exit;
        } else if ($keyFormAddingResult == "false") {

            $_SESSION['files'] = $_FILES;

            $_SESSION['post'] = $_POST;

            unset($_SESSION['categoryList']);

            unset($_SESSION['informationContainer']);

            unset($_SESSION['sizeForm']);

            unset($_SESSION['priceForm']);

            unset($_SESSION['nameForm']);

            unset($_SESSION['colorForm']);

            unset($_SESSION['connect']);

            unset($_SESSION['queryResult']);

            header('Location: http://setshly/php/adding/adding.php');

            exit;
        }
        ;
    }
    ;
}
;

?>