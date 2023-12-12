<?php
$selfDir = dirname(__FILE__);
require_once $selfDir .'/config.php';

$resultBody = array('success' => true, 'forward_code' => 200, 'message' => 'Временные файлы успешно удалены.');

$clearZip = clearZip();
removeDirectory($selfDir . '/../update_tmp/');

if ($clearZip === false) {
    $resultBody = array('success' => true, 'forward_code' => 500, 'message' => 'При удалении временных файлов произошла ошибка.');
}

loadHeaders();
setResponseCode(200);
echo json_encode($resultBody);