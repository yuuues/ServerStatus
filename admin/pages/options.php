<?php
$app = (isset($_GET['app']) ? $_GET['app'] : 'main');

switch ($app) {
    default:
        if (!@include_once"options/".$app.".page.php") {
            include_once "options/index.page.php";
        }
        break;
}