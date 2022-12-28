<?php
/**
 * NourCode
 * @category    NourCode
 * @copyright   Copyright (c) 2014 NourCode (http://www.nourcode.net/)
 * @license     http://www.nourcode.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2020-04-26 13:54:35
 * @@Function:
 */

namespace NourCode\Bannerslider\Block\Adminhtml\Bannerslider\Edit\Tab;

use NourCode\Bannerslider\Model\Status;

class Form extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Framework\DataObjectFactory
     */
    protected $_objectFactory;

    /**
     * @var \NourCode\Bannerslider\Model\Bannerslider
     */

    protected $_bannerslider;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;


    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\DataObjectFactory $objectFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \NourCode\Bannerslider\Model\Bannerslider $bannerslider,
        array $data = []
    ) {
        $this->_objectFactory = $objectFactory;
        $this->_bannerslider = $bannerslider;
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * prepare layout.
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());
        return $this;
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->getBannerslider();

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('media_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Bannerslider Information')]);

        if ($model->getId()) {
            $fieldset->addField('bannerslider_id', 'hidden', ['name' => 'bannerslider_id']);
        }

        $fieldset->addField('title', 'text',
            [
                'label' => __('Title'),
                'title' => __('Title'),
                'name'  => 'title',
                'required' => true,
            ]
        );

        $identifier = $fieldset->addField('identifier', 'text',
            [
                'label' => __('Identifier'),
                'title' => __('Identifier'),
                'name'  => 'identifier',
                'required' => true,
                'class' => 'validate-xml-identifier',
            ]
        );

        if($this->getRequest()->getParam('bannerslider_id')){
            $identifier->setAfterElementHtml(
                '<p class="nm"><small>Don\'t change Identifier</small></p>
                <script type="text/javascript">
                require([
                    "jquery",
                ],  function($){
                        jQuery(document).ready(function($) {
                            var identifier  = "#'.$identifier->getHtmlId().'";
                            if ($(identifier).val()) {$(identifier).prop("disabled", true); }
                        })
                })
                </script>
                '
            );
        }

        $fieldset->addField(
            'exclude_lazyload_visible',
            'select',
            [
                'label' => __('Load visible images'),
                'title' => __('Load visible images'),
                'name' => 'exclude_lazyload_visible',
                'options' => ['0' => __('No'), '1' => __('Yes')],
                'value' => 0,
                'after_element_html' => '<small>Not use lazyload with Images Visible. This feature require module a <a href="https://magepow.com/magento2-speed-optimizer.html?refer=bannerslider">Magepow_SpeedOptimizer</a></small>',
            ]
        );

        $fieldset->addField(
            'background-image',
            'select',
            [
                'label' => __('Show image as background'),
                'title' => __('Show image as background'),
                'name' => 'background-image',
                'options' => ['0' => __('No'), '1' => __('Yes')],
                'value' => 0,
                'after_element_html' => '<small>This feature require module a <a href="https://magepow.com/magento2-speed-optimizer.html?refer=bannerslider">Magepow_SpeedOptimizer</a></small>',
            ]
        );

        $fieldset->addField(
            'IntersectionObserver',
            'select',
            [
                'label' => __('Use IntersectionObserver'),
                'title' => __('Use IntersectionObserver'),
                'name' => 'useIntersectionObserver',
                'options' => ['0' => __('No'), '1' => __('Yes')],
                'value' => 0,
                'after_element_html' => '<small>This feature can read more here <a href="https://developer.mozilla.org/en-US/docs/Web/API/IntersectionObserver">IntersectionObserver</a></small>',
            ]
        );

        $fieldset->addField('image-class', 'text',
            [
                'label' => __('Image class'),
                'title' => __('Image class'),
                'name'  => 'image-class',
                'required' => false,
                // 'value' => 'loaded',
            ]
        );


        /* Check is single store mode */
        if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'stores',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true)
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'stores',
                'hidden',
                ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
            $model->setStoreId($this->_storeManager->getStore(true)->getId());
        }


        $fieldset->addField('status', 'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'options' => Status::getOptionArray(),
                'value' => 1,
            ]
        );

        $form->addValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return mixed
     */
    public function getBannerslider()
    {
        return $this->_coreRegistry->registry('bannerslider');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getPageTitle()
    {
        return $this->getBannerslider()->getId()
            ? __("Edit Bannerslider '%1'", $this->escapeHtml($this->getBannerslider()->getName())) : __('New Bannerslider');
    }

    /**
     * Prepare label for tab.
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('General Information');
    }

    /**
     * Prepare title for tab.
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

}
