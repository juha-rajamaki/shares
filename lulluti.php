<?php

        ini_alter('date.timezone','Europe/Helsinki');

if (isset($_GET['page']) && $_GET['page'] === 'index') {
    require_once('perkele.html');
    die;
}

$today = date('Y-m-d');

$output = file_get_contents("/tmp/$today-dax.log");

header('Content-Type: application/json');

echo json_encode(explode("\n", $output));
