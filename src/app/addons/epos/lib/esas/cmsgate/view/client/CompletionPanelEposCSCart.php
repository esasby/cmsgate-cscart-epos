<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 24.06.2019
 * Time: 14:11
 */

namespace esas\cmsgate\view\client;

use esas\cmsgate\epos\view\client\CompletionPanelEpos;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;

class CompletionPanelEposCSCart extends CompletionPanelEpos
{
    public function getCssClass4MsgSuccess()
    {
        return "cm-notification-content notification-content alert-success";
    }

    public function getCssClass4MsgUnsuccess()
    {
        return "cm-notification-content notification-content alert-error";
    }

    public function getCssClass4Button()
    {
        return "ty-btn ty-btn__secondary";
    }

    public function elementTabHeaderInput($key)
    {
        return
            (!$this->isOnlyOneTabEnabled() ? element::input(
                attribute::id("input-" . $key),
                attribute::type("radio"),
                attribute::name("tabs2"),
                attribute::style("display: none"),
                attribute::checked($this->isTabChecked($key))
            ) : "");
    }

    public function getCssClass4TabHeaderLabel()
    {
        return "ty-step__title-active ty-step__title-txt";
    }
}