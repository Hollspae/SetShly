<?php 
    require_once '../config/connect.php';
    $goods = mysqli_query($connect, 'SELECT * FROM `Product`');

    include '../PATTERN/header.php';

?>



    <!-- Подвал -->

    <?php
        include '../PATTERN/footer.php';
    ?>