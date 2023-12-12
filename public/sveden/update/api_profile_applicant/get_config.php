<?php
$selfDir = dirname(__FILE__);
require_once $selfDir . '/../config.php';

$response = array(
    'client_id' => $clientId,
    'vuz_id' => $vuzId,
    'api_domain_auth' => $apiDomainAuth,
    'api_domain_vikon' => $apiDomen,
    'api_domain_filemanager' => $filemanagerApiDomen,
    'vuz_name' => $vuzName,
);
loadHeaders();
echo json_encode($response);