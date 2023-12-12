<?php
$selfDir = dirname(__FILE__);
require_once $selfDir . '/config.php';

$optNameLengthMin = 2;
$optNameLengthMax = 255;
$optSubjectLengthMin = 2;
$optSubjectLengthMax = 255;
$optMessageLengthMin = 2;
$optMessageLengthMax = 1000;

$res['success'] = true;
$res['errorID'] = array();
$res['messages'] = array();

$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
$consent = filter_var($_POST['consent'], FILTER_SANITIZE_NUMBER_INT);

$lenName = mb_strlen($name);
if ($lenName < $optNameLengthMin || $lenName >= $optNameLengthMax) {
    $res['success'] = false;
    $res['messages'][] = 'Имя должно содержать от ' .
        $optNameLengthMin . ' до ' .
        $optNameLengthMax . ' символов.';
    $res['errorID'][] = 'name';
}
if (!$email) {
    $res['success'] = false;
    $res['messages'][] = 'Введен некорректный email.';
    $res['errorID'][] = 'email';
}
$lenSubject = mb_strlen($subject);
if ($lenSubject < $optSubjectLengthMin || $lenSubject >= $optSubjectLengthMax) {
    $res['success'] = false;
    $res['messages'][] = 'Тема сообщения должна содержать от ' .
        $optSubjectLengthMin . ' до ' .
        $optSubjectLengthMax . ' символов.';
    $res['errorID'][] = 'subject';
}
$lenMessage = mb_strlen($message);
if ($lenMessage < $optMessageLengthMin || $lenMessage >= $optMessageLengthMax) {
    $res['success'] = false;
    $res['messages'][] = 'Сообщение должно содержать от ' .
        $optMessageLengthMin . ' до ' .
        $optMessageLengthMax . ' символов.';
    $res['errorID'][] = 'message';
}
if($consent != true){
    $res['success'] = false;
    $res['messages'][] = 'Не получено согласие на обработку персональных данных.';
    $res['errorID'][] = 'consent';
}

$code = filter_var($_POST['captcha'], FILTER_SANITIZE_STRING);
session_start();
if (!isset($_SESSION['captcha']) || strtoupper(trim($_SESSION['captcha'])) != strtoupper(trim($code))) {
    $res['success'] = false;
    $res['errorID'][] = 'captcha';
    $res['messages'][] = 'Неверный код с картинки.';
}
unset($_SESSION['captcha']);

if ($res['success']) {
    $res['success'] = false;

    $headers = array('Accept: application/json');
    $data = getRemoteData($apiDomen . 'oauth2/ClientCredentials', null, true,
        array(
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'grant_type' => 'client_credentials',
            'scope' => 'feedback',
            ), $headers
    );

    if ($data->success) {
        if (isset($data->info->access_token)) {
            $accessToken = $data->info->access_token;

            try {
                $data = getRemoteData($apiDomen . 'update/feedbackSendMail?access_token=' . $accessToken . '&d=' . $domenName .
                    '&n=' . urlencode($name) .
                    '&e=' . urlencode($email) .
                    '&s=' . urlencode($subject) .
                    '&m=' . urlencode($message)
                );

                if ($data->info->success) {
                    $res['success'] = true;
                } else {
                    $res['message'] = $data->info->message;
                }

            } catch (Exception $e) {
                $res['message'] = 'Ошибка. '.$e->getMessage();
            }

            $res['success'] = true;
        } else {
            $res['message'] = 'Ошибка ' . $data->info->message;
        }
    } else {
        $res['message'] = $data->message;
    }
}

loadHeaders();

echo json_encode($res);
