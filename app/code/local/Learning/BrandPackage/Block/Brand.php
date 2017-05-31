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

    public function getSlides()
    {
    	$slides = Mage::getModel('learning_brandpackage/brand')
            		->getCollection()
            		->addIsActiveFilter()
            		->addOrderByPosition();

    	return $slides;
    }
}
