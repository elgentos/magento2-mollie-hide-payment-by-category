<?php

namespace Elgentos\MollieHidePaymentByCategory\Plugin;

use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Mollie\Payment\Model\Mollie;
use Magento\Quote\Api\Data\CartInterface;

class AroundMethod
{
    private ScopeConfigInterface $scopeConfig;
    private Cart $cart;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Cart $cart
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->cart = $cart;
    }

    public function aroundIsAvailable(
        Mollie $subject,
        callable $proceed,
        CartInterface $quote = null
    ) {
        $excludedCategories = $this->scopeConfig->getValue('payment/' . $subject::CODE . '/exclude_categories');

        if (!$excludedCategories) {
            return $proceed($quote);
        }

        $excludedCategories = explode(',', $excludedCategories);

        foreach ($this->cart->getQuote()->getAllItems() as $item) {
            $categories = $item->getProduct()->getCategoryIds();
            if (array_intersect($excludedCategories, $categories)) {
                return false;
            }
        }

        return $proceed($quote);
    }
}
