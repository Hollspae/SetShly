   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="css/main.css">
       <link rel="shortcut icon" href="img/logo.png" type="image/png">
       <script src="https://unpkg.com/popper.js@1" defer></script>
       <script src="https://unpkg.com/tippy.js@5" defer></script>
       <script src="js/app.js?v=0.2" defer></script>
       <title>SetShly - Заказывай на свой вкус!</title>
   </head>

   <body id="body">
       <div class="preloader" id="preloader">
           <div class="spinner">
               <div class="blob top"></div>
               <div class="blob bottom"></div>
               <div class="blob left"></div>
               <div class="blob move-blob"></div>
           </div>
       </div>
       <div class="background-navigation display-none"></div>
       <header id="header">
           <div class="search"> <img src="img/search.png" alt="" draggable="false">
               <input type="search" placeholder="Поиск">
           </div>
           <h1><a href="../Index/index.php" style="color: #282b34;">SetShly</a></h1> <img class="logo" src="img/logo.png" alt="" draggable="false">
           <nav id="navigation-header" class="navigation-header">
               <ul id="menu">
                   <li>
                       <div class="profile"><img src="img/profile.png" alt="Личный кабинет" draggable="false"></div>
                   </li>
                   <li>
                       <a href="../Liked/liked.html" class="liked"><img src="img/liked.png" alt="Избранное" draggable="false"></a>
                   </li>
                   <li>
                       <a href="../Basket/basket.html" class="basket"><img src="img/basket.png" alt="Корзина" draggable="false"></a>
                   </li>
               </ul>
           </nav>
       </header>
       <div class="authorization authorization-closed">
           <div class="closing-authorization"> <img src="img/closing.png" alt="Закрыть" draggable="false"> </div>
           <form>
               <h3>Вход</h3>
               <div class="inputs">
                   <div class="login">
                       <label for="login">Логин</label>
                       <input type="text" id="login">
                   </div>
                   <div class="password">
                       <label for="password">Пароль</label>
                       <input type="password" id="password">
                   </div>
               </div>
               <button>Продолжить</button>
               <div class="registration-unlock">Регистрация</div>
           </form>
       </div>
       <div class="registration registration-closed">
           <div class="closing-registration"> <img src="img/closing.png" alt="Закрыть" draggable="false"> </div>
           <form>
               <h3>Регистрация</h3>
               <div class="inputs">
                   <div class="surname">
                       <label for="surname">Фамилия</label>
                       <input type="text" id="surname">
                   </div>
                   <div class="name">
                       <label for="name">Имя</label>
                       <input type="text" id="name">
                   </div>
                   <div class="telephone">
                       <label for="telephone">Телефон</label>
                       <input type="text" id="telephone">
                   </div>
                   <div class="mail">
                       <label for="mail">Почта</label>
                       <input type="text" id="mail">
                   </div>
               </div>
               <div class="agreement">
                   <div class="agreement-button agreement-false">
                       <div class="agreement-button-click"></div>
                   </div>
                   <p>Я принимаю пользовательское соглашение и даю согласие на обработку персональных данных</p>
               </div>
               <button>Продолжить</button>
           </form>
       </div>
       <main id="main">
           <aside class="transition-false">
               <div class="activation false">Меню</div>
               <nav id="navigation-aside" class="navigation-products">
                   <ul class="female-clothink">
                       <li><a href="">ЖЕНСКОЕ</a></li>
                       <li><a href="">верхняя одежда</a></li>
                       <li><a href="">нижняя одежда</a></li>
                       <li><a href="">обувь</a></li>
                   </ul>
                   <ul class="male-clothink">
                       <li><a href="">МУЖСКОЕ</a></li>
                       <li><a href="">верхняя одежда</a></li>
                       <li><a href="">нижняя одежда</a></li>
                       <li><a href="">обувь</a></li>
                   </ul>
               </nav>
           </aside>
           <div class="buttons"><a class="button" href="report.php">Все товары</a><a class="button" href="reportSameCategory.php">Одной категории</a><a class="button" href="reportSameEmbroidery.php">Одной вышивки</a></div>
           <table class="html-table">
               <thead>
                   <tr>
                       <th>
                           Товар
                       </th>
                       <th>
                           Категория
                       </th>
                       <th>
                           Вышивка
                       </th>
                       <th>
                           Количество
                       </th>
                       <th>
                           Наименование
                       </th>
                       <th>
                           Фото
                       </th>
                       <th>
                           Цена
                       </th>
                   </tr>
               </thead>
               <tbody>
                    <?php
                        $connect = mysqli_connect('127.0.0.1', 'root', '', 'Shop');
                            
                        $products = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Товар`'));

                        if (count($products) != 0) {
                            
                            function trHTML($num) {

                                $connect = mysqli_connect('127.0.0.1', 'root', '', 'Shop');
                        
                                $products = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Товар`'));

                                $priceProducts = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Прайс-лист_товаров`'));

                                if ($products[$num][0]) {
                                    if ($products[$num][1] == 1) { $category = 'Футболка'; };
                                    if ($products[$num][1] == 2) { $category = 'Джинсы'; };
                                    if ($products[$num][1] == 3) { $category = 'Носки'; };
                                    if ($products[$num][1] == 4) { $category = 'Худи'; };

                                    if ($products[$num][2] == 1) { $embroidery = 'Кит'; };
                                    if ($products[$num][2] == 2) { $embroidery = 'Надпись'; };
                                    if ($products[$num][2] == 3) { $embroidery = 'Подсолнух-nike'; };
                                    if ($products[$num][2] == 4) { $embroidery = 'Руки'; };

                                    echo '<tr>
                                        <td>
                                            '.$products[$num][0].'
                                        </td>
                                        <td>
                                            '.$category.'
                                        </td>
                                        <td>
                                            '.$embroidery.'
                                        </td>
                                        <td>
                                            '.$products[$num][3].'
                                        </td>
                                        <td>
                                            '.$products[$num][4].'
                                        </td>
                                        <td>
                                            '.$products[$num][6].'
                                        </td>
                                        <td>
                                            '.$priceProducts[$num][2].'
                                        </td>
                                    </tr>';
                                };
                            };
                        };
                    trHTML(0);
                    trHTML(1);
                    trHTML(2);
                    trHTML(3);
                    trHTML(4);
                    trHTML(5);
                    trHTML(6);
                    trHTML(7);
                    trHTML(8);
                    ?>
               </tbody>
           </table>
       </main>
       <footer id="footer">
           <div class="about-company"><a href="">О НАС</a></div>
           <div class="help"><a href="">ПОМОЩЬ</a></div>
           <div class="find"><a href="">НАЙДИ НАС</a></div>
       </footer>
   </body>

   </html>