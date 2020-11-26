{if !empty($completionPanel)}
    {$completionPanel->render() nofilter}
{elseif !empty($completionPanelWebpay)}
    {$completionPanelWebpay->redirectWebpay() nofilter}
{/if}

