<?php

namespace Xigen\OrderComment\Setup;

use Xigen\OrderComment\Helper\Data\OrderComment;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallData
 * @package Xigen\OrderComment\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var \Magento\Sales\Setup\SalesSetupFactory
     */
    protected $salesSetupFactory;

    /**
     * @var \Magento\Quote\Setup\QuoteSetupFactory
     */
    protected $quoteSetupFactory;

    /**
     * InstallData constructor.
     * @param \Magento\Sales\Setup\SalesSetupFactory $salesSetupFactory
     * @param \Magento\Quote\Setup\QuoteSetupFactory $quoteSetupFactory
     */
    public function __construct(
        \Magento\Sales\Setup\SalesSetupFactory $salesSetupFactory,
        \Magento\Quote\Setup\QuoteSetupFactory $quoteSetupFactory
    ) {
        $this->salesSetupFactory = $salesSetupFactory;
        $this->quoteSetupFactory = $quoteSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $quoteInstaller = $this->quoteSetupFactory->create(['resourceName' => 'quote_setup', 'setup' => $setup]);
        $salesInstaller = $this->salesSetupFactory->create(['resourceName' => 'sales_setup', 'setup' => $setup]);

        $quoteInstaller->addAttribute(
            'quote',
            OrderComment::COMMENT_FIELD_NAME,
            [
                'type' => Table::TYPE_TEXT,
                'length' => '64k',
                'nullable' => true,
                'visible' => true,
                'required' => false,
                'grid' => false
            ]
        );

        $salesInstaller->addAttribute(
            \Magento\Sales\Model\Order::ENTITY,
            OrderComment::COMMENT_FIELD_NAME,
            [
                'type' => Table::TYPE_TEXT,
                'length' => '64k',
                'nullable' => true,
                'visible' => true,
                'required' => false,
                'grid' => false
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_grid'),
            OrderComment::COMMENT_FIELD_NAME,
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => '64k',
                'nullable' => true,
                'comment' => 'Order Comment'
            ]
        );

        $setup->endSetup();
    }
}
