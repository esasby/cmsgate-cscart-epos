<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 01.03.2018
 * Time: 12:55
 */
require_once(dirname(__FILE__) . '/init.php');

use esas\cmsgate\cscart\CSCartInstallHelper;
use esas\cmsgate\cscart\CSCartPaymentMethod;
use esas\cmsgate\cscart\CSCartPaymentProcessor;
use esas\cmsgate\epos\ConfigFieldsEpos;
use esas\cmsgate\hutkigrosh\ConfigFieldsHutkigrosh;
use esas\cmsgate\Registry;
use esas\cmsgate\RegistryEposCSCart;

if (!defined('BOOTSTRAP')) {
    die('Access denied');
}
function fn_epos_install()
{
    CSCartInstallHelper::uninstallDb();
    $mainProcessor = new CSCartPaymentProcessor();
    $mainProcessor->initDefaults();;
    $mainProcessor->setProcessorName(RegistryEposCSCart::PAYMENT_PROCESSOR_NAME_EPOS);
    $mainProcessor->setTemplate('views/orders/components/payments/cc_outside.tpl');
    $mainPaymentMethod = new CSCartPaymentMethod();
    $mainPaymentMethod->initDefaults();;
    $mainPaymentMethod->setLogo('epos.png');
    $mainPaymentMethod->setProcessor($mainProcessor);
    CSCartInstallHelper::addPaymentMethod($mainPaymentMethod);


    $webpayProcessor = new CSCartPaymentProcessor();
    $webpayProcessor->initDefaults();;
    $webpayProcessor->setProcessorName(RegistryEposCSCart::PAYMENT_PROCESSOR_NAME_WEBPAY);
    $webpayProcessor->setTemplate('views/orders/components/payments/cc_outside.tpl');
    $webpayProcessor->setAdminTemplate('epos_webpay.tpl');
    $webpayPaymentMethod = new CSCartPaymentMethod();
    $webpayPaymentMethod->initDefaults();
    $webpayPaymentMethod->setLogo('epos_webpay.png');
    $webpayPaymentMethod->setProcessor($webpayProcessor);
    $webpayPaymentMethod->setName(Registry::getRegistry()->getTranslator()->getConfigFieldDefault(ConfigFieldsEpos::paymentMethodNameWebpay()));
    $webpayPaymentMethod->setDescription(Registry::getRegistry()->getTranslator()->getConfigFieldDefault(ConfigFieldsEpos::paymentMethodDetailsWebpay()));
    CSCartInstallHelper::addPaymentMethod($webpayPaymentMethod);
}

function fn_epos_uninstall(){
    CSCartInstallHelper::uninstallDb();
}
