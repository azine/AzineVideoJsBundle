# video.js Bundle for Symfony2

## Current Version

video.js v4.7.2

## Installation

### Add bundle to your composer.json file

``` js
// composer.json

{
    "require": {
        // ...
        "azine/video.js-bundle": "~4.7"
    }
}
```

### Add bundle to your application kernel

``` php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Azine\VideoJsBundle\AzineVideoJsBundle(),
        // ...
    );
}
```

### Download the bundle using Composer

``` bash
$ php composer.phar update azine/video.js-bundle
```

### Install assets

Given your server's public directory is named "web", install the public vendor resources

``` bash
$ php app/console assets:install web
```

Optionally, use the --symlink attribute to create links rather than copies of the resources

``` bash
$ php app/console assets:install --symlink web
```

## Usage

Refer to the desired files in your HTML template, e.g.

``` html
<link rel="stylesheet" type="text/css" href="{{ asset('bundles/azinevideojs/css/video-js.min.css') }}" />
<script type="text/javascript" src="{{ asset('bundles/azinevideojs/js/video.min.js') }}"></script>
```

## Licenses

Refer to the source code of the included files for license information

## References

1. http://www.videojs.com/
2. http://symfony.com
