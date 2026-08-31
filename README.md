# Azine video.js Bundle for Symfony

A lightweight Symfony bundle that exposes the existing Video.js 4.7.2 assets used by Azine applications.

## Requirements

- PHP `^8.5`
- Symfony FrameworkBundle `^7.4`

## Installation

Install via Composer:

```bash
composer require azine/video.js-bundle:^2.0
```

Enable the bundle when it is not registered automatically:

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

Symfony installs the bundle public tree below:

```text
public/bundles/azinevideojs/
```

## Public asset contract

The 2.x release keeps these public paths stable:

```text
bundles/azinevideojs/js/video.js
bundles/azinevideojs/js/video.min.js
bundles/azinevideojs/js/video.dev.js
bundles/azinevideojs/js/video.dev.min.js
bundles/azinevideojs/css/video-js.css
bundles/azinevideojs/css/video-js.min.css
bundles/azinevideojs/font/vjs.eot
bundles/azinevideojs/font/vjs.svg
bundles/azinevideojs/font/vjs.ttf
bundles/azinevideojs/font/vjs.woff
```

The CSS references the font files relatively (`../font/...`), so the complete `css/` and `font/` directories must be installed together.

Three accidental multiply-minified JavaScript artifacts from older repository history are intentionally not part of the supported contract:

```text
video.dev.min.min.js
video.min.min.js
video.min.min.min.js
```

## Usage

Reference bundle assets in Twig:

```twig
<link rel="stylesheet" href="{{ asset('bundles/azinevideojs/css/video-js.min.css') }}" />
<script src="{{ asset('bundles/azinevideojs/js/video.min.js') }}"></script>
```

Existing Video.js markup and initialization can remain unchanged; this upgrade changes the PHP/Symfony packaging layer, not the player API or bundled Video.js version.

## Development

Run checks locally:

```bash
composer validate --strict --no-check-publish
composer update
vendor/bin/phpunit -c phpunit.xml.dist
```

CI runs PHP 8.5 against both the current stable and lowest supported dependency sets. It also lints PHP and fails on PHPUnit skips, notices and deprecations.

## Upgrade notes

### PHP 8.5 / Symfony 7.4

- Raised the runtime requirement to PHP 8.5.
- Targets Symfony FrameworkBundle 7.4.
- Replaced legacy Composer PSR-0/`target-dir` metadata with PSR-4 autoloading.
- Uses PHPUnit 12.5 and GitHub Actions CI.
- Tests the complete supported JavaScript, CSS and font asset contract.
- Preserves the existing `bundles/azinevideojs/...` public URLs after `assets:install`.
- Removes only duplicate generated JavaScript files that were not part of the supported consumer contract.

## License

Refer to the source code of included Video.js files for upstream license details. The bundle itself is Apache-2.0 licensed.
