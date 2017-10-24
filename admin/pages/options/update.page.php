<script>
    var gitHubPath = 'Kytoh/ServerStatus';  // example repo
    var url = 'https://api.github.com/repos/' + gitHubPath + '/releases/latest';
    var currentVersion = 'v<?php echo $serverStatus['version'] ?>';

    $.get(url).done(function (data) {
        $("#checkingNewVersion").hide();
        latestVersion = data.tag_name;
        $("#latestVersion").html(latestVersion);
        if(latestVersion != currentVersion){
            $("#NewVersionAvailable").show();
            $("#NewVersionAvailable a").attr("href", data.browser_download_url);
        }else{
            $("#updated").show();
        }
    });</script>

<div id="page-wrapper">
    <div class="row">
        <br/>
        <div class="alert alert-primary" id="checkingNewVersion">Comprobando si hay nuevas versiones...</div>
        <div class="alert alert-success" id="updated" style="display:none">Ya dispone de la ultima versi&oacute;n disponible</div>
        <div class="alert alert-warning" id="NewVersionAvailable" style="display:none">Hay disponible una nueva versi&oacute;n<br/>
            Ultima Versión Disponible: <a href=""><span id="latestVersion"></span></a><br/></div>
        <div class="alert alert-light">Versión Instalada: v<?php echo $serverStatus['version']; ?></div>
    </div>
</div>
