<?php
session_start();
require_once '../../config/connect.php';

$arrColorID = [];
$arrSizeID = [];

function getProduct($product_list, $category_list, $product_price_list, $embroidery, $material_list, $production_list, $color_list)
{
    for ($i = 0; $i <= count($product_list) - 1; $i++) {

        $product_id = $product_list[$i][0];
        if ($product_id == $product_list[$i][0]) {

            $product_name = $product_list[$i][2];
            $IDcategory = $product_list[$i][1];
            for ($z = 0; $z <= count($category_list); $z++) {
                if ($IDcategory == $category_list[$z][0]) {
                    $product_category = $category_list[$z][1]; //Название категории
                }
            }
            for ($j = 0; $j <= count($product_price_list); $j++) {
                if ($product_id == $product_price_list[$j][1]) {
                    $product_price = $product_price_list[$j][2];
                }
            }
            for ($s = 0; $s <= count($production_list); $s++) {
                if ($product_id == $production_list[$s][2]) {
                    $arrIDembroidery[] = $production_list[$s][3];
                    $IDembroidery = array_shift($arrIDembroidery);
                }
            }

            if (!empty($IDembroidery)) {
                for ($a = 0; $a <= count($embroidery); $a++) {
                    if ($IDembroidery == $embroidery[$a][0]) {
                        $product_embroidery = $embroidery[$a][1]; //Вышивка товара
                    }
                }
            }

            $dir = "../../../ProductImg/$product_category/$product_embroidery/";
            $fileIMG = scandir($dir, 1);

            $IMGName = array_shift($fileIMG);

            echo '
            
                            <section class="section-product">
                                <div class="section-block">
                                <img class="card-product__img" src="../../../ProductImg/' . $product_category . '/' . $product_embroidery . '/' . $IMGName . '" alt="Изображение товара" draggable="false">
                                    <div class="section_block__information">
                                        <div class="section-product_info">
                                            <h3>' . $product_name . '</h3>
                                            <h3>' . $product_price . ' р</h3>
                                        </div>
                                        <div class="section-product_info">
        
                                        </div>
                                    </div>
                                </div>
                            <div class="section_block__edit">
                                <a href="http://setshly/php/Administration/Product/productEditDetailed.php?card=' . $product_id . '"> Изменить </a>
                            </div>
                        </section>
            ';
        }
    }
    ;
}


//Подсчет количества
for ($i = 0; $i <= count($production_list); $i++) {
    if ($_SESSION['IDProduct_Form'] == $production_list[$i][2]) {
        $arrlistMaterial[] = $production_list[$i][1];
    }
}
if (!empty($arrlistMaterial)) {
    for ($j = 0; $j <= count($material_list); $j++) {
        foreach ($arrlistMaterial as $val) {
            if ($material_list[$j][0] == $val) {
                $materialID = $material_list[$j][1];
                $arrCount[] = $material_list[$j][4];

                $arrCountSum = array_sum($arrCount);
            }
        }
    }
}

for ($i = 0; $i <= count($linesParish); $i++) {
    if ($materialID == $linesParish[$i][1]) {
        $globalCount = $linesParish[$i][3];
    }
}
function CountMaterial($arrCountSum, $globalCount)
{

    if (!empty($globalCount && !empty($arrCountSum))) {
        if ($arrCountSum <= $globalCount) {
            echo '  <p class="detalied">' . $arrCountSum . '/' . $globalCount . '</p>';
        } else {
            echo '  <p class="detaliedFailed">' . $arrCountSum . '/' . $globalCount . '</p>';
        }


    }

}


function OutputDetalied($production_list, $material_list, $color_list, $size_list, $arrCountSum, $globalCount, $connect)
{

    for ($i = 0; $i <= count($production_list); $i++) {
        if ($_SESSION['IDProduct_Form'] == $production_list[$i][2]) {
            $arrlistMaterial[] = $production_list[$i][1];
        }
    }
    if (!empty($arrlistMaterial)) {


        for ($j = 0; $j <= count($material_list); $j++) {
            foreach ($arrlistMaterial as $val) {
                if ($material_list[$j][0] == $val) {
                    for ($i = 0; $i < count($color_list); $i++) {
                        if ($material_list[$j][2] == $color_list[$i][0]) {
                            for ($s = 0; $s < count($size_list); $s++) {
                                if ($material_list[$j][3] == $size_list[$s][0]) {
                                    echo '
                                    <tr>
                                        <td> ' . $color_list[$i][1] . '</td>
                                        <td> ' . $size_list[$s][1] . '</td>
                                        <td> 
                                        <input class="inputCount" type="text" id="inpute" name="' . $color_list[$i][1] . '-' . $size_list[$s][1] . '" placeholder="' . $material_list[$j][4] . '" value=""></td>
                                       
                                    </tr>
                                ';
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    if (!empty($_POST)) {

        $inputValues = $_POST;
        foreach ($inputValues as $key => $value) {
            if (strpos($key, '-') !== false) {
                $pattern = '/^[1-9][0-9]*$/';

                if (preg_match($pattern, $value) && $value !== "") {

                    $pos = strpos($key, '-');

                    if ($pos !== false) {

                        $ColorName = substr($key, 0, $pos);
                        $SizeName = substr($key, $pos + 1);
                        $Color_size_count[] = [$ColorName, $SizeName, $value];

                    }
                }
            }
        }
    }
    if (!empty($Color_size_count)) {
        foreach ($Color_size_count as $Color_size_countValue) {
            $ColorDetalied[] = $Color_size_countValue;
        }
    }

    if (!empty($ColorDetalied)) {
        for ($o = 0; $o <= count($ColorDetalied); $o++) {
            $colorName = $ColorDetalied[$o][0];
            $SizeName = $ColorDetalied[$o][1];
            $CountProduct = $ColorDetalied[$o][2];

            $CountProductSum[] = $ColorDetalied[$o][2];
            $CountSum = array_sum($CountProductSum);
            for ($k = 0; $k <= count($color_list); $k++) {
                if ($colorName == $color_list[$k][1]) {
                    $ColorID = $color_list[$k][0];
                }

            }
            for ($k = 0; $k <= count($size_list); $k++) {
                if ($SizeName == $size_list[$k][1]) {
                    $SizeID = $size_list[$k][0];
                }
            }
            //$CountSum - подсчет суммы введенных значений
            //$arrCountSum - подсчет существующего количество
            //$globalCount - максимальное количество

            foreach ($arrlistMaterial as $val) {
                for ($j = 0; $j <= count($material_list); $j++) {
                    if ($material_list[$j][0] == $val && $material_list[$j][2] == $ColorID && $material_list[$j][3] == $SizeID) {

                        $queryEditCount = mysqli_query($connect, "UPDATE `Список Материалов` SET `Количество` = '{$CountProduct}' WHERE `ID Цвета` = '{$ColorID}' AND `ID Размера` = '{$SizeID}' ");
                    }
                }
            }
        }
    }
}



$NameProductBefor = 0;
$PriceProductBefore = 0;
$arrlistMaterial = [];

$_SESSION['nameProduct_Form'] = [];
$_SESSION['priceProduct_Form'] = [];
$_SESSION['categoryProduct_Form'] = [];
$_SESSION['discriptionProduct_Form'] = [];
$_SESSION['nameProduct_Form'] = preg_replace('/[^a-zA-Zа-яА-Я\s]/ui', '', $_POST['nameProduct__input']);
$_SESSION['priceProduct_Form'] = preg_replace('/[^\d]/', '', $_POST['priceProduct__input']);
$_SESSION['categoryProduct_Form'] = $_POST['categoryProduct__select'];
$_SESSION['discriptionProduct_Form'] = preg_replace('/[^a-zA-Zа-яА-Я\s]/ui', '', $_POST['discriptionProduct__textarea']);





if (!empty($_SESSION['nameProduct_Form'])) {

    $queryEditName = mysqli_query($connect, "UPDATE `Товар` SET `Название` = '{$_SESSION['nameProduct_Form']}' WHERE `Товар`.`ID_Товара` ='{$_SESSION['IDProduct_Form']}' ");
    if ($queryEditName) {
        $successfully = 1;
    }
}
if (!empty($CategoryProductAfter)) {

    $queryEditNCategory = mysqli_query($connect, "UPDATE `Товар` SET `ID_Категории` = '{$CategoryProductAfter}' WHERE `Товар`.`ID_Товара` ='{$_SESSION['IDProduct_Form']}' ");
    if ($queryEditNCategorye) {
        $successfully = 1;
    }
}
if (!empty($_SESSION['discriptionProduct_Form'])) {

    $queryEditDiscription = mysqli_query($connect, "UPDATE `Товар` SET `Описание` = '{$_SESSION['discriptionProduct_Form']}' WHERE `Товар`.`ID_Товара` ='{$_SESSION['IDProduct_Form']}' ");
    if ($queryEditNCategory) {
        $successfully = 1;
    }
}

if (!empty($_SESSION['priceProduct_Form'])) {

    $globalPriceUpdateID = count(mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Прайс-лист_товаров`'))) + 1;
    $date = date('Y-m-d');

    for ($i = 0; $i <= count($product_price_list); $i++) {
        if ($_SESSION['IDProduct_Form'] == $product_price_list[$i][1]) {
            $priceProduct = $product_price_list[$i][2];
        }
    }

    if ($_SESSION['priceProduct_Form'] !== $priceProduct) {
        $queryAddPrice = mysqli_query($connect, "INSERT INTO `Прайс-лист_товаров` (`ID_Прайс-листа_товаров`, `ID Товара`, `Цена`, `Дата`) VALUES ('{$globalPriceUpdateID}', '{$_SESSION['IDProduct_Form']}', '{$_SESSION['priceProduct_Form']}', '{$date}')");

        if ($queryEditNCategory) {
            $successfully = 1;
        }
    }


}
if ($successfully == 1) {
    unset($_SESSION['IDProduct_Form']);
    unset($_SESSION['nameProduct_Form']);
    unset($_SESSION['priceProduct_Form']);

    unset($_SESSION['categoryProduct_Form']);
    unset($_SESSION['discriptionProduct_Form']);

    unset($_SESSION['nameProduct_Form']);
    unset($_SESSION['priceProduct_Form']);

    unset($_SESSION['categoryProduct_Form']);
    unset($_SESSION['discriptionProduct_Form']);

    // header('Location: http://setshly/php/Administration/Product/product.php?card=' . $_SESSION['IDProduct_Form'] . '');

}




