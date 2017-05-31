<?php

class Learning_BrandPackage_Block_Adminhtml_Brand extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller     = 'adminhtml_brand';
        $this->_blockGroup     = 'learning_brandpackage';
        $this->_headerText     = Mage::helper('learning_brandpackage')->__('Manage Brands');
        $this->_addButtonLabel = Mage::helper('learning_brandpackage')->__('Add Brand');
        parent::__construct();
    }
}
