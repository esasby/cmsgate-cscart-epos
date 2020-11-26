<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 01.03.2018
 * Time: 12:53
 */

if (!defined('BOOTSTRAP')) {
    die('Access denied');
}

require_once(dirname(__FILE__) . '/lib/vendor/esas/cmsgate-core/src/esas/cmsgate/CmsPlugin.php');

use esas\cmsgate\CmsPlugin;
use esas\cmsgate\RegistryEposCSCart;


(new CmsPlugin(dirname(__FILE__) . '/lib/vendor', dirname(__FILE__) . '/lib'))
    ->setRegistry(new RegistryEposCSCart())
    ->init();