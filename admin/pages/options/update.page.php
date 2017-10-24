<script src="js/semver-github.min.js"></script>
<script>
    var gitHubPath = 'Kytoh/ServerStatus';  // example repo
    var url = 'https://api.github.com/repos/' + gitHubPath + '/tags';

    $.get(url).done(function (data) {
        var versions = data.sort(function (v1, v2) {
            return semver.compare(v2.name, v1.name)
        });
        $('#result').html(versions[0].name);
    });</script>
<div id="page-wrapper">
    <div class="row">
        Ultima versión disponbile: <span id="result"></span><br/>
        Versión Actuall: <?php echo $serverStatus['version']; ?>
    </div>
</div>
