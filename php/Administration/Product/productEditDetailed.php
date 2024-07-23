<?php session_start();
require_once '../../config/connect.php';
require_once 'productForm.php';

$url = urldecode(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$cut_search = substr($url, 71);


$CutIDProduct = $cut_search[0];

$arrlistMaterial = [];
$_SESSION['IDProduct_Form'] = [];
$_SESSION['IDProduct_Form'] = $CutIDProduct;

if (!empty($_SESSION['IDProduct_Form'])) {

    for ($i = 0; $i <= count($product_list); $i++) {

        if ($_SESSION['IDProduct_Form'] == $product_list[$i][0]) {
            $NameProductBefore = $product_list[$i][2];
            $DiscriptionProductBefore = $product_list[$i][3];
            $CategoryProductBefore = $product_list[$i][1];

            for ($a = 0; $a <= count($category_list); $a++) {
                if ($CategoryProductBefore == $category_list[$a][0]) {
                    $CategoryNameBefore = $category_list[$a][1];

                }

                if ($_SESSION['categoryProduct_Form'] == $category_list[$a][1]) {
                    $CategoryProductAfter = $category_list[$a][0];
                }
            }
        }

    }
    for ($i = 0; $i <= count($product_price_list); $i++) {
        if ($_SESSION['IDProduct_Form'] == $product_price_list[$i][1]) {
            $PriceProductBefore = $product_price_list[$i][2];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libs/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/png">
    <script src="https://unpkg.com/popper.js@1" defer></script>
    <script src="https://unpkg.com/tippy.js@5" defer></script>
    <script src="js/app.js" defer></script>
    <title>SetShly - Заказывай на свой вкус!</title>
</head>

<body>
    <main>
        <nav id="navigation">
            <ul id="navigation-link">
                <li>
                    <a href="http://setshly/php/profile/profile.php" >
                        <img class="navigation_arrow" src="img/arrow.png" alt="">
                    </a>
                </li>
                <li>
                    <div class="navigation-link__a">
                        <a class="asd" href="../../Index/index.php">Главная страница</a>
                    </div>
                </li>
                <li>
                    <form class="search" method="get">
                        <input type="search" name="search" placeholder="Поиск">
                    </form>
                </li>
            </ul>
        </nav>
        
        <section class="SECTION__productEditDetailed">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="SectionDetalied">
                    <table>
                        <tr>
                            <th>Цвет</th>
                            <th>Размер</th>
                            <th>Количество
                                <?php CountMaterial($arrCountSum, $globalCount); ?>
                                
                            </th>
               
                        </tr>
                       
                        <?php
                             OutputDetalied($production_list, $material_list, $color_list, $size_list,  $arrCountSum, $globalCount, $connect);
                            
                        ?>
                    </table>
                    
                    
                </div>
                <div class="SelectionEdit">

                    <ul>
                        <li>
                            <h2>Название</h2>
                        </li>
                        <li>
                            <h2>Цена</h2>
                        </li>

                        <li>
                            <h2>Категория</h2>
                        </li>
                        <li>
                            <h2>Описание</h2>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <input name="nameProduct__input" id="nameProduct__input" type="text"
                                value="<?php echo $NameProductBefore ?>">
                        </li>
                        <li>
                            <input name="priceProduct__input" id="priceProduct__input" type="text"
                                value="<?php echo $PriceProductBefore ?>">
                        </li>

                        <li>
                            <select name="categoryProduct__select" id="categoryProduct__select">

                                <?php for ($a = 0; $a <= count($category_list) - 1; $a++) { ?>
                                    <option value="<?php echo $category_list[$a][1]; ?>" <?php
                                       if ($CategoryNameBefore == $category_list[$a][1])
                                           echo 'selected'; ?>>
                                        <?php echo $category_list[$a][1];
                                } ?>
                                </option>
                            </select>
                        </li>
                        <li>
                            <textarea name="discriptionProduct__textarea"
                                id="discriptionProduct__textarea"><?php echo $DiscriptionProductBefore ?></textarea>
                        </li>

                        <li class="SelectionEdit__btn">
                            <button type="submit" name="formSubmitEdit">Сохранить</button>
                            <button type="submit">Отменить</button>
                        </li>

                    </ul>
            </form>
            </div>
        </section>

    
    </main>
</body>

</html>