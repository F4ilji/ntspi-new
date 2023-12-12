<?php

//частично переписанно. Для того чтобы можно было переписать js

$selfDir = dirname(__FILE__);
require_once $selfDir . '/config.php';
$token = filterAccessToken($_GET['access_token']);

$dlHandler = null;

try {
    $versionResp = remoteRequest($apiDomen . 'update/version?&d=' . $domenName . '&access_token=' . $token);

    if ($versionResp->curlHasError) {
        throw new RuntimeException('CURL ' . $versionResp->curlErrorTxt);
    }

    if ($versionResp->code != 200) {
        $resultBody = array(
            'success' => false,
            'forward_code' => $versionResp->code,
            'message' =>  'Не удается получить новую версию. ' . (!empty($versionResp->responseBody->message ) ? $versionResp->responseBody->message : 'Неизвестная ошибка')
        );
        loadHeaders();
        setResponseCode(200);
        echo json_encode($resultBody);
        die();
    }
    $serverVersion = $versionResp->responseBody->version;
    $createZipResp = remoteRequest($apiDomen . 'update/get?&d=' . $domenName . '&access_token=' . $token);

    if ($createZipResp->curlHasError) {
        throw new RuntimeException('CURL ' . $createZipResp->curlErrorTxt);
    }
    if ($createZipResp->code != 200) {
        $resultBody = array(
            'success' => false,
            'forward_code' => $createZipResp->code,
            'message' =>  'Не удается сформировать архив с обновлениями. ' . (!empty($createZipResp->responseBody->message ) ? $createZipResp->responseBody->message : 'Неизвестная ошибка')
        );
        loadHeaders();
        setResponseCode(200);
        echo json_encode($resultBody);
        die();
    }

    $headers = array(
        'Accept-Encoding: zip, gzip',
        'Authorization: Bearer ' . $token
    );
    $zip = remoteRequest($createZipResp->responseBody->link . '?&d=' . $domenName . '&access_token=' . $token, false, false, $headers);
    if ($zip->curlHasError) {
        throw new RuntimeException('CURL ' . $zip->curlErrorTxt);
    }

    if ($zip->code != 200) {
        $zip->responseBody = json_decode($zip->responseBody);

        $resultBody = array(
            'success' => false,
            'forward_code' => $zip->code,
            'message' => 'Не удается скачать файл с обновлениями. ' . (!empty($zip->responseBody->message ) ? $zip->responseBody->message : 'Неизвестная ошибка')
        );

        loadHeaders();
        setResponseCode(200);
        echo json_encode($resultBody);
        die();
    }

    $filename = $selfDir . '/update-' . $serverVersion . '.zip';
    $dlHandler = fopen($filename, 'w');
    if (!fwrite($dlHandler, $zip->responseBody)) {
        throw new RuntimeException('Не удается записать архив на диск' , 500);
    }

    $resultBody = array(
        'success' => true,
        'forward_code' => 200,
        'version' => $serverVersion,
        'message' => 'Архив с базовыми обновлениями успешно загружен.'
    );

} catch (Exception $ex) {
    $resultBody = array('success' => false, 'forward_code' => 500, 'message' => $ex->getMessage());
}

if ($dlHandler) {
    fclose($dlHandler);
}

loadHeaders();
setResponseCode(200);
echo json_encode($resultBody);
