<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ktpl\Crud\Block;

use Magento\Framework\View\Element\Template;

/**
 * Main contact form block
 */
class Form extends Template {

    /**
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context, array $data = []) {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

}
