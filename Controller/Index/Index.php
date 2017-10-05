<?php

namespace PeterBustraan\VapeCalculator\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $volts = 0.0;
        $ohms  = 0.0;
        $amps  = 0.0;
        $watts = 0.0;

        return $this->_pageFactory->create();

    }
}