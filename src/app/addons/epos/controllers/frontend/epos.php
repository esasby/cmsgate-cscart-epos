<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 26.02.2018
 * Time: 14:02
 */

use esas\cmsgate\epos\controllers\ControllerEposCallback;
use esas\cmsgate\utils\Logger;

if ($mode == 'callback') {
    try {
        $controller = new ControllerEposCallback();
        $controller->process();
    } catch (Throwable $e) {
        Logger::getLogger("callback")->error("Exception:", $e);
    }
    exit;
}