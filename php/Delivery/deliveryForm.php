<?php
session_start();
require_once '../config/connect.php';

$Delivered = "Доставлено";

function OutPutOrder($Order, $StatusOrder, $list_productToOrder, $production_list, $product_price_list, $product_list, $category_list, $embroidery, $material_list, $color_list, $size_list)
{
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

    if (!empty($_SESSION['id_user'])) {

        for ($as = 0; $as <= count($Order); $as++) {
            if ($Order[$as][8] == "0" && $Order[$as][2] != "5") {

                $listProduct[] = $Order[$as][1];
            }

        }
  
        if (!empty($listProduct)) {
            foreach ($listProduct as $list) {

                for ($j = 0; $j <= count($list_productToOrder); $j++) {
                    if ($_SESSION['id_user'] == $list_productToOrder[$j][1] && $list == $list_productToOrder[$j][0]) {

                        $listToOrder[] = $list_productToOrder[$j][2];
                        $count[] = $list_productToOrder[$j][3];
                        $OrderAndCount = array_combine($listToOrder, $count);

                        $listProductOrder[] = $list_productToOrder[$j][0];
                    }
                }
            }
        }


        if (!empty($listProductOrder)) {
            foreach ($listProductOrder as $value) {
                for ($i = 0; $i <= count($Order); $i++) {
                    if ($value == $Order[$i][1]) {

                        $OrderStatusList[] = $Order[$i][2];
                        $DateReceipt[] = $Order[$i][6];
                    }
                }
            }
        }  

        if (!empty($OrderStatusList)) {
            foreach ($OrderStatusList as $statuse) {
                for ($j = 0; $j <= count($StatusOrder); $j++) {
                    if ($statuse == $StatusOrder[$j][0]) {
                        $StatusName = $StatusOrder[$j][1];

                    }
                }

            }

           

            foreach ($OrderAndCount as $Production => $count) {

                for ($i = 0; $i <= count($production_list); $i++) {
                    if ($Production == $production_list[$i][0]) {
                        $list_materialID = $production_list[$i][1];
                        $productID = $production_list[$i][2];
                        $embroideryID = $production_list[$i][3];
                   

                    }

                }
                for ($i = 0; $i <= count($product_price_list); $i++) {
                    if ($productID == $product_price_list[$i][1]) {
                        $product_price = $product_price_list[$i][2]; //Прайс товара
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

                foreach ($DateReceipt as $values) {
                    $formattedDate = date($format, strtotime($values));
                    $formattedDates = str_replace(array_keys($months), array_values($months), $formattedDate);

                }


                echo '
                    <form action="DeleteDelivery.php" method="post">
                        <section class="section-product">
                        <img class="card-product__img" src="../../ProductImg/' . $product_category . '/' . $product_embroidery . '/' . $colorName . '.png" alt="Изображение товара">
                        <div class="section-productInfo">
                            <div class="section-product_infoTOP">
                                <h2>' . $product_name . '</h2>
                            </div>
                            <div class="section-product_CENTER">
                                <p>Цвет: ' . $colorName . '</p>
                                <p>Размер: ' . $sizeName . '</p>
                                <p>Количество: ' . $count . ' шт</p>
                            </div>
                            <div class="section-product_BOTTOM">
                                <span>' . $StatusName . '</span>
                                <p>Дата получения: ' . $formattedDates . '</p>
                            </div>
                            <div class="section-product_BUTTON">
                                <button type="submit" name="order-' . $Production . '" vlaue="">Отменить заказ</button>
                            </div>
                        </div>
                    </section>
                </form>';
            }



        } else {
            $Delivery = "У вас нет ближайших доставок!";
            if (!empty($Delivery)) {
                echo '<p class="DeliveryNone">' . $Delivery . '</p>';
            }
        }
    } else {
        $Delivery = "У вас нет ближайших доставок!";
        if (!empty($Delivery)) {
            echo '<p class="DeliveryNone">' . $Delivery . '</p>';
        }
    }
}


