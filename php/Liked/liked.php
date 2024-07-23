<?php
require_once '../config/connect.php';
include '../PATTERN/header.php';

?>
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
    <section>
        <ul class="container__products row-1">
            <li class="product pd-1">
                <div class="card-product"><img src="" alt=""></div>
            </li>
            <li class="product pd-2">
                <div class="card-product"></div>
            </li>
            <li class="product pd-3">
                <div class="card-product"></div>
            </li>
        </ul>
        <ul class="container__products row-2">
            <li class="product pd-4">
                <div class="card-product"></div>
            </li>
            <li class="product pd-5">
                <div class="card-product"></div>
            </li>
            <li class="product pd-6">
                <div class="card-product"></div>
            </li>
        </ul>
        <ul class="container__products row-3">
            <li class="product pd-7">
                <div class="card-product"></div>
            </li>
            <li class="product pd-8">
                <div class="card-product"></div>
            </li>
            <li class="product pd-9">
                <div class="card-product"></div>
            </li>
        </ul>
    </section>
</main>

<?php
include '../PATTERN/footer.php';
?>