<?php

$selfDir = dirname(__FILE__);
require_once $selfDir . '/config.php';

$operationIdentity = (string) filter_var($_GET['operation_identity'], FILTER_SANITIZE_STRING);
$token = filterAccessToken($_GET['access_token']);

try {
    $headers = array('Accept: application/json', 'Authorization: Bearer ' . $token);
    $response = remoteRequest($apiDomen . 'pull_updates/getStatusPartGenerationJson?operation_identity=' . $operationIdentity, true, false, $headers);
    if (!$response->curlHasError) {
        if ($response->code == 200) {
            $resultBody = array(
                'success' => true,
                'status' => $response->responseBody->status,
                'forward_code' => 200,
            );
        } else {
            $resultBody = array(
                'success' => false,
                'forward_code' => $response->code,
                'message' => !empty($response->responseBody->message ) ? $response->responseBody->message : 'неизвестная ошибка'
            );
        }
    }else {
        throw new RuntimeException('CURL ' . $response->curlErrorTxt);
    }
} catch (Exception $ex) {
    setResponseCode(!empty($response->code) ? $response->code : 500 );
    $resultBody = array('success' => false, 'forward_code' => 500, 'message' => $ex->getMessage());
}

loadHeaders();
setResponseCode(200);
echo json_encode($resultBody);