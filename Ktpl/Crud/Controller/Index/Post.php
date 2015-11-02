<?php

/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ktpl\Crud\Controller\Index;

use Magento\Framework\App\Filesystem\DirectoryList;

class Post extends \Magento\Contact\Controller\Index {
//class Post extends \Magento\Framework\App\Action\Action {

    /**
     * Post user question
     *
     * @return void
     * @throws \Exception
     */
    public function execute() {
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            $this->_redirect('crud/index/form');
            return;
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            $model = $this->_objectManager->create('Ktpl\Crud\Model\Crud');
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                try {
                    $uploader = $this->_objectManager->create('\Magento\MediaStorage\Model\File\Uploader', array('fileId' => 'image'));
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                            ->getDirectoryRead(DirectoryList::MEDIA);
                    $config = $this->_objectManager->get('Ktpl\Crud\Model\Crud');
                    $result = $uploader->save($mediaDirectory->getAbsolutePath('bannerslider/images'));
                    unset($result['tmp_name']);
                    unset($result['path']);
                    $data['image'] = $result['file'];
                } catch (Exception $e) {
                    $data['image'] = $_FILES['image']['name'];
                }
            } else if (isset($data['image']['delete'])) {
                $data['image'] = '';
            } else if (isset($data['image']['value'])) {
                $data['image'] = $data['image']['value'];
            }

            $model->setData($data);
            $model->setStoreId($this->storeManager->getStore()->getId())
                        ->setStores([$this->storeManager->getStore()->getId()])
                        ->save();
            try {
                $model->save();
                $this->messageManager->addSuccess(
                        __('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
                );
                //$this->_redirect('crud/index/form');
                //return;
            } catch (\Exception $e) {
                $this->messageManager->addError(
                        __('We can\'t process your request right now. Sorry, that\'s all we know.'));
                //$this->_redirect('crud/index/form');
                //return;
            }
        } catch (\Exception $e) {
            $this->messageManager->addError(
                    __('We can\'t process your request right now. Sorry, that\'s all we know.')
            );
            //$this->_redirect('crud/index/form');
            //return;
        }
        
        $resultRedirect->setUrl($this->_redirect('crud/index/form'));
        
        return $resultRedirect;
    }

}
