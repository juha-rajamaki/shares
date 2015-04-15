<?php
	$watchlist = $argv[10];

var_dump($watchlist);
die('asd');

        foreach($watchlist as $item):

                $share = $item['SHARE'];
		// print_r($share);

		require_once("./"."$share");

		print_r($title);
		print_r($url);

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
//      curl_setopt($curl, CURLOPT_SSLVERSION, 3);

        $data = curl_exec($curl);

        preg_match_all('#<tr[^>]*>(.*?)</tr>#s', $data, $matches);
        preg_match_all('/([0-9]+\.[0-9]+)/', $matches[0][14], $matches);


        endforeach;
