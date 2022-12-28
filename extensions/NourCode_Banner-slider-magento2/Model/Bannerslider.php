<?php
/**
 * NourCode
 * @category    NourCode
 * @copyright   Copyright (c) 2014 NourCode (http://www.nourcode.net/)
 * @license     http://www.nourcode.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-11 23:15:05
 * @@Modify Date: 2020-04-26 16:52:18
 * @@Function:
 */

namespace NourCode\Bannerslider\Model;

class Bannerslider extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = 'bannerslider_id';

    /**
     * @var \NourCode\Bannerslider\Model\ResourceModel\Bannerslider\CollectionFactory
     */
    protected $_bannersliderCollectionFactory;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \NourCode\Bannerslider\Model\ResourceModel\Bannerslider\CollectionFactory $bannersliderCollectionFactory,
        \NourCode\Bannerslider\Model\ResourceModel\Bannerslider $resource,
        \NourCode\Bannerslider\Model\ResourceModel\Bannerslider\Collection $resourceCollection
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
        $this->_bannersliderCollectionFactory = $bannersliderCollectionFactory;
    }

}
