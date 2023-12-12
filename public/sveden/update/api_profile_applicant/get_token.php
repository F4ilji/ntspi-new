<?php
$selfDir = dirname(__FILE__);
require_once $selfDir . '/../config.php';

$login = filterLogin($_POST['login']);
$password = filterPassword($_POST['password']);
$code = filterInt($_POST['code']);

$res = array();
try {
    $postFields = array(
        'grant_type' => 'password',
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'username' => $login,
        'password' => $password,
        'code' => $code,
        'scope' => '',
    );
    $data = getRemoteData($apiDomainAuth . 'oauth/token', null, true, $postFields);
    if ($data->success) {
        setResponseCode($data->code);
        $res = $data->info;
    } else {
        throw new Exception('Не удалось соединиться с удаленным сервером.', 522);
    }
} catch (Exception $e) {
    setResponseCode($e->getCode());
    $res['error'] = 'Ошибка при получении токена. ' . $e->getMessage();
}
loadHeaders();
echo json_encode($res);
