<?php

namespace Vendor\Contacts\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper {
    public function getModel($modelName){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $model = $objectManager->create('\Vendor\Contacts\Model\\'.ucfirst($modelName));
        return $model;
    }
}
?>