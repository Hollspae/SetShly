<?php
require_once '../config/connect.php';

//При регистрации сразу создавать корзину

if (isset($_POST['formSubmit2'])) {
    $surnameForm = preg_replace("/[^a-zA-Zа-яА-Я0-9]/ui", "", $_POST['surname']);
    $nameForm = preg_replace("/[^a-zA-Zа-яА-Я0-9]/ui", "", $_POST['name']);
    $telephoneForm = preg_replace("/[^0-9]/ui", "", $_POST['telephone']);
    $passwordForm = $_POST['password2'];
    $agreementForm = $_POST['agreement'];

    if (
        !empty($surnameForm) && !empty($nameForm) && !empty($telephoneForm) && !empty($passwordForm) && !empty($agreementForm)
        && is_numeric($telephoneForm) && preg_match("/^([А-ЯЁ]{1}[а-яё]{3,16})|([A-Z]{1}[a-z]{3,16})$/u", $surnameForm)
        && preg_match("/^([А-ЯЁ]{1}[а-яё]{3,16})|([A-Z]{1}[a-z]{3,16})$/u", $nameForm) && preg_match('/^[a-z0-9]{6,}+$/i', $passwordForm)
    ) {
        $query_user = mysqli_query($connect, 'SELECT * FROM `Пользователь`');

        $query_user_list = mysqli_fetch_all($query_user);

        $key_user = 0;

        for ($i = 0; $i <= count($query_user_list); $i++) {
            if ($telephoneForm == $query_user_list[$i][4]) {
                $key_user++;
                $i = count($query_user_list);

            }
            ;
        }
        ;

        $user_updateID = count($query_user_list) + 1;
        $user_role = 2;

        if ($key_user === 0) {
$asd = 0;
            $query_add_user = mysqli_query($connect, 'INSERT INTO `Пользователь` (`ID Пользователя`, `ID_Роли`, `Фамилия`, `Имя`, `Номер телефона`, `Пароль`) VALUES (' . $user_updateID . ', ' . $user_role . ', "' . $surnameForm . '", "' . $nameForm . '", ' . $telephoneForm . ', "' . $passwordForm . '")');
            session_start();
            $_SESSION['id_user'] = $user_updateID;
            $_SESSION['name'] = $nameForm;

            $_SESSION['surname'] = $$surnameForm;
            $_SESSION['number'] = $telephoneForm;
            $_SESSION['role'] = $user_role;


            for ($i = 0; $i <= count($basket) - 1; $i++) {
                $lastID_basket = $basket[$i][0];
            }
            ;
            $ID_Basket = $lastID_basket + 1;

            $Summ = 0;
            $Date = date('Y-m-d');
            $IDUSER = $_SESSION['id_user'];
            $Determinant = 0;

            $query_add_basket = mysqli_query($connect, 'INSERT INTO `Корзина` (`ID Корзины`, `ID Пользователя`, `Сумма`, `Дата формирования`, `Определитель`) VALUES (' . $ID_Basket . ', ' . $IDUSER . ', ' . $Summ . ', "' . $Date . '", ' . $Determinant . ')');

            $_SESSION['completedRegistration'] = "successfully";

            header('Location: http://setshly/php/Profile/profile.php');
            exit;
        }
        ;
    }
    ;
}
;
?>