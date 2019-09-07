<?php

namespace Xigen\OrderComment\Plugin\Model\Order;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\OrderFactory;

/**
 * Class LoadOrderComment
 * @package Xigen\OrderComment\Plugin\Model\Order
 */
class LoadOrderComment
{
    /**
     * @var OrderFactory
     */
    private $orderFactory;

    /**
     * @var OrderExtensionFactory
     */
    private $orderExtensionFactory;

    /**
     * LoadOrderComment constructor.
     * @param OrderFactory $orderFactory
     * @param OrderExtensionFactory $extensionFactory
     */
    public function __construct(
        OrderFactory $orderFactory,
        OrderExtensionFactory $extensionFactory
    ) {
        $this->orderFactory = $orderFactory;
        $this->orderExtensionFactory = $extensionFactory;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $resultOrder
     * @return OrderInterface
     */
    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface $resultOrder
    ) {
        $this->setOrderComment($resultOrder);
        return $resultOrder;
    }

    /**
     * @param OrderInterface $order
     */
    public function setOrderComment(OrderInterface $order)
    {
        if ($order instanceof \Magento\Sales\Model\Order) {
            $value = $order->getOrderComment();
        } else {
            $temp = $this->getOrderFactory()->create();
            $temp->load($order->getId());
            $value = $temp->getOrderComment();
        }

        $extensionAttributes = $order->getExtensionAttributes();
        $orderExtension = $extensionAttributes ? $extensionAttributes : $this->getOrderExtensionFactory()->create();
        $orderExtension->setOrderComment($value);
        $order->setExtensionAttributes($orderExtension);
    }

    /**
     * @return OrderFactory
     */
    public function getOrderFactory()
    {
        return $this->orderFactory;
    }

    /**
     * @return OrderExtensionFactory
     */
    public function getOrderExtensionFactory()
    {
        return $this->orderExtensionFactory;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param \Magento\Sales\Api\Data\OrderSearchResultInterface $orderSearchResult
     * @return \Magento\Sales\Api\Data\OrderSearchResultInterface
     */
    public function afterGetList(
        OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderSearchResultInterface $orderSearchResult
    ) {
        foreach ($orderSearchResult->getItems() as $order) {
            $this->setOrderComment($order);
        }
        return $orderSearchResult;
    }
}
