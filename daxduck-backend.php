<?php
// Juha's Hack. :-D
ini_alter('date.timezone','Europe/Helsinki');

$today = date('Y-m-d');

$filename = "tmp/$today-dax.log";

if (isset($_GET['data'])) {
    $data = null;

    if ($_GET['data'] === 'short') {
        $data = shell_exec("tail -n301 $filename");
    } else if ($_GET['data'] === 'long') {
        $data = file_get_contents($filename);
    }

    renderJson($data);
}

require_once('long-n-short-charts.html');

die;

function renderJson($output)
{
    header('Content-Type: application/json');

    echo json_encode(explode("\n", $output));

    die;
}
