<?php

$selfDir = dirname(__FILE__);
require_once $selfDir . '/config.php';

$dlHandler = null;
$token = filterAccessToken($_POST['access_token']);
$operationIdentity =  (string) filter_var($_POST['operation_identity'], FILTER_SANITIZE_STRING);
$part = filterPartName($_POST['part']);

try {
    $headers = array(
        'Authorization: Bearer ' . $token,
        'Accept-Encoding: zip, gzip'
    );

    $response = remoteRequest(
        $apiDomen . 'pull_updates/downloadPartResult?operation_identity=' . $operationIdentity . '&part=' . $part,
        false,
        false,
        $headers
    );

    if (!$response->curlHasError) {
        if ($response->code == 200) {
            $filename = $selfDir . '/' . $operationIdentity . '.zip';
            $dlHandler = fopen($filename, 'w');
            if (!fwrite($dlHandler, $response->responseBody) ) {
               throw new RuntimeException('Не удается записать архив на диск');
            }

            $unpackTmpPath = $selfDir . '/../update_tmp/';
            if (!file_exists($unpackTmpPath)) {
                mkdir($unpackTmpPath, 0775);
            }
            if ($part === 'abitur') {
                $unpackPath = $unpackTmpPath;
            } else {
                $unpackPath = $selfDir . '/../';
            }

            $resUnpack = unpackZipWithReplaceFolder($filename, $unpackPath, $selfDir, $part);
            if (!$resUnpack['success']) {
                throw new RuntimeException('Не удалось распаковать архив раздела ' . $part . '.');
            }

            if ($part === 'abitur') {
                $abiturPath = $selfDir . '/../../abitur';
                if (!file_exists($abiturPath)) {
                    mkdir($abiturPath, 0775);
                } else {
                    $removeAbiturFiles = explode(';', $removeAbiturFiles);
                    foreach ($removeAbiturFiles as $file) {
                        $filePath = $abiturPath . '/' . $file;
                        if (file_exists($filePath)) {
                            if (is_dir($filePath)) {
                                removeDirectory($filePath);
                            } else {
                                unlink($filePath);
                            }
                        }
                    }
                }
                copyDirectory($unpackPath . 'abitur', $abiturPath);
            }
            $resultBody = array('success' => true, 'forward_code' => 200, 'message' => 'Раздел ' . $part . ' успешно обновлен.');
        } else {
            $response->responseBody = json_decode($response->responseBody);

            $resultBody = array(
                'success' => false,
                'forward_code' => $response->code,
                'message' => !empty($response->responseBody->message ) ? $response->responseBody->message : 'неизвестная ошибка'
            );
        }
    } else {
        throw new RuntimeException('CURL ' . $response->curlErrorTxt);
    }
} catch (Exception $ex) {
    $resultBody = array('success' => false, 'forward_code' => 500, 'message' => $ex->getMessage());
}

if($dlHandler != null){
    fclose($dlHandler);
}

clearZip();
loadHeaders();
setResponseCode(200);
echo json_encode($resultBody);
