<?php 
    require_once '../config/connect.php';
    $goods = mysqli_query($connect, 'SELECT * FROM `Product`');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SetShly</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    

    <link rel="stylesheet" href="/fonts/fonts.css">
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>

</head>
<body>
<div class="contentBODY">

<!-- Шапка -->
    <div class="head">

        <div class="head-left">
            <div class="search">
                <button type="submit"><img src="/php/Index/img/sear.png" alt=""></button>
                <input type="search" placeholder="Поиск">
            </div>
        </div>


        <div class="head-center">
            <a href="../Index/index.php">SetShly</a>

        </div>

        <div class="head-right">
            <a href="../Basket/basket.php"> <img src="/basic_img/bas.png">   </a>
            <a href="../Liked/liked.php"> <img src="/basic_img/li.png">    </a>
            <a href="../Profile/profile.php"> <img src="/basic_img/prof.png">  </a> 
        </div>


    </div>


    <!-- Подвал -->

    <footer>
        <div class="footerColumns">

            <p>Ваш Аккаунт</p>
            
            <a href="#">Войти</a>
            <a href="#">Регистрация</a>
       
        </div>

        <div class="footerColumns">

            <p>О Компании</p>
            
            <a href="#">Блог о нас</a>
            <a href="#">Что-нибудь еще</a>
            <a href="#">Пиво 387</a>
            <a href="#">Пиво 387</a>
            <a href="#">Пиво 387</a>
            

        </div>

        <div class="footerColumns">

            <p>Yf pfgfc</p>
            
            <a href="#">Xnj yb,elm</a>
            <a href="#">Tot xnj yb,elm</a>
            <a href="#">Gbdj 387</a>

        </div>

        <div class="footerColumns">

            <p>Найти нас</p>
            
            <div class="footerColumnsLINK">

                <a href="https://vk.com/Hollspae"><img src="/basic_img/messenger/vk.png "></a>
                <a href="https://t.me/Hollspae"><img src=" /basic_img/messenger/tg.png  "></a>
                <a href="Hollspae@vk.com">Почтецка</a>

            </div>

        </div>
   
    </footer>

</div>


</body>
</html>