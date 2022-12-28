<?php
/**
 * NourCode
 * @category    NourCode
 * @copyright   Copyright (c) 2014 NourCode (http://www.nourcode.net/)
 * @license     http://www.nourcode.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2016-03-24 11:15:19
 * @@Function:
 */


namespace NourCode\Bannerslider\Block\Adminhtml\Bannerslider\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * construct.
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('bannerslider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Bannerslider Information'));
    }

}
