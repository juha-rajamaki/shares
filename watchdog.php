<?php

/*	WatchDog program for timing your buy's and sell's	*/

	ini_alter('date.timezone','Europe/Helsinki');
	exec('reset');
	require_once('watchdog.conf.example');
// 	print_r($watchlist);



/*
	foreach($watchlist as $item):

		print_r($item['SHARE']);

	endforeach;
*/



	$argv[10] = $watchlist[0]['SHARE'];
	require_once('app/getdata.php');


die('WatchDog!');
