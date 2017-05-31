<?php

class Learning_BrandPackage_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
      $this->loadLayout();
      $this->renderLayout();

    }

    public function detailAction()
    {
      $slug = $this->getRequest()->getParam('name');
      $entity = Mage::getModel('learning_brandpackage/brand')->loadInstanceBySlug($slug);
      Mage::register('current_entity',$entity);

      $this->loadLayout();
      $this->renderLayout();
    }
}
