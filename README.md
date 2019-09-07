# Order Comments #

Order Comment Extension to enable customer to leave order comments on the checkout.  The comment is then visible in the admin.

# Install instructions #

`composer require dominicwatts/ordercomment`

`php bin/magento setup:upgrade`

`php bin/magento setup:di:compile`

I recommend that you redeploy the static content in your theme

`php bin/magento setup:static-content:deploy`