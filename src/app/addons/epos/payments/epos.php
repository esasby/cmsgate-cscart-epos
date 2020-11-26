<?php

use esas\cmsgate\epos\controllers\ControllerEposInvoiceAdd;
use esas\cmsgate\Registry;
use esas\cmsgate\wrappers\OrderWrapperCSCart;

if (!defined('BOOTSTRAP')) {
    die('Access denied');
}
if ($mode == 'place_order') {
    try {
        $orderWrapper = new OrderWrapperCSCart($order_info);
        $controller = new ControllerEposInvoiceAdd();
        $resp = $controller->process($orderWrapper);
        // в массив $pp_response помещаются данные для дальнейшей обработки ядром
        $pp_response['order_status'] = Registry::getRegistry()->getConfigWrapper()->getBillStatusPending();
        $pp_response['transaction_id'] = $resp->getInvoiceId();
    } catch (Throwable $e) {
        $pp_response['order_status'] = Registry::getRegistry()->getConfigWrapper()->getBillStatusFailed();
        $pp_response["reason_text"] = $e->getMessage();
    }
}

