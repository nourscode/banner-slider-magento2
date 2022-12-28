<?php
/**
 * NourCode
 * @category    NourCode
 * @copyright   Copyright (c) 2014 NourCode (http://www.nourcode.net/)
 * @license     http://www.nourcode.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-01-11 23:15:05
 * @@Modify Date: 2017-02-6 21:27:23
 * @@Function:
 */

namespace NourCode\Bannerslider\Model\Widget\Config;

class Slider implements \Magento\Framework\Option\ArrayInterface
{

	protected $scopeConfig;
	protected $_bannerslider;

	public function __construct(
		// \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\NourCode\Bannerslider\Model\Bannerslider $bannerslider
	)
	{
		$this->_bannerslider = $bannerslider;
	}

    public function toOptionArray()
    {
		$bannerslider = $this->_bannerslider->getCollection();
		$options = array();
		foreach ($bannerslider as $item) {
			$options[$item->getIdentifier()] = $item->getTitle();
		}
        return $options;
    }

}
