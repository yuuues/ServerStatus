<script src="admin/js/semver-github.min.js"></script>
<p>Ultima versión disponbile: <span id="result"></span></p>
Versión Actuall: <= $serverStatus['version']?>
var gitHubPath = 'Kytoh/ServerStatus';  // example repo
var url = 'https://api.github.com/repos/' + gitHubPath + '/tags';

$.get(url).done(function (data) {
var versions = data.sort(function (v1, v2) {
    return semver.compare(v2.name, v1.name)
});
$('#result').html(versions[0].name);
});