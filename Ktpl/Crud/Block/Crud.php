<?php

namespace Ktpl\Crud\Block;

use Magento\Store\Model\Store;

class Crud extends \Magento\Framework\View\Element\Template {
   
    protected $_crudFactory;
    
    protected $request;
    
    const PAGE_PARM_NAME = 'p';

    public function __construct(
            \Magento\Backend\Block\Widget\Context $context, 
            \Ktpl\Crud\Model\crudFactory $crudFactory, 
            \Magento\Framework\App\Config\ScopeConfigInterface $config,           
            \Magento\Framework\App\Request\Http $request,
            array $data = []) {
        $this->_crudFactory = $crudFactory;
        $this->_config = $config;        
        $this->request = $request;
        parent::__construct($context, $data);
    }

    
    
    public function getCollection() {
        $collection = $this->_crudFactory->create()->getCollection()->addFieldToFilter('is_active',1);
        
        $collection->setCurPage($this->getCurrentPage());
        $limit = (int)$this->getLimit();
        if ($limit) {
            $collection->setPageSize($limit);
        }
        
        return $collection;
    }

    public function getBannerImage($imageName) {
        $unsecureBaseURL = $this->_config->getValue(Store::XML_PATH_UNSECURE_BASE_URL, 'default');
        $mediaDirectory = $unsecureBaseURL . 'pub/media/';
        return $mediaDirectory . 'bannerslider/images' . $imageName;
    }
    
    public function getAvailableLimit()
    {
        return array(5=>5,10=>10,25=>25,50=>50);
    }
    
    public function getDefaultPerPageValue()
    {       
        return 5;
    }
    
    
    public function getCurrentPage()
    {
        $page = (int) $this->request->getParam(self::PAGE_PARM_NAME);
        return $page ? $page : 1;
    }
    
    public function getLimit()
    {
        $limit = $this->_getData('_current_limit');
        if ($limit) {
            return $limit;
        }

        $limits = $this->getAvailableLimit();
        $defaultLimit = $this->getDefaultPerPageValue();
        if (!$defaultLimit || !isset($limits[$defaultLimit])) {
            $keys = array_keys($limits);
            $defaultLimit = $keys[0];
        }

        $limit = $this->getMinLimit();
        if (!$limit || !isset($limits[$limit])) {
            $limit = $defaultLimit;
        }
        
        $this->setData('_current_limit', $limit);
        return $limit;
    }
    
    
     public function getPagerHtml()
    {
         return $this->getChildHtml('pager');        
    }
    
    
    
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        //$this->pageConfig->getTitle()->set("Testing");
        if ($this->getCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'ktpl_crud_toolbar_pager'
            )->setAvailableLimit($this->getAvailableLimit())->setLimit($this->getLimit())->setCollection(
                $this->getCollection()
            );           
            $this->setChild('pager', $pager);
            $this->getCollection()->load();
        }
        return $this;
    }
    

}
