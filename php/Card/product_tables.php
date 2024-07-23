<?php
    require '../config/connect.php';

    $option_red = '<option value="1">Красный</option>
                    <option value="2">Синий</option>
                    <option value="3">Белый</option>
                    <option value="4">Черный</option>
                    <option value="5">Желтый</option>
                    <option value="6">Зеленый</option>
                    <option value="7">Нет</option>';

    $option_blue = '<option value="1">Синий</option>
                    <option value="2">Красный</option>
                    <option value="3">Белый</option>
                    <option value="4">Черный</option>
                    <option value="5">Желтый</option>
                    <option value="6">Зеленый</option>
                    <option value="7">Нет</option>';

    $option_white = '<option value="1">Белый</option>
                    <option value="2">Красный</option>
                    <option value="3">Синий</option>
                    <option value="4">Черный</option>
                    <option value="5">Желтый</option>
                    <option value="6">Зеленый</option>
                    <option value="7">Нет</option>';

    $option_black = '<option value="1">Черный</option>
                    <option value="2">Красный</option>
                    <option value="3">Синий</option>
                    <option value="4">Белый</option>
                    <option value="5">Желтый</option>
                    <option value="6">Зеленый</option>
                    <option value="7">Нет</option>';

    $option_yellow = '<option value="1">Желтый</option>
                    <option value="2">Красный</option>
                    <option value="3">Синий</option>
                    <option value="4">Белый</option>
                    <option value="5">Черный</option>
                    <option value="6">Зеленый</option>
                    <option value="7">Нет</option>';

    $option_green = '<option value="1">Зеленый</option>
                    <option value="2">Красный</option>
                    <option value="3">Синий</option>
                    <option value="4">Белый</option>
                    <option value="5">Черный</option>
                    <option value="6">Желтый</option>
                    <option value="7">Нет</option>';

    $option_color_none = '<option value="1">Нет</option>
                    <option value="2">Красный</option>
                    <option value="3">Синий</option>
                    <option value="4">Белый</option>
                    <option value="5">Черный</option>
                    <option value="6">Желтый</option>
                    <option value="7">Зеленый</option>';

    $option_s = '<option value="1">S</option>
                <option value="2">M</option>
                <option value="3">L</option>
                <option value="4">XL</option>
                <option value="5">2XL</option>
                <option value="6">Нет</option>';

    $option_m = '<option value="1">M</option>
                <option value="2">S</option>
                <option value="3">L</option>
                <option value="4">XL</option>
                <option value="5">2XL</option>
                <option value="6">Нет</option>';

    $option_l = '<option value="1">L</option>
                <option value="2">S</option>
                <option value="3">M</option>
                <option value="4">XL</option>
                <option value="5">2XL</option>
                <option value="6">Нет</option>';

    $option_xl = '<option value="1">XL</option>
                <option value="2">S</option>
                <option value="3">M</option>
                <option value="4">L</option>
                <option value="5">2XL</option>
                <option value="6">Нет</option>';

    $option_2xl = '<option value="1">2XL</option>
                    <option value="2">S</option>
                    <option value="3">M</option>
                    <option value="4">L</option>
                    <option value="5">XL</option>
                    <option value="6">Нет</option>';

    $option_proportion_none = '<option value="1">Нет</option>
                <option value="2">S</option>
                <option value="3">N</option>
                <option value="4">L</option>
                <option value="5">XL</option>
                <option value="6">2XL</option>';

//    if(empty($_FILES['image']['size']))  die('Вы не выбрали файл');
//    if($_FILES['image']['size'] > (10 * 1024 * 1024)) die('Размер файла не должен превышать 10Мб');
//    $imageinfo = getimagesize($_FILES['image']['tmp_name']);
//    $arr = array('image/jpeg','image/gif','image/png'); // массив допустимых форматов
//    if(!in_array($imageinfo['mime'],$arr)) {
//        echo ('Картинка должна быть формата JPG, GIF или PNG');
//    } else {
//        $upload_dir = 'img/'; //имя папки с картинками
//        $name = $upload_dir.date('YmdHis').rand(100,1000).'.png'; // переименовываем файл чтоб исключить повторы имен
//        $mov = move_uploaded_file($_FILES['image']['tmp_name'],$name); // перемещаем файл
//        if($mov) {
//            mysqli_query($link, "INSERT INTO `table_name` (`title`, `meta_d`, `meta_kw`, `text`, `image`) VALUES ('".$title."', '".$meta_d."', '".$meta_kw."', '".$text."', '".$name."')");
//        } else {
//                echo 'Произошла ошибка при загрузке фотографии. Пожалуйста, попробуйте снова';
//        }
//    }

?>
