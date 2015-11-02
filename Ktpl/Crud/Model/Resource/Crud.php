<?php
namespace Ktpl\Crud\Model\Resource;

class Crud extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('crud', 'crud_id');
    }
}
?>