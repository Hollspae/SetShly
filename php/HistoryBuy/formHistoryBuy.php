<?php
require_once '../config/connect.php';
session_start();

$successfully = 0;
$one = 1;

$Status = "Доставлено";
for ($i = 0; $i <= count($list_productToOrder); $i++) {
    if ($_SESSION['id_user'] == $list_productToOrder[$i][1]) {
        $listProduct[] = $list_productToOrder[$i][0];
    }

}

if (!empty($listProduct)) {

    for ($i = 0; $i <= count($Order); $i++) {

        foreach ($listProduct as $list) {

            if ($list == $Order[$i][1] && $Order[$i][8] == $one) {

                $listOrder[] = $Order[$i][0];

            }
        }

        for ($j = 0; $j <= count($StatusOrder); $j++) {
            if ($Status == $StatusOrder[$j][1]) {
                $IDStatus = $StatusOrder[$j][0];
            }
        }

        if (!empty($listOrder) && !empty($IDStatus)) {
            foreach ($listOrder as $list) {

                if ($list == $Order[$i][0] && $IDStatus == $Order[$i][2]) {
                    $ListORDER_approved[] = $Order[$i][0]; //ID заказа со статусом "Доставлено"
                    $ListORDERProduct_approved[] = $Order[$i][1]; //ID списка продуктов заказов
                    $ListORDERDelivery_approved[] = $Order[$i][2]; //Список доставок
                    $ListORDERDate_approved[] = $Order[$i][6]; // Список дат получения

                }
            }
        }
    }
}


if (!empty($ListORDERProduct_approved)) {
    foreach ($ListORDERProduct_approved as $listproduct) {
        for ($i = 0; $i <= count($list_productToOrder); $i++) {
            if ($listproduct == $list_productToOrder[$i][0]) {
                $listPRODUCTION[] = $list_productToOrder[$i][2]; //Список изготовлений
                $listPRODUCTIONcount[] = $list_productToOrder[$i][3]; // Список количества изготовлений в заказе




            }
        }

    }

}

if (!empty($listPRODUCTION)) {
    foreach ($listPRODUCTION as $production) {
        for ($s = 0; $s <= count($production_list); $s++) {
            if ($production == $production_list[$s][0]) {
                $listMATERIALlist[] = $production_list[$s][1];
                $listPRODUCT[] = $production_list[$s][2];
                $listEMBROIDERY[] = $production_list[$s][3];

                sort($listPRODUCT);


            }
        }
    }
}

if (!empty($listEMBROIDERY)) {
    for ($a = 0; $a <= count($embroidery); $a++) {
        foreach ($listEMBROIDERY as $embr) {
            if ($embr == $embroidery[$a][0]) {
                $embroideryName[] = $embroidery[$a][1];
            }
        }
    }
}

if (!empty($listPRODUCT)) {
    foreach ($listPRODUCT as $product) {
        for ($i = 0; $i <= count($product_list); $i++) {
            if ($product == $product_list[$i][0]) {

                $ProductName[] = $product_list[$i][2];
                $ProductCategory[] = $product_list[$i][1];


            }

        }
    }

}
if (!empty($ProductCategory)) {
    foreach ($ProductCategory as $categ) {
        for ($i = 0; $i <= count($category_list); $i++) {

            if ($categ == $category_list[$i][0]) {
                $NameCategory[] = $category_list[$i][1]; //Название категорий

            }
        }
    }
    ;
}

if (!empty($listMATERIALlist)) {
    for ($i = 0; $i <= count($material_list); $i++) {
        foreach ($listMATERIALlist as $list) {
            if ($list == $material_list[$i][0]) {
                $listColor = $material_list[$i][2];
                $listSize[] = $material_list[$i][3];

                for ($j = 0; $j <= count($color_list); $j++) {
                    if ($listColor == $color_list[$j][0]) {

                        $colorName[] = $color_list[$j][1]; //Название цвет
                    }
                }
            }
        }
    }
}

if (!empty($listSize)) {
    foreach ($listSize as $list) {
        for ($i = 0; $i <= count($size_list); $i++) {
            if ($list == $size_list[$i][0]) {
                $sizeName[] = $size_list[$i][1]; //Название размера
            }
        }
    }
}



if (!empty($ProductName) && !empty($ListORDER_approved) && !empty($listPRODUCTIONcount) && !empty($ListORDERDate_approved) && !empty($colorName) && !empty($sizeName) && !empty($NameCategory) && !empty($embroideryName)) {

    $_SESSION['order'] = array();
    $testCount = function () {
        return count($_SESSION['order']);
    };

    $_SESSION['order2'] = array();
    $testCount2 = function () {
        return count($_SESSION['order2']);
    };
    $_SESSION['order3'] = array();
    $testCount3 = function () {
        return count($_SESSION['order3']);
    };
    $_SESSION['order4'] = array();
    $testCount4 = function () {
        return count($_SESSION['order4']);
    };
    $_SESSION['order5'] = array();
    $testCount5 = function () {
        return count($_SESSION['order5']);
    };
    $_SESSION['order6'] = array();
    $testCount6 = function () {
        return count($_SESSION['order6']);
    };
    $_SESSION['order7'] = array();
    $testCount7 = function () {
        return count($_SESSION['order7']);
    };

    $Array = array_combine(array_values($ProductName), array_values($ListORDER_approved));
    // $Array2 = array_combine(array_values($listPRODUCTIONcount), array_values($ListORDERDate_approved));
    $Array3 = array_combine(array_values($colorName), array_values($sizeName));
    // $Array4 = array_combine(array_values($NameCategory), array_values($embroideryName));

    foreach ($Array as $name => $id) {
        $_SESSION['order']['key-' . ($testCount() + 1)] = [$id, $name];
    }
    foreach ($listPRODUCTIONcount as $count) {
        $_SESSION['order2']['key-' . ($testCount2() + 1)] = [$count];
    }
    foreach ($ListORDERDate_approved as $date) {
        $_SESSION['order3']['key-' . ($testCount3() + 1)] = [$date];
    }
    foreach ($Array3 as $color => $size) {
        $_SESSION['order4']['key-' . ($testCount4() + 1)] = [$color, $size];
    }
    foreach ($embroideryName as $embroider) {
        $_SESSION['order5']['key-' . ($testCount5() + 1)] = [$embroider];
    }
    foreach ($NameCategory as $categorys) {
        $_SESSION['order6']['key-' . ($testCount6() + 1)] = [$categorys];
    }

    foreach ($listPRODUCT as $idproduct) {
        $_SESSION['order7']['key-' . ($testCount7() + 1)] = [$idproduct];
    }


    foreach ($_SESSION['order'] as $key => &$value) {
        $value[] = $_SESSION['order2'][$key][0];

        $value[] = $_SESSION['order3'][$key][0];

        $value[] = $_SESSION['order4'][$key][0];
        $value[] = $_SESSION['order4'][$key][1];

        $value[] = $_SESSION['order5'][$key][0];

        $value[] = $_SESSION['order6'][$key][0];

        $value[] = $_SESSION['order7'][$key][0];
        $value[] = $_SESSION['id_user'][0];

        $successfully = 1;
    }

}

// echo "<pre>";
// print_r($_SESSION['order']);

// [0] => ID Заказа
// [1] => Название
// [2] => Количество 
// [3] => Дата получения
// [4] => Цвет
// [5] => Размер
// [6] => Вышивка
// [7] => Категория
// [8] => ИД товара
// [9] => ИД пользователя

function OutPutHistory($successfully, $feedback)
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
    if (!empty($_SESSION['order'])) {


        for ($i = 1; $i <= count($_SESSION['order']); $i++) {
            $_SESSION['colorFeed'] = $_SESSION['order']['key-' . $i][4];
            $_SESSION['sizeFeed'] = $_SESSION['order']['key-' . $i][5];
            $_SESSION['ProductFeed'] = $_SESSION['order']['key-' . $i][8];
            $_SESSION['embroideryFeed'] = $_SESSION['order']['key-' . $i][6];

            // for ($j = 0; $j < count($feedback); $j++) {
            //     if ($_SESSION['order']['key-' . $i][8] == $feedback[$j][2] && $_SESSION['order']['key-' . $i][9] == $feedback[$j][1]) {
             
                    $formattedDate = date($format, strtotime($_SESSION['order']['key-' . $i][3]));
                    $formattedDates = str_replace(array_keys($months), array_values($months), $formattedDate);

             

            echo '
                <div class="buy-card" >
                    <input type="hidden" name="inputID" value="' . $_SESSION['order']['key-' . $i][0] . '">
                    <div class="buy-card__top" onclick="location.href=`../card/card.php?card=' . $_SESSION['order']['key-' . $i][0] . '&color=&size=>`">
                        <img src="../../ProductImg/' . $_SESSION['order']['key-' . $i][7] . '/' . $_SESSION['order']['key-' . $i][6] . '/' . $_SESSION['order']['key-' . $i][4] . '.png" alt="">
                    </div>
                    <div class="buy-card__bottom">
     
                        <h2 class="buy-card_text name">' . $_SESSION['order']['key-' . $i][1] . '</h2>
                        <h2 class="buy-card_text date">Получен ' . $formattedDates . '</h2>
    
                        <div class="rating_result" id="rating_result" hidden></div>
                    </div>
                </div>';


        }

        // if ($_SESSION['order']['key-' . $i][8] !== $feedback[$j][2] && $_SESSION['order']['key-' . $i][9] !== $feedback[$j][1]) { {
        //         $asd[] = $_SESSION['order']['key-' . $i][1];
        //         $_SESSION['namesproduct'] = $asd;

        //         echo '
        //             <div class="buy-card" >
        //                 <input type="hidden" name="inputID" value="' . $_SESSION['order']['key-' . $i][0] . '">
        //                 <div class="buy-card__top" onclick="location.href=`../card/card.php?card=' . $_SESSION['order']['key-' . $i][0] . '&color=&size=>`">
        //                     <img src="../../ProductImg/' . $_SESSION['order']['key-' . $i][7] . '/' . $_SESSION['order']['key-' . $i][6] . '/' . $_SESSION['order']['key-' . $i][4] . '.png" alt="">
        //                 </div>
        //                 <div class="buy-card__bottom">
        //                     <h2 class="buy-card_text name">' . $_SESSION['order']['key-' . $i][1] . '</h2>
        //                     <h2 class="buy-card_text date">Получен ' . $_SESSION['order']['key-' . $i][3] . '</h2>
        //                     <form action="" method="post">
        //                         <div class="rating">
        //                             <div class="rating__item" id="star-open1" data-item-value="5">★</div>
        //                             <div class="rating__item" id="star-open2" data-item-value="4">★</div>
        //                             <div class="rating__item" id="star-open3" data-item-value="3">★</div>
        //                             <div class="rating__item" id="star-open4" data-item-value="2">★</div>
        //                             <div class="rating__item" id="star-open5" data-item-value="1">★</div>
        //                         </div>
        //                     </form>
        //                     <div class="rating_result" id="rating_result" hidden></div>
        //                 </div>
        //             </div>';

        //     }
        // }
        //     }

        // }

    }
}






// print_r($_SESSION['namesproduct']);




// $_SESSION['feedback'] = array();
// $testfeedback = function () {
//     return count($_SESSION['feedback']);
// };
// $_SESSION['feedback1'] = array();
// $testfeedback1 = function () {
//     return count($_SESSION['feedback1']);
// };

// if (!empty($listPRODUCT) && !empty($ProductName) && !empty($colorName) && !empty($sizeName)) {


//     $ArrayFeedback = array_combine(array_values($listPRODUCT), array_values($ProductName));
//     $ArrayFeedback1 = array_combine(array_values($colorName), array_values($sizeName));

//     foreach ($ArrayFeedback as $id => $name) {
//         $_SESSION['feedback']['key-' . ($testfeedback() + 1)] = [$id, $name];
//     }
//     foreach ($ArrayFeedback1 as $color => $size) {
//         $_SESSION['feedback1']['key-' . ($testfeedback1() + 1)] = [$color, $size];
//     }
//     ////////
//     foreach ($_SESSION['feedback'] as $key => &$value) {
//         $value[] = $_SESSION['feedback1'][$key][0];
//         $value[] = $_SESSION['feedback1'][$key][1];
//     }
// }

// echo "<pre>";
// print_r($_SESSION['feedback']);

//0 - ID товара
//1 - название
//2 -  цвет
//3 - размер
