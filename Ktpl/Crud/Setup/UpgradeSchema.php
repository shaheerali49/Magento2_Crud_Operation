<?php

namespace Ktpl\Crud\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface {

    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        if (version_compare($context->getVersion(), '0.0.3') < 0) {

            $installer = $setup;
            $installer->startSetup();

            $installer->getConnection()->addColumn(
                    $installer->getTable('crud'), 'url_key', array(
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                'nullable' => true,
                'length' => '1k',
                'comment' => 'Url Key'
                    )
            );

            $installer->endSetup();
        }
    }

}
