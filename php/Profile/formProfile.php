<?php
session_start();
require_once '../config/connect.php';


if (empty($_SESSION['name'])) {
    header('Location: http://setshly/php/Index/index.php');
    exit;

} else {
    $loginForm = $_SESSION['name'];

    for ($i = 0; $i <= count($query_user_list); $i++) {
        if ($loginForm == $query_user_list[$i][3]) {
            $idForm = $query_user_list[$i][0];

            $UserRole = $query_user_list[$i][1];
            $UserSurName = $query_user_list[$i][2];
            $UserName = $query_user_list[$i][3];
            $UserNumber = $query_user_list[$i][4];
            $UserPassword = $query_user_list[$i][5];


        }
    }


}


if (isset($_POST['formSubmitEdit'])) {
    $patternName = '/^[А-ЯА-Я][а-яА-ЯёЁ]+$/u';
    $patternPassword = '/^[0-9a-zA-Z]+$/';

    $NameProfile = $_POST['NameProfile'];
    $SurnameProfile = $_POST['SurnameProfile'];

    $NumberProfile = $_POST['NumberProfile'];
    $PasswordProfile = $_POST['PasswordProfile'];

    if (empty($NameProfile) || empty($SurnameProfile) || empty($NumberProfile) || empty($PasswordProfile)) {
        header('Location: http://setshly/php/profile/personalDate.php');
    }
    if (!empty($_POST['NameProfile']) && preg_match($patternName, $NameProfile)) {
        $_SESSION['name'] = $NameProfile;
        $_SESSION['NAME'] = "";
        $queryProfile_edit = mysqli_query($connect, "UPDATE `Пользователь` SET `Имя` = '{$NameProfile}' WHERE `Пользователь`.`ID Пользователя` = '{$idForm}' ");
        header('Location: http://setshly/php/profile/personalDate.php');
    } 
    if (!empty($_POST['NameProfile']) && !preg_match($patternName, $NameProfile)) {
        $_SESSION['NAME'] = 'Не корректное имя!';
    }

    if (!empty($_POST['SurnameProfile']) && preg_match($patternName, $SurnameProfile)) {
        $_SESSION['SURNAME'] = "";
        $queryProfile_edit = mysqli_query($connect, "UPDATE `Пользователь` SET `Фамилия` = '{$SurnameProfile}' WHERE `Пользователь`.`ID Пользователя` = '{$idForm}' ");

        header('Location: http://setshly/php/profile/personalDate.php');
    } 
    if (!empty($_POST['SurnameProfile']) && !preg_match($patternName, $SurnameProfile)) {
        $_SESSION['SURNAME'] = 'Не корректная фамилия!';
    }



    function isValidNumber($NumberProfile)
    {
        $NumberProfile = preg_replace('/\D/', '', $NumberProfile);

        if (substr($NumberProfile, 0, 1) !== '7') {
            return false;
        }
        if (strlen($NumberProfile) !== 11) {
            return false;
        }
        return true;
    }

    if (!empty($_POST['NumberProfile']) && isValidNumber($NumberProfile)) {
        $_SESSION['NUMBER'] = "";
        $queryProfile_edit = mysqli_query($connect, "UPDATE `Пользователь` SET `Номер телефона` = '{$NumberProfile}' WHERE `Пользователь`.`ID Пользователя` = '{$idForm}' ");
        header('Location: http://setshly/php/profile/personalDate.php');

    } 
    if (!empty($_POST['NumberProfile']) && !isValidNumber($NumberProfile)) {
        $_SESSION['NUMBER'] = 'Не корректный номер!';
        header('Location: http://setshly/php/profile/personalDate.php');
        ;
    }

   
    if (!empty($_POST['PasswordProfile']) && strlen($PasswordProfile) < 8 && preg_match($patternPassword, $PasswordProfile)) {
        $_SESSION['PASSWORD'] = "";
        $queryProfile_edit = mysqli_query($connect, "UPDATE `Пользователь` SET `Пароль` = '{$PasswordProfile}' WHERE `Пользователь`.`ID Пользователя` = '{$idForm}' ");
        header('Location: http://setshly/php/profile/personalDate.php');
    }
    if (!empty($_POST['PasswordProfile']) && strlen($PasswordProfile) > 6 || !empty($_POST['PasswordProfile']) &&  !preg_match($patternPassword, $PasswordProfile)) {
        $_SESSION['PASSWORD'] = 'Не корректный пароль!';
        header('Location: http://setshly/php/profile/personalDate.php');
    } 




}


?>