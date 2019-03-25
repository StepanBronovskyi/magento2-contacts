<?php

namespace Vendor\Contacts\Model\Resource\Contact;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {
    protected function _construct() {
        $this->_init(
            'Vendor\Contacts\Model\Contact',
            'Vendor\Contacts\Model\Resource\Contact'
        );
    }
}
?>