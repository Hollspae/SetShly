<?php
session_start();
require_once '../config/connect.php';
$url = urldecode(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$cut_search = substr($url, 38, 1);
$product_id = $cut_search;

if (isset($_POST)) {
    $Ratingproduct = $_POST['ratings'];

    if (!empty($_POST['Discription'])) {
        $Discriptionproduct = $_POST['Discription'];
    } else {
        $Discriptionproduct = "";
    }



    $date = date('Y-m-d');
    $id_user = $_SESSION['id_user'];
    $IDORDER = 0;
    for ($i = 0; $i < count($feedback); $i++) {
        $listID[] = $feedback[$i][0];

    }
    if (!empty($listID)) {
        foreach ($listID as $v) {
            $IDORDERs = $v;

        }
    }

    $IDORDER = $IDORDERs + 1;
    if (!empty($Ratingproduct)) {;
        $queryFeedback = mysqli_query($connect, "INSERT INTO `Отзыв` (`ID Отзыва`, `ID Пользователя`, `ID Товара`, `Дата`, `Содержание`, `Оценка`) VALUES ('{$IDORDER} ', ' {$id_user}', '{$product_id}', '{$date}', '{$Discriptionproduct}', '{$Ratingproduct}')");
    }





    


}



// header('Location: ' . $_SERVER['REQUEST_URI']);