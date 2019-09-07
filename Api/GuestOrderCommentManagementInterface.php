<?php

namespace Xigen\OrderComment\Api;

/**
 * Interface GuestOrderCommentManagementInterface
 * @package Xigen\OrderComment\Api
 */
interface GuestOrderCommentManagementInterface
{
    /**
     * @param string $cartId
     * @param \Xigen\OrderComment\Api\Data\OrderCommentInterface $orderComment
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function saveOrderComment(
        $cartId,
        \Xigen\OrderComment\Api\Data\OrderCommentInterface $orderComment
    );
}
