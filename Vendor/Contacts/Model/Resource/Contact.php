<?php
namespace Vendor\Contacts\Model\Resource;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Contact extends AbstractDb {
    protected function _construct() {
        $this->_init('contacts_table', 'id');
    }
}
?>