<!DOCTYPE html>
<html>
    <head>
        <title>KCSystem | Estado de Servicios</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        <link href="templates/<?php echo $serverStatus['template']; ?>/css/custom.css" rel="stylesheet">
        <style>
            body { padding-top: 60px; }
            @media (max-width: 979px) {
                body { padding-top: 0px; }
            }
        </style>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="#">Estado de Servicios</a>
                    <span class="brand right"><span id="timer">0</span> <span id="reload" class="lnr lnr-sync reload"></span></span>
                </div>
            </div>

        </div>

        <div class="container content">
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th id="status" style="text-align: center;">Status</th>
                        <th id="name">Name</th>
                        <th id="type">Type</th>
                        <th id="host">Host</th>
                        <th id="location">Location</th>
                        <th id="uptime">Uptime</th>
                        <th id="load">Load</th>
                        <th id="ram">RAM</th>
                        <th id="hdd">HDD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $sTable; ?>
                </tbody>
            </table>
        </div>

        <div class="container">
            <p style="text-align: center; font-size: 10px;">KCSystem <a href="">ServerStatus <?php echo $serverStatus['version']; ?></a></p>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
        <?php echo $GLOBALS['sJavascript']; ?>
    </body>
</html>
