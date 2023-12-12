<?php
$selfDir = dirname(__FILE__);
require_once $selfDir . '/config.php';
include($selfDir . '/read_settings.php');

$res['success'] = false;
$token = filterAccessToken($_GET['access_token']);
$startFiles = filterInt($_GET['startFiles']);
$filesForPart = filterInt($_GET['filesForPart']);
try {
    $data = getRemoteData($filemanagerApiDomen . 'sync/createPackFiles?files_for_part=' . $filesForPart . '&token=' . $token);
    include('pack_files.php');
} catch (Exception $e) {
    $res['message'] = 'Ошибка при получении списка файлов. ' . $e->getMessage();
}
loadHeaders();
echo json_encode($res);