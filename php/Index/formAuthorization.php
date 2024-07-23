<?php
session_start();
require_once '../config/connect.php';


if (isset($_POST['formSubmit1'])) {
    $query_user = mysqli_query($connect, 'SELECT * FROM `Пользователь`');
    $query_user_list = mysqli_fetch_all($query_user);

    $loginForm = $_POST['login'];
    $passwordForm = $_POST['password1'];
    $err = [];


    if (empty(preg_replace("/[^0-9]/ui", "", $loginForm))) {
        $err[] = 'Не корректный Логин';

    }
    if (empty(preg_match('/^[a-z0-9]{6,}+$/i', $passwordForm))) {
        $err[] = 'Не корректный пароль';

    }

    if (count($err) == 0) {


        for ($i = 0; $i <= count($query_user_list); $i++) {
            if ($loginForm == $query_user_list[$i][4]) {
                $_SESSION['id_user'] = $query_user_list[$i][0];
                $_SESSION['name'] = $query_user_list[$i][3];
                $_SESSION['surname'] = $query_user_list[$i][2];
                $_SESSION['number'] = $query_user_list[$i][4];
                $_SESSION['role'] = $query_user_list[$i][1];


                if ($passwordForm == $query_user_list[$i][5]) {
                    $_SESSION['pass'] = $passwordForm;


                    $_SESSION['completedLogin'] = "successfully";

                    $logaut = true;
                    header("Location: http://setshly/php/Profile/profile.php");
                    exit;

                }


            }
        }
        ;

    }
    ;
}
;









// if (!empty($_POST['login']) && !empty($_POST['password1']) && preg_replace("/[^0-9]/ui", "",$loginForm) && preg_match('/^[a-z0-9]{6,}+$/i',$passwordForm) ) {

//     $query_user = mysqli_query(mysqli_connect('127.0.0.1', 'root', '', 'Shop'), 'SELECT * FROM `Пользователь`');
//     $query_user_list = mysqli_fetch_all($query_user);
//     $key_user = 0;

//     for ($i = 0; $i <= count($query_user_list); $i++) {
//         if($loginForm == $query_user_list[$i][3]) {
//             $key_user++;
//             $i = count($query_user_list);

//         };
//     };

//     for ($i = 0; $i <= count($query_user_list); $i++) {
//         if($passwordForm == $query_user_list[$i][4]) {
//             $key_user++;
//             $i = count($query_user_list);
//         };
//     };
//     // echo "<script>alert(`Добро пожаловать, $loginForm`)</script>)";

//     if ($key_user === 2) {

//         // setcookie('login', $loginForm, 0, '/');
//         // setcookie('password', $passwordForm, 0, '/');

//         for ($i = 0; $i <= count($query_user_list); $i++) {
//             if ($loginForm == $query_user_list[$i][3]) {
//                 if ($query_user_list[$i][5] == 1) {
//                     $role++;
//                 };  

//                 if ($query_user_list[$i][5] == 2) {
//                     $role = 2;
//                 };
//             };
//         };

//         if ($role == 1) {
//             setcookie('role', 'Administrator', 0, '/');
//         };
//         if ($role == 2) {
//             setcookie('role', 'User', 0, '/');
//         };




//     };


// }





?>