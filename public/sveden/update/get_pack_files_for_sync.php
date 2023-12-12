<?php
$selfDir = dirname(__FILE__);
require_once $selfDir. '/config.php';

$res['success'] = false;
$files = isset($_POST['files']) ? $_POST['files'] : array();
if (count($files) > 0) {
    foreach ($files as &$file) {
        $file = filterFileName($file);
        $file = str_replace('+', '%2B', $file);
    }
    $files = json_encode($files);
    $token = filterAccessToken($_POST['access_token']);
    try {
        $requestParams = array(
            'token' => $token,
            'files' => $files,
        );
        $data = getRemoteData($filemanagerApiDomen . 'sync/getPackFilesForSync', null, true, $requestParams);
        include( $selfDir . '/pack_files.php');
    } catch (Exception $e) {
        $res['message'] = 'Ошибка при получении списка файлов. ' . $e->getMessage();
    }
} else {
    $res['success'] = true;
    $res['message'] = 'Не получен список файлов';
}
loadHeaders();
echo json_encode($res);