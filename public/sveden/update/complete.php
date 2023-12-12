<?php
$selfDir = dirname(__FILE__);
require_once  $selfDir . '/config.php';

$res['success'] = false;

try {
    $headers = array(
        'Accept: application/json',
        'Authorization: Bearer ' . $token = filterAccessToken($_POST['access_token']),
    );

    $response = remoteRequest($apiDomen . 'pull_updates/assist/updateEndedSuccessJson', true, array(), $headers);
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
                'message' => !empty($response->responseBody->message )
                    ? $response->responseBody->message
                    : 'Неизвестная ошибка'
            );
        }
    } else {
        throw new RuntimeException( 'CURL ' . $response->curlErrorTxt);
    }
} catch (Exception $ex) {
    $resultBody = array('success' => false, 'forward_code' => 500, 'message' => $ex->getMessage());
}

loadHeaders();
setResponseCode(200);
echo json_encode($resultBody);
