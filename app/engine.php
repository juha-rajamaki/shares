<?php

ini_alter('date.timezone','Europe/Helsinki');
exec('reset');

$wait 				= 10;
$has_changed 			= 0;
$has_changed_plus		= 0;
$has_changed_negative		= 0;
$now 				= date('d.m.Y H:i:s');
$text 				= 1;

echo "Run start @ ".$now."";
echo "\n\nLegend: ";
echo "".chr(27) . "[42m" ."TODAY HIGHEST". chr(27) . "[0m"." ";
echo "".chr(27) . "[44m" ."HIGH". chr(27) . "[0m"." ";
echo "".chr(27) . "[40m" ."NO CHANGE". chr(27) . "[0m"." ";
echo "".chr(27) . "[43m" ."LOW". chr(27) . "[0m"." ";
echo "".chr(27) . "[41m" ."TODAY LOWEST". chr(27) . "[0m"."\n\n";

for ($x = 0; $x <= 10000; $x++) {

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
//	curl_setopt($curl, CURLOPT_SSLVERSION, 3);

	$data = curl_exec($curl);
	$data = str_replace(' ', '', $data);

	preg_match_all('#<tr[^>]*>(.*?)</tr>#s', $data, $matches);
        preg_match_all('/([0-9]+\.[0-9]+)/', $matches[0][14], $matches);

	if(count($matches[0]) <= 4) { die("Nordic Growth Market open times : http://www.ngm.se/handel-2/?lang=en\n\n"); exit; }

	$today_start    = $matches[0][7];
	$current 	= $matches[0][0];
	$today_lowest 	= $matches[0][9];
	$today_highest	= $matches[0][8];
	$today_average 	= ($today_lowest+$today_highest)/2;
	$volatility 	= round(($today_highest/$today_lowest)*100-100, 2);

	curl_close($curl);

	if($text != 0) {
        	$text           = "Today Start: $today_start \nToday Lowest: $today_lowest \nToday Highest: $today_highest \nToday Average: $today_average \nCurrent: $current\nVolatility: $volatility% \n";
        	echo $text;
        	echo "\n$title ($url) - kehitys :\n\n";
        	$text = 0;
	}

	// Test if web page available
        if(count($matches[0]) <= 4) { die("Nordic Growth Market open times : http://www.ngm.se/handel-2/?lang=en\n\n"); exit; }

	// NO CHANGE
	if($current == $today_start) {
		$out = "[40m";
	} elseif ($current > $today_start) {

                // IF HIGHEST TODAY
                if($current == $today_highest) {
                        $out = "[42m";
                } else { // HIGH
                        $out = "[44m"; // GREEN
                }

	} elseif ($current < $today_start) {

        	// IF LOWEST TODAY
        	if($current == $today_lowest) {
        	        $out = "[41m";
	        } else {
                	// IF LOW
        	        $out = "[43m"; // RED
	        }


	} else {

	}

if($has_changed == 0) { $has_changed = $current; }

if($current != $has_changed)  {

	// On Plus side
	if($has_changed > $today_start) {

        	$pre = round($current / $today_start * 100 - 100, 2);

	// On Negative side
	} elseif($has_changed < $today_start) {

                $pre = round($current / $today_start * 100 - 100, 2);

	} else {
	// No change

	        $pre = "0.00";

	}

	if($current > $has_changed) {

                // GOING UP
		$has_changed_plus++;
		$has_changed_negative = 0;
                $last_change = round($current / $has_changed * 100 - 100, 2);
                $pre = "".chr(27) . "[1;32m" ."+$last_change%:$has_changed_plus". chr(27) . "[0m"." ($pre%) ";

	} else {

		// GOING DOWN
		$has_changed_negative++;
		$has_changed_plus = 0;
                $last_change = round($current / $has_changed * 100 - 100, 2);
                $pre = "".chr(27) . "[1;33m" ."$last_change%:$has_changed_plus". chr(27) . "[0m"." ($pre%) ";

	}

        $has_changed = $current;

	// Show Direction %
	echo $pre;

}

echo "".chr(27) . "$out" ."$current". chr(27) . "[0m"." ";

sleep ($wait);

} //for
