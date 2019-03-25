<?php
namespace Vendor\Contacts\Model;
use Magento\Framework\Model\AbstractModel;

class Contact extends AbstractModel {
    protected function _construct() {
        $this->_init('Vendor\Contacts\Model\Resource\Contact');
    }
}
?>