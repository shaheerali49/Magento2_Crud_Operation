<?php
namespace Ktpl\Crud\Controller\Adminhtml\crud;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ktpl_Crud::crud');
        $resultPage->addBreadcrumb(__('Ktpl'), __('Ktpl'));
        $resultPage->addBreadcrumb(__('Manage item'), __('Manage item'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage item'));

        return $resultPage;
    }
}
?>