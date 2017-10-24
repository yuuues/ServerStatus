<?php
    require_once './../vendor/autoload.php';
    require_once "./../admin/lib/_autoload.php";
    include('./../config/ky-config.php');

    $Server = new Servers($dbo->db);
    $serverUnknown = '<div class = "progress progress-striped active">
        <div class = "bar bar-info" style = "width: 100%;"><small>Unknwon</small></div>
    </div>';
    $systemDown = '<div class="progress"><div class="bar bar-danger" style="width: 100%;"><small>Down</small></div></div>';

    function get_data($url)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    if (is_numeric($_GET['url'])) {
        $Server->getServers($_GET['url']);
        $result = $Server->servers[0];

        $url = $result['url']."/uptime.php";
        $output = get_data($url);
        if (($output == NULL) || ($output === false)) {
            $array = array();
            $array['uptime'] = $systemDown;
            $array['load'] = $systemDown;
            $array['online'] = $systemDown;
            $array['network'] = $systemDown;

            echo json_encode($array);
        } else {
            $data = json_decode($output, true);
            $data['uptime'] = ($data['uptime'] == "0:0:0") ? $serverUnknown : $data['uptime'];
            $data['load'] = ($data['load'] == "0.00") ? $serverUnknown : $data['load'];

            if (0 == $memory = $data['memory']) {
                $memlevel = null;
            } elseif ($memory >= 51) {
                $memlevel = "success";
            } elseif ($memory <= 50) {
                $memlevel = "warning";
            } elseif ($memory <= 35) {
                $memlevel = "danger";
            }

            $data['memory'] = (!is_null($memlevel)) ? '<div class="progress progress-striped active">
<div class="bar bar-'.$memlevel.'" style="width: '.$memory.'%;">'.$memory.'%</div> </div>'
                    : $serverUnknown;

            if (0 == $hdd = $data['hdd']) {
                $hddlevel = null;
            } elseif ($hdd >= 51) {
                $hddlevel = "success";
            } elseif ($hdd <= 50) {
                $hddlevel = "warning";
            } elseif ($hdd <= 35) {
                $hddlevel = "danger";
            }
            $data['hdd'] = (!is_null($hddlevel)) ? '<div class="progress progress-striped active">
<div class="bar bar-'.$hddlevel.'" style="width: '.$hdd.'%;">'.$hdd.'%</div></div>'
                    : $serverUnknown;

            $data["load"] = number_format($data["load"], 2);
            $data['online'] = '<div class = "progress">
            <div class = "bar bar-success" style = "width: 100%;"><small>Up</small></div>
            </div>';
            $data['network'] = ($data['network']['tt'] <> -1) ? 'rx: '. $data['network']['rx'] .' | tx: '.$data['network']['tx'] : $serverUnknown;
            echo json_encode($data);
        }
    }