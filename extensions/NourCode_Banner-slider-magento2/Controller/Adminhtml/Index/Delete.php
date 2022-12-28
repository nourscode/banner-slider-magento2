<?php
/**
 * NourCode
 * @category    NourCode
 * @copyright   Copyright (c) 2014 NourCode (http://www.nourcode.net/)
 * @license     http://www.nourcode.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2016-04-22 16:56:00
 * @@Function:
 */

namespace NourCode\Bannerslider\Controller\Adminhtml\Index;

class Delete extends \NourCode\Bannerslider\Controller\Adminhtml\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('bannerslider_id');
        try {
            $item = $this->_bannersliderFactory->create()->setId($id);
            $item->delete();
            $this->messageManager->addSuccess(
                __('Delete successfully !')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        $resultRedirect = $this->_resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
