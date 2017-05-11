<?php
    $host = 'localhost';
    $user = '';
    $pass = '';
    $data = 'status';
    $sSetting['refresh'] = "10000";

    mysql_connect($host, $user, $pass) or die(mysql_error());
    mysql_select_db($data) or die(mysql_error());

    $template = "./templates/default/";
    $index = $template."index.php";
?>

mys