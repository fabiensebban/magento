<?php

class Learning_BrandPackage_Block_Adminhtml_Brand_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('brand_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('learning_brandpackage')->__('Brand Information'));
    }
}
