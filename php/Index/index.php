<?php 
    require_once '../config/connect.php';
    $goods = mysqli_query($connect, 'SELECT * FROM `Product`');
?>
<!-- dsda -->
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SetShly</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    
  
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/fonts/fonts.css">
    <link rel='stylesheet' type='text/css' media='screen' href='css/styles.css'>
</head>
<body>
<div class="contentBODY">

    <!-- МЕНЮ -->
    
    <div class="menu">

        <div class="title">
            <h1>МУЖСКОЕ</h1>
            <h1>ЖЕНСКОЕ</h1>
        </div>

        <div class="list_menu">
            <ul class="rra">
                <li><a href="#">Верхняя одежда</a></li>
                <li><a href="#">Нижняя одежда</a></li>
                <li><a href="#">Обувь</a></li>
                <li><a href="#">Верхняя одежда</a></li>
                <li><a href="#">Нижняя одежда</a></li>
                <li><a href="#">Обувь</a></li>
            </ul>
            <div class="ul-menu">
                <ul>
                 <li><a href="#">Верхняя одежда</a></li>
                 <li><a href="#">Нижняя одежда</a></li>
                 <li><a href="#">Обувь</a></li>
                 <li><a href="#">Верхняя одежда</a></li>
                </ul>
            </div>
         </div>

         <div class="openMe">
            <p>ПОТЯНИ</p>
         </div> 
    </div> 

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



    <!-- Основной блок -->
    <div class="Content">

        <div class="content-paul">

            <div class="Paul">
              <a class="LINK" href="../Man/Man.php">МУЖСКОЕ</a>
               <img src="/basic_img/women.jpg">
           </div>
           <div class="Paul">
               <a class="LINK" href="../Woman/Woman.php" >ЖЕНСКОЕ</a>
               
               <img src="/basic_img/women.jpg">
           </div> 

         </div>

    </div>


    <!--Sale -->
    <div class="Sale">
        <div class="div">
        <a class="LINK" href="../Hits/Hits.php" >ХИТЫ</a>
        </div>
        
        <div class="div">
        <a class="LINK" href="../Sale/Sale.php" >РАСПРОДАЖА</a>
        </div>

        <div class="div">
        <a class="LINK" href="../Discounts/Discounts.php" >СКИДКИ</a>
        </div>
      


        
    </div>



    <!-- Слайдер -->
    <div class="swiper mySwiper slider">
    
        <div class="swiper-wrapper slider-card">
             <div class="swiper-slide card">
                 <img src="img/tov1.jpg" alt="">
                 <p>Описание</p>
                 <p>Рублей</p>
             </div>
             <div class="swiper-slide card">
                 <img src="img/tov1.jpg" alt="">
                 <p>Описание</p>
                 <p>Рублей</p>
             </div>
             <div class="swiper-slide card">
                 <img src="img/tov1.jpg" alt="">
                 <p>Описание</p>
                 <p>Рублей</p>
             </div>

             <div class="swiper-slide card">
                 <img src="img/2tov.jpg" alt="">
                 <p>Описание</p>
                 <p>Рублей</p>
             </div>
             <div class="swiper-slide card">
                 <img src="img/2tov.jpg" alt="">
                 <p>Описание</p>
                 <p>Рублей</p>
             </div>
             <div class="swiper-slide card">
                 <img src="img/2tov.jpg" alt="">
                 <p>Описание</p>
                 <p>Рублей</p>
             </div>

             
         </div>
         
         <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
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


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
<!-- <script src="/js/index.js"></script> -->
<!-- <script src="/js/index.js"></script> -->
</body>
</html>