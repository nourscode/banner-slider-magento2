<?php
/**
 * NourCode
 * @category    NourCode
 * @copyright   Copyright (c) 2014 NourCode (http://www.nourcode.net/)
 * @license     http://www.nourcode.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2016-04-22 16:54:37
 * @@Function:
 */

namespace NourCode\Bannerslider\Controller\Adminhtml\Index;

class MassStatus extends \NourCode\Bannerslider\Controller\Adminhtml\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $bannersliderIds = $this->getRequest()->getParam('bannerslider');
        $status = $this->getRequest()->getParam('status');
        $storeViewId = $this->getRequest()->getParam('store');
        if (!is_array($bannersliderIds) || empty($bannersliderIds)) {
            $this->messageManager->addError(__('Please select Bannerslider(s).'));
        } else {
            $collection = $this->_bannersliderCollectionFactory->create()
                // ->setStoreViewId($storeViewId)
                ->addFieldToFilter('bannerslider_id', ['in' => $bannersliderIds]);
            try {
                foreach ($collection as $item) {
                    $item->setStoreViewId($storeViewId)
                        ->setStatus($status)
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been changed status.', count($bannersliderIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $resultRedirect = $this->_resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/', ['store' => $this->getRequest()->getParam('store')]);
    }
}
