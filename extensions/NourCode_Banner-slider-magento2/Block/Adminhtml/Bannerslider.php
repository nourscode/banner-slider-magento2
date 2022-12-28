<?php
/**
 * NourCode
 * @category    NourCode
 * @copyright   Copyright (c) 2014 NourCode (http://www.nourcode.net/)
 * @license     http://www.nourcode.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2016-02-29 14:25:17
 * @@Function:
 */

namespace NourCode\Bannerslider\Block\Adminhtml;

class Bannerslider extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor.
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_bannerslider';
        $this->_blockGroup = 'NourCode_Bannerslider';
        $this->_headerText = __('Bannerslider');
        $this->_addButtonLabel = __('Add New Bannerslider');
        parent::_construct();
    }
}
