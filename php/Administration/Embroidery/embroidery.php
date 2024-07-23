<?php
session_start();
require_once '../../config/connect.php';
require_once 'embroideryForm.php';


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
                 
                    <div class="navigation-link__a">
                        <a href="http://setshly/php/Administration/Product/product.php"  class="history-back">
                            <img class="navigation_arrow" src="img/arrow.png" alt="">
                        </a>
                        <a class="asd" href="../../Index/index.php">Главная страница</a>
                    </div>
                </li>
                <li>
                    <div class="navigation-link__a">

                        <a class="asd" href="http://setshly/php/addingProduct/addingProduct.php">Товар</a>

                    </div>
                </li>
                <li>
                    <div class="navigation-link__a">

                        <a class="asd" href="http://setshly/php/Administration/Category/category.php">Категории</a>
                    </div>
                </li>

            </ul>
        </nav>


        <section class="SECTION__productEditDetailed">
            <div class="HeaderSETCION">
                <h2>Добавление вышивки</h2>
            </div>
            <form action="" method="post" enctype="multipart/form-data"> 
                <div class="SelectionEdit">

                    <ul>

                        <li>
                            <h2>Название</h2>
                        </li>
                        <li>
                            <h2>Описание</h2>
                        </li>
                        <li>
                            <h2>Фотография</h2>
                        </li>

                    </ul>
                    <ul>

                        <li>
                            <input name="nameEmbroidery" id="nameEmbroidery" type="text"
                                value="<?php echo $NameProductBefore; ?>" <?php if (!empty($Error['embroidery'])) {
                                       echo $Error['category'];
                                   }
                                   ; ?>>
                        </li>
                        <li>
                            <input name="discriptionEmbroidery" id="discriptionEmbroidery" type="text" value="<?php echo $NameProductBefore;
                            ?>">
                        </li>
                        <li>
                            <input type="file" name="imageFile" id="imageFile">
                        </li>
                        <li class="SelectionEdit__btn">
                            <button type="submit" name="SubmitEmbroideryAdd">Добавить</button>
                        </li>
                    </ul>

                </div>
            </form>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="SectionDetalied">

                    <table>
                        <tr>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Фотография</th>
                            <th></th>
                        </tr>

                        <?php EmbroideryEdit($embroidery) ?>

                    </table>
                </div>

            </form>


        </section>
    </main>
</body>

</html>