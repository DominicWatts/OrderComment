<?php

namespace Xigen\OrderComment\Helper\Data;

use Xigen\OrderComment\Api\Data\OrderCommentInterface;
use Magento\Framework\Api\AbstractSimpleObject;

/**
 * Class OrderComment
 * @package Xigen\OrderComment\Helper\Data
 */
class OrderComment extends AbstractSimpleObject implements OrderCommentInterface
{
    const COMMENT_FIELD_NAME = 'order_comment';

    /**
     * @return mixed|string|null
     */
    public function getComment()
    {
        return $this->_get(static::COMMENT_FIELD_NAME);
    }

    /**
     * @param string $comment
     * @return OrderComment|null
     */
    public function setComment($comment)
    {
        return $this->setData(static::COMMENT_FIELD_NAME, $comment);
    }
}
