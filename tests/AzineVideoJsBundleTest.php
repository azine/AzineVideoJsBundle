<?php

declare(strict_types=1);

namespace Azine\VideoJsBundle\Tests;

use Azine\VideoJsBundle\AzineVideoJsBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class AzineVideoJsBundleTest extends TestCase
{
    public function testBundleCanBeInstantiated(): void
    {
        $bundle = new AzineVideoJsBundle();

        self::assertInstanceOf(Bundle::class, $bundle);
    }

    public function testCanonicalAssetsArePackaged(): void
    {
        $root = dirname(__DIR__);

        foreach ([
            'Resources/public/js/video.js',
            'Resources/public/js/video.min.js',
            'Resources/public/css/video-js.css',
            'Resources/public/css/video-js.min.css',
        ] as $asset) {
            self::assertFileExists($root.'/'.$asset, sprintf('Expected packaged asset "%s".', $asset));
            self::assertGreaterThan(0, filesize($root.'/'.$asset));
        }
    }

    public function testDuplicateGeneratedAssetsAreNotPackaged(): void
    {
        $root = dirname(__DIR__);

        foreach ([
            'Resources/public/js/video.dev.min.min.js',
            'Resources/public/js/video.min.min.js',
            'Resources/public/js/video.min.min.min.js',
        ] as $asset) {
            self::assertFileDoesNotExist($root.'/'.$asset);
        }
    }
}
