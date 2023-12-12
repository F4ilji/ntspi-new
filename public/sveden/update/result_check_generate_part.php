<?php

$selfDir = dirname(__FILE__);
require_once $selfDir . '/config.php';

$token = filterAccessToken($_POST['access_token']);
$operationIdentity =  (string) filter_var($_POST['operation_identity'], FILTER_SANITIZE_STRING);
$part = filterPartName($_POST['part']);

try {
    $headers = array(
        'Accept: application/json',
        'Authorization: Bearer ' . $token,
    );

    $response = remoteRequest(
        $apiDomen . 'pull_updates/checkPartGenerationResultJson?operation_identity=' . $operationIdentity . '&part=' . $part,
        true,
        false,
        $headers
    );
    if (!$response->curlHasError) {
        if ($response->code == 200) {
            $resultBody = array(
                'success' => true,
                'forward_code' => 200,
            );
        } else {
            $resultBody = array(
                'success' => false,
                'forward_code' => $response->code,
                'message' => !empty($response->responseBody->message ) ? $response->responseBody->message : 'Неизвестная ошибка'
            );
        }
    } else {
        throw new RuntimeException('CURL ' . $response->curlErrorTxt);
    }
} catch (Exception $ex) {
    $resultBody = array('success' => false, 'forward_code' => 500, 'message' => $ex->getMessage());
}

loadHeaders();
setResponseCode(200);
echo json_encode($resultBody);