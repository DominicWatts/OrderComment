<?php

namespace Xigen\OrderComment\Model;

use Magento\Quote\Model\QuoteIdMaskFactory;

/**
 * Class GuestOrderCommentManagement
 * @package Xigen\OrderComment\Model
 */
class GuestOrderCommentManagement implements \Xigen\OrderComment\Api\GuestOrderCommentManagementInterface
{
    /**
     * @var QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;

    /**
     * @var \Xigen\OrderComment\Api\OrderCommentManagementInterface
     */
    protected $orderCommentManagement;

    /**
     * GuestOrderCommentManagement constructor.
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param \Xigen\OrderComment\Api\OrderCommentManagementInterface $orderCommentManagement
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        \Xigen\OrderComment\Api\OrderCommentManagementInterface $orderCommentManagement
    ) {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->orderCommentManagement = $orderCommentManagement;
    }

    /**
     * @param string $cartId
     * @param \Xigen\OrderComment\Api\Data\OrderCommentInterface $orderComment
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface|string
     */
    public function saveOrderComment(
        $cartId,
        \Xigen\OrderComment\Api\Data\OrderCommentInterface $orderComment
    ) {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->orderCommentManagement->saveOrderComment($quoteIdMask->getQuoteId(), $orderComment);
    }
}
