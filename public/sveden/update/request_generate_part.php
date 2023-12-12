<?php

$selfDir = dirname(__FILE__);
require_once $selfDir . '/config.php';

$token = filterAccessToken($_POST['access_token']);
$part = filterPartName($_POST['part']);

try {
    $headers = array(
        'Accept: application/json',
        'Authorization: Bearer ' . $token,
    );

    $post = array('part' => $part);
    $response = remoteRequest($apiDomen . 'pull_updates/generatePartJson', true, $post, $headers);
    if (!$response->curlHasError) {
        if ($response->code == 200) {
            $resultBody = array(
                'success' => true,
                'operation_identity' => $response->responseBody->operation_identity,
                'ttl' => $response->responseBody->ttl,
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