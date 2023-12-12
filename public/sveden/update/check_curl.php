<?php

function isCurlExists()
{
    if (in_array('curl', get_loaded_extensions())) {
        return true;
    } else {
        return false;
    }
}

function checkCurl($url, $postFields = false)
{
    $error = '';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    if (is_array($postFields)) {
        curl_setopt($ch, CURLOPT_POST, true);
        $postVars = "";
        foreach ($postFields as $key => $value) {
            $postVars .= $key . '=' . $value . '&';
        }
        $postVars = rtrim($postVars, '&');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
    }
    curl_exec($ch);
    if (curl_errno($ch) > 0 || curl_error($ch)) {
        $error = 'Curl error code: ' . curl_errno($ch) . '. Error: ' . curl_error($ch);
    }
    curl_close($ch);
    return $error;
}

if (!isCurlExists()) {
    echo '<p class="alert alert-danger">
            На Вашем сервере отсутствует расширение PHP для работы с cURL.<br>
            Вам следует обратиться в службу технической поддержки Вашего хостинг-провайдера с просьбой 
            включить PHP расширение curl. 
        </p>';
} else {
    if (($err = checkCurl($apiDomen)) || ($err = checkCurl($apiDomen, array('post' => 42)))) {
        echo '<p class="alert alert-danger">
                В процессе тестирования соединения с сервером обновлений, PHP расширение cURL вернуло 
                следующую ошибку:<br> ' . $err .
            '</p>';
    }
}