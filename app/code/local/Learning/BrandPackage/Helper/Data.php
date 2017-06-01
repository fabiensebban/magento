<?php

class Learning_BrandPackage_Helper_Data extends Mage_Core_Helper_Abstract
{
  const IMAGE_FOLDER = "product";

  /**
   * Renvoie l'URL de l'image
   * @param $filename
   * @return string
   */
  public function getImageUrl($filename)
  {
      return Mage::getBaseUrl('media') . self::IMAGE_FOLDER . '/' . $filename;
  }

  public function getProductImageUrl($product)
  {
      $imageUrl = Mage::getBaseUrl('media') . 'catalog/product' . $product->getImage();
      $imageCacheUrl = Mage::helper('catalog/image')->init($product, 'image');
      return $imageCacheUrl;
  }
}
