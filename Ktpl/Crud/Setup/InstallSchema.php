<?php

namespace Ktpl\Crud\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface {

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;

        $installer->startSetup();
        if (!$installer->tableExists('crud')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('crud')
                    )->addColumn(
                            'crud_id', Table::TYPE_INTEGER, null, ['identity' => true, 'nullable' => false, 'primary' => true], 'crud ID'
                    )->addColumn(
                            'title', Table::TYPE_TEXT, 255, ['nullable' => false], 'Title'
                    )->addColumn(
                            'content', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '2M', array('nullable' => false), 'Content'
                    )->addColumn(
                            'publish_date', \Magento\Framework\DB\Ddl\Table::TYPE_DATE, null, array(), 'Publish Date'
                    )->addColumn(
                            'image', Table::TYPE_TEXT, 255, ['nullable' => false], 'Image'
                    )->addColumn(
                            'is_active', Table::TYPE_SMALLINT, null, [], 'Active Status'
                    )->addColumn(
                            'created_at', Table::TYPE_TIMESTAMP, null, [], 'Creation Time'
                    )->addColumn(
                            'update_time', Table::TYPE_TIMESTAMP, null, [], 'Modification Time'
                    )->setComment(
                    'Crud Table'
            );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }

}
