<?php
session_start();
require_once '../../config/connect.php';
require_once 'moderForm.php';


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

        <h2 class="HeaderDelivery">Редактирование администраторов</h2>
        <nav class="container-navigation">
            <ul>
                <li><a href="http://setshly/php/profile/profile.php" class="history-back">
                        <img class="navigation_arrow" src="img/arrow.png" alt=""></a></li>
                <li><a href="http://setshly/php/Index/index.php">Главная страница</a></li>
                <li><a href="http://setshly/php/profile/profile.php">Личный кабинет</a></li>
                <li><a href="http://setshly/php/Administration/Product/product.php">Товар</a></li>
                
            </ul>
        </nav>

        <section class="SECTION__productEditDetailed">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="SectionDetalied">

                    <table>
                        <tr>
                            <th>Пользователь</th>
                            <th>Номер телефона</th>
                            <th>Роль</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php OutPutModer($Role) ?>

                    </table>
                </div>
                <div class="SelectionEdit">



                </div>
            </form>

        </section>
    </main>
</body>

</html>