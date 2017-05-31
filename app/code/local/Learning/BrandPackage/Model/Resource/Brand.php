<?php

class Learning_BrandPackage_Model_Resource_Brand extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('learning_brandpackage/brand', 'entity_id');
    }

    /**
     * Perform actions before object save
     *
     * @param Varien_Object $object
     * @return Mage_Core_Model_Resource_Db_Abstract
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $slide)
    {
        $slug = $this->createSlug($slide->getName());
        $verifSlug = $this->checkIfSlugExists($slug,$slide->getId());
        $slide->setSlug($verifSlug);
        var_dump($slide);die();
        parent::_beforeSave($slide);
        return $this;
    }

    protected function checkIfSlugExists($slug, $id){
           $table = $this->getMainTable();
           $readAdapter = $this->_getReadAdapter();

           $sql = $readAdapter->select()->from($table)->where("slug = '".$slug."' ");

           if($id != null) {
               $sql->where("entity_id <> ".$id);
           }

           $result = $readAdapter->fetchRow($sql);

           if($result){
               throw new mysqli_sql_exception('Slug already exists');
           }

           return $slug;
    }

    protected function createSlug($name){
      $newName = strtolower($name);
      return str_replace(' ', '_', $name);
    }

    public function loadInstanceBySlug($slug, $object){
      $table = $this->getMainTable();
      $readAdapter = $this->_getReadAdapter();

      $sql = $readAdapter->select()->from($table)->where("slug = '".$slug."' ");
      $result = $readAdapter->fetchRow($sql);

      if($result){
        $object->setData($result);
      }
      return $object;
    }

}
