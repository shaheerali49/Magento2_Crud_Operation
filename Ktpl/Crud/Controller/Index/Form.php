<?php

namespace Ktpl\Crud\Controller\Index;
class Form extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {        
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
