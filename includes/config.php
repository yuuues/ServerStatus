<?php
    $host = 'localhost';
    $user = 'jeffrey';
    $pass = '1234';
    $data = 't_ServerStatus';
    $sSetting['refresh'] = "10000"; // 10 sec

    mysql_connect($host, $user, $pass) or die(mysql_error());
    mysql_select_db($data) or die(mysql_error());

    // Available: "default" & "dark"
    $template = "default";
    $index = "./templates/".$template."/index.php";
?>