<?php
$selfDir = dirname(__FILE__);
require_once $selfDir . '/config.php';

$res['success'] = false;
$refreshToken = filterAccessToken($_POST['refresh_token']);
try {
    $headers = array('Accept: application/json');
    $data = getRemoteData($apiDomen . 'oauth2/RefreshToken', null, true, array(
        'refresh_token' => $refreshToken,
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'grant_type' => 'refresh_token',
    ), $headers);
    if ($data->success) {
        if (isset($data->info->access_token)) {
            $res['access_token'] = $data->info->access_token;
            $res['refresh_token'] = $data->info->refresh_token;
            $res['success'] = true;
        } else {
            $res['message'] = $data->info->message;
            setResponseCode($data->code);
        }
    } else {
        $res['message'] = 'Не удалось соединиться с сервером.';
        setResponseCode($data->code);
    }

} catch (Exception $e) {
    $res['message'] = 'Ошибка при обновлении ключа. ' . $e->getMessage();
    setResponseCode(500);
}
loadHeaders();
echo json_encode($res);

