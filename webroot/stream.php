<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');


function send($id, $msg) {

    echo "id: $id" . PHP_EOL;
    echo "data: $msg" . PHP_EOL;
    echo PHP_EOL;
    ob_flush();
    flush();
}

$id = (int)$_GET['id'];
$sql = "select status from stadium WHERE id = {$id}";
$db = new mysqli('localhost','gaskets','byxRAA8WpeSBDRm7','stadium');
$data = mysqli_fetch_assoc($db->query($sql));
$status = $data['status'];



$serverTime = time();
if($status == 2){
    send($serverTime, $status);
}



