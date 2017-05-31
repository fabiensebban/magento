<?php

$table = $this->getConnection()
    ->newTable($this->getTable('learning_brandpackage/brand_product'))
    ->addColumn('rel_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'identity'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'Relation ID')
    ->addColumn('brand_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'nullable'  => false,
            'default'   => '0',
        ), 'Brand ID')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'nullable'  => false,
            'default'   => '0',
        ), 'Product ID')
    ->addColumn('position', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'nullable'  => false,
            'default'   => '0',
        ), 'Position')
    ->addIndex($this->getIdxName('learning_brandpackage/brand_product', array('product_id')), array('product_id'))
    ->addForeignKey($this->getFkName('learning_brandpackage/brand_product', 'brand_id', 'learning_brandpackage/brand', 'entity_id'), 'brand_id', $this->getTable('learning_brandpackage/brand'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($this->getFkName('learning_brandpackage/brand_product', 'product_id', 'catalog/product', 'entity_id'), 'product_id', $this->getTable('catalog/product'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Brand to Product Linkage Table');
$this->getConnection()->createTable($table);