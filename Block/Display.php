<?php

namespace PeterBustraan\VapeCalculator\Block;

class Display extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }

    public function siteUrl()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->create('\Magento\Store\Model\StoreManagerInterface');
        $siteUrl = $storeManager->getStore()->getBaseUrl();

        return $siteUrl;
    }

    public function ajaxUrl()
    {
        $ajaxUrl = $this->siteUrl() . 'ohmcalc/index/ohmlaw' ;

        return $ajaxUrl;
    }

    public function sayHello()
    {
        return __('Hello World');
    }
}