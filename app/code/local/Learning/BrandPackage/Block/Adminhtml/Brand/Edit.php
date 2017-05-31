<?php

class Learning_BrandPackage_Block_Adminhtml_Brand_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->_objectId   = 'id';
        $this->_blockGroup = 'learning_brandpackage';
        $this->_controller = 'adminhtml_brand';

        $this->_updateButton('save', 'label', Mage::helper('learning_brandpackage')->__('Save Brand'));
        $this->_updateButton('delete', 'label', Mage::helper('learning_brandpackage')->__('Delete Brand'));
        $this->_removeButton('reset');

        $this->_addButton('saveandcontinue', array(
            'label'   => Mage::helper('learning_brandpackage')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('brand_data') && Mage::registry('brand_data')->getId()) {
            return Mage::helper('learning_brandpackage')->__("Edit Brand '%s'", Mage::registry('brand_data')->getName());
        } else {
            return Mage::helper('learning_brandpackage')->__('Add Brand');
        }
    }
}
