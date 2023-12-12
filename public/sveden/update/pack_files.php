<?php
$selfDir = dirname(__FILE__);
if ($data->success) {
    if ($data->info->success) {
        if ($data->info->archiveName) {
            $opts = array(
                'http' => array(
                    'method' => "GET",
                    'header' => "Accept-language: ru\r\n" .
                        "Accept-Encoding: zip, gzip"
                )
            );
            $zip = getRemoteData($filemanagerApiDomen . 'file/archive/' . $data->info->archiveName . '?token=' . $token, $opts, false);
            if ($zip->success) {
                $fileName = $data->info->archiveName;
                $pathToFileCreateFile = $selfDir . '/' . $fileName;

                $dlHandler = fopen($pathToFileCreateFile, 'w');
                if (fwrite($dlHandler, $zip->info)) {
                    try {
                        $resUnpack = unpackZip($pathToFileCreateFile, $selfDir . "/../files/");
                        if ($resUnpack['success']) {
                            $res['success'] = true;
                            $res['message'] = 'Пакет файлов ' . $fileName . ' распакован.';
                            $clearArchive = getRemoteData($filemanagerApiDomen . 'file/removeArchive/' . $fileName . '?token=' . $token);
                        } else {
                            $res['message'] = $resUnpack['message'];
                        }
                    } catch (Exception $e) {
                        $res['message'] = 'Ошибка при распоковке пакета файлов ' . $fileName . ' ' . $e->getMessage();
                    }
                } else {
                    $res['message'] = 'Не удается записать пакет с файлами на диск.';
                }
                fclose($dlHandler);
                clearZip();
            } else {
                $res['message'] = 'Не удается скачать пакет с файлами. ' . $zip->message;
            }
        } else {
            $res['success'] = true;
            $res['message'] = 'Пакет с файлами пустой.';
        }
    } else {
        $res['error'] = isset($data->info->error) ? $data->info->error : '';
        $res['message'] = 'Ошибка в формировании пакета файлов.' . $data->info->message;
    }
} else {
    $res['message'] = 'Не удалось соединиться с файловым сервером. ' . $data->message;
}
