<?php
    //Используйте dirname(__FILE__) для определение относительных путей в функции. Файл может быть подключён.

    class getResult
    {
        public $success = false;
        public $code = 200;
        public $message = 'Не удается получить данные от удаленного сервера';
        public $info = '';
    }

    // @deprecated  use remoteRequest
    function getRemoteData($url, $opts = NULL, $decode = true, $postFields = false, $headers = array())
    {
        $result = new getResult();
        $result->success = false;

        $output = null;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST , 0);
        if (is_array($postFields)) {
            curl_setopt($ch, CURLOPT_POST , true);
            $postVars = "";
            foreach($postFields as $key => $value) {
                $postVars .= $key . '=' . $value . '&';
            }
            $postVars = rtrim($postVars ,'&');
            curl_setopt($ch, CURLOPT_POSTFIELDS , $postVars);
        } else {
            $headers[] = 'Content-type: application/json';
        }
        if ($headers !== array()) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $output = curl_exec($ch);
        if (curl_errno($ch) > 0 || curl_error($ch)) {
            if (DEBUG_MODE === true) {
                $result->message .= ';' . '#:' . curl_errno($ch) . 'Error:' . curl_error($ch);
            }
        }
        $curlInfo = curl_getinfo($ch);
        $result->code = $curlInfo['http_code'];
        curl_close($ch);

        if ($output) {
            $result->success = true;
            $result->info = ($decode) ? json_decode($output) : $output;
        }
        return $result;
    }

    function getContents($url, $opts)
    {
        return file_get_contents($url, false, ($opts != NULL) ? stream_context_create($opts) : NULL);
    }

    function loadHeaders()
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
    }

    function removeDirectory($dir, $folderIsDel = true)
    {
        $success = false;
        if (file_exists($dir)) {
            if ($objs = glob($dir . "/*")) {
                foreach ($objs as $obj) {
                    if (is_dir($obj)) {
                        removeDirectory($obj);
                    } else {
                        if (NO_DEL_FILE_PHP && substr($obj, -4) === '.php') {
                            $folderIsDel = false;
                        } else {
                            unlink($obj);
                        }
                    }
                }
            }
            if ($folderIsDel) {
                $success = rmdir($dir);
            } else {
                $success = true;
            }
        }
        return $success;
    }

    function copyDirectory($src, $dst) {
        $dir = opendir($src);
        if (!file_exists($dst)) {
            mkdir($dst, 0775, true);
        }
        while(($file = readdir($dir)) !== false) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    copyDirectory($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    function unpackZipWithReplaceFolder($fileName, $pathToUnpack, $selfDir, $part)
    {
        $resUnpack['success'] = false;
        $resUnpack['message'] = '';
        $pathToFolder = $selfDir . '/../' . $part;
        $tmpPathToFolder = $selfDir . '/../_' . $part;
        if (file_exists($tmpPathToFolder)) {
            $tmpPathToFolder =  $tmpPathToFolder . '_tmp';
        }

        if (file_exists($pathToFolder)) {
            rename($pathToFolder, $tmpPathToFolder);
            $resUnpack = unpackZip($fileName, $pathToUnpack);
            if ($resUnpack['success']) {
                if (file_exists($tmpPathToFolder)) {
                    removeDirectory($tmpPathToFolder);
                }
            } else {
                rename($tmpPathToFolder, $pathToFolder);
            }
        } else {
            $resUnpack = unpackZip($fileName, $pathToUnpack);
        }

        return $resUnpack;
    }

    function unpackZip($fileName, $pathToUnpack)
    {
        $res['success'] = false;
        $res['message'] = '';
        if($pathToUnpack) {
            if (extension_loaded('zip')) {
                $zip = new ZipArchive;
                if ($isOpenedZip = $zip->open($fileName)) {
                    $zip->extractTo($pathToUnpack);
                    $zip->close();
                    $res['success'] = true;

                } else {
                    $res['message'] = 'Ошибка при распоковке файлов библиотеки ZIP:' . $isOpenedZip;
                }
            } else {
                require_once dirname(__FILE__) . '/zip_helper.php';
                $archive = new PclZip($fileName);
                $unZipResult = $archive->extract(PCLZIP_OPT_PATH, $pathToUnpack,
                    PCLZIP_CB_PRE_EXTRACT, 'preExtractCallback', PCLZIP_OPT_REPLACE_NEWER);
                if ($unZipResult == 0) {
                    $res['message'] = 'Ошибка при распоковке файлов:' . $archive->errorInfo(true);
                } else {
                    $res['success'] = true;
                }
                $archive->privCloseFd();
            }
        }
        return $res;
    }

    function preExtractCallback($preEvent, &$preHeader)
    {
        if (!is_dir($preHeader['filename'])) {
            if (strpos($preHeader['filename'], '.htaccess')) {
                return 0;
            }
            if (file_exists($preHeader['filename'])) {
                unlink($preHeader['filename']);
            }
        }
        return 1;
    }

    function filterAccessToken($token)
    {
        return filter_var($token, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^[a-z0-9_\-\.]+$/i')));
    }

    function filterFileName($file)
    {
        return filter_var($file, FILTER_VALIDATE_REGEXP,
            array('options' => array('regexp' => '/^[a-z0-9\+\.\,\(\)\;\#\№\-\_\«\»\!\%\=\$\@\'\&\–]+$/i'))
        );
    }

    function filterPath($file)
    {
        return filter_var($file, FILTER_VALIDATE_REGEXP,
            array('options' => array('regexp' => '/^[a-z0-9\.\-\_\–\/]+$/i'))
        );
    }

    function filterInt($number)
    {
        return filter_var($number, FILTER_VALIDATE_INT);
    }

    function filterUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    function filterVersion($version)
    {
        return filter_var($version, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^[0-9\.]+$/')));
    }

    function filterPartName($part)
    {
        return filter_var($part, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^[a-z\_]+$/i')));
    }

    function filterLogin($str)
    {
        return filter_var($str, FILTER_VALIDATE_EMAIL);
    }

    function filterPassword($str)
    {
        return filter_var($str, FILTER_SANITIZE_STRING);
    }

    function logFile($message) {
        $file_name = date("Y_m_d")."_log.log";
        // Запись в файл
        $file = fopen($file_name, 'a+');
        fwrite($file, date('Y-m-d H:i:s') . ' --- ' . $message . "\r\n");
        fclose($file);
    }

    function clearZip()
    {
        if ($filelist = glob(dirname(__FILE__) .  '/../update/*.zip')) {
            foreach ($filelist as $file) {
                if (!unlink($file)) {
                    return false;
                }
            }
        }
        return true;
    }

    function setResponseCode($code, $reason = null) {
        $code = intval($code);

        if (version_compare(phpversion(), '5.4', '>') && is_null($reason)) {
            http_response_code($code);
        } else {
            header(trim("HTTP/1.0 $code $reason"));
        }
    }

    class RemoteResult
    {
        public $curlHasError = true;
        public $curlErrorTxt = '';

        public $code = 0;
        public $responseBody = '';
    }

    function remoteRequest($url, $responseAsJson = true, $postFields = false, $headers = array())
    {
        $result = new RemoteResult();

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

        if ($headers !== array()) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $output = curl_exec($ch);

        if (curl_errno($ch) > 0 || curl_error($ch)) {
            $result->curlErrorTxt .= ';' . '#:' . curl_errno($ch) . 'Error:' . curl_error($ch);
        } else{
            $result->curlHasError = false;

            $curlInfo = curl_getinfo($ch);
            $result->code = (int) $curlInfo['http_code'];
            $result->responseBody = ($responseAsJson) ? json_decode($output) : $output;
        }
        curl_close($ch);
        return $result;
    }