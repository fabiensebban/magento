<?php

class Learning_BrandModule_Model_Resource_Brand extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('learning_brandmodule/brand', 'entity_id');
    }
}
