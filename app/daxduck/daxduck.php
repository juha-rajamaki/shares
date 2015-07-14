<?php

/*

        DaxDuck program getting DAX in real time
        Written by borre 2015
        Open Source - please free to use, share and contribute.

*/

ini_set('display_errors', 1);
error_reporting(E_NOTICE);
ini_alter('date.timezone','Europe/Helsinki');

$url = "http://www.finanzen100.de/index/db-dax_H128378787_14207349/";

// Loop forever
while (true) {

    // Loop for 12 h max
    for ($x = 0; $x <= 43200; $x++) {

	require("daxduck.conf");

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $data = curl_exec($curl);

        // Clean up the white spaces from data for better matching
        $data = str_replace(" ", "", $data);

        // find rows from data
        preg_match_all('#<tr[^>]*>(.*?)</tr>#s', $data, $matches);

        // Get Decimals
        preg_match_all('/([0-9]+\.[0-9]+)/', $matches[1][1], $matches);

        $dax_now = $matches[0][0];
        $dax_now = str_replace(".", "", $dax_now);

	if($dax_now) { $position = $dax_now-$today_start; }

        $positionStr = "" . $position . "\n";

	$now = date('d.m.Y H:i:s');
        echo "".$x." [".$now."]     ".$positionStr."";

        $today = date('Y-m-d');

        file_put_contents("../../tmp/$today-dax.log", $positionStr, FILE_APPEND);

        sleep(1);

    }
}

