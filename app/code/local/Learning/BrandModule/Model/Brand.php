<?php
class Learning_BrandModule_Model_Brand extends Mage_Core_Model_Abstract
{
    const VISIBILITY_HIDDEN = '0';
    const VISIBILITY_DIRECTORY = '1';
    protected function _construct()
    {
        $this->_init('learning_brandmodule/brand');
    }
    /**
     * This method is used in the grid and form for populating the dropdown.
     */
    public function getAvailableVisibilies()
    {
        return array(
            self::VISIBILITY_HIDDEN
            => Mage::helper('learning_brandmodule')
                ->__('Hidden'),
            self::VISIBILITY_DIRECTORY
            => Mage::helper('learning_brandmodule')
                ->__('Visible in Directory'),
        );
    }
    protected function _beforeSave()
    {
        parent::_beforeSave();
        /**
         * Perform some actions just before a brand is saved.
         */
        $this->_updateTimestamps();
        $this->_prepareUrlKey();
        return $this;
    }
    protected function _updateTimestamps()
    {
        $timestamp = now();
        /**
         * Set the last updated timestamp.
         */
        $this->setUpdatedAt($timestamp);
        /**
         * If we have a brand new object, set the created timestamp.
         */
        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }
        return $this;
    }
    protected function _prepareUrlKey()
    {
        /**
         * In this method, you might consider ensuring
         * that the URL Key entered is unique and
         * contains only alphanumeric characters.
         */
        return $this;
    }
}