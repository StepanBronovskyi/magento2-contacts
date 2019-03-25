<?php

namespace Vendor\Contacts\Controller\View;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action {

    protected $_resultPageFactory;
    private $_contactsFactory;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Vendor\Contacts\Model\ContactFactory $contactsFactury
    ){
        $this->_resultPageFactory = $resultPageFactory;
        $this->_contactsFactory = $contactsFactury;
        parent::__construct($context);
    }
    public function execute(){

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Contacts')));

        return $resultPage;
    }
}
?>