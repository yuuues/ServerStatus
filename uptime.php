<?php

    $network = false;

    function sec2human($time)
    {
        $seconds = $time % 60;
        $mins = floor($time / 60) % 60;
        $hours = floor($time / 60 / 60) % 24;
        $days = floor($time / 60 / 60 / 24);
        return $days > 0 ? $days.' day'.($days > 1 ? 's' : '') : $hours.':'.$mins.':'.$seconds;
    }
    $array = array();
    $fh = fopen('/proc/uptime', 'r');
    $uptime = fgets($fh);
    fclose($fh);
    $uptime = explode('.', $uptime, 2);
    $array['uptime'] = sec2human($uptime[0]);

    $fh = fopen('/proc/meminfo', 'r');
    $mem = 0;
    while ($line = fgets($fh)) {
        $pieces = array();
        if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
            $memtotal = $pieces[1];
        }
        if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
            $memfree = $pieces[1];
        }
        if (preg_match('/^Cached:\s+(\d+)\skB$/', $line, $pieces)) {
            $memcache = $pieces[1];
            break;
        }
    }
    fclose($fh);

    $memmath = $memcache + $memfree;
    $memmath2 = $memmath / $memtotal * 100;
    $array['memory'] = round($memmath2);

    $hddtotal = disk_total_space("/");
    $hddfree = disk_free_space("/");
    $hddmath = $hddfree / $hddtotal * 100;
    $array['hdd'] = round($hddmath);

    $load = sys_getloadavg();
    $array['load'] = $load[0];

    // Get the vnstat current network monitor
    $rx = str_replace("\n","", shell_exec('vnstat -i eth0 | grep "today" | awk \'{print $2" "substr ($3, 1, 1)}\''));
    $tx = str_replace("\n","", shell_exec('vnstat -i eth0 | grep "today" | awk \'{print $5" "substr ($6, 1, 1)}\''));
    $tt = str_replace("\n","", shell_exec('vnstat -i eth0 | grep "today" | awk \'{print $8" "substr ($9, 1, 1)}\''));
    $array['network'] = array('rx' => !empty($rx) ? $rx : '-1', 'tx' => !empty($tx) ? $tx : '-1', 'tt' => !empty($tt) ? $tt : '-1');
    echo json_encode($array);
