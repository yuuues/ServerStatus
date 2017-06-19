<?php
    $db['host'] = 'localhost';
    $db['user'] = 'jeffrey';
    $db['pass'] = '1234';
    $db['data'] = 't_ServerStatus';

    mysql_connect($db['host'], $db['user'], $db['pass']) or die(mysql_error());
    mysql_select_db($db['data']) or die(mysql_error());

    $serverStatus = array(
        'version' => '1.1.1',
        'refresh' => 10000,
        // Available: "default" & "dark"
        'template' => 'default'
    );


    $index = "./templates/".$serverStatus['template']."/index.php";
?>