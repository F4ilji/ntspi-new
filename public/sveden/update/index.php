<?php
$selfDir = dirname(__FILE__);
require_once $selfDir. '/config.php';
require_once $selfDir. '/helper.php';

header('Content-Type: text/html; charset=UTF-8');
$currentVersion = file_get_contents($selfDir .  '/cur_version.php');

$assetsUpdateDir = (!empty($GLOBALS['VIKON_PATH']))
    ? '//' . $domenName . $GLOBALS['VIKON_PATH'] . '/sveden/assets/update/'
    : '//' . $domenName . '/sveden/assets/update/';

$assetsCommonDir = (!empty($GLOBALS['VIKON_PATH']))
    ? '//' . $domenName . $GLOBALS['VIKON_PATH'] . '/sveden/assets/review/v1/common/'
    : '//' . $domenName . '/sveden/assets/review/v1/common/';
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Обновление сведений об образовательной организации</title>
    <link href="<?php echo $assetsCommonDir ?>css/vendor.css?v=<?php echo $currentVersion; ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assetsUpdateDir ?>css/sveden.update.css?v=<?php echo $currentVersion; ?>" rel="stylesheet" type="text/css"/>
</head>
<body class="vikon-wrapper">
<input type="hidden" name="domen" value="<?php echo $domenName; ?>">
<input type="hidden" name="api_domen" value="<?php echo $apiDomen; ?>">
<input type="hidden" name="client_id" value="<?php echo $clientId; ?>">
<input type="hidden" name="current_version" value="<?php echo $currentVersion; ?>">
<input type="hidden" name="code" value="<?php echo isset($_GET['code']) ? $_GET['code'] : null; ?>">

<div class="wrapper container">

    <div class="main-wrapper">

        <header class="header">
            Обновление сведений об образовательной организации
            <hr>
        </header>

        <div class="container-fluid">

            <div class="form-group">
                <a href="/sveden" class="btn btn-primary">На главную</a>
                <a href="/sveden/update/index.php" class="btn btn-primary" id="exit" style="display: none;">Выход</a>
                <a href="https://db-nica.ru/rukovodstvo/selectFaq/43/132" target="_blank" class="btn btn-primary help-button">Помощь</a>
            </div>

            <div class="alert alert-danger" id="message-container" style="display: none;"></div>

            <div class="row" id="wait-load">
                <div class="text-center">
                    <img src="<?= $assetsCommonDir ?>/images/throbber.gif">
                    идет загрузка страницы
                </div>
            </div>

            <div class="row" id="no-enter" style="display: none;">
                <div class="col-sm-12 text-center">
                    <h3>Требуется вход</h3>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="enter-vikon">
                            Войти через VIKON
                        </button>
                    </div>
                </div>
            </div>

            <div class="row" id="yes-enter" style="display: none;">
                <div class="col-sm-6">
                    <h3>Текущая версия системы: <span class="label label-default"><?php echo $currentVersion; ?></span></h3>
                    <div class="form-group settings-update" id="settings-update">
                        <h3>Обновление по частям:</h3>
                        <ul>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" name="select-all" id="select-all" checked>
                                    <label for="select-all">Выбрать все</label>
                                </div>
                            </li>
                        </ul>
                        <b>Обновить следующие разделы:</b>
                        <ul>
                            <?php
                            $parts = json_decode($parts);
                            foreach ($parts as $partKey => $partVal) { ?>
                                <li>
                                    <div class="checkbox">
                                        <input type="checkbox" name="part" id="<?php echo $partKey; ?>"
                                               value="<?php echo $partKey; ?>" checked>
                                        <label for="<?php echo $partKey; ?>"><?php echo $partVal; ?></label>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                        <b>Синхронизация файлов:</b>
                        <ul>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" name="sync" id="sync" value="sync" checked>
                                    <label for="sync">Синхронизировать файлы</label>
                                </div>
                            </li>
                            <li>
                                <div class="count-files">
                                    <select class="form-control select-count-files" name="count-files-in-batch">
                                        <?php
                                        $minCountFilesInBatch = 1;
                                        for ($counFilesInBatch = 5; $counFilesInBatch >= $minCountFilesInBatch; $counFilesInBatch--) { ?>
                                            <option value="<?php echo $counFilesInBatch; ?>">
                                                <?php echo $counFilesInBatch; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    Максимальное количество файлов в пакете обновлений
                                    <span class="glyphicon glyphicon-question-sign text-info"
                                          title="Рекомендуется уменьшить в случае возникновения ошибок получения файлов"></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group hide admin-mode-panel" id="admin-mode-panel">
                        <b>Дополнительные опции для администратора:</b>
                        <ul>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" name="no_core" id="no_core" value="no_core">
                                    <label for="no_core">Не обновлять ядро</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input type="checkbox" name="debug_mode" id="debug_mode" value="debug_mode">
                                    <label for="debug_mode">Debug Mode</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6">
                    <h3>Наличие обновления: <span class="label label-warning" id="new-version">получение информации...</span></h3>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="start-update">Начать обновление</button>
                    </div>
                    <p class="alert alert-success" id="update-complete" style="display: none;"></p>
                    <p class="alert alert-danger" id="clear_tmp_error_layout" style="display: none;"></p>
                    <div class="row" id="progressbar-container" style="display: none;">
                        <div class="col-xs-12">
                            <div class="progress">
                                <div id="progressbar" class="progress-bar progress-bar-primary progress-bar-striped"
                                     role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 0;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info process-container" id="process-container" style="display: none;"></div>
                </div>
            </div>

        </div>

        <?php require_once $selfDir . '/is_writable.php'; ?>
        <?php require_once $selfDir . '/check_curl.php'; ?>
    </div>

    <footer class="footer">
        <hr>
        <div class="text-center">
            <p class="copyright">
                Национальный фонд поддержки инноваций в сфере образования (НФПИ)
                <br>
                Copyright © 2013-<?php echo date('Y') ?>
            </p>
        </div>
    </footer>

</div>

<?php
$vendorJsPath = $assetsCommonDir . 'js/vendor.js?v=' . $currentVersion;
$updateJsPath = $assetsUpdateDir . 'js/sveden.update.js?v=' . $currentVersion;
if (isset($_GET['vendorJsPath'])) {
    $vendorJsPathParam = filterPath($_GET['vendorJsPath']);
    $vendorJsPath = $apiDomen . $vendorJsPathParam . '?v=' . $currentVersion;
}
if (isset($_GET['updateJsPath'])) {
    $updateJsPathParam = filterPath($_GET['updateJsPath']);
    $updateJsPath = $apiDomen . $updateJsPathParam . '?v=' . $currentVersion;
}
?>

<script src="<?php echo $vendorJsPath ?>"></script>
<script src="<?php echo $updateJsPath ?>"></script>

</body>
</html>
