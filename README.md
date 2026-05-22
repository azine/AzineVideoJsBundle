# Azine video.js Bundle for Symfony

A lightweight Symfony bundle that exposes video.js assets for use in Twig templates.

## Requirements

- PHP `^8.5`
- Symfony FrameworkBundle `^7.4`

## Installation

Install via Composer:

```bash
composer require azine/video.js-bundle
```

Enable the bundle (only needed for Symfony versions that do not use Flex auto-registration):

```php
// config/bundles.php
return [
    // ...
    Azine\VideoJsBundle\AzineVideoJsBundle::class => ['all' => true],
];
```

Install bundle assets:

```bash
php bin/console assets:install public
```

## Usage

Reference bundle assets in Twig:

```twig
<link rel="stylesheet" href="{{ asset('bundles/azinevideojs/css/video-js.min.css') }}" />
<script src="{{ asset('bundles/azinevideojs/js/video.min.js') }}"></script>
```

## Development

Run checks locally:

```bash
composer validate --strict --no-check-publish
composer update
composer test
```

## Upgrade notes

### Modernization for PHP 8.5 / Symfony 7.4

- Raised minimum runtime to PHP 8.5.
- Updated Symfony dependency target to FrameworkBundle 7.4.
- Replaced legacy Composer autoload metadata (`target-dir`/PSR-0) with PSR-4 autoloading.
- Added PHPUnit 12 configuration and a baseline test suite entry point.
- Added GitHub Actions CI to validate Composer metadata and run tests on each push and pull request.

## License

Refer to the source code of included video.js files for upstream license details. The bundle itself is Apache-2.0 licensed.
