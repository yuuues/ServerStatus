<?php
    require_once './vendor/autoload.php';
    require_once "./admin/lib/_autoload.php";
    include('./config/ky-config.php');

    $Server = new Servers($dbo->db);
    // Inizialise current Server
    $Server->getServers();

    $sJavascript = '<script type="text/javascript">
		function uptime() {
			$(function() {';
    $sTable = '';
    Foreach ($Server->servers as $result) {
        $sJavascript .= '$.getJSON("pull/index.php?url='.$result["id"].'",function(result){
            $("#online'.$result["id"].'").html(result.online);
            $("#uptime'.$result["id"].'").html(result.uptime);
            $("#load'.$result["id"].'").html(result.load);
            $("#memory'.$result["id"].'").html(result.memory);
            $("#hdd'.$result["id"].'").html(result.hdd);
            $("#network'.$result["id"].'").html(result.network);
	});';
        $sTable .= '
		<tr>
			<td id="online'.$result["id"].'">
				<div class="progress">
					<div class="bar bar-danger" style="width: 100%;"><small>Down</small></div>
				</div>
			</td>
			<td>'.$result["name"].'</td>
			<td>'.$result["type"].'</td>
			<td>'.$result["host"].'</td>
			<td>'.$result["location"].'</td>
			<td id="uptime'.$result["id"].'">n/a</td>
			<td id="load'.$result["id"].'">n/a</td>
                        <td id="memory'.$result["id"].'">-</td>
			<td id="hdd'.$result["id"].'">-</td>
			<td class="network" id="network'.$result['id'].'">-</td>
		</tr>';
    }
    $sJavascript .= '});
	}

        var timer;
        function mynumber(){
            if (Number($("#timer").html()) == 0){
               $("#timer").html("'.($serverStatus['refresh'] / 1000).'");
               uptime();
            }
            $("#timer").html(Number($("#timer").html()) - 1);
        }
        function Reloader(){
            timer = setInterval(mynumber, 1000);
        }
        function clearReloader(){
            clearInterval(timer);
            Reloader();
            uptime();
            $("#timer").html("'.($serverStatus['refresh'] / 1000).'");
        }
        $(function(){

            $("#reload").click(function(){
                clearReloader();
            });
        });
        Reloader();
	</script>';

    include('view/index.php');
