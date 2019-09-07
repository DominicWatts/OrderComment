<?php

namespace Xigen\OrderComment\Observer;

use Xigen\OrderComment\Helper\Data\OrderComment;

/**
 * Class AddOrderCommentToOrder
 * @package Xigen\OrderComment\Observer
 */
class AddOrderCommentToOrder implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        $order->setData(OrderComment::COMMENT_FIELD_NAME, $quote->getData(OrderComment::COMMENT_FIELD_NAME));
    }
}
