<?php

namespace Xigen\OrderComment\Api\Data;

/**
 * Interface OrderCommentInterface
 * @package Xigen\OrderComment\Api\Data
 */
interface OrderCommentInterface
{
    /**
     * @return string|null
     */
    public function getComment();

    /**
     * @param string $comment
     * @return null
     */
    public function setComment($comment);
}
