<?php

class Learning_Slider_Adminhtml_Slider_SlideController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        return $this->loadLayout()->_setActiveMenu('learning_slider');
    }

    /**
     * @return Mage_Core_Controller_Varien_Action
     */
    public function indexAction()
    {
        return $this->_initAction()->renderLayout();
    }

  /**
   * @return $this
   */
  public function newAction()
  {
      $this->_forward('edit');

      return $this;
  }

  /**
   * @return $this|Mage_Core_Controller_Varien_Action
   */
  public function editAction()
  {
      $id = $this->getRequest()->getParam('id');
      /** @var Learning_Slider_Model_Slide $slide */
      $slide = Mage::getModel('learning_slider/slide')->load($id);

      if ($slide->getId() || $id == 0) {

          $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
          if (!empty($data)) {
              $slide->setData($data);
          }
          Mage::register('slide_data', $slide);

          return $this->_initAction()->renderLayout();
      }

      Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning_slider')->__('Slide does not exist'));

      return $this->_redirect('*/*/');
  }
  
}
