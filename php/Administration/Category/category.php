<?php
session_start();
require_once '../../config/connect.php';
require_once 'categoryForm.php';


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
                    <a href="" onclick="history.back();return false;" class="history-back">
                        <img class="navigation_arrow" src="img/arrow.png" alt="">
                    </a>
                </li>
                <li>
                    <div class="navigation-link__a">
                        <a class="asd" href="../../Index/index.php">Главная страница</a>
                    </div>
                </li>


            </ul>



            <section class="SECTION__productEditDetailed">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="SectionDetalied">

                            <table>
                                <tr>
                                    <th>Категория</th>
                                    <th></th>
                                </tr>

                                <?php CategoryEdit($category_list) ?>

                            </table>
                    </div>
                    <div class="SelectionEdit">
                 
                            <ul>
                                <li>
                                    <h2>Название</h2>
                                </li>
                                <li>
                                    <input name="nameCategory" id="nameCategory" type="text" value="<?php echo $NameProductBefore;
                                    ?>" <?php if (!empty($Error['category'])) {
                                        echo $Error['category'];
                                    }
                                    ; ?>>
                                </li>
                                <li class="SelectionEdit__btn">
                                    <button type="submit" name="SubmitCategoryAdd">Добавить</button>
                                </li>
                            </ul>
                  
                    </div>
                </form>

            </section>
    </main>
</body>

</html>