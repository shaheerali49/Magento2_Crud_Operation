<?php
namespace Ktpl\Crud\Block\Adminhtml\Crud\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('crud_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Item Information'));
    }
}
