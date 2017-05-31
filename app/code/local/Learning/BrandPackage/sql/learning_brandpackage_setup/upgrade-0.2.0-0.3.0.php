<?php

$installer = $this;
$installer->startSetup();

$brandTable = $installer->getConnection()
    ->addColumn($installer->getTable('learning_brandpackage/brand'),
    'slug',
    array(
      'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
      'nullable'  => false,
      'length'    => 255,
      'comment'   => 'Title slug'
    ));

$installer->endSetup();
