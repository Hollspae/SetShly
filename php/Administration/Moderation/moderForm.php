<?php
session_start();
require_once '../../config/connect.php';


for ($i = 0; $i < count($query_user_list); $i++) {
    $listIDUser[] = $query_user_list[$i][0];
    $listIDRole[] = $query_user_list[$i][1];
    $listIDSurName[] = $query_user_list[$i][2];
    $listIDName[] = $query_user_list[$i][3];
    $listIDNumber[] = $query_user_list[$i][4];



}



$_SESSION['user'] = array();
$testuser = function () {
    return count($_SESSION['user']);
};
$_SESSION['user0'] = array();
$testuser0 = function () {
    return count($_SESSION['user0']);
};

$_SESSION['user1'] = array();
$testuser1 = function () {
    return count($_SESSION['user1']);
};
$_SESSION['user2'] = array();
$testuser2 = function () {
    return count($_SESSION['user2']);
};
$_SESSION['user3'] = array();
$testuser3 = function () {
    return count($_SESSION['user3']);
};
$_SESSION['user4'] = array();
$testuser4 = function () {
    return count($_SESSION['user4']);
};

$Array2 = array_combine(array_values($listIDSurName), array_values($listIDName));

for ($j = 0; $j < count($Role); $j++) {
    foreach ($listIDRole as $role) {
        if ($role == $Role[$j][0]) {
            $listRoleName[] = $Role[$j][1];
        }
    }
   
}
foreach ($listIDRole as $k => $IDrole) {
    $_SESSION['user0']['key-' . ($testuser0() + 1)] = [$IDrole];
}
foreach ($listRoleName as $k => $NumberRole) {
    $_SESSION['user1']['key-' . ($testuser1() + 1)] = [$NumberRole];
}
foreach ($Array2 as $Surname => $Name) {
    $_SESSION['user2']['key-' . ($testuser2() + 1)] = [$Surname, $Name];
}
foreach ($listIDUser as $k => $id) {
    $_SESSION['user3']['key-' . ($testuser3() + 1)] = [$id];
}
foreach ($listIDNumber  as $k => $number) {
    $_SESSION['user4']['key-' . ($testuser4() + 1)] = [$number];
}

//////
foreach ($_SESSION['user0'] as $key => &$value) {
   

    $value[] = $_SESSION['user1'][$key][0];
    
    $value[] = $_SESSION['user3'][$key][0];

    $value[] = $_SESSION['user2'][$key][0];
    $value[] = $_SESSION['user2'][$key][1];

$value[] = $_SESSION['user4'][$key][0];
}



foreach ($_SESSION['user0'] as &$value) { // Используем ссылку для обновления элементов массива
    if ($value[0] == 1) {
        $value[1] = 'Администратор';
    } elseif ($value[0] == 2) {
        $value[1] = 'Пользователь';
    }
}

// echo "<pre>";
// print_r($_SESSION['user0']);
function OutPutModer($Role)
{
    for ($j = 0; $j < count($Role); $j++) {
        $roelsID[] = $Role[$j][0];
        $rolesName[] = $Role[$j][1];
    }
    $ArrayRole = array_combine(array_values($roelsID), array_values($rolesName));
    if(!empty($_SESSION['user1'])){
    

    for ($i = 1; $i <= count($_SESSION['user0']); $i++) {
        echo '<tr>
                <td value="' . $_SESSION['user0']['key-' . $i][3] . '"> ' . $_SESSION['user0']['key-' . $i][3] . ' ' . $_SESSION['user0']['key-' . $i][4] . '</td>
                <td>' . $_SESSION['user0']['key-' . $i][5] . '</td>
                <td>' . $_SESSION['user0']['key-' . $i][1] . '</td>
                <td>
                    <select class="tbl-option" name="role-' . $_SESSION['user0']['key-' . $i][2] . '">';
        foreach ($ArrayRole as $ids => $name) {
            echo '<option  value="' . $ids . '">' . $name . '</option>';
        }
        echo '
	                </select>
                </td>
                <td><button class="tbl-btn" type="submit" id="btn" name="btn-' . $_SESSION['user0']['key-' . $i][2] . '" value="' . $_SESSION['user0']['key-' . $i][2] . '" ">Сохранить</button></td>
            </tr>';

    }
    }

}





if (!empty($_POST)) {

    $inputValues = $_POST;
 

    foreach ($inputValues as $key => $valuear) {
        if (strpos($key, 'btn-') !== false) {
            $pattern = '/^[1-9][0-9]*$/';

            if (preg_match($pattern, $valuear) && $valuear !== "") {
                $a = substr($key, $pos + 4);
            }
            if ($key = 'btn-' . $a . '') {
                $vals = $valuear;
                $idrol = $_POST['role-' . $vals . ''];
            }
        }
    }
    echo "<pre>";
    echo "role " . $idrol;
    echo "<pre>";
    echo "user " . $vals;
    if (!empty($vals) && !empty($idrol)) {

       
        $queryEditRole = mysqli_query($connect, "UPDATE `Пользователь` SET `Пользователь`.`ID_Роли` = '{$idrol}' WHERE `Пользователь`.`ID Пользователя` ='{$vals}'");
        if($queryEditRole){
            $sencefull = 1;
        }
    }


}
if($sencefull == 1){
    unset($_SESSION['user0']);
    header('Location: http://setshly/php/Administration/Moderation/moder.php');
}
