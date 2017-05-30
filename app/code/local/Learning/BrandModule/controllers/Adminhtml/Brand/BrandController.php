<?php

class Learning_BrandModule_Adminhtml_Brand_BrandController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Instantiate our grid container block and add to the page content.
     * When accessing this admin index page we will see a grid of all
     * brands currently available in our Magento instance, along with
     * a button to add a new one if we wish.
     */
    public function indexAction()
    {
        // instantiate the grid container
        $brandBlock = $this->getLayout()
            ->createBlock('learning_brandmodule/adminhtml_brand');

        // add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($brandBlock)
            ->renderLayout();
    }

    /**
     * This action handles both viewing and editing of existing brands.
     */
    public function editAction()
    {
        /**
         * retrieving existing brand data if an ID was specified,
         * if not we will have an empty Brand entity ready to be populated.
         */
        $brand = Mage::getModel('learning_brandmodule/brand');
        if ($brandId = $this->getRequest()->getParam('id', false)) {
            $brand->load($brandId);
            if ($brand->getId() < 1) {
                $this->_getSession()->addError(
                    $this->__('This brand no longer exists.')
                );
                return $this->_redirect(
                    'learning_brandmodule_admin/brand/index'
                );
            }
        }

        // process $_POST data if the form was submitted
        if ($postData = $this->getRequest()->getPost('brandData')) {
            try {
                $brand->addData($postData);
                $brand->save();

                $this->_getSession()->addSuccess(
                    $this->__('The brand has been saved.')
                );

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'learning_brandmodule_admin/brand/edit',
                    array('id' => $brand->getId())
                );
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

            /**
             * if we get to here then something went wrong. Continue to
             * render the page as before, the difference being this time
             * the submitted $_POST data is available.
             */
        }

        // make the current brand object available to blocks
        Mage::register('current_brand', $brand);

        // instantiate the form container
        $brandEditBlock = $this->getLayout()->createBlock(
            'learning_brandmodule/adminhtml_brand_edit'
        );

        // add the form container as the only item on this page
        $this->loadLayout()
            ->_addContent($brandEditBlock)
            ->renderLayout();
    }

    public function deleteAction()
    {
        $brand = Mage::getModel('learning_brandmodule/brand');
        if ($brandId = $this->getRequest()->getParam('id', false)) {
            $brand->load($brandId);
        }

        if ($brand->getId() < 1) {
            $this->_getSession()->addError(
                $this->__('This brand no longer exists.')
            );
            return $this->_redirect(
                'learning_brandmodule_admin/brand/index'
            );
        }

        try {
            $brand->delete();

            $this->_getSession()->addSuccess(
                $this->__('The brand has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }
        return $this->_redirect(
            'learning_brandmodule_admin/brand/index'
        );
    }

    /**
     * Thanks to Ben for pointing out this method was missing. Without
     * this method the ACL rules configured in adminhtml.xml are ignored.
     */
    protected function _isAllowed()
    {

        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('learning_brandmodule/brand');
                break;
        }

        return $isAllowed;
    }
}
