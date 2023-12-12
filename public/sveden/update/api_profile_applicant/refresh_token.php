<?php
$selfDir = dirname(__FILE__);
require_once $selfDir . '/../config.php';

$refreshToken = filterAccessToken($_POST['refresh_token']);

$res = array();
try {
    $postFields = array(
        'grant_type' => 'refresh_token',
        'refresh_token' => $refreshToken,
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'scope' => '',
    );
    $data = getRemoteData($apiDomainAuth . 'oauth/token', null, true, $postFields);
    if ($data->success) {
        $res = $data->info;
    } else {
        throw new Exception('Не удалось соединиться с удаленным сервером.', 522);
    }
} catch (Exception $e) {
    setResponseCode($e->getCode());
    $res['error'] = 'Ошибка при обновлении токена. ' . $e->getMessage();
}
loadHeaders();
echo json_encode($res);
