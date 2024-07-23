<?php
require_once '../config/connect.php';
session_start();

session_unset();
session_destroy();



header("Location: http://setshly/php/Index/index.php");
exit;


?>