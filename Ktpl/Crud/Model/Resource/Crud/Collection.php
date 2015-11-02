<?php
namespace Ktpl\Crud\Model\Resource\Crud;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ktpl\Crud\Model\Crud', 'Ktpl\Crud\Model\Resource\Crud');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>