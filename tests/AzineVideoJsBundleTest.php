<?php

declare(strict_types=1);

namespace Azine\VideoJsBundle\Tests;

use Azine\VideoJsBundle\AzineVideoJsBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class AzineVideoJsBundleTest extends TestCase
{
    private const PUBLIC_ASSETS = [
        'Resources/public/js/video.dev.js',
        'Resources/public/js/video.dev.min.js',
        'Resources/public/js/video.js',
        'Resources/public/js/video.min.js',
        'Resources/public/css/video-js.css',
        'Resources/public/css/video-js.min.css',
        'Resources/public/font/vjs.eot',
        'Resources/public/font/vjs.svg',
        'Resources/public/font/vjs.ttf',
        'Resources/public/font/vjs.woff',
    ];

    public function testBundleCanBeInstantiated(): void
    {
        $bundle = new AzineVideoJsBundle();

        self::assertInstanceOf(Bundle::class, $bundle);
        self::assertSame(dirname(__DIR__), $bundle->getPath());
        self::assertSame('AzineVideoJsBundle', $bundle->getName());
    }

    public function testCompletePublicAssetContractIsPackaged(): void
    {
        $root = dirname(__DIR__);

        foreach (self::PUBLIC_ASSETS as $asset) {
            $path = $root.'/'.$asset;
            self::assertFileExists($path, sprintf('Expected packaged asset "%s".', $asset));
            self::assertGreaterThan(0, filesize($path), sprintf('Expected non-empty asset "%s".', $asset));
        }
    }

    public function testCssFontReferencesResolveInsideThePublicAssetTree(): void
    {
        $root = dirname(__DIR__);
        $css = file_get_contents($root.'/Resources/public/css/video-js.css');

        self::assertIsString($css);

        foreach ([
            '../font/vjs.eot',
            '../font/vjs.woff',
            '../font/vjs.ttf',
            '../font/vjs.svg#icomoon',
        ] as $reference) {
            self::assertStringContainsString($reference, $css);
            $filesystemReference = preg_replace('/[#?].*$/', '', $reference);
            self::assertNotNull($filesystemReference);
            self::assertFileExists($root.'/Resources/public/css/'.$filesystemReference);
        }
    }

    public function testAssetsInstallTargetContractIsStable(): void
    {
        $bundle = new AzineVideoJsBundle();
        $source = $bundle->getPath().'/Resources/public';
        $targetPrefix = 'bundles/'.strtolower($bundle->getName());

        self::assertDirectoryExists($source);
        self::assertSame('bundles/azinevideojsbundle', $targetPrefix);

        foreach (self::PUBLIC_ASSETS as $asset) {
            $relative = substr($asset, strlen('Resources/public/'));
            self::assertNotFalse($relative);
            self::assertFileExists($source.'/'.$relative);
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
