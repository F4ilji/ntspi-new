<?php
$selfDir = dirname(__FILE__);
require_once $selfDir . '/config.php';

$res['success'] = false;
$token = filterAccessToken($_GET['access_token']);
try {
    $existingFiles = scandir($selfDir . '/../files');
    if (is_array($existingFiles)) {
        $data = getRemoteData($filemanagerApiDomen . 'sync/getFilesForSync?token=' . $token);
        if ($data->success) {
            if ($data->info->success) {
                if ($files = $data->info->files) {
                    foreach ($existingFiles as $key => $file) {
                        if (!in_array($file, $files) && $file != '.' && $file != '..') {
                            $filePath = $selfDir . '/../files/' . $file;
                            if (is_dir($filePath)) {
                                removeDirectory($filePath);
                            } else {
                                unlink($filePath);
                            }
                        } else {
                            if (filesize($selfDir . '/../files/' . $file) <= 0) {
                                unset($existingFiles[$key]);
                            }
                        }
                    }
                    $filesForSync = array();
                    foreach ($files as $file) {
                        if (!in_array($file, $existingFiles)) {
                            $filesForSync[] = $file;
                        }
                    }
                    $res['success'] = true;
                    $res['message'] = count($filesForSync) > 0
                        ? 'Получен список недостающих файлов.'
                        : 'Недостающих файлов не обнаружено.';
                    $res['files'] = $filesForSync;
                } else {
                    $res['success'] = true;
                    $res['files'] = array();
                    $res['Список всех файлов пуст. Синхронизация отменена.'];
                }
            } else {
                $res['error'] = isset($data->info->error) ? $data->info->error : '';
                $res['message'] = 'Ошибка в получении списка всех файлов.';
            }
        } else {
            $res['message'] = 'Не удалось соединиться с файловым сервером.';
        }
    } else {
        $res['message'] = 'Не удалось просканировать существующие файлы.';
    }
} catch (Exception $e) {
    $res['message'] = 'Ошибка. ' . $e->getMessage();
}
loadHeaders();
echo json_encode($res);

