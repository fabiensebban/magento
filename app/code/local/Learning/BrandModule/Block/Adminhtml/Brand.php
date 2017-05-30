<?php

class Learning_BrandModule_Block_Adminhtml_Brand extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller     = 'adminhtml_brand';
        $this->_blockGroup     = 'learning_brandmodule';
        $this->_headerText     = Mage::helper('learning_brandmodule')->__('Manage Brands');
        $this->_addButtonLabel = Mage::helper('learning_brandmodule')->__('Add Brand');
        parent::__construct();
    }
    public function getCreateUrl()
    {
        /**
         * When the "Add" button is clicked, this is where the user should
         * be redirected to - in our example, the method editAction of
         * BrandController.php in BrandDirectory module.
         */
        return $this->getUrl(
            'learning_brandmodule_admin/brand/edit'
        );
    }
}
