<?php
namespace Vendor\Contacts\Block\Adminhtml;

class Grid extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_grid';
        $this->_blockGroup = 'Vendor_Contacts';
        $this->_headerText = __('Contacts');
        $this->_addButtonLabel = __('Create New Contact');
        parent::_construct();
    }
}
