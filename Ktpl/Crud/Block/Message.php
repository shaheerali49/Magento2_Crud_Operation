<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ktpl\Crud\Block;

/**
 * Main contact form block
 */
class Message extends \Magento\Framework\View\Element\Messages {
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Message\Factory $messageFactory,
        \Magento\Framework\Message\CollectionFactory $collectionFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,        
        array $data = []
    ) {
        parent::__construct(
            $context,
            $messageFactory,
            $collectionFactory,
            $messageManager,
            $data
        );        
    }
    
    protected function _prepareLayout()
    {
        $this->addMessages($this->messageManager->getMessages(true));        
        return parent::_prepareLayout();
    }

}
