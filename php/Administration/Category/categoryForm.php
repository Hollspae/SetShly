<?php
session_start();
require_once '../../config/connect.php';



function CategoryEdit($category_list)
{
    for ($i = 0; $i <= count($category_list) - 1; $i++) {
        $IDCategory = $category_list[$i][0];
        $NameCategory = $category_list[$i][1];
        echo '<tr>
                <td> ' . $NameCategory . '</td>
                <td><button class="DeleteCategory" type="submit" id="btn" name="btn" value="'.$IDCategory.'">Удалить</button></td>
             </tr>';

    }


}
if (isset($_POST['SubmitCategoryAdd'])) {
    $pattern = '/^[А-Яа-яёЁё]{1,}$/u';

    if (preg_match($pattern, $_POST['nameCategory'])) {

        for ($i = 0; $i <= count($category_list) - 1; $i++) {
            $NameCategory = $category_list[$i][1];

            if ($_POST['nameCategory'] != $NameCategory) {

                $notEmpty = function ($value) {
                    return !empty($value);
                };

                $EndCategoryID[] = $category_list[$i][0];
                $filteredArray = array_filter($EndCategoryID, $notEmpty);
                $EndCategory = array_pop($filteredArray) + 1;

                $queryCategory = mysqli_query($connect, "INSERT INTO `Категория` (`ID_Категории`, `Наименование`) VALUES ('{$EndCategory}', '{$_POST['nameCategory']}')");

            }
        }
    } else {
        $Error['category'] = 'Не корректное значение';
    }
}
if(isset($_POST['btn'])){

    $queryDeleteCategory = mysqli_query($connect, "DELETE FROM `Категория` WHERE `ID_Категории` = '{$_POST['btn']}'");
}