<?php

namespace Xigen\OrderComment\Model;

use Xigen\OrderComment\Helper\Data\OrderComment;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\ValidatorException;

/**
 * Class OrderCommentManagement
 * @package Xigen\OrderComment\Model
 */
class OrderCommentManagement implements \Xigen\OrderComment\Api\OrderCommentManagementInterface
{
    /**
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * OrderCommentManagement constructor.
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param int $cartId
     * @param \Xigen\OrderComment\Api\Data\OrderCommentInterface $orderComment
     * @return string|null
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     * @throws ValidatorException
     */
    public function saveOrderComment(
        $cartId,
        \Xigen\OrderComment\Api\Data\OrderCommentInterface $orderComment
    ) {
        $quote = $this->quoteRepository->getActive($cartId);
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }
        $comment = $orderComment->getComment();

        $this->validateComment($comment);

        try {
            $quote->setData(OrderComment::COMMENT_FIELD_NAME, strip_tags($comment));
            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('The order comment could not be saved'));
        }

        return $comment;
    }

    /**
     * @param $comment
     * @throws ValidatorException
     */
    protected function validateComment($comment)
    {
        $maxLength = $this->scopeConfig->getValue(OrderCommentConfigProvider::CONFIG_MAX_LENGTH);
        if ($maxLength && (mb_strlen($comment) > $maxLength)) {
            throw new ValidatorException(__('Comment is too long'));
        }
    }
}
