<?php

namespace Ktpl\Crud\Block;

use Magento\Store\Model\Store;

class Qrcode extends \Magento\Catalog\Block\Product\View {
   public function getQrcode(){
        $sku = $this->getProduct()->getSku();
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setHeight(256);
        $renderer->setWidth(256);
        $writer = new \BaconQrCode\Writer($renderer);
        $pngfileName = "pub/media/qrcode/".$sku.".png";        
        $writer->writeFile($sku, $pngfileName);       
       
   }
   public function getProductSku(){       
       return $this->getProduct()->getSku();;
   }
   
   public function getMediaUrl(){
       return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
   }
   
}
