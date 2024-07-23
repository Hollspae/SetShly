<?
session_start();
require_once '../config/connect.php';

$inputValues = $_POST;
foreach ($inputValues as $key => $value) {
    if (preg_match('/^order-\d+$/', $key)) {

        $firstDigitPosition = strpos($key, '-') + 1;
        $lastDigitPosition = strrpos($key, '0');
        $IDDeleteCard = ($lastDigitPosition !== false) ? substr($key, $firstDigitPosition, $firstDigitPosition, $lastDigitPosition - $firstDigitPosition) : substr($key, $firstDigitPosition);
    }
}

for ($i = 0; $i <= count($list_productToOrder); $i++) {
    if ($_SESSION['id_user'] == $list_productToOrder[$i][1]) {

        $ListProductOrder[] = $list_productToOrder[$i][0];
    }
}

if (!empty($ListProductOrder)) {
    $Status = 5;
    foreach ($ListProductOrder as $list) {
        for ($i = 0; $i <= count($Order); $i++) {
            if ($list == $Order[$i][1] && $Status != $Order[$i][2]) {
                $ListOrder[] = $Order[$i][0];
            }
        }
    }
}

if(!empty($ListOrder)){
    foreach($ListOrder as $order){
        $queryDeleteCardBasket = mysqli_query($connect, "DELETE FROM `Заказ` WHERE `ID заказа` = '{$order}'");
        $sencefull = 1;
    }
}
if($sencefull == 1){
    header('Location: http://setshly/php/Delivery/delivery.php');
    exit;
} else {
    header('Location: http://setshly/php/Delivery/delivery.php');
    exit;
}

