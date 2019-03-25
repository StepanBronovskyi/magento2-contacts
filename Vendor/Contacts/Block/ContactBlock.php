<?php
namespace Vendor\Contacts\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use Magento\Framework\UrlInterface;

class ContactBlock extends Template {

    const POST_ACTION = 'contacts/post/index';
    const CREATE_CONTACT_URL = 'contacts/index/index';
    const CONTACTS_URL = 'contacts/view/index';

    private $_contactsFactory;

    public function __construct(
        Context $context,
        \Vendor\Contacts\Model\ContactFactory $contactsFactury,
        UrlInterface $urlBuilder
    ){
        $this->urlBuilder = $urlBuilder;
        $this->_contactsFactory = $contactsFactury;
        parent::__construct($context);
    }

    public function getContacts() {
        $contacts = $this->_contactsFactory->create();
        $collection = $contacts->getCollection()->setOrder('first_name','ASC');

        $result = [];
        foreach($collection as $item){
            $result[] = $item->getData();
        }

        return $result;
    }

    public function getPostAction() {
        return self::POST_ACTION;
    }

    public function getCreateContactUrl() {
        return $this->urlBuilder->getUrl(self::CREATE_CONTACT_URL);
    }

    public function getContactsUrl() {
        return $this->urlBuilder->getUrl(self::CONTACTS_URL);
    }
}
?>