<?php

class Learning_BrandPackage_Block_Brand extends Mage_Core_Block_Template
{
    public function methodFromTheBlock()
    {
        return 'this is a method from the block !';
    }

    public function magentoMethod()
    {
        return 'Magento is so amazing !';
    }

    public function getBrands()
    {
    	$brands = Mage::getModel('learning_brandpackage/brand')
            		->getCollection();

    	return $brands;
    }

    public function getProducts($brand)
    {
        return $brand->getSelectedProductsCollection()
                    ->addFieldToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
                    ->setVisibility(array(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH, Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG))
                    //->load(true)
                    ->addAttributeToSelect(['name', 'SKU', 'description', 'price', 'image']);
    }
}
