<?php
/**
 * NourCode
 * @category 	NourCode
 * @copyright 	Copyright (c) 2014 NourCode (http://www.nourcode.net/)
 * @license 	http://www.nourcode.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-03-04 11:44:03
 * @@Modify Date: 2016-03-29 13:48:49
 * @@Function:
 */
namespace NourCode\Bannerslider\Block\Adminhtml\Bannerslider\Helper\Grid;

class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /**
     * Store manager.
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Bannerslider factory.
     *
     * @var \Magestore\Bannerslider\Model\BannersliderFactory
     */
    protected $_bannersliderFactory;

    /**
     * [__construct description].
     *
     * @param \Magento\Backend\Block\Context              $context
     * @param \Magento\Store\Model\StoreManagerInterface  $storeManager
     * @param \Magento\Cms\Model\BlockFactory $blockFactory
     * @param array                                       $data
     */
    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \NourCode\Bannerslider\Model\BannersliderFactory $bannersliderFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_bannersliderFactory  = $bannersliderFactory;
    }

    /**
     * Render action.
     *
     * @param \Magento\Framework\DataObject $row
     *
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $storeViewId = $this->getRequest()->getParam('store');
        $item = $this->_bannersliderFactory->create()->setStoreViewId($storeViewId)->load($row->getId());
        $data = json_decode($item->getConfig() ?? '', true);
        if(!isset($data['media_gallery'])) return '<span>' . __('No media.') . '</span>';
        $gallery = $data['media_gallery'];
        $_images = $gallery['images'];
        $src     ='';
        if(is_array($_images)){
            foreach ($_images as $image) {
                $src = $this->_storeManager->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                ) . 'nourcode/bannerslider' . $image['file'];
                break;
            }
        }
        return '<image style="max-width:100px;" src ="'.$src.'" alt="Preview" >';
    }
}
