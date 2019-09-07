<?php

namespace Xigen\OrderComment\Block\Order;

use Xigen\OrderComment\Helper\Data\OrderComment;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context as TemplateContext;

/**
 * Class Comment
 * @package Xigen\OrderComment\Block\Order
 */
class Comment extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Registry|null
     */
    protected $coreRegistry = null;

    /**
     * Comment constructor.
     * @param TemplateContext $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        TemplateContext $context,
        Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->_isScopePrivate = true;
        $this->_template = 'order/view/comment.phtml';
        parent::__construct($context, $data);
    }

    /**
     * @return bool
     */
    public function hasOrderComment()
    {
        return strlen($this->getOrderComment()) > 0;
    }

    /**
     * @return string
     */
    public function getOrderComment()
    {
        return trim($this->getOrder()->getData(OrderComment::COMMENT_FIELD_NAME));
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->coreRegistry->registry('current_order');
    }

    /**
     * @return string
     */
    public function getOrderCommentHtml()
    {
        return nl2br($this->escapeHtml($this->getOrderComment()));
    }
}
