<?php

use esas\cmsgate\epos\controllers\ControllerEposCompletionPage;
use esas\cmsgate\epos\controllers\ControllerEposCompletionPageWebpay;
use esas\cmsgate\epos\utils\RequestParamsEpos;
use esas\cmsgate\RegistryEposCSCart;
use esas\cmsgate\utils\RequestParamsCSCart;

if ($mode == 'complete') {
    $orderId = $_REQUEST[RequestParamsCSCart::ORDER_ID];
    if (!empty($orderId)) {
        try {
            $order_info = fn_get_order_info($orderId);
            $processor = $order_info["payment_method"]["processor"];
            if ($processor == RegistryEposCSCart::PAYMENT_PROCESSOR_NAME_EPOS
                || ($processor == RegistryEposCSCart::PAYMENT_PROCESSOR_NAME_WEBPAY && array_key_exists(RequestParamsEpos::WEBPAY_STATUS, $_REQUEST)) ) { //или случай нажатия кнопки назад на форме webpay
                $controller = new ControllerEposCompletionPage();
                $completionPanel = $controller->process($orderId);
                Tygh::$app['view']->assign('completionPanel', $completionPanel);
            } elseif ($processor == RegistryEposCSCart::PAYMENT_PROCESSOR_NAME_WEBPAY) {
                $controller = new ControllerEposCompletionPageWebpay();
                $completionPanel = $controller->process($orderId);
                Tygh::$app['view']->assign('completionPanelWebpay', $completionPanel);
            }
        } catch (Throwable $e) {
            Logger::getLogger("complete")->error("Exception:", $e);
        }
    }

}