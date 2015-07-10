<?php
        ini_alter('date.timezone','Europe/Helsinki');
$today = date('Y-m-d');

$filename = "/tmp/$today-dax.log";

if (isset($_GET['page']) && $_GET['page'] === 'index') {
    require_once('perkele.html');
    die;
}

if (isset($_GET['data'])) {
    json(shell_exec("tail -n301 $filename"));
}

json(file_get_contents($filename));

function json($output)
{
    header('Content-Type: application/json');

    echo json_encode(explode("\n", $output));

    die;
}
