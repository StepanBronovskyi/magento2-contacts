<?php

namespace Vendor\Contacts\Controller\Adminhtml\Accept;
use Vendor\Contacts\Model\Contact;
use Magento\Backend\App\Action;
use Magento\Framework\UrlInterface;

class Index extends \Magento\Backend\App\Action {

    const CONTACT_ACCEPTED = 1;

    public function __construct(
        Action\Context $context,
        UrlInterface $urlBuilder
    ) {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context);
    }

    public function execute() {

        $id = $this->getRequest()->getParam('id');

        if (!($contact = $this->_objectManager->create(Contact::class)->load($id))) {
            $this->messageManager->addErrorMessage('Unable to proceed. Please, try again.');
        }
        else {
            $contact = $this->_objectManager->create(Contact::class)->load($id);
            $contact->setAccepted(self::CONTACT_ACCEPTED);
            $contact->save();
            $this->messageManager->addSuccessMessage('Contact success accepted');
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $redirectUrl = $this->_urlBuilder->getUrl('contact/grid/index');
        return $resultRedirect->setUrl($redirectUrl);
    }
}