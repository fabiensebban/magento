<?php

class Learning_BrandPackage_Adminhtml_Brand_BrandController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        return $this->loadLayout()->_setActiveMenu('learning_brandpackage');
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
        $slide = Mage::getModel('learning_brandpackage/brand')->load($id);

        if ($slide->getId() || $id == 0) {

          $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
          if (!empty($data)) {
              $slide->setData($data);
          }
          Mage::register('brand_data', $slide);

          return $this->_initAction()->renderLayout();
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning_brandpackage')->__('Brand does not exist'));

        return $this->_redirect('*/*/');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            /*
            $delete = (!isset($data['image_url']['delete']) || $data['image_url']['delete'] != '1') ? false : true;
            $data['image_url'] = $this->_saveImage('image_url', $delete);
            */
            /** @var Learning_Slider_Model_Slide $slide */
            $slide = Mage::getModel('learning_brandpackage/brand');

            if ($id = $this->getRequest()->getParam('id')) {
                $slide->load($id);
            }

            try {
                $slide->addData($data);
                $slide->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_brandpackage')->__('The brand has been saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array(
                            'id'       => $slide->getId(),
                            '_current' => true
                        ));

                    return;
                }

                $this->_redirect('*/*/');

                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->_getSession()->addException($e, Mage::helper('learning_brandpackage')->__('An error occurred while saving the brand.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));

            return;
        }
        $this->_redirect('*/*/');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                /** @var Learning_Slider_Model_Slide $slide */
                $slide = Mage::getModel('learning_brandpackage/brand');
                $slide->load($id)->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_brandpackage')->__('Brand was successfully deleted'));
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                return;
            }
        }

        return $this->_redirect('*/*/');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function massDeleteAction()
    {
        $slideIds = $this->getRequest()->getParam('brand');
        if (!is_array($slideIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning_brandpackage')->__('Please select brand(s)'));
        } else {
            try {
                foreach ($slideIds as $slide) {
                    Mage::getModel('learning_brandpackage/brand')->load($slide)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_brandpackage')->__('Total of %d brand(s) were successfully deleted', count($slideIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        return $this->_redirect('*/*/index');
    }

}
