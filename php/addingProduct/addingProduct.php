<?php
session_start();
require_once '../config/connect.php';
require_once 'addingForm.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="shortcut icon" href="images/logo.png" type="images/png">
    <script src="https://unpkg.com/popper.js@1" defer></script>
    <script src="https://unpkg.com/tippy.js@5" defer></script>
    <script src="scripts/app.js" defer></script>
    <title>SetShly - Заказывай на свой вкус!</title>
</head>


<body id="body">
    <main id="main">

        <h2 class="HeaderDelivery">Добавление товара</h2>
        <nav id="navigation">
            <ul id="navigation-link">
                <li>
                    <div class="navigation-link__a">
                        <a href="http://setshly/php/Administration/Product/product.php" class="history-back">
                            <img class="navigation_arrow" src="images/arrow.png" alt="">
                        </a>
                        <a class="navigation-link__a" href="http://setshly/php/Index/index.php">Главная страница</a>
                    </div>
                </li>
                <li>
                    <a class="navigation-link__a"
                        href="http://setshly/php/Administration/Embroidery/embroidery.php">Вышивка</a>
                </li>
                <li>
                    <a class="navigation-link__a"
                        href="http://setshly/php/Administration/Category/category.php">Категории</a>
                </li>
            </ul>
        </nav>

        <section class="SECTION__productEditDetailed">
            <form method="post" action="" enctype="multipart/form-data">


                <div class="SelectionEdit">

                    <div class="SelectionDIV">

                        <h2>Название</h2>
                        <input name="nameProduct" id="nameProduct" type="text" style="<?php echo $borderName ?>"
                            value="<?php echo $_SESSION['nameProduct_Form'] ?>">

                    </div>
                    <p><?php echo $Error['name'] ?></p>
                    <p><?php echo $Error['errorName'] ?></p>

                    <div class="SelectionDIV">

                        <h2>Цена</h2>
                        <input name="priceProduct" id="priceProduct" type="text" style="<?php echo $borderPrice ?>"
                            value="<?php echo $_SESSION['priceProduct_Form'] ?>">

                    </div>
                    <p><?php echo $Error['price'] ?></p>




                    <div class="SelectionDIV">

                        <h2>Материал</h2>
                        <select name="materialProduct" id="materialProduct">

                            <?php for ($a = 0; $a <= count($material) - 1; $a++) { ?>
                                <option value="<?php echo $material[$a][1]; ?>" <?php
                                   if ($_SESSION['materialProduct_Form'] == $material[$a][1]) {

                                       echo 'selected';
                                   } ?> id="<?php echo $materialID ?>">
                                    <?php echo $material[$a][1];
                            } ?>
                            </option>
                        </select>
                    </div>




                    <div class="SelectionDIV">

                        <h2>Категория</h2>
                        <select name="categoryProduct" id="categoryProduct">

                            <?php for ($a = 0; $a <= count($category_list) - 1; $a++) { ?>
                                <option value="<?php echo $category_list[$a][1]; ?>" <?php
                                   if ($$_SESSION['categoryProduct_Form'] == $category_list[$a][1]) {
                                       $categoryID = $category_list[$i][0];
                                       echo 'selected';
                                   } ?>>
                                    <?php echo $category_list[$a][1];
                            } ?>
                            </option>
                        </select>
                    </div>


                    <div class="SelectionDIV">

                        <h2>Вышивка</h2>
                        <select name="embroideryProduct" id="embroideryProduct">

                            <?php for ($a = 0; $a <= count($embroidery) - 1; $a++) { ?>
                                <option value="<?php echo $embroidery[$a][1]; ?>" <?php
                                   if ($_SESSION['embroideryProduct_Form'] == $embroidery[$a][1])
                                       echo 'selected'; ?>>
                                    <?php echo $embroidery[$a][1];
                            } ?>
                            </option>
                        </select>

                    </div>


                    <div class="SelectionDIV">

                        <h2>Цвет</h2>
                        <select name="ColorProduct" id="ColorProduct">

                            <?php for ($a = 0; $a <= count($color_list) - 1; $a++) { ?>
                                <option value="<?php echo $color_list[$a][1]; ?>" <?php
                                   if ($_SESSION['ColorProduct_Form'] == $color_list[$a][1]) {

                                       echo 'selected';
                                   }
                                   ?>>
                                    <?php echo $color_list[$a][1];

                            } ?>
                            </option>
                        </select>
                    </div>

                    <div class="SelectionDIV">

                        <h2>Размер</h2>
                        <div class="SelectionDIV_size">
                            <select name="SizeProduct1" id="SizeProduct" class="SizeProduct">

                                <?php foreach ($arrlistSize as $k => $v) { ?>
                                    <option value="<?php echo $v; ?>" <?php
                                       if ($_SESSION['SizeProduct1'] == $v)
                                           echo 'selected'; ?>>
                                        <?php echo $v;
                                } ?>
                                </option>

                            </select>

                            <select name="SizeProduct2" id="SizeProduct" class="SizeProduct">

                                <?php foreach ($arrlistSize as $k => $v) { ?>
                                    <option value="<?php echo $v; ?>" <?php
                                       if ($_SESSION['SizeProduct2'] == $v)
                                           echo 'selected'; ?>>
                                        <?php echo $v;
                                } ?>
                                </option>
                            </select>
                            <select name="SizeProduct3" id="SizeProduct" class="SizeProduct">

                                <?php foreach ($arrlistSize as $k => $v) { ?>
                                    <option value="<?php echo $v; ?>" <?php
                                       if ($_SESSION['SizeProduct3'] == $v)
                                           echo 'selected'; ?>>
                                        <?php echo $v;
                                } ?>
                                </option>
                            </select>
                            <select name="SizeProduct4" id="SizeProduct" class="SizeProduct">

                                <?php foreach ($arrlistSize as $k => $v) { ?>
                                    <option value="<?php echo $v; ?>" <?php
                                       if ($_SESSION['SizeProduct4'] == $v)
                                           echo 'selected'; ?>>
                                        <?php echo $v;
                                } ?>
                                </option>
                            </select>
                            <select name="SizeProduct5" id="SizeProduct" class="SizeProduct">

                                <?php foreach ($arrlistSize as $k => $v) { ?>
                                    <option value="<?php echo $v; ?>" <?php
                                       if ($_SESSION['SizeProduct5'] == $v)
                                           echo 'selected'; ?>>
                                        <?php echo $v;
                                } ?>
                                </option>
                            </select>
                        </div>
                    </div>

                    <p><?php echo $Error['Size']; ?></p>



                    <div class="SelectionDIV">

                        <h2>Количество</h2>
                        <div class="SelectionDIV_count">
                            <input type="text" value="<?php echo $_SESSION['countSize1'] ?>" id="countSize1"
                                name="countSize1">
                            <input type="text" value="<?php echo $_SESSION['countSize2'] ?>" id="countSize2"
                                name="countSize2">
                            <input type="text" value="<?php echo $_SESSION['countSize3'] ?>" id="countSize3"
                                name="countSize3">
                            <input type="text" value="<?php echo $_SESSION['countSize4'] ?>" id="countSize4"
                                name="countSize4">
                            <input type="text" value="<?php echo $_SESSION['countSize5'] ?>" id="countSize5"
                                name="countSize5">
                        </div>
                    </div>

                    <p><?php echo $Error['Count']; ?></p>






                    <div class="SelectionDIV">

                        <h2>Описание</h2>
                        <textarea name="discriptionProduct" id="discriptionProduct"
                            style="<?php echo $borderDiscription ?>"> <?php echo $_SESSION['discriptionProduct_Form'] ?>
                            </textarea>

                    </div>

                    <p><?php echo $Error['discription'] ?></p>





                    <div class="SelectionDIV">

                        <h2>Фотография</h2>

                        <input type="file" id="custom-file-upload" name="custom-file-upload" class="custom-file-upload">


                    </div>
                    <p><?php echo $Error['img'] ?></p>


                    <div class="SelectionDIV Selection_btn">
                        <button type="submit" name="formSubmitEdit" id="formSubmitEdit">Сохранить</button>
                        <button>Отменить</button>
                    </div>
                </div>


        </section>
        </form>




        <footer id="footer">
            <div class="about-company"><a href="">О НАС</a></div>
            <div class="help"><a href="">ПОМОЩЬ</a></div>
            <div class="find"><a href="">НАЙДИ НАС</a></div>
        </footer>
    </main>
</body>

</html>