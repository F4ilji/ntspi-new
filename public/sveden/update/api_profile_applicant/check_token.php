<?php
$selfDir = dirname(__FILE__);
require_once $selfDir . '/../config.php';

$accessToken = filterAccessToken($_POST['access_token']);

$res = array();
try {
    $headers = array('Accept: application/json', 'Authorization: Bearer ' . $accessToken);
    $data = getRemoteData($apiDomainAuth . 'api/profile_applicant/check_access_token', null, true, false, $headers);
    if ($data->success) {
        $res = $data->info;
    } else {
        throw new Exception('Не удалось соединиться с удаленным сервером.', 522);
    }
} catch (Exception $e) {
    setResponseCode($e->getCode());
    $res['error'] = 'Ошибка при проверке токена. ' . $e->getMessage();
}
loadHeaders();
echo json_encode($res);
