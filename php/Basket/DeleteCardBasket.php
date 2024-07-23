















<?
require_once '../config/connect.php';

$inputValues = $_POST;


foreach ($inputValues as $key => $value) {
    if (preg_match('/^submitDeleteProduct=\d+$/', $key)) {

        $firstDigitPosition = strpos($key, '=') + 1;
        $lastDigitPosition = strrpos($key, '0');
        $IDDeleteCard = ($lastDigitPosition !== false) ? substr($key, $firstDigitPosition, $firstDigitPosition, $lastDigitPosition - $firstDigitPosition) : substr($key, $firstDigitPosition);
    }
}


if (!empty($IDDeleteCard)) {
    $queryDeleteCardBasket = mysqli_query($connect, "DELETE FROM `Список товаров` WHERE `Список товаров`.`ID Списка товаров` = '{$IDDeleteCard}'");
    $sencefull = 1;
}
if ($sencefull == 1) {
    header('Location: http://setshly/php/Basket/basket.php');
    exit;
} else {
    header('Location: http://setshly/php/Basket/basket.php');
    exit;
}
