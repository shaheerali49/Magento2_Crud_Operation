<?php

namespace Ktpl\Crud\Block\Adminhtml\Crud\Grid\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\Object;
use Magento\Store\Model\StoreManagerInterface;

class Image extends AbstractRenderer {

    private $_storeManager;

    /**
     * @param \Magento\Backend\Block\Context $context
     * @param array $data
     */
    public function __construct(\Magento\Backend\Block\Context $context, StoreManagerInterface $storemanager, array $data = []) {
        $this->_storeManager = $storemanager;
        parent::__construct($context, $data);
        $this->_authorization = $context->getAuthorization();
    }

    /**
     * Renders grid column
     *
     * @param Object $row
     * @return  string
     */
    public function render(Object $row) {
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        );
        $html = '';
        if ($this->_getValue($row) != '') {
            $imageUrl = $mediaDirectory . '/bannerslider/images' . $this->_getValue($row);
            $html = '<img src="' . $imageUrl . '" width="50"/>';
        }
        return $html;
    }

}
