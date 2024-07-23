<?php
require_once '../config/connect.php';
// include 'form-basket.php';

print_r($_POST);

if (isset($_POST['submitOrder'])) {


    for ($a = 0; $a <= count($basket); $a++) {
        if ($_SESSION['id_user'] == $basket[$a][1]) {
            $BasketID = $basket[$a][0]; //ID корзины пользователя
        }
    }

    for ($a = 0; $a <= count($list_productToBasket); $a++) {
        if ($BasketID == $list_productToBasket[$a][2]) {
            $productionProduct[] = $list_productToBasket[$a][1]; //ID изготовлений в списке товаров
        }
    }

    if (!empty($productionProduct)) {
        foreach ($productionProduct as $values) {

            for ($j = 0; $j <= count($list_productToBasket); $j++) {

                if ($values == $list_productToBasket[$j][1]) {
                    $countProductBasket = $list_productToBasket[$j][3];

                    for ($i = 0; $i <= count($production_list); $i++) {
                        if ($values == $production_list[$i][0]) {
                            $productID = $production_list[$i][2];
                        }
                    }

                    for ($i = 0; $i <= count($product_price_list); $i++) {
                        if ($productID == $product_price_list[$i][1]) {
                            $product_price = $product_price_list[$i][2]; //Прайс товара
                            $arrproduct_prices[] = $countProductBasket * $product_price;
                            $arrProduct_price = array_sum($arrproduct_prices); //Сумма корзины

                        }


                    }
                }
            }
        }
    }

    for ($i = 0; $i <= count($StatusOrder); $i++) {
        $IDStatusOrder = 1;
        if ($IDStatusOrder == $StatusOrder[$i][0]) {
            $NameStatusOrder = $StatusOrder[$i][1]; //Статус доставки "В сборке"
        }
    }

    $date = date('Y-m-d'); //Дата заказа
    $dateReceipt = date("Y-m-d", time() + 60 * 60 * 24 * 7);

    foreach ($ARRnumberCardUser as $key => $value) {
        if ($_POST['NumberCardInput'] == $key) {
            $NumberCard = $value;
        }
    }

    if (!empty($BasketID) && !empty($productionProduct) && !empty($arrProduct_price) && !empty($_POST['DeliveryText']) && !empty($NameStatusOrder) && !empty($date) && !empty($dateReceipt)) {
        for ($i = 0; $i <= count($delivery); $i++) {
            if ($_POST['DeliveryText'] == $delivery[$i][0]) {
                $IDdelivery = $delivery[$i][0];
                $Index = $delivery[$i][2];
                $Region = $delivery[$i][3];
                $City = $delivery[$i][4];
                $Adrress = $delivery[$i][5];
                $HouseNumber = $delivery[$i][6];
            }
        }

        for ($i = 0; $i <= count($Order); $i++) {
            $EndOrderID[] = $Order[$i][0];
            $countOrderID = count($EndOrderID);
            if ($countOrderID < 1) {
                $EndOrder = 1;
            }
            if ($countOrderID = 1) {
                $EndOrder = array_pop($EndOrderID) - 1;
                $EndOrder = $EndOrder + 1;
            }

        }

        // if ($_POST['sale']) {
        //     echo $_POST['sale'];
        // }
        // if (!empty($procent) && !empty($arrProduct_price)) {
        //     $arrProduct_price = $arrProduct_price - ($arrProduct_price * ($procent / 100)); //скидос
        // }


        // $queryOrder = mysqli_query($connect, "INSERT INTO `Заказ` (`ID заказа`, `ID корзины`, `ID статуса заказа`, `ID доставки`, `ID Скидочного промокода`,`Дата заказа`, `Дата получения`,`Сумма`) VALUES ('{$EndOrder}', '{$BasketID}', '{$IDStatusOrder}', '{$IDdelivery}', '{$Sale}', '{$date}','{$dateReceipt}', '{$arrProduct_price}')");
    }






}



