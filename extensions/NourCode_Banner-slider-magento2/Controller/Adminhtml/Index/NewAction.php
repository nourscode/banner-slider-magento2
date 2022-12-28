<?php
/**
 * NourCode
 * @category 	NourCode
 * @copyright 	Copyright (c) 2014 NourCode (http://www.nourcode.net/)
 * @license 	http://www.nourcode.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2016-04-22 16:53:42
 * @@Function:
 */

namespace NourCode\Bannerslider\Controller\Adminhtml\Index;

class NewAction extends \NourCode\Bannerslider\Controller\Adminhtml\Action
{
    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}
