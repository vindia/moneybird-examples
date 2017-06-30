> Please note that these examples only work with V1 of the Moneybird API. In V2 Moneybird introduced OAuth for authentication and many other things and this is not compatible with these examples. Please check out [EmileBons/moneybird-com-php-api](https://github.com/EmileBons/moneybird-com-php-api) or [picqer/moneybird-php-client](https://github.com/picqer/moneybird-php-client) for PHP libraries that do support V2 of the Moneybird API.

# Moneybird Examples

Just some quick examples of using the Moneybird API in PHP. [Moneybird][mb] is the best online invoicing tool for freelancers and small companies. It's a shame they only operate in The Netherlands.

You'll need their [PHP API class][mb_php_class] to actually use these examples.

For more information, check the excellent [online API documentation][mb_docs] or create an issue in this repository.

[mb]: http://moneybird.nl
[mb_php_class]: https://github.com/bluetools/moneybird_php_api
[mb_docs]: http://www.moneybird.nl/api

## Disclaimer (dragons!)
Please note that in your real live code you might want to be a little bit more defensive in your programming. I've ignored the fact that input can be wrong and don't catch any errors. You might want to do so in your live application.
