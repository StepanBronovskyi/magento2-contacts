<?php

namespace Vendor\Contacts\Controller\Index;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action {

    protected $_resultPageFactory;

    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory){

        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    public function execute(){

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Add contact')));

        return $resultPage;
    }
}
?>