<?php
use esas\cmsgate\CmsConnectorCSCart;
use esas\cmsgate\Registry;

if (!defined('BOOTSTRAP')) {
    die('Access denied');
}

if ($mode == 'processor') {
    $configForm = Registry::getRegistry()->getConfigForm();
    $mainPaymentMethod = CmsConnectorCSCart::getInstance()->getMainPaymentMethod(); //для отображения названия
    Tygh::$app['view']->assign('configForm', $configForm);
    Tygh::$app['view']->assign('mainPaymentMethod', $mainPaymentMethod);
}