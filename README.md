# elgentos/magento2-mollie-hide-payment-by-category

## Magento 2 module to hide Mollie payment methods based on category

This module allows you to hide Mollie payment methods based on category. This is useful if you want to hide payment methods like Klarna or Afterpay for certain categories.

## Installation

```
composer require elgentos/magento2-mollie-hide-payment-by-category
php bin/magento s:up
```

## Configuration

Go to Stores > Configuration > Mollie > Payment Methods and you can select the categories for which you want to hide per payment method.