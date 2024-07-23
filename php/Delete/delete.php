<?php
require_once '../config/connect.php';
    $product_id = $_GET['del'];
    $query = (mysqli_query($connect, "DELETE FROM `Товар` WHERE `Товар`.`ID_Товара` = '$product_id'"));
      
    header('Location: http://setshly/php/Index/index.php');
    exit;  
?>