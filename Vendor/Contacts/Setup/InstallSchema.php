<?php

namespace Vendor\Contacts\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements InstallSchemaInterface{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable('contacts_table');
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn('id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ], 'ID')
                ->addColumn('first_name', Table::TYPE_TEXT, null, [
                    'length' => 32,
                    'nullable' => false
                ], 'First Name')
                ->addColumn('last_name', Table::TYPE_TEXT, null, [
                    'length' => 32,
                    'nullable' => false
                ], 'Last Name')
                ->addColumn('email', Table::TYPE_TEXT, null, [
                    'length' => 54,
                    'nullable' => false
                ], 'Email')
                ->addColumn('phone', Table::TYPE_TEXT, null, [
                    'nullable' => false
                ], 'Phone')
                ->addColumn('accepted', Table::TYPE_BOOLEAN, null, [
                    'nullable' => true
                ], 'Accepted')
                ->setComment('Contacts Table');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
?>