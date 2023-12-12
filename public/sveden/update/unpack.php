<?php
    $selfDir = dirname(__FILE__);
    require_once $selfDir . '/config.php';

    $version = filterVersion($_GET['version']);
    $fileName = $selfDir.  '/update-' . $version . '.zip';
    $resultBody = array('success' => true, 'forward_code' => 200,  'message' => 'Скрипты обновления успешно обновлены');

    if (file_exists($fileName)) {
        try {
            $res = unpackZip($fileName,  $selfDir . '/'. './../../');
            if (!$res['success']) {
                $resultBody = array('success' => false, 'forward_code' => 500, 'message' => $res['message']);
            }
        } catch (Exception $e) {
            $resultBody = array(
                'success' => false,
                'forward_code' => 500,
                'message' => 'Ошибка при распаковке скриптов обновления' . $e->getMessage()
            );
        }
    } else {
        $resultBody = array(
            'success' => false,
            'forward_code' => 500,
            'message' => 'Не найден файл ' . $fileName . ' для распаковки'
        );
    }

loadHeaders();
setResponseCode(200);
echo json_encode($resultBody);