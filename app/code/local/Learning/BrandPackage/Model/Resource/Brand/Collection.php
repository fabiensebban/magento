<?php

class Learning_BrandPackage_Model_Resource_Brand_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('learning_brandpackage/brand');
    }
}
