<?php

class Learning_BrandModule_Model_Resource_Brand_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        parent::_construct();

        $this->_init('learning_brandmodule/brand');
    }
}
