<?php

class Learning_BrandPackage_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
      $this->loadLayout();
      $this->renderLayout();

    }

    public function showAction()
    {
      die('this is show action !');
    }
}
