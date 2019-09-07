<?php

namespace Xigen\OrderComment\Api;

/**
 * Interface OrderCommentManagementInterface
 * @package Xigen\OrderComment\Api
 */
interface OrderCommentManagementInterface
{
    /**
     * @param int $cartId
     * @param \Xigen\OrderComment\Api\Data\OrderCommentInterface $orderComment
     * @return string
     */
    public function saveOrderComment(
        $cartId,
        \Xigen\OrderComment\Api\Data\OrderCommentInterface $orderComment
    );
}
