<?php
    error_reporting(-1);

    define('DEBUG_MODE', true) or die();
    define('ADMIN_DIR', dirname($_SERVER['REQUEST_URI'])) or die();
    define('API_DIR', dirname($_SERVER['REQUEST_URI']) .'/api/apu.php');
    require_once '../vendor/autoload.php';
    require_once "lib/_autoload.php";
    require_once "../config/ky-config.php";

    // Verificamos si tiene sesión iniciada. En caso contrario enviamos al login
    if (!$dbo->AuthClass->checkSession($cookies['Auth'])) {
        $page = 'login';
        $logged = false;
    } else {
        $page = ((isset($_GET['page'])) ? $_GET['page'] : '');
        $logged = true;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>KCSystem | Administrador de Servicios</title>
        <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="dist/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="../vendor/components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="../vendor/components/jquery/jquery.min.js"></script>
        <script src="../vendor/components/jquery-cookie/jquery.cookie.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <?php
                include 'layouts/main.php';
                include 'layouts/sidebar.php';

                switch ($page) {
                    case 'logout':
                        $dbo->AuthClass->logout($cookies['Auth']);
                        echo '<script>window.location = "index.php" </script>';
                        break;
                    default:
                        if (!@include_once"pages/".$page.".php") {
                            include_once "pages/index.php";
                        }
                        break;
                }
            ?>
        </div>
        <div class="container">
            <p style="text-align: center; font-size: 10px;">KCSystem <a href="https://github.com/Kytoh/ServerStatus">ServerStatus <?php echo $serverStatus['version']; ?></a></p>
        </div>

        <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<!--        <script src="dist/js/sb-admin-2.js"></script>-->
    </body>
</html>

