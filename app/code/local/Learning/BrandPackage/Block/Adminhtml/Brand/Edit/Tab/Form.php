<?php

class Learning_BrandPackage_Block_Adminhtml_Brand_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('brand_form', array('legend' => Mage::helper('learning_brandpackage')->__('Brand information')));

        $fieldset->addField('name', 'text', array(
            'label'    => Mage::helper('learning_brandpackage')->__('Name'),
            'name'     => 'name',
            'class'    => 'required-entry',
            'required' => true
        ));

        $fieldset->addField('description', 'text', array(
                'label'    => Mage::helper('learning_brandpackage')->__('Description'),
                'name'     => 'description',
                'class'    => 'required-entry',
                'required' => true
        ));


        if (Mage::getSingleton('adminhtml/session')->getSlideData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSlideData());
            Mage::getSingleton('adminhtml/session')->getSlideData(null);
        } elseif (Mage::registry('brand_data')) {
            $form->setValues(Mage::registry('brand_data')->getData());
        }

        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return Mage::helper('learning_brandpackage')->__('Brand Information');
    }

    public function getTabTitle()
    {
        return Mage::helper('learning_brandpackage')->__('Brand Information');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}
