<?php
/**
 * NourCode
 * @category    NourCode
 * @copyright   Copyright (c) 2014 NourCode (http://www.nourcode.net/)
 * @license     http://www.nourcode.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2016-04-22 16:54:02
 * @@Function:
 */

namespace NourCode\Bannerslider\Controller\Adminhtml\Index;

class Edit extends \NourCode\Bannerslider\Controller\Adminhtml\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('bannerslider_id');
        $storeViewId = $this->getRequest()->getParam('store');
        $model = $this->_bannersliderFactory->create();

        if ($id) {
            $model->setStoreViewId($storeViewId)->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This Bannerslider no longer exists.'));
                $resultRedirect = $this->_resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }else {
                if($model->getData('config')){
                    $tmp = json_decode($model->getData('config'), true);
                    if(is_array($tmp)){
                        // unset($tmp['form_key']);
                        unset($tmp['bannerslider_id']);
                        $model->addData($tmp);
                    }
                }
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $model->setData('media_attributes', array());

        // $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        // $model = $objectManager->get('Magento\Catalog\Model\Product')->load(3);

        $this->_coreRegistry->register('bannerslider', $model);
        $this->_coreRegistry->register('current_product', $model, 1);
        $this->_coreRegistry->register('product', $model, 1);
        $resultPage = $this->_resultPageFactory->create();

        return $resultPage;
    }
}
