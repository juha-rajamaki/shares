<?php

	ini_set('display_errors', 0);
	error_reporting(E_NOTICE);
	ini_alter('date.timezone','Europe/Helsinki');

        $filename        = $argv[1];
	$knock 		 = $argv[2];

	$myfile = fopen("watchdog-daily/$filename", "w") or die("Unable to open file!");
	$txt = "<?php\n";
        $txt .= '$title          = '; $txt .= "'"; $txt .= "$filename"; $txt .= "';\n";
	$txt .= '$knock          = '; $txt .= "'"; $txt .= "$knock"; $txt .= "';\n";
        $txt .= '$url          	= '; $txt .= "'"; $txt .= "http://www.netfondsbank.fi/quotes/ppaper.php?paper=$filename.NGM"; $txt .= "';\n";
        $txt .= '$engine         = '; $txt .= "'"; $txt .= "2"; $txt .= "';\n";
        $txt .= '$my_price       = '; $txt .= "'"; $txt .= ""; $txt .= "';\n";

	fwrite($myfile, $txt);
	fclose($myfile);
