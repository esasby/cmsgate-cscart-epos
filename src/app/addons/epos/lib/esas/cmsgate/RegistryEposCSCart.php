<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 15.07.2019
 * Time: 11:22
 */

namespace esas\cmsgate;

use esas\cmsgate\cscart\CSCartPaymentProcessor;
use esas\cmsgate\descriptors\ModuleDescriptor;
use esas\cmsgate\descriptors\VendorDescriptor;
use esas\cmsgate\descriptors\VersionDescriptor;
use esas\cmsgate\epos\ConfigFieldsEpos;
use esas\cmsgate\epos\PaysystemConnectorEpos;
use esas\cmsgate\epos\RegistryEpos;
use esas\cmsgate\view\admin\AdminViewFields;
use esas\cmsgate\view\admin\ConfigFormCSCart;
use esas\cmsgate\view\client\CompletionPanelEposCSCart;

class RegistryEposCSCart extends RegistryEpos
{
    public function __construct()
    {
        $this->cmsConnector = new CmsConnectorCSCart();
        $this->paysystemConnector = new PaysystemConnectorEpos();
    }

    /**
     * Переопделение для упрощения типизации
     * @return RegistryEposCSCart
     */
    public static function getRegistry()
    {
        return parent::getRegistry();
    }

    /**
     * Переопделение для упрощения типизации
     * @return ConfigFormCSCart
     */
    public function getConfigForm()
    {
        return parent::getConfigForm();
    }

    public function createConfigForm()
    {
        $managedFields = $this->getManagedFieldsFactory()->getManagedFieldsExcept(AdminViewFields::CONFIG_FORM_COMMON,
            [
                ConfigFieldsEpos::shopName(),
                ConfigFieldsEpos::useOrderNumber(),
                ConfigFieldsEpos::paymentMethodName(),
                ConfigFieldsEpos::paymentMethodDetails(),
                ConfigFieldsEpos::paymentMethodNameWebpay(),
                ConfigFieldsEpos::paymentMethodDetailsWebpay()
            ]);
        $configForm = new ConfigFormCSCart(
            AdminViewFields::CONFIG_FORM_COMMON,
            $managedFields);
        return $configForm;
    }

    public function getCompletionPanel($orderWrapper)
    {
        return new CompletionPanelEposCSCart($orderWrapper);
    }

    function getUrlWebpay($orderWrapper)
    {
        return REAL_URL; //todo check
    }

    public function createModuleDescriptor()
    {
        return new ModuleDescriptor(
            "epos",
            new VersionDescriptor("1.13.0", "2020-11-26"),
            "Прием платежей через ЕРИП (сервис Epos)",
            "https://bitbucket.esas.by/projects/CG/repos/cmsgate-cscart-epos/browse",
            VendorDescriptor::esas(),
            "Выставление пользовательских счетов в ЕРИП"
        );
    }

    const PAYMENT_PROCESSOR_NAME_EPOS = "Epos";
    const PAYMENT_PROCESSOR_NAME_WEBPAY = "Epos card";
}