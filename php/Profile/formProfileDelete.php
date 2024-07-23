<?php
session_start();
require_once '../config/connect.php';
if (empty($_SESSION['name'])) {
    header('Location: http://setshly/php/Index/index.php');
    exit;
}
if (isset($_POST['formSubmitDelete'])) {

    $loginForm = $_SESSION['name'];
    $query_user_list = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `Пользователь`'));

    for ($i = 0; $i <= count($query_user_list); $i++) {
        if ($loginForm == $query_user_list[$i][3]) {
            $idForm = $query_user_list[$i][0];

        }
    }

    $query_userDELETE = mysqli_query($connect, "DELETE FROM `Пользователь` WHERE `Пользователь`.`ID Пользователя` = '$idForm' ");

    
    session_unset();
    session_destroy();

    header("Location: http://setshly/php/Index/index.php");
    exit;

}

?>