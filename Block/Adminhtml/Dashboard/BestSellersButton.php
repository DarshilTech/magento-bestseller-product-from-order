<?php

namespace DarshilTech\Bestsellers\Block\Adminhtml\Dashboard;

use Magento\Backend\Block\Template;
use Magento\Framework\UrlInterface;

class BestSellersButton extends Template
{
    protected $urlBuilder;

    public function __construct(
        Template\Context $context,
        UrlInterface $urlBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->urlBuilder = $urlBuilder;
    }

    public function getFormAction()
    {
        return $this->urlBuilder->getUrl('bestsellers/export/download');
    }
}