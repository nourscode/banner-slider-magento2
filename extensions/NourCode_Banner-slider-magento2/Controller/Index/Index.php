<?php

/**
 * @Author: Alex Dong
 * @Date:   2021-07-12 09:41:19
 * @Last Modified by:   Alex Dong
 * @Last Modified time: 2021-07-12 09:41:27
 */

namespace NourCode\Bannerslider\Controller\Index;

class Index extends \NourCode\Bannerslider\Controller\Index
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

}
