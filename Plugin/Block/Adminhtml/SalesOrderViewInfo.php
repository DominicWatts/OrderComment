<?php

namespace Xigen\OrderComment\Plugin\Block\Adminhtml;

use Xigen\OrderComment\Helper\Data\OrderComment;

/**
 * Class SalesOrderViewInfo
 * @package Xigen\OrderComment\Plugin\Block\Adminhtml
 */
class SalesOrderViewInfo
{
    /**
     * @param \Magento\Sales\Block\Adminhtml\Order\View\Info $subject
     * @param $result
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterToHtml(
        \Magento\Sales\Block\Adminhtml\Order\View\Info $subject,
        $result
    ) {
        $commentBlock = $subject->getLayout()->getBlock('xigen_order_comments');
        if ($commentBlock !== false && $subject->getNameInLayout() == 'order_info') {
            $commentBlock->setOrderComment($subject->getOrder()->getData(OrderComment::COMMENT_FIELD_NAME));
            $result = $result . $commentBlock->toHtml();
        }

        return $result;
    }
}
