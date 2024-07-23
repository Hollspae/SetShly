<?php
session_start();
require_once '../../config/connect.php';


for ($i = 0; $i < count($Order); $i++) {

    $listOrder[] = $Order[$i][0];

    if (!empty($listOrder)) {
        foreach ($listOrder as $ID) {
            if ($ID == $Order[$i][0]) {
                $listorderBasket[] = $Order[$i][1];
                $listStatusID[] = $Order[$i][2];
                $dates[] = $Order[$i][5];
                $dateReceipts[] = $Order[$i][6];
            }
        }
    }
}


if (!empty($listStatusID)) {
    for ($i = 0; $i <= count($StatusOrder); $i++) {
        foreach ($listStatusID as $ID) {
            if ($ID == $StatusOrder[$i][0]) {
                $listStatusName[] = $StatusOrder[$i][1];
            }
        }

    }
}


if (!empty($listorderBasket)) {
    for ($i = 0; $i <= count($list_productToOrder); $i++) {
        foreach ($listorderBasket as $ID) {
            if ($ID == $list_productToOrder[$i][0]) {
                $users[] = $list_productToOrder[$i][1];
                $productionsBasket[] = $list_productToOrder[$i][2];
            }
        }

    }
}

if (!empty($users)) {
    for ($i = 0; $i <= count($query_user_list); $i++) {
        foreach ($users as $ID) {
            if ($ID == $query_user_list[$i][0]) {
                $users[] = $query_user_list[$i][1];
                $SurNames[] = $query_user_list[$i][2];
                $Names[] = $query_user_list[$i][3];
            }
        }

    }
}

if (!empty($productionsBasket)) {
    for ($i = 0; $i <= count($production_list); $i++) {
        foreach ($productionsBasket as $id) {
            if ($id == $production_list[$i][0]) {
                $listMaterial[] = $production_list[$i][1];
                $products[] = $production_list[$i][2];
            }
        }
    }
}
if (!empty($products)) {
    for ($i = 0; $i <= count($product_list); $i++) {
        foreach ($products as $id) {
            if ($id == $product_list[$i][0]) {
                $NameProduct[] = $product_list[$i][2];
            }
        }
    }
}
if (!empty($productionsBasket)) {
    for ($i = 0; $i <= count($material_list); $i++) {
        foreach ($listMaterial as $id) {
            if ($id == $material_list[$i][0]) {
                $listColorID = $material_list[$i][2];
                $listSizeID = $material_list[$i][3];
                if (!empty($listColorID)) {
                    for ($j = 0; $j <= count($color_list); $j++) {

                        if ($listColorID == $color_list[$j][0]) {
                            $listColorName[] = $color_list[$j][1];
                        }

                    }
                }
                if (!empty($listSizeID)) {
                    for ($j = 0; $j <= count($size_list); $j++) {

                        if ($listSizeID == $size_list[$j][0]) {
                            $listSizeName[] = $size_list[$j][1];
                        }
                    }

                }

            }
        }
    }
}


for ($i = 0; $i < count($StatusOrder); $i++) {
    $listStatusALL[] = $StatusOrder[$i][1];
}

$months = [
    "January" => "января",
    "February" => "февраля",
    "March" => "марта",
    "April" => "апреля",
    "May" => "мая",
    "June" => "июня",
    "July" => "июля",
    "August" => "августа",
    "September" => "сентября",
    "October" => "октября",
    "November" => "ноября",
    "December" => "декабря"
];
$format = "j F Y";

foreach ($dates as $values) {

    $formattedDate = date($format, strtotime($values));
    $formattedDates = str_replace(array_keys($months), array_values($months), $formattedDate);
}


$_SESSION['deliveryAdmin'] = array();
$_SESSION['deliveryAdmin1'] = array();
$_SESSION['deliveryAdmin2'] = array();
$_SESSION['deliveryAdmin3'] = array();
$_SESSION['deliveryAdmin4'] = array();
$_SESSION['deliveryAdmin5'] = array();
$_SESSION['deliveryAdmin6'] = array();
$_SESSION['deliveryAdmin7'] = array();
$_SESSION['deliveryAdmin8'] = array();
$_SESSION['deliveryAdmin9'] = array();


$testDelivery = function () {
    return count($_SESSION['deliveryAdmin']);
};
$testDelivery1 = function () {
    return count($_SESSION['deliveryAdmin1']);
};
$testDelivery2 = function () {
    return count($_SESSION['deliveryAdmin2']);
};
$testDelivery3 = function () {
    return count($_SESSION['deliveryAdmin3']);
};
$testDelivery4 = function () {
    return count($_SESSION['deliveryAdmin4']);
};
$testDelivery5 = function () {
    return count($_SESSION['deliveryAdmin5']);
};
$testDelivery6 = function () {
    return count($_SESSION['deliveryAdmin6']);
};
$testDelivery7 = function () {
    return count($_SESSION['deliveryAdmin7']);
};
$testDelivery8 = function () {
    return count($_SESSION['deliveryAdmin8']);
};




foreach ($NameProduct as $name) {
    $_SESSION['deliveryAdmin']['key-' . ($testDelivery() + 1)] = [$name];
}
foreach ($listOrder as $id) {
    $_SESSION['deliveryAdmin1']['key-' . ($testDelivery1() + 1)] = [$id];
}
foreach ($listColorName as $color) {
    $_SESSION['deliveryAdmin2']['key-' . ($testDelivery2() + 1)] = [$color];
}
foreach ($listSizeName as $size) {
    $_SESSION['deliveryAdmin3']['key-' . ($testDelivery3() + 1)] = [$size];
}
foreach ($dates as $dat) {
    $formattedDate = date($format, strtotime($dat));
    $formattedDate = str_replace(array_keys($months), array_values($months), $formattedDate);
    $_SESSION['deliveryAdmin4']['key-' . ($testDelivery4() + 1)] = [$formattedDate];
}
foreach ($dateReceipts as $dat) {
    $formattedDates = date($format, strtotime($dat));
    $formattedDatesReaceipts = str_replace(array_keys($months), array_values($months), $formattedDates);

    $_SESSION['deliveryAdmin5']['key-' . ($testDelivery5() + 1)] = [$formattedDatesReaceipts];
}
foreach ($SurNames as $surN) {
    $_SESSION['deliveryAdmin6']['key-' . ($testDelivery6() + 1)] = [$surN];
}
foreach ($Names as $name) {
    $_SESSION['deliveryAdmin7']['key-' . ($testDelivery7() + 1)] = [$name];
}
foreach ($listStatusName as $name) {
    $_SESSION['deliveryAdmin8']['key-' . ($testDelivery8() + 1)] = [$name];
}


//////
foreach ($_SESSION['deliveryAdmin'] as $key => &$value) {
    $value[] = $_SESSION['deliveryAdmin1'][$key][0];
    $value[] = $_SESSION['deliveryAdmin2'][$key][0];
    $value[] = $_SESSION['deliveryAdmin3'][$key][0];
    $value[] = $_SESSION['deliveryAdmin4'][$key][0];
    $value[] = $_SESSION['deliveryAdmin5'][$key][0];
    $value[] = $_SESSION['deliveryAdmin6'][$key][0];
    $value[] = $_SESSION['deliveryAdmin7'][$key][0];
    $value[] = $_SESSION['deliveryAdmin8'][$key][0];

}



// echo "<pre>";
// print_r($_SESSION['deliveryAdmin']);


function OutPutDelvieryStatus($listStatusALL)
{
    for ($i = 1; $i <= count($_SESSION['deliveryAdmin']); $i++) {
        echo '<tr>
                <td value="' . $_SESSION['deliveryAdmin']['key-' . $i][1] . '"> ' . $_SESSION['deliveryAdmin']['key-' . $i][0] . '</td>
                <td>' . $_SESSION['deliveryAdmin']['key-' . $i][2] . ', ' . $_SESSION['deliveryAdmin']['key-' . $i][3] . '</td>
                <td>' . $_SESSION['deliveryAdmin']['key-' . $i][6] . ' ' . $_SESSION['deliveryAdmin']['key-' . $i][7] . '</td>
                <td>' . $_SESSION['deliveryAdmin']['key-' . $i][4] . '</td>
                <td>' . $_SESSION['deliveryAdmin']['key-' . $i][5] . '</td>
                       <td>' . $_SESSION['deliveryAdmin']['key-' . $i][8] . '</td>
                <td>
                    <select class="tbl-option" name="order-' . $_SESSION['deliveryAdmin']['key-' . $i][1] . '">';
        foreach ($listStatusALL as $name) {
            echo '<option  value="' . $name . '">' . $name . '</option>';
        }
        echo '
                    </select>
                </td>
                <td><button class="tbl-btn" type="submit" id="btn" name="btn" value="' . $_SESSION['deliveryAdmin']['key-' . $i][1] . '" ">Сохранить</button></td>
            </tr>';
    }
}




if (isset($_POST)) {
    $inputValues = $_POST;

    // print_r($inputValues);

    $btn = $_POST['btn'];


    foreach ($inputValues as $key => $values) {
        if (strpos($key, 'order-') !== false) {
            $pattern = '/^[1-9][0-9]*$/';

            if ($_POST['order-' . $btn . '']) {
                $statuse = $_POST['order-' . $btn . ''];
            }
        }
    }

    if (!empty($statuse)) {
        for ($j = 0; $j <= count($StatusOrder); $j++) {
            if ($statuse == $StatusOrder[$j][1]) {
                $idStatuse = $StatusOrder[$j][0];
            }
        }
    }


    for ($i = 0; $i <= count($Order); $i++) {
        foreach ($listorderBasket as $val) {
            $one = 1;
            $null = 0;

            if ($btn == $Order[$i][0] && $val == $Order[$i][1]) {
                echo $idStatuse;
                ;

                $sencefull = 1;
                if ($idStatuse == 5) {
                    $queryEditStatus = mysqli_query($connect, "UPDATE `Заказ` SET `Заказ`.`ID статуса заказа` = '{$idStatuse}' WHERE `Заказ`.`ID заказа` ='{$btn}'");
                    $queryEditStatus = mysqli_query($connect, "UPDATE `Заказ` SET `Заказ`.`Определитель` = '{$one}' WHERE `Заказ`.`ID заказа` ='{$btn}'");
                }
                if ($idStatuse < 5) {
                    $queryEditStatus = mysqli_query($connect, "UPDATE `Заказ` SET `Заказ`.`ID статуса заказа` = '{$idStatuse}' WHERE `Заказ`.`ID заказа` ='{$btn}'");
                    $queryEditStatus = mysqli_query($connect, "UPDATE `Заказ` SET `Заказ`.`Определитель` = '{$null} WHERE `Заказ`.`ID заказа` ='{$btn}'");
                }
            }
        }
    }





}
