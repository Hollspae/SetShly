<?php
session_start();

require_once '../config/connect.php';



$url = urldecode(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$cut_search = substr($url, 42, 1);

$cut_searchColor = substr($url, 50);
$explode_color = explode('&', $cut_searchColor);
array_pop($explode_color);
$ColorName_url = $explode_color[0];


$strpos_size = strpos($url, '&', strpos($url, '&', +1) + 1) + 6;
$SizeName_url = substr($url, $strpos_size);


$product_id = $cut_search;



if (empty($_SESSION['name'])) {
    header('Location: http://setshly/php/Index/index.php');
    exit;
}
if (!empty($SizeName_url)) {
    for ($i = 0; $i <= count($size_list); $i++) {
        if ($SizeName_url == $size_list[$i][1]) {
            $SizeID = $size_list[$i][0];
        }
    }
}
if (!empty($ColorName_url)) {
    for ($i = 0; $i <= count($color_list); $i++) {
        if ($ColorName_url == $color_list[$i][1]) {
            $ColorID = $color_list[$i][0];
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $globalIDListProduct = count(mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Список товаров`'))) + 1;

    if (!empty($product_id) && !empty($_SESSION['id_user'])) {


        for ($i = 0; $i <= count($production_list); $i++) {
            if ($product_id == $production_list[$i][2]) {
                $arrlistMaterial[] = $production_list[$i][1];
            }
        }
        if (!empty($arrlistMaterial)) {

            for ($j = 0; $j <= count($material_list); $j++) {
                foreach ($arrlistMaterial as $val) {
                    if ($material_list[$j][0] == $val && $material_list[$j][2] == $ColorID && $material_list[$j][3] == $SizeID) {

                        $ListMaterialID = $material_list[$j][0];


                    }
                }
            }
        }
        if (!empty($ListMaterialID)) {
            for ($a = 0; $a <= count($basket); $a++) {
                if ($_SESSION['id_user'] == $basket[$a][1]) {
                    $BasketID = $basket[$a][0];

                    $queryListProduct = mysqli_query($connect, 'INSERT INTO `Список товаров` (`ID Списка товаров`, `ID Изготовления`, `ID Корзины`, `Количество`) VALUES (' . $globalIDListProduct . ', ' . $ListMaterialID . ', ' . $BasketID . ', 1)');
                }
            }
        }

    }


}

function PriceOutput($connect, $basket, $list_productToBasket, $production_list, $product_price_list, $procent)
{
    if (!empty($_SESSION['id_user'])) {
        for ($a = 0; $a <= count($basket); $a++) {
            if ($_SESSION['id_user'] == $basket[$a][1]) {
                $BasketID = $basket[$a][0]; //ID корзины пользователя
            }
        }
    } else {
        header("Location: http://setshly/php/Index/index.php");
        exit;
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
                    $list_productToBasketID = $list_productToBasket[$j][0];


                    for ($i = 0; $i <= count($production_list); $i++) {
                        if ($values == $production_list[$i][0]) {
                            $list_materialID = $production_list[$i][1];
                            $productID = $production_list[$i][2];
                            $embroideryID = $production_list[$i][3];
                            $countProductionMAX = $production_list[$i][4];


                        }
                    }

                    for ($i = 0; $i <= count($product_price_list); $i++) {
                        if ($productID == $product_price_list[$i][1]) {
                            $product_price = $product_price_list[$i][2]; //Прайс товара
                            $product_prices = $countProductBasket * $product_price;
                            $arrproduct_prices[] = $countProductBasket * $product_price;
                            $arrProduct_price = array_sum($arrproduct_prices);

                        }
                    }
                }
            }
        }
    }


    if (!empty($arrProduct_price)) {
        echo $arrProduct_price;
        $date = date('Y-m-d');

        $queryUpdateSumm = mysqli_query($connect, "UPDATE `Корзина` SET `Сумма` = '{$arrProduct_price}' WHERE `Корзина`.`ID Коризны` = '{$BasketID}';");
        $queryUpdateDate = mysqli_query($connect, "UPDATE `Корзина` SET `Дата формирования` = '{$date}' WHERE `Корзина`.`ID Коризны` = '{$BasketID}';");
    }
}

//ВЫВОД ТОВАРОВ
function dataOutput($basket, $list_productToBasket, $production_list, $product_price_list, $product_list, $category_list, $embroidery, $material_list, $color_list, $size_list, $connect)
{

    if (!empty($_SESSION['id_user'])) {
        for ($a = 0; $a <= count($basket); $a++) {
            if ($_SESSION['id_user'] == $basket[$a][1]) {
                $BasketID = $basket[$a][0]; //ID корзины пользователя
            }
        }
    } else {
        header("Location: http://setshly/php/Index/index.php");
        exit;
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
                    $list_productToBasketID = $list_productToBasket[$j][0];
                    $production_productToBasketID[] = $values;
                    $production_countProductBasket[] = $list_productToBasket[$j][3];


                    for ($i = 0; $i <= count($production_list); $i++) {
                        if ($values == $production_list[$i][0]) {
                            $list_materialID = $production_list[$i][1];
                            $productID = $production_list[$i][2];
                            $embroideryID = $production_list[$i][3];
                            $countProductionMAX = $production_list[$i][4];


                        }
                    }

                    for ($i = 0; $i <= count($product_price_list); $i++) {
                        if ($productID == $product_price_list[$i][1]) {
                            $product_price = $product_price_list[$i][2]; //Прайс товара
                            $product_prices = $countProductBasket * $product_price;
                            $arrproduct_prices[] = $countProductBasket * $product_price;
                            $arrProduct_price = array_sum($arrproduct_prices);

                        }


                        for ($s = 0; $s <= count($product_list); $s++) {
                            if ($productID == $product_list[$s][0]) {
                                $product_name = $product_list[$s][2];
                                $product_categoryID = $product_list[$s][1];

                                for ($d = 0; $d <= count($category_list); $d++) {
                                    if ($product_categoryID == $category_list[$d][0]) {
                                        $product_category = $category_list[$d][1]; //Название категории
                                    }
                                }
                                for ($j = 0; $j <= count($embroidery); $j++) {
                                    if ($embroideryID == $embroidery[$j][0]) {
                                        $product_embroidery = $embroidery[$j][1]; // Название вышивки
                                    }
                                }
                            }
                        }
                    }


                    for ($i = 0; $i <= count($material_list); $i++) {
                        if ($list_materialID == $material_list[$i][0]) {
                            $colorID = $material_list[$i][2];
                            $sizeID = $material_list[$i][3];


                        }
                    }
                    for ($i = 0; $i <= count($color_list); $i++) {
                        if ($colorID == $color_list[$i][0]) {
                            $colorName = $color_list[$i][1]; // Название цвета
                        }
                    }

                    for ($i = 0; $i <= count($size_list); $i++) {
                        if ($sizeID == $size_list[$i][0]) {
                            $sizeName = $size_list[$i][1]; //Название размерв
                        }
                    }



                    echo '
    
                    
                        <div class="section-block">
                            <img class="card-product__img" src="../../../ProductImg/' . $product_category . '/' . $product_embroidery . '/' . $colorName . '.png" alt="Изображение товара" draggable="false">
                            <div class="section_block__information">
                                <div class="section-product_infoTOP">
                                   <h2>' . $product_name . '</h2>
                                   <form action="DeleteCardBasket.php" method="post">
                                   <div class="sectionTOP">                              
                                        <h2>' . $product_prices . ' р</h2>
                                        <button name="submitDeleteProduct=' . $list_productToBasketID . '" id="submitDeleteProduct=' . $list_productToBasketID . '">
                                             <img class="card-close" src="../../basic_img/closing.png"  draggable="false"">
                                        </button>
                                   </div>
                                   </form>
                                </div>
                                <div class="section-product_infoBOTTOM">
                                   <p>Цвет: ' . $colorName . '</p>
                                   <p>Размер: ' . $sizeName . '</p>
                                </div>

                                <div class="section-product_count">
                                    <form action="" method="post">
                                        <p>Количество </p>
                                        <input class="input_count"  type="text" id="countInput" name="countInput-' . $list_productToBasketID . '" value="" placeholder="' . $countProductBasket . '">
                                        <h3 class="countmax">max: ' . $countProductionMAX . ' </h3>
                                    </form>
                                    
                                    
                                </div>
                            </div>
                        </div>';
                    session_start();
                    $_SESSION['test'] = array();
                    $testCount = function () {
                        return count($_SESSION['test']);
                    };

                    $_SESSION['orderProduction'] = array();
                    $testCountProductionOrder = function () {
                        return count($_SESSION['orderProduction']);
                    };


                    $ArraybasketToOrder = array_combine($production_productToBasketID, $production_countProductBasket); //Товары в корзину
                    $ArrayProductionToOrder = array_combine($production_productToBasketID, $production_countProductBasket); //Товары в заказ
                    $sumPrice = 0;
                    foreach ($ArraybasketToOrder as $production => $count) {

                        $_SESSION['test']['key-' . ($testCount() + 1)] = [$_SESSION['id_user'], $production, $count];

                    }
                    foreach ($ArrayProductionToOrder as $production => $count) {

                        $_SESSION['orderProduction']['key-' . ($testCountProductionOrder() + 1)] = [$_SESSION['id_user'], $production, $count, $sumPrice];
                    }
                }
            }
        }
    } else {
        $BaksetText = "Товар не добавлен в корзину!";
        if (!empty($BaksetText)) {
            echo '<p class="BasketNone">' . $BaksetText . '</p>';
        }
    }
}

if (!empty($_POST)) {
    $inputValues = $_POST;

    $arrayWithMinusKey = array_filter(array_keys($inputValues), function ($key) {
        return strpos($key, '-') !== false;
    });


    $valuesWithMinusKey = array_intersect_key($inputValues, array_flip($arrayWithMinusKey)); //Достаем нужны ключи и значения для редактирование количества
    function isEmpty($value)
    {
        return !empty($value);
    }
    $filteredArray = array_filter($valuesWithMinusKey, 'isEmpty'); // убираем пустые значения

    foreach ($filteredArray as $key => $value) {
        if (strpos($key, '-') !== false) {
            $pattern = '/^[1-9][0-9]*$/';

            if (preg_match($pattern, $value) && $value !== "") {

                $pos = strpos($key, '-');

                if ($pos !== false) {

                    $IDProductionProduct = substr($key, $pos + 1);
                    $Array_ProductionCount[] = [$IDProductionProduct, $value];

                }
            }
        }
    }
    if (!empty($Array_ProductionCount)) {
        foreach ($Array_ProductionCount as $Array_Value) {
            $ArrDetalied[] = $Array_Value;
        }
    }
    if (!empty($ArrDetalied)) {
        for ($o = 0; $o <= count($ArrDetalied); $o++) {
            $IDProductionProduct = $ArrDetalied[$o][0];
            $CountProduct = $ArrDetalied[$o][1];

            for ($j = 0; $j <= count($list_productToBasket); $j++) {
                if ($list_productToBasket[$j][0] == $IDProductionProduct) {
                    $idProduction = $list_productToBasket[$j][1];
                    for ($v = 0; $v <= count($production_list); $v++) {
                        if ($idProduction == $production_list[$v][0]) {
                            $countMax = $production_list[$v][4];
                        }
                    }


                    if (!empty($countMax) && $CountProduct <= $countMax) {
                        $queryCountBakset = mysqli_query($connect, "UPDATE `Список Товаров` SET `Количество` = '{$CountProduct}' WHERE `Список товаров`.`ID Списка товаров` = '{$IDProductionProduct}' ");

                    }

                }
            }
        }
    }

}



function DeliveryUser($delivery)
{
    for ($i = 0; $i < count($delivery); $i++) {
        $IDDelivery[] = $delivery[$i][0];
        $Region[] = $delivery[$i][3];
        $City[] = $delivery[$i][4];
        $Address[] = $delivery[$i][5];
        $HouseNumber[] = $delivery[$i][6];

    }
    $ARRDeliveryAddress = array();
    foreach ($IDDelivery as $fk => $fv) {
        if (isset($IDDelivery[$fk])) {
            $ARRDeliveryAddress[$fv][] = $IDDelivery[$fk];
        }
        if (isset($Region[$fk])) {
            $ARRDeliveryAddress[$fv][] = $Region[$fk];
        }
        if (isset($City[$fk])) {
            $ARRDeliveryAddress[$fv][] = $City[$fk];
        }
        if (isset($Address[$fk])) {
            $ARRDeliveryAddress[$fv][] = $Address[$fk];
        }
        if (isset($HouseNumber[$fk])) {
            $ARRDeliveryAddress[$fv][] = $HouseNumber[$fk];
        }
    }
    foreach ($ARRDeliveryAddress as $value) {
        for ($i = 0; $i <= count($value); $i++) {
            $IDDelivery = $value[0];
            $VRegion = $value[1];
            $VCity = $value[2];
            $VAdrress = $value[3];
            $VHouseNumber = $value[4];
        }
        echo '
            <option name="DeliveryOption" id="DeliveryOption" value="' . $IDDelivery . '">' . $VRegion . ', г. ' . $VCity . ', ' . $VAdrress . ' ' . $VHouseNumber . '</option>
        ';

    }

}
$numberCardUser = "0000 0000 0000 0000";
for ($i = 0; $i <= count($Card); $i++) {
    if ($_SESSION['id_user'] == $Card[$i][1]) {
        $numberCardUser = $Card[$i][2];
        $ARRnumberCardUser[] = $Card[$i][2];
    }
}

$countCardUser = count(mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `Карта пользователя` WHERE `ID Пользователя` = '{$_SESSION['id_user']}'")));

function InputCardUser($countCardUser, $ARRnumberCardUser, $Card, $connect)
{
    echo '  
            <div class="decoration-payment2">
                <h3>Карта: </h3> 
                <select name="NumberCardInput" id="NumberCardInput">';
                foreach ($ARRnumberCardUser as $key => $number) {

                    echo '<option value="' . $number . '">' . $number . '</option>';
    }
    echo '</select></div>';
  
    
}


//Добавление карты пользователя
if (isset($_POST['SubmitDetaliedCard'])) {
    $NumberCard = $_POST['CardNumber'];
    $Duration = $_POST['Duration'];
    $CVV = $_POST['CVV'];

    if (!is_numeric($NumberCard) || empty($NumberCard) || !is_numeric($Duration) || empty($Duration) || !is_numeric($CVV) || empty($CVV)) {
        $Error = 'Не правильные данные!';
    } else {
        if (!empty($_SESSION['id_user'])) {
            for ($i = 0; $i <= count($Card); $i++) {
                if ($NumberCard == $Card[$i][2]) {
                    $Error = 'Карта существует!';
                }
            }
        }

    }

    if (empty($Error)) {
        $globalCard = count(mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Карта пользователя`'))) + 1;

        $queryCard = mysqli_query($connect, 'INSERT INTO `Карта пользователя` (`ID Оплаты пользователя`, `ID Пользователя`, `Номер карты`, `Срок действия`, `CVV`) VALUES (' . $globalCard . ', ' . $_SESSION['id_user'] . ', ' . $NumberCard . ', ' . $Duration . ', ' . $CVV . ')');
        $message = 'success';

    }
    if ($message == 'success') {

        header('Location: http://setshly/php/Basket/basket.php?message=success');
        exit();
    }

}



if (isset($_POST['submitOrder'])) {

    if (!empty($_SESSION['test'])) {
        for ($i = 0; $i <= count($list_productToOrder) - 1; $i++) {
            $lastID_productToOrder = $list_productToOrder[$i][0];

        }
        ;
        $ID_productToOrder = $lastID_productToOrder + 1;

        $sessionProductToBasketCount = count($_SESSION['test']);


        for ($i = 1; $i <= count($_SESSION['test']); $i++) {
                    $IDProducttoOrderLIST[] = $ID_productToOrder;
                    $queryProductToOrder = mysqli_query($connect, 'INSERT INTO `Список товаров заказа` (`ID Списка товаров заказа`, `ID Пользователя`, `ID Изготовления`, `Количество`) VALUES (' . $ID_productToOrder . ', ' . $_SESSION['test']['key-' . $i][0] . ', ' . $_SESSION['test']['key-' . $i][1] . ', ' . $_SESSION['test']['key-' . $i][2] . ' )');
                    $ID_productToOrder = $ID_productToOrder + 1;


        }

        if ($queryProductToOrder) {

            for ($k = 0; $k <= count($_SESSION['orderProduction']); $k++) {
                $counter = $_SESSION['orderProduction']['key-' . $k][2];

                for ($j = 0; $j <= count($production_list); $j++) {
                    if ($_SESSION['orderProduction']['key-' . $k][1] == $production_list[$j][0]) {
                        $productID = $production_list[$j][2];

                        for ($a = 0; $a <= count($product_price_list); $a++) {
                            if ($productID == $product_price_list[$a][1]) {
                                $priceProducttoOrder = $product_price_list[$a][2];

                                $sumPrices[] = $counter * $priceProducttoOrder;
                                $sumPrice = array_filter($sumPrices);
                            }
                        }

                    }

                }
                foreach ($sumPrice as $price) {

                    $_SESSION['orderProduction']['key-' . $k][3] = $price;
                }

            }



            for ($i = 0; $i <= count($StatusOrder) - 1; $i++) {
                $ListOrderAssembly[] = $StatusOrder[$i][0];
            }
            $IDorderAssembly = array_shift($ListOrderAssembly); //статус "В сборке"


            for ($i = 0; $i <= count($Card); $i++) {
                if ($_POST['NumberCardInput'] == $Card[$i][2] && $_SESSION['id_user'] == $Card[$i][1]) {
                    $IDcard = $Card[$i][0]; // ID карты
                }
            }

            $date = date('Y-m-d');
            $dateReceipt = date("Y-m-d", time() + 60 * 60 * 24 * 7);
            if (!empty($_SESSION['orderProduction'])) {
                for ($j = 0; $j <= count($_SESSION['orderProduction']); $j++) {
                    $ArrSum[] = $_SESSION['orderProduction']['key-' . $j][3];
                }
                $allsum = array_sum($ArrSum);// сумма заказа

            }
            
       
            

            for ($zi = 0; $zi < count($Order); $zi++) {
                $IDListOrder[] = $Order[$zi][0];
     
            }
       
          
             
                foreach ($IDProducttoOrderLIST as $value) {
                    
                    $countListOrder = array_pop($IDListOrder)+1;
             echo $countListOrder;
                    $queryOrder = mysqli_query($connect, 'INSERT INTO `Заказ` (`ID заказа`, `ID Списка товаров заказа`, `ID статуса заказа`, `ID доставки`, `ID оплаты пользователя`, `Дата заказа`, `Дата получения`, `Сумма`, `Определитель`) VALUES (' . $countListOrder  . ', ' . $value . ', ' . $IDorderAssembly . ', ' . $_POST['DeliveryText'] . ', ' . $IDcard . ' , "' . $date . '" , "' . $dateReceipt . '", ' . $allsum . ', "0"  )');
           
            }
        }
        header("Location: http://setshly/php/Delivery/delivery.php");
        exit;
    }
   

    header("Location: http://setshly/php/Basket/basket.php");
}
