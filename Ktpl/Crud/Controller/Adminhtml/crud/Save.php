<?php

namespace Ktpl\Crud\Controller\Adminhtml\crud;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action {

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context) {
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
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

            $id = $this->getRequest()->getParam('crud_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The item has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['crud_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the item.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['crud_id' => $this->getRequest()->getParam('crud_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}
