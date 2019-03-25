<?php
namespace Vendor\Contacts\Controller\Post;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;

class Index extends \Magento\Framework\App\Action\Action {

    const CONTACTS_URL = 'contacts/view/index';
    const CREATE_CONTACT_URL = 'contacts/index/index';


    private $_contactsFactory;

    public function __construct(
        Context $context,
        \Vendor\Contacts\Model\ContactFactory $contactsFactury,
        UrlInterface $urlBuilder
    ) {

        $this->urlBuilder = $urlBuilder;
        $this->_contactsFactory = $contactsFactury;
        parent::__construct($context);
    }

    public function execute() {

        $post = (array) $this->getRequest()->getPost();
        //if post request
        if (!empty($post)) {

            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->urlBuilder->getUrl(self::CREATE_CONTACT_URL));

            $error = false;
            //check empty, email field
            if(!\Zend_Validate::is(trim($post['first_name']), 'NotEmpty')) {
                $error = true;
                $this->messageManager->addErrorMessage('Wrong First Name !');
            }
            if(!\Zend_Validate::is(trim($post['last_name']), 'NotEmpty')) {
                $error = true;
                $this->messageManager->addErrorMessage('Wrong Last Name !');
            }
            if(!\Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                $error = true;
                $this->messageManager->addErrorMessage('Wrong Email! !');
            }
            if(!\Zend_Validate::is(trim($post['phone']), 'NotEmpty')) {
                $error = true;
                $this->messageManager->addErrorMessage('Wrong Phone!');
            }

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $contact = $objectManager->create('Vendor\Contacts\Model\Contact');

            // check existing contact with this email
            if(!empty($contact->getCollection()->addFieldToFilter('email', $post['email'])->getFirstItem()->getData())) {
                $error = true;
                $this->messageManager->addErrorMessage('Email already exist!');
            }

            if ($error) {
                return $resultRedirect;
            }

            $contact->setData($post);
            $contact->save();

            $this->messageManager->addSuccessMessage('Contact done !');

            $resultRedirect->setUrl($this->urlBuilder->getUrl(self::CONTACTS_URL));
            return $resultRedirect;
        }

        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}