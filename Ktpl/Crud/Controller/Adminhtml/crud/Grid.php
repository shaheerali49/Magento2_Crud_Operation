<?php

namespace Ktpl\Crud\Controller\Adminhtml\crud;

class Grid extends \Ktpl\Crud\Controller\Adminhtml\crud
{
    /**
     * Order grid
     *
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $resultLayout = $this->resultLayoutFactory->create();
        return $resultLayout;
    }
}
