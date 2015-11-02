<?php
namespace Ktpl\Crud\Model;

class Crud extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ktpl\Crud\Model\Resource\Crud');
    }
}
?>