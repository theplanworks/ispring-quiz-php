# A PHP package to read quiz results from iSpring QuizMaker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/theplan/ispring-quiz-php.svg?style=flat-square)](https://packagist.org/packages/theplan/ispring-quiz-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/theplan/ispring-quiz-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/theplan/ispring-quiz-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/theplan/ispring-quiz-php.svg?style=flat-square)](https://packagist.org/packages/theplan/ispring-quiz-php)

This PHP package helps you parse results from [iSpring QuizMaker](https://www.ispringsolutions.com/ispring-quizmaker) when the presentation is configured to send results to a server.

It requires PHP 8.1+.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/ispring-quiz-php.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/ispring-quiz-php)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require theplan/ispring-quiz-php
```

## Usage

```php
/*
$quizData is the resuest object from QuizMaker
*/
$quizService = new ThePLAN\IspringQuizPhp();
$results = $quizService->parseQuizXml($quizData->detailedResults, $quizData->version);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Matt Fox](https://github.com/mixaster)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
