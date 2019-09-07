<?php

namespace Xigen\OrderComment\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class OrderCommentConfigProvider
 * @package Xigen\OrderComment\Model
 */
class OrderCommentConfigProvider implements ConfigProviderInterface
{
    const CONFIG_MAX_LENGTH = 'xigen_ordercomments/ordercomments/max_length';
    const CONFIG_FIELD_DEFAULT_SHOW = 'xigen_ordercomments/ordercomments/not_collapse';
    const CONFIG_FIELD_CHECKOUT_TITLE = 'xigen_ordercomments/ordercomments/checkouttitle';
    const IS_ORDER_COMMENT_ENABLE = 'xigen_ordercomments/general/enable';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * OrderCommentConfigProvider constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return [
            'max_length' => (int) $this->scopeConfig->getValue(self::CONFIG_MAX_LENGTH),
            'comment_initial_not_collapse' => (int) $this->scopeConfig->getValue(self::CONFIG_FIELD_DEFAULT_SHOW),
            'checkout_title' => $this->scopeConfig->getValue(self::CONFIG_FIELD_CHECKOUT_TITLE),
            'is_ordercomment_enable' => (int) $this->scopeConfig->getValue(self::IS_ORDER_COMMENT_ENABLE)
        ];
    }
}
