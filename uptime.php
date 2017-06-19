<?php

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
    echo json_encode($array);
