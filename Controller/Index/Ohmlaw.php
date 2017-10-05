<?php
/**
 * Created by Peter Bustraan
 */

namespace PeterBustraan\VapeCalculator\Controller\Index;


use Magento\Framework\App\ResponseInterface;

class Ohmlaw extends \Magento\Framework\App\Action\Action
{
    protected $_context;
    protected $_pageFactory;
    protected $_jsonEncoder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Json\EncoderInterface $encoder,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->_context = $context;
        $this->_pageFactory = $pageFactory;
        $this->_jsonEncoder = $encoder;
        parent::__construct($context);
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        // TODO: Have agregator inside try catch to ensure full functionality

        //$resultRedirect = $this->resultRedirectFactory->create();

        try
        {
            $request = $this->getRequest()->getParams();

            $result = new \PeterBustraan\VapeCalculator\Model\Ohmlaw($request);

            $this->getResponse()->representJson($this->_jsonEncoder->encode($result->returnValues()));

            return;
        }
        catch (\Exception $e)
        {
            return __('ERROR');
        }
    }
}