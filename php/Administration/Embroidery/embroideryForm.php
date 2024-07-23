<?php
session_start();
require_once '../../config/connect.php';


//Вывод вышивок
function EmbroideryEdit($embroidery)
{
    for ($i = 0; $i <= count($embroidery) - 1; $i++) {
        $IDEmbroidery = $embroidery[$i][0];
        $NameEmbroidery = $embroidery[$i][1];
        $DiscriptionEmbroidery = $embroidery[$i][2];
        echo '<tr>
                <td value="' . $IDEmbroidery . '"> ' . $NameEmbroidery . '</td>
                <td>' . $DiscriptionEmbroidery . '</td>
                <td><img class="imgCategory" src="../../../embroidery/' . $NameEmbroidery . '.png"></td>
                <td><button class="DeleteEmbroidery" type="submit" id="btn" name="btn" value="' . $IDEmbroidery . '">Удалить</button></td>
             </tr>';
    }
}


//Удаление вышивки
if (isset($_POST['btn'])) {

    $queryDeleteEmbroidery = mysqli_query($connect, "DELETE FROM `Вышивка` WHERE `ID_Вышивки` = '{$_POST['btn']}'");
}


if (isset($_POST['SubmitEmbroideryAdd'])) {

    $pattern = '/^[А-ЯА-ЯЁЁ]{1}/u';
    if (preg_match($pattern, $_POST['nameEmbroidery']) && preg_match($pattern, $_POST['discriptionEmbroidery'])) {



        if (isset($_FILES['imageFile'])) {
            $targetFolder = '../../../embroidery/';
            // Получаем информацию о загруженном файле
            $fileInfo = pathinfo($_FILES['imageFile']['name']);
        
            // Проверяем, что файл имеет допустимый формат
            if ($fileInfo['extension'] === 'png') {
                // Переименовываем файл
                $newFileName = ''.$_POST['nameEmbroidery'].'.' . $fileInfo['extension'];
        
                // Создаем путь к файлу в целевой папке
                $targetPath = $targetFolder . $newFileName;
        
                // Перемещаем файл в целевую папку
                if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $targetPath)) {
                    $sencefull = 1;
                } 
            }
        }
    }
}
if($sencefull == 1){
    for( $i = 0; $i < count($embroidery); $i++){
        $EndIDEmbroidery[] = $embroidery[$i][0];

        $notEmpty = function ($value) {
            return !empty($value);
        };

        $filteredArray = array_filter($EndIDEmbroidery, $notEmpty);
        $EndEmbroidery = array_pop($filteredArray) + 1;
    }
    if(!empty($EndEmbroidery)){
        $queryProductToOrder = mysqli_query($connect, "INSERT INTO `Вышивка` (`ID_Вышивки`, `Название`, `Описание`, `Фото`) VALUES ('{$EndEmbroidery}', '{$_POST['nameEmbroidery']}', '{$_POST['discriptionEmbroidery']}', '{$newFileName}')");
    }
     
}