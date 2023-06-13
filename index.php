<?php
session_start();
header("Content-Type:text/html;charset=UTF-8");

require_once ("config.php");
require_once ("classes/Acore.php");
require_once ("classes/AcoreAdmin.php");

if(isset($_GET['option'])):
    $class = trim(strip_tags($_GET['option']));
else:
    $class='Main';
endif;

if(file_exists("classes/".$class.".php")):
    include ("classes/".$class.".php");
    if(class_exists($class)):
        $obj = new $class;
        $obj -> get_body();
    else:
        exit("<p>Неправильный данные для входа!</p>");
    endif;
else:
    exit("<p>Неправильный адрес</p>");
endif;